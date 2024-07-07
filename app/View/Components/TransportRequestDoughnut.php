<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\TransportRequest;
use Illuminate\Support\Facades\Auth;

class TransportRequestDoughnut extends Component
{
    public $transportRequestsCount;
    public $pendingCount, $approvedCount, $declinedCount;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        if(Auth::user()->hasRole('admin')){
            // Get all transport requests counts
            $this->transportRequestsCount = TransportRequest::count();
            $this->pendingCount = TransportRequest::where('status', 'Pending')->count();
            $this->approvedCount = TransportRequest::where('status', 'Approved')->count();
            $this->declinedCount = TransportRequest::where('status', 'Declined')->count();
        } else {
            // Get the transport requests for the authenticated user (non-admin user)
            $this->transportRequestsCount = TransportRequest::where('user_id', Auth::id())->latest()->count();
            $this->pendingCount = TransportRequest::where('user_id', auth()->user()->id)->where('status', 'Pending')->count();
            $this->approvedCount = TransportRequest::where('user_id', auth()->user()->id)->where('status', 'Approved')->count();
            $this->declinedCount = TransportRequest::where('user_id', auth()->user()->id)->where('status', 'Declined')->count();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transport-request-doughnut');
    }
}
