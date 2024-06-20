<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutConfirmationModal extends Component
{
    public $showModal = false;

    protected $listeners = ['logout' => 'show'];

    public function show()
    {
        $this->showModal = true;
    }

    public function logout()
    {
        Session::invalidate();
        Session::regenerateToken();
        Auth::guard('web')->logout();

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.logout-confirmation-modal');
    }
}
