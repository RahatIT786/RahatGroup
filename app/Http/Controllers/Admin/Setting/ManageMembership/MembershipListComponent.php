<?php

namespace App\Http\Controllers\Admin\Setting\ManageMembership;


use App\Models\Membership;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MembershipListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10,$id, $is_edit,$membership,$adult_commision,$chlid_commision,$infant_commision;
    public function getmembership()
    {
        $query = Membership::query()
        ->desc();
        return $query->paginate($this->perPage);
        

    } 

    public function filterMembership()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    } 

    // public function isDelete(Membership $membership)
    // {
    //     // dd($enquirie);
    //     $this->typesId = $membership->id;
    //     $this->confirm('Are you sure to delete this?', [
    //         'icon' => 'question',
    //         'confirmButtonText' => 'Yes',
    //         'onConfirmed' => 'confirmDelete',
    //     ]);
    // }

    // public function confirmDelete()
    // {
    //     $hotelData = Membership::whereId($this->typesId);
    //     $hotelData->delete();
    //     $this->alert('success', Lang::get('messages.member_deleted'));
    // }


    public function edit(Membership $membership)
    {
       
        $this->is_edit = true;
        $this->id = $membership->id;
        $this->membership = $membership->membership;
        $this->adult_commision = $membership->adult_commision;
        $this->chlid_commision = $membership->chlid_commision;
        $this->infant_commision = $membership->infant_commision;
        
    //    dd( $this->chlid_commision, $this->infant_commision);
    }
    public function update()
    {
        $validated = $this->validate([
            'membership' => 'required',
            'adult_commision' => 'required',
            'chlid_commision' => 'required',
            'infant_commision' => 'required',
        ], [

            'adult_commision.required' => 'Please Enter Adult Commision',
            'chlid_commision.required' => 'Please Enter Chlid Commision',
            'infant_commision.required' => 'Please Enter Infant Commision',
            ]
        );
        Membership::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.member_update'));
        $this->dispatch('close-modal', modal: 'editModal');
        $this->is_edit = false;
        $this->resetPage();
        // return redirect()->route('admin.siteFee.index');
    }

    public function render()
    {
        return view('admin.setting.manage-membership.membership-list-component', [
            'Memberships' => $this->getmembership()
        ]);
    }
}
