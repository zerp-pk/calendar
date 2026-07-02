<?php

namespace Zerp\Calendar\Listeners;

use Zerp\School\Events\CreateEvent;
use Zerp\Calendar\Models\CalenderUtility;

class CreateSchoolEventListener
{
    public function handle(CreateEvent $event)
    {
        if (module_is_active('Calendar') && $event->request->get('sync_to_google_calendar') == true) {
            $calendarSchoolEvent = $event->event;
            $calendarRequest = $event->request;
            
            $type = 'school_event';
            $calendarSchoolEvent->title = $calendarRequest->title;
            $calendarSchoolEvent->start_date = $calendarRequest->event_date . ' ' . $calendarRequest->start_time;
            $calendarSchoolEvent->end_date = $calendarRequest->event_date . ' ' . $calendarRequest->end_time ;

            CalenderUtility::addCalendarData($calendarSchoolEvent, $type, $calendarSchoolEvent->created_by);
        }
    }
}