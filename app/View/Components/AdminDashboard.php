<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;
use App\Models\TransportRequest;
use App\Models\TransportSchedule;
use App\Models\SchoolVehicle;
use App\Models\SchoolDriver;

class AdminDashboard extends Component
{
    public $totalUsers;
    public $totalTransportRequests;
    public $totalTransportSchedules;
    public $totalSchoolVehicles;
    public $totalSchoolDrivers;
    public $requestApprovalRate;
    public $peakRequestMonth;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        /* Analytics */
        // Total Counts
        $this->totalUsers = User::count();
        $this->totalTransportRequests = TransportRequest::count();
        $this->totalTransportSchedules = TransportSchedule::count();
        $this->totalSchoolVehicles = SchoolVehicle::count('id');
        $this->totalSchoolDrivers = SchoolDriver::count('id');

        // Request approval rate
        $this->requestApprovalRate = number_format((TransportRequest::where('status', 'Approved')->count() / $this->totalTransportRequests) * 100, 2);

        // Peak request month
        $this->peakRequestMonth = TransportRequest::selectRaw('MONTH(event_date) as month, count(*) as requests')
            ->groupBy('month')
            ->orderBy('requests', 'desc')
            ->first();

        // Return the month name
        $this->peakRequestMonth = date('F', mktime(0, 0, 0, $this->peakRequestMonth->month, 10));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-dashboard');
    }
}
