<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\TourCallUsBack;

use Livewire\Component;
use App\Models\TourCallUsBack;
use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class TourCallUsBackListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $typesId, $modalData = null, $search_full_name, $modalRelationship, $support_team;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getTourCallUsBack()
    {
        $this->total = TourCallUsBack::count(); // Total count of TourCallUsBack enquiry
        $this->complete = TourCallUsBack::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return TourCallUsBack::query()
            ->searchLike('full_name', $this->search_full_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function mount()
    {
        $this->staffMaster = Staff::where('role_id', 5)
            ->get()
            ->mapWithKeys(function ($staff) {
                return [$staff->id => $staff->first_name . ' ' . $staff->last_name];
            });
        // dd($this->staffMaster);
    }

    public function update()
    {
        $validated = $this->validate([
            'support_team' => 'required',
        ]);

        $form_data = [
            'support_team' => $this->support_team,
            'status'    => 1
        ];
        TourCallUsBack::whereId($this->modalRelationship->id)->update($form_data);
        // dd($this->modalRelationship);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        // $this->resetPage();
        return redirect()->route('admin.tourcallusback.index');
    }

    public function isDelete(TourCallUsBack $tourcallusback)
    {
        // dd($enquirie);
        $this->typesId = $tourcallusback->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $tourcallusbackData = TourCallUsBack::whereId($this->typesId);
        $tourcallusbackData->delete();
        $this->alert('success', Lang::get('messages.tourcallusback_deleted'));
    }

    public function getModalContent(TourCallUsBack $tourcallusback)
    {
        $this->modalData = $tourcallusback;
    }

    public function getModalRelationship(TourCallUsBack $tourcallusback)
    {
        $this->modalRelationship = $tourcallusback;
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterTourCallUsBack()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.manage-enquiry.tour-call-us-back.tour-call-us-back-list-component', [
            'TourCallUsBack' => $this->getTourCallUsBack()
        ]);
    }
}
