<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\TransportRequest;

class TransportRequestHistory extends Component
{
    public $transportRequests;
    public $pendingCount, $approvedCount, $declinedCount;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->transportRequests = TransportRequest::all();
        $this->pendingCount = TransportRequest::where('status', 'Pending')->count();
        $this->approvedCount = TransportRequest::where('status', 'Approved')->count();
        $this->declinedCount = TransportRequest::where('status', 'Declined')->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transport-request-history');
    }
}
