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
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->totalUsers = User::count();
        $this->totalTransportRequests = TransportRequest::count();
        $this->totalTransportSchedules = TransportSchedule::count();
        $this->totalSchoolVehicles = SchoolVehicle::count('id');
        $this->totalSchoolDrivers = SchoolDriver::count('id');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-dashboard');
    }
}
