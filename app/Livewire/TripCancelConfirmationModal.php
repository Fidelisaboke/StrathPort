<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TripCancelledNotification;
use App\Notifications\CarpoolTripCancelledNotification;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\TransportSchedule;
use App\Models\TransportRequest;
use App\Models\CarpoolingDetails;


class TripCancelConfirmationModal extends Component
{
    public $showModal = false;
    public $redirectUrl;
    public $id;
    public $modelClass;

    protected $listeners = ['cancelTrip' => 'show'];

    public function show($redirectUrl, $id, $modelClass)
    {
        $this->redirectUrl = $redirectUrl;
        $this->id = $id;
        $this->modelClass = $modelClass;
        $this->showModal = true;
    }
    public function render()
    {
        return view('livewire.trip-cancel-confirmation-modal');
    }
    /**
     * Cancel the trip
     */
    public function cancelTrip()
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::find($this->id);
        if (!$model || !$model->status) {
            session()->flash('error', 'Failed to cancel trip.');
            return;
        }

        $model->status = 'Cancelled';
        if ($model->save()) {
            if ($model instanceof TransportRequest) {
                $transportRequest = $model->transportRequest;

                $user = $transportRequest->user;

                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;

                Notification::send([$admins, $user], new TripCancelledNotification($model));

                session()->flash('success', 'Trip has been cancelled successfully.');

                return redirect("{$this->redirectUrl}/{$this->id}")->with('success', "Your scheduled trip has been cancelled successfully.");
            }

            if ($model instanceof TransportSchedule) {
                $studentStaffRoles = Role::whereIn('name', ['student', 'staff'])->get();
                $users = User::role($studentStaffRoles, 'web')->get();

                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;
                Notification::send([$admins, $users], new TripCancelledNotification($model));

                return redirect("{$this->redirectUrl}/{$this->id}")->with('success', 'Transport Schedule cancelled successfully.');
            }

            if ($model instanceof CarpoolingDetails) {
                $requestOwner = $model->carpoolRequest->user;

                // Get the user account of the carpool driver
                $carpoolDriver = $model->carpoolRequest->carpoolDriver;
                $carpoolDriverUser = $carpoolDriver->user;

                Notification::send([$requestOwner, $carpoolDriverUser], new CarpoolTripCancelledNotification($model));

                return redirect("$this->redirectUrl/$this->id}")->with('success', 'Carpool Trip cancelled successfully.');
            }

            return redirect("{$this->redirectUrl}/{$this->id}")->with('success', 'Trip cancelled successfully.');
        } else {
            return redirect("{$this->redirectUrl}/{$this->id}")->with('error', 'Error cancelling trip.');
        }
    }
}
