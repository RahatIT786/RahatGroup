<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\CallUsBack;

use Livewire\Component;
use App\Models\CallUsBack;
use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CallUsBackListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $typesId, $modalData = null, $search_full_name, $modalRelationship, $support_team;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];
    public function getCallUsBack()
    {
        $this->total = CallUsBack::count(); // Total count of CallUsBack enquiry
        $this->complete = CallUsBack::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return CallUsBack::query()
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
        CallUsBack::whereId($this->modalRelationship->id)->update($form_data);
        // dd($this->modalRelationship);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        // $this->resetPage();
        return redirect()->route('admin.callusback.index');
    }



    public function isDelete(CallUsBack $callusback)
    {
        // dd($enquirie);
        $this->typesId = $callusback->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $callusbackData = CallUsBack::whereId($this->typesId);
        $callusbackData->delete();
        $this->alert('success', Lang::get('messages.forexenquiry_deleted'));
    }

    public function getModalContent(CallUsBack $callusback)
    {
        $this->modalData = $callusback;
    }

    public function getModalRelationship(CallUsBack $callusback)
    {
        $this->modalRelationship = $callusback;
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterCallUsBack()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.manage-enquiry.call-us-back.call-us-back-list-component', [
            'CallUsBack' => $this->getCallUsBack()
        ]);
    }
}
