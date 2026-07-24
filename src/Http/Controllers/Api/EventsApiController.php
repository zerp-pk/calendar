<?php

namespace Zerp\Calendar\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Zerp\Calendar\Http\Controllers\CalendarController;

/**
 * Read-only calendar feed. The calendar module owns no events of its own; it
 * aggregates them from whichever modules are active (invoices, HRM leave and
 * holidays, lead tasks, contracts, meetings, ...). This endpoint reuses the
 * exact aggregation the web calendar renders, via
 * CalendarController::collectCalendarData, so the two feeds never drift.
 *
 * Query params: calendar_type (local|google, default local), module_filter
 * (an event type key or 'all', default all).
 */
class EventsApiController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        try {
            if (!Auth::user()->can('manage-calendar')) {
                return $this->errorResponse(__('Permission denied'), null, 403);
            }

            $data = app(CalendarController::class)->collectCalendarData($request);

            if ($data['googleError']) {
                return $this->errorResponse($data['googleError'], null, 502);
            }

            return $this->successResponse([
                'events' => $data['events'],
                'available_filters' => $data['availableFilters'],
                'calendar_type' => $data['calendarType'],
                'module_filter' => $data['moduleFilter'],
                'has_google_calendar_config' => $data['hasGoogleCalendarConfig'],
            ], __('Calendar events retrieved successfully'));
        } catch (\Throwable $e) {
            Log::error('Calendar events API error', ['e' => $e]);
            return $this->errorResponse(__('Something went wrong'), null, 500);
        }
    }
}
