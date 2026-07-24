<?php

namespace Zerp\Calendar\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Zerp\Calendar\Http\Requests\Api\UpdateCalendarSettingsApiRequest;

/**
 * Read and update this company's Google Calendar integration settings. Values
 * live in the shared company settings store (keyed by creatorId), the same
 * place the web CalendarSettingsController reads and writes.
 */
class SettingsApiController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            if (!Auth::user()->can('manage-calendar')) {
                return $this->errorResponse(__('Permission denied'), null, 403);
            }

            $creatorId = creatorId();

            $hasTokens = (bool) (company_setting('google_calendar_token', $creatorId)
                && company_setting('google_calendar_refresh_token', $creatorId));

            return $this->successResponse([
                'google_calendar_id' => company_setting('google_calendar_id', $creatorId),
                'google_calendar_enable' => company_setting('google_calendar_enable', $creatorId),
                'has_json_file' => (bool) company_setting('google_calendar_json_file', $creatorId),
                'has_tokens' => $hasTokens,
            ], __('Calendar settings retrieved successfully'));
        } catch (\Throwable $e) {
            Log::error('Calendar settings API index error', ['e' => $e]);
            return $this->errorResponse(__('Something went wrong'), null, 500);
        }
    }

    public function update(UpdateCalendarSettingsApiRequest $request)
    {
        try {
            if (!Auth::user()->can('edit-google-calendar-settings')) {
                return $this->errorResponse(__('Permission denied'), null, 403);
            }

            $settings = $request->input('settings', []);

            if ($request->hasFile('json_file')) {
                $settings['google_calendar_json_file'] = file_get_contents($request->file('json_file')->getRealPath());
            }

            foreach ($settings as $key => $value) {
                setSetting($key, $value, creatorId());
            }

            return $this->successResponse(null, __('Google Calendar settings saved successfully'));
        } catch (\Throwable $e) {
            Log::error('Calendar settings API update error', ['e' => $e]);
            return $this->errorResponse(__('Something went wrong'), null, 500);
        }
    }
}
