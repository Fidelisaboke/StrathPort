<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class DeleteConfirmationModal extends Component
{
    public $showModal = false;
    public $indexRoute;
    public $id;
    public $modelClass;
    public $adminModule;

    protected $listeners = ['delete' => 'show'];

    public function show($indexRoute, $id, $modelClass, $adminModule = false)
    {
        $this->indexRoute = $indexRoute;
        $this->id = $id;
        $this->modelClass = $modelClass;
        $this->adminModule = $adminModule;
        $this->showModal = true;
    }
    public function render()
    {
        return view('livewire.delete-confirmation-modal');
    }
    /**
     * Delete the specified resource in storage
     */
    public function delete(){
        $modelClass = $this->modelClass;
        $model = $modelClass::find($this->id);
        if ($model && !$this->adminModule) {
            $model->delete();
            session()->flash('success', 'Resource deleted successfully.');
        } elseif ($model && $this->adminModule && Gate::allows('admin')) {
            if($model->hasRole('admin')){
                session()->flash('error', 'Cannot delete an admin!');
            } else {
                $model->delete();
                session()->flash('success', 'Resource deleted successfully.');
            }
        } elseif ($model && $this->adminModule && !Gate::allows('admin')) {
            abort(403, 'Unauthorized');
        }
        else {
            session()->flash('error', 'Failed to delete the resource.');
        }

        return redirect()->route($this->indexRoute);
    }


}
