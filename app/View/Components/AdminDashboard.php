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
use App\Models\CarpoolDriver;
use App\Models\CarpoolVehicle;

class AdminDashboard extends Component
{
    public $totalUsers;
    public $totalTransportRequests;
    public $totalTransportSchedules;
    public $totalSchoolVehicles;
    public $totalSchoolDrivers;
    public $requestApprovalRate;
    public $peakRequestMonth;
    public $totalcarpoolDrivers;
    public $totalcarpoolVehicles;
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
        $this->totalcarpoolDrivers = CarpoolDriver::count('id');
        $this->totalcarpoolVehicles = CarpoolVehicle::count('id');

        // Request approval rate
        $total = $this->totalTransportRequests;
        $this->requestApprovalRate = $total > 0 
            ? number_format((TransportRequest::where('status', 'Approved')->count() / $total) * 100, 2)
            : 0;

        // Peak request month
        $peak = TransportRequest::selectRaw('EXTRACT(MONTH FROM event_date) as month, count(*) as requests')
            ->groupBy('month')
            ->orderBy('requests', 'desc')
            ->first();

        // Return the month name
        if ($peak && $peak->month) {
            $this->peakRequestMonth = date('F', mktime(0, 0, 0, $peak->month, 10));
        } else {
            $this->peakRequestMonth = 'N/A';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-dashboard');
    }
}
