<?php

namespace Zerp\Calendar\Http\Requests\Api;

use App\Http\Requests\ApiFormRequest;

/**
 * Body for POST /api/calendar/settings. Mirrors the web
 * CalendarSettingsController::store: the service-account JSON can arrive either
 * as an uploaded file (json_file) or inline in settings.google_calendar_json_file.
 */
class UpdateCalendarSettingsApiRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'settings.google_calendar_json_file' => 'nullable|string',
            'settings.google_calendar_id' => 'nullable|string',
            'settings.google_calendar_enable' => 'required|string',
            'json_file' => 'nullable|file|mimes:json|max:2048',
        ];
    }
}
