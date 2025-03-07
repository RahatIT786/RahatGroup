<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\CustomizedUmrah;

use App\Models\Umrah;
use App\Models\Staff;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CustomizedUmrahListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $typesId, $modalData = null, $search_sharingtype, $support_team, $modalRelationship;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;

    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getumrah()
    {
        $this->total = Umrah::count(); // Total count of Umrah enquiry
        $this->complete = Umrah::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return Umrah::query()
            ->searchLike('sharing_type', $this->search_sharingtype)
            ->OrderBy('status', 'ASC')
            ->paginate($this->perPage);
    }

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
            'status'    => 1
        ];
        Umrah::whereId($this->modalRelationship->id)->update($form_data);
        // dd($this->modalRelationship);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        // $this->resetPage();
        return redirect()->route('admin.umrah.index');
    }

    public function isDelete(Umrah $umrah)
    {
        // dd($enquirie);
        $this->typesId = $umrah->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $hotelData = Umrah::whereId($this->typesId);
        $hotelData->delete();
        $this->alert('success', Lang::get('messages.customized_deleted'));
    }

    public function getModalContent(Umrah $umrah)
    {
        $this->modalData = $umrah;
    }

    public function getModalRelationship(Umrah $umrah)
    {
        $this->modalRelationship = $umrah;
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterUmrah()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.manage-enquiry.customized-umrah.customized-umrah-list-component', [
            'Customizedumrah' => $this->getumrah()
        ]);
    }
}
