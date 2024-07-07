<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\TransportSchedule;

class TripStatusBar extends Component
{
    public $inProgressCount;
    public $completedCount;
    public $cancelledCount;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->inProgressCount = TransportSchedule::where('status', 'In Progress')->count();
        $this->completedCount = TransportSchedule::where('status', 'Completed')->count();
        $this->cancelledCount = TransportSchedule::where('status', 'Cancelled')->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.trip-status-bar');
    }
}
