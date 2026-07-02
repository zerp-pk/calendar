<?php

namespace Zerp\Calendar\Providers;

use App\Events\DefaultData;
use App\Events\GivePermissionToRole;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Zerp\Appointment\Events\AppointmentStatus;
use Zerp\Lead\Events\CreateDealTask;
use Zerp\Lead\Events\CreateLeadTask;
use Zerp\CMMS\Events\CreateWorkOrder;
use Zerp\Contract\Events\CreateContract;
use Zerp\GoogleMeet\Events\CreateGoogleMeeting;
use Zerp\Jitsi\Events\CreateJitsiMeeting;
use Zerp\HospitalManagement\Events\UpdateHospitalAppointmentStatus;
use Zerp\Sales\Events\CreateSalesCall;
use Zerp\ZoomMeeting\Events\CreateZoomMeeting;
use Zerp\Sales\Events\CreateSalesMeeting;
use Zerp\School\Events\CreateEvent;
use Zerp\Taskly\Events\CreateProjectTask;
use Zerp\ToDo\Events\CreateToDo;
use Zerp\TeamWorkload\Events\CreateTeamWorkloadHoliday;
use Zerp\Recruitment\Events\CreateInterview;
use Zerp\Hrm\Events\CreateLeaveApplication;
use Zerp\Hrm\Events\CreateEvent as HrmCreateEvent;
use App\Events\CreateSalesInvoice;
use App\Events\CreatePurchaseInvoice;

use Zerp\Calendar\Listeners\CreateDealTaskLis;
use Zerp\Calendar\Listeners\CreateLeadTaskLis;
use Zerp\Calendar\Listeners\CreateWorkorderLis;
use Zerp\Calendar\Listeners\CreateAppointmentStatusListener;
use Zerp\Calendar\Listeners\CreateContractListener;
use Zerp\Calendar\Listeners\CreateGoogleMeetingListener;
use Zerp\Calendar\Listeners\CreateJitsiMeetingListener;
use Zerp\Calendar\Listeners\CreateHospitalAppointmentListener;
use Zerp\Calendar\Listeners\CreateSalesCallListener;
use Zerp\Calendar\Listeners\CreateZoomMeetingListener;
use Zerp\Calendar\Listeners\CreateSalesMeetingListener;
use Zerp\Calendar\Listeners\CreateSchoolEventListener;
use Zerp\Calendar\Listeners\CreateProjectTaskListener;
use Zerp\Calendar\Listeners\CreateToDoListener;
use Zerp\Calendar\Listeners\CreateTeamWorkloadHolidayListener;
use Zerp\Calendar\Listeners\CreateInterviewListener;
use Zerp\Calendar\Listeners\CreateLeaveApplicationListener;
use Zerp\Calendar\Listeners\CreateEventListener;
use Zerp\Calendar\Listeners\CreateSalesInvoiceListener;
use Zerp\Calendar\Listeners\CreatePurchaseInvoiceListener;
use Zerp\Calendar\Listeners\DataDefault;
use Zerp\Calendar\Listeners\GiveRoleToPermission;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        DefaultData::class => [
            DataDefault::class,
        ],
        GivePermissionToRole::class => [
            GiveRoleToPermission::class,
        ],
        CreateDealTask::class => [
            CreateDealTaskLis::class,
        ],
        CreateLeadTask::class => [
            CreateLeadTaskLis::class,
        ],
        CreateWorkOrder::class => [
            CreateWorkorderLis::class,
        ],
        AppointmentStatus::class => [
            CreateAppointmentStatusListener::class,
        ],
        CreateContract::class => [
            CreateContractListener::class,
        ],
        CreateGoogleMeeting::class => [
            CreateGoogleMeetingListener::class,
        ],
        CreateJitsiMeeting::class => [
            CreateJitsiMeetingListener::class,
        ],
        UpdateHospitalAppointmentStatus::class => [
            CreateHospitalAppointmentListener::class,
        ],
        CreateZoomMeeting::class => [
            CreateZoomMeetingListener::class,
        ],
        CreateSalesCall::class => [
            CreateSalesCallListener::class,
        ],
        CreateSalesMeeting::class => [
            CreateSalesMeetingListener::class,
        ],
        CreateEvent::class => [
            CreateSchoolEventListener::class,
        ],
        CreateProjectTask::class => [
            CreateProjectTaskListener::class,
        ],
        CreateToDo::class => [
            CreateToDoListener::class,
        ],
        CreateTeamWorkloadHoliday::class => [
            CreateTeamWorkloadHolidayListener::class,
        ],
        CreateInterview::class => [
            CreateInterviewListener::class,
        ],
        CreateLeaveApplication::class => [
            CreateLeaveApplicationListener::class,
        ],
        HrmCreateEvent::class => [
            CreateEventListener::class,
        ],
        CreateSalesInvoice::class => [
            CreateSalesInvoiceListener::class,
        ],
        CreatePurchaseInvoice::class => [
            CreatePurchaseInvoiceListener::class,
        ],
    ];
}
