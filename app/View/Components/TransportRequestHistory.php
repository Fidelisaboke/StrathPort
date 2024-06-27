<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\TransportRequest;

class TransportRequestHistory extends Component
{
    public $transport_requests;
    public $pending_count, $approved_count, $declined_count;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->transport_requests = TransportRequest::all();
        $this->pending_count = TransportRequest::where('status', 'Pending')->count();
        $this->approved_count = TransportRequest::where('status', 'Approved')->count();
        $this->declined_count = TransportRequest::where('status', 'Declined')->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transport-request-history');
    }
}
