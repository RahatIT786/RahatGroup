<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\ShoppingEnquiry;


use App\Models\ShoppingEnquiry;
use App\Models\Staff;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShoppingEnquiryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $typesId, $modalData = null, $search_name, $support_team, $modalRelationship,$name;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getshopping()
    {
        $this->total = ShoppingEnquiry::count(); // Total count of ShoppingEnquiry enquiry
        $this->complete = ShoppingEnquiry::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return ShoppingEnquiry::query()
            ->searchLike('name', $this->search_name)
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
        ShoppingEnquiry::whereId($this->modalRelationship->id)->update($form_data);
        // dd($this->modalRelationship);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        // $this->resetPage();
        return redirect()->route('admin.shoppingenquiry.index');
    }

    public function isDelete(ShoppingEnquiry $shoppingenquiry)
    {
        // dd($enquirie);
        $this->typesId = $shoppingenquiry->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $hotelData = ShoppingEnquiry::whereId($this->typesId);
        $hotelData->delete();
        $this->alert('success', Lang::get('messages.shoppingenquiry_deleted'));
    }

    public function getModalContent(ShoppingEnquiry $shoppingenquiry)
    {
        $this->modalData = $shoppingenquiry;
    }

    public function getModalRelationship(ShoppingEnquiry $shoppingenquiry)
    {
        $this->modalRelationship = $shoppingenquiry;
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterShopping()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('admin.manage-enquiry.shopping-enquiry.shopping-enquiry-list-component', [
            'Shopping' => $this->getshopping()
        ]);
    }
}
