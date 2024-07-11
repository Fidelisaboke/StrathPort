<?php

namespace App\Livewire;

use Livewire\Component;
use App\Notifications\TripCancelledNotification;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;
use App\Models\User;

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
    public function cancelTrip(){
        $modelClass = $this->modelClass;
        $model = $modelClass::find($this->id);
        if ($model) {
            $model->status = 'Cancelled';
            if($model->save()){
                if($model->transportRequest){
                    $transportRequest = $model->transportRequest;
                    $user = $transportRequest->user;
                    // Notify the user that the trip has been cancelled
                    Notification::send($user, new TripCancelledNotification($model));

                    // Notify all admins that the trip has been cancelled
                    $adminRole = Role::findByName('admin', 'web');
                    $admins = $adminRole->users;
                    Notification::send($admins, new TripCancelledNotification($model));

                    session()->flash('success', 'Trip has been cancelled successfully.');
                }

                if(!$model->transportRequest){
                    // Notify all users that are students and staff
                    $roles = Role::whereIn('name', ['student', 'staff'])->get();
                    $users = User::role($roles, 'web')->get();
                    Notification::send($users, new TripCancelledNotification($model));

                    // Notify all admins that the trip has been cancelled
                    $adminRole = Role::findByName('admin', 'web');
                    $admins = $adminRole->users;
                    Notification::send($admins, new TripCancelledNotification($model));
                }

            session()->flash('success', 'Trip has been cancelled successfully.');
        }
    }else {
            session()->flash('error', 'Failed to cancel trip.');
        }

        return redirect($this->redirectUrl.'/'.$this->id);
    }
}
