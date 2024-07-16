<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\CarpoolingDetails;
use App\Models\TransportSchedule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TripCompletedNotification;
use App\Notifications\CarpoolTripCompletedNotification;

class TripCompletedConfirmationModal extends Component
{

    public $showModal = false;
    public $redirectUrl;
    public $id;
    public $modelClass;

    protected $listeners = ['completeTrip' => 'show'];
    public function show($redirectUrl, $id, $modelClass)
    {
        $this->redirectUrl = $redirectUrl;
        $this->id = $id;
        $this->modelClass = $modelClass;
        $this->showModal = true;
    }
    public function render()
    {
        return view('livewire.trip-completed-confirmation-modal');
    }

    /**
     * Complete the trip
     */
    public function completeTrip()
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::find($this->id);
        if (!$model || !$model->status) {
            session()->flash('error', 'Failed to complete trip.');
            return;
        }

        if ($model instanceof TransportSchedule) {
            // Check if a vehicle is assigned to the transport schedule
            if (is_null($model->schoolVehicle)) {
                return redirect("{$this->redirectUrl}/{$this->id}")->with('error', 'No vehicle assigned to the transport schedule.');
            }

            $model->status = 'Completed';

            if (!$model->save()) {
                return redirect("{$this->redirectUrl}/{$this->id}")->with('error', 'Error completing trip.');
            }

            // Change availability status of the school vehicle if the transport schedule has a school vehicle
            if ($model->schoolVehicle) {
                $schoolVehicle = $model->schoolVehicle;
                $schoolVehicle->availability_status = 'Available';
                if (!$schoolVehicle->save()) {
                    return redirect("{$this->redirectUrl}/{$this->id}")->with('error', 'Error updating school vehicle availability status. Trip completed.');
                }

                // Change availability status of the driver
                $schoolDriver = $schoolVehicle->schoolDriver;
                $schoolDriver->availability_status = 'Available';
                if (!$schoolDriver->save()) {
                    return redirect("{$this->redirectUrl}/{$this->id}")->with('error', 'Error updating school driver availability status. Trip completed.');
                }
            }


            if ($model->transportRequest) {
                $user = $model->transportRequest->user;
                Notification::send($user, new TripCompletedNotification($model));

                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;
                Notification::send($admins, new TripCompletedNotification($model));

                return redirect("{$this->redirectUrl}/{$this->id}")->with('success', 'Transport Schedule completed successfully.');
            }

            $studentStaffRoles = Role::whereIn('name', ['student', 'staff'])->get();
            $users = User::role($studentStaffRoles, 'web')->get();
            Notification::send($users, new TripCompletedNotification($model));

            $adminRole = Role::findByName('admin', 'web');
            $admins = $adminRole->users;
            Notification::send($admins, new TripCompletedNotification($model));

            return redirect("{$this->redirectUrl}/{$this->id}")->with('success', 'Transport Schedule completed successfully.');
        }

        if ($model instanceof CarpoolingDetails) {
            $requestOwner = $model->carpoolRequest->user;

            // Get the user account of the carpool driver
            $carpoolDriver = $model->carpoolRequest->carpoolDriver;

            // Change availability status of the carpool driver
            $carpoolDriver->availability_status = 'Available';

            if (!$carpoolDriver->save()) {
                return redirect("{$this->redirectUrl}/{$this->id}")->with('error', 'Error updating carpool driver availability status. Trip completed.');
            }

            $carpoolDriverUser = $carpoolDriver->user;

            Notification::send([$requestOwner, $carpoolDriverUser], new CarpoolTripCompletedNotification($model));

            return redirect("$this->redirectUrl/{$this->id}")->with('success', 'Carpool Trip completed successfully.');
        }

        // return redirect("{$this->redirectUrl}/{$this->id}")->with('success', 'Trip completed successfully.');
        return redirect("{$this->redirectUrl}/{$this->id}")->with('error', 'Error completing trip.');
    }
}
