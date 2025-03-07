<?php

namespace App\Http\Controllers\Admin\Services\ManageLaundry;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use App\Models\Laundry;
use App\Models\Staff;

class LaundryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $search_name, $laundryId = null, $support_team, $modalData, $modalRelationship;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function mount()
    {
        $this->staffMaster = Staff::where('role_id', 5)
            ->get()
            ->mapWithKeys(function ($staff) {
                return [$staff->id => $staff->first_name . ' ' . $staff->last_name];
            });
    }

    public function update()
    {
        $validated = $this->validate([
            'support_team' => 'required',
        ]);

        $form_data = [
            'support_team' => $this->support_team,
        ];
        Laundry::whereId($this->modalRelationship->id)->update($form_data);
        // dd($this->modalRelationship);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        // $this->resetPage();
        return redirect()->route('admin.laundry.index');
    }

    public function getLaundry()
    {
        $this->total = Laundry::count(); // Total count of Laundry enquiry
        $this->complete = Laundry::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        // dd(auth()->user('agent')->id);
        return Laundry::query()
            // ->where('agent_id', auth()->user('agent')->id)
            ->searchLike('name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function filterLaundry()
    {
        $this->resetPage();
    }

    public function isDelete(Laundry $laundry)
    {
        // dd($service);
        $this->laundryId = $laundry->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }
    public function confirmDelete()
    {
        $laundryData = Laundry::whereId($this->laundryId);
        //   dd($serviceData);
        $laundryData->delete();
        $this->alert('success', Lang::get('messages.service_delete'));
    }

    public function getModalContent(Laundry $laundry)
    {
        $this->modalData = $laundry;
    }

    public function getModalRelationship(Laundry $laundry)
    {
        $this->modalRelationship = $laundry;
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function render()
    {
        return view('admin.services.manage-laundry.laundry-list-component', [
            'laundries' => $this->getLaundry(),
        ]);
    }
}
