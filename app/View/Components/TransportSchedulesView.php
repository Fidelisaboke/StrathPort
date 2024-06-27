<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\TransportSchedule;

class TransportSchedulesView extends Component
{
    public $transport_schedules;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->transport_schedules = TransportSchedule::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transport-schedules-view');
    }
}
