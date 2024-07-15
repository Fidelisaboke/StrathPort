<?php

namespace App\Livewire;

use App\Models\CarpoolRequest;
use Livewire\Component;
use App\Models\User;
use App\Models\TransportRequest;
use App\Notifications\TransportRequestDeclinedNotification;
use App\Notifications\CarpoolRequestDeclinedNotification;
use Illuminate\Support\Facades\Validator;

class TransportRequestDeclinedModal extends Component
{
    public $showModal = false;
    public $redirectUrl;
    public $id;
    public $modelClass;
    public $state = [];
    public $declinedReason;
    protected $listeners = ['declineTransportRequest' => 'show'];

    public function show($redirectUrl, $id, $modelClass)
    {
        $this->redirectUrl = $redirectUrl;
        $this->id = $id;
        $this->modelClass = $modelClass;
        $this->showModal = true;
    }
    public function render()
    {
        return view('livewire.transport-request-declined-modal');
    }
    /**
     * Decline the specified transport request
     */
    public function declineTransportRequest()
    {
        // Validate decline reason
        $validatedData = Validator::make(['declinedReason' => $this->declinedReason], [
            'declinedReason' => 'required|string|max:255',
        ])->validate();

        $modelClass = $this->modelClass;
        $model = $modelClass::find($this->id);
        if (!$model || !$model->status) {
            return redirect("{$this->redirectUrl}/{$this->id}")->with('error', 'The request does not exist.');
        }

        if ($model instanceof TransportRequest) {
            $transportRequest = $model;
            $transportRequest->status = 'Declined';
            if ($transportRequest->save()) {
                // Notify the user that the transport request has been declined
                $transportRequest->user->notify(new TransportRequestDeclinedNotification($transportRequest, $this->declinedReason));

                // Notify all admins
                $admins = User::role('admin', 'web')->get();
                foreach ($admins as $admin) {
                    $admin->notify(new TransportRequestDeclinedNotification($transportRequest, $this->declinedReason));
                }

                return redirect("{$this->redirectUrl}/{$this->id}")->with('success', 'Transport request declined successfully.');
            }
        }

        if ($model instanceof CarpoolRequest) {
            $carpoolRequest = $model;
            $carpoolRequest->status = 'Declined';
            if ($carpoolRequest->save()) {
                // Notify the user that the carpool request has been declined
                $carpoolRequest->user->notify(new CarpoolRequestDeclinedNotification($carpoolRequest, $this->declinedReason));

                // Notify the carpool driver connected to the carpool request
                $carpoolDriver = $carpoolRequest->carpoolDriver;
                $carpoolDriver->user->notify(new CarpoolRequestDeclinedNotification($carpoolRequest, $this->declinedReason));

                return redirect("{$this->redirectUrl}/{$this->id}")->with('success', 'Carpool request declined successfully.');
            }
        }

        return redirect("{$this->redirectUrl}/{$this->id}")->with('error', 'Failed to decline the request.');
    }
}
