<?php

namespace Zerp\Calendar\Listeners;

use Zerp\Jitsi\Events\CreateJitsiMeeting;
use Zerp\Calendar\Models\CalenderUtility;

class CreateJitsiMeetingListener
{
    public function handle(CreateJitsiMeeting $event)
    {
        if (module_is_active('Calendar') && $event->request->get('sync_to_google_calendar') == true) {
            $calendarJitsiMeeting = $event->meeting;
            $calendarRequest = $event->request;

            $type = 'jitsi_meeting';
            $calendarJitsiMeeting->title = $calendarRequest->title;
            $calendarJitsiMeeting->start_date = $calendarRequest->start_time;
            $calendarJitsiMeeting->end_date = $calendarRequest->start_time;

            CalenderUtility::addCalendarData($calendarJitsiMeeting, $type, $calendarJitsiMeeting->created_by);
        }
    }
}
