<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\FoodEnquiry;

use Livewire\Component;
use App\Models\FoodEnquiry;
use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;


class FoodEnquiryListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $typesId, $modalData = null, $search_name, $modalRelationship, $support_team,$name;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];
    public function getFoodEnquiry()
    {
        $this->total = FoodEnquiry::count(); // Total count of FoodEnquiry enquiry
        $this->complete = FoodEnquiry::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return FoodEnquiry::query()
            ->searchLike('name', $this->search_name)
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
        FoodEnquiry::whereId($this->modalRelationship->id)->update($form_data);
        // dd($this->modalRelationship);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        // $this->resetPage();
        return redirect()->route('admin.foodenquiry.index');
    }



    public function isDelete(FoodEnquiry $foodenquiry)
    {
        // dd($enquirie);
        $this->typesId = $foodenquiry->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $foodenquiryData = FoodEnquiry::whereId($this->typesId);
        $foodenquiryData->delete();
        $this->alert('success', Lang::get('messages.foodenquiry_deleted'));
    }

    public function getModalContent(FoodEnquiry $foodenquiry)
    {
        $this->modalData = $foodenquiry;
    }

    public function getModalRelationship(FoodEnquiry $foodenquiry)
    {
        $this->modalRelationship = $foodenquiry;
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterFoodEnquiry()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('admin.manage-enquiry.food-enquiry.food-enquiry-list-component', [
            'FoodEnquiry' => $this->getFoodEnquiry()
        ]);
    }
}
