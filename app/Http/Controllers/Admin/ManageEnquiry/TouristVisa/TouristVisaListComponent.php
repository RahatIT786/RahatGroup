<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\TouristVisa;

use Livewire\Component;
use App\Models\TouristVisa;
use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class TouristVisaListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $countryname, $visa_type, $cust_name, $visaId, $modalData, $support_team, $modalRelationship;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];

    // @manas
    public function mount()
    {
        $this->staffMaster = Staff::where('role_id', 5)
            ->get()
            ->mapWithKeys(function ($staff) {
                return [$staff->id => $staff->first_name . ' ' . $staff->last_name];
            });
    }

    public function update()
    //nibedita
    {
        $validated = $this->validate([
            'support_team' => 'required',
        ]);

        $form_data = [
            'support_team' => $this->support_team,
            'status'    => 1
        ];
        //end nivi
        TouristVisa::whereId($this->modalRelationship->id)->update($form_data);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        return redirect()->route('admin.touristVisa.index');
    }
    // @end

    public function getTouristVisa()
    {
        $this->total = TouristVisa::count(); // Total count of TouristVisa enquiry
        $this->complete = TouristVisa::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return TouristVisa::query()
            ->with('country')
            ->searchLike('visa_type', $this->visa_type)
            ->searchLike('cust_name', $this->cust_name)
            // ->desc('support_team')
            // ->orderByRaw('support_team IS NULL DESC')
            ->desc()
            ->paginate($this->perPage);
    }


    public function isDelete(TouristVisa $touristVisa)
    {
        $this->visaId = $touristVisa->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $visatypeId = TouristVisa::whereId($this->visaId);
        $visatypeId->delete();
        $this->alert('success', Lang::get('messages.tourist_visa_deleted'));
    }

    public function getModalContent(TouristVisa $touristVisa)
    {
        $this->modalData = $touristVisa;
        // dd($this->modalData);
    }
    // @manas
    public function getModalRelationship(TouristVisa $touristVisa)
    {
        $this->modalRelationship = $touristVisa;
        //nibedita
        $this->support_team = $this->modalRelationship->support_team;
    }
    // @end
    public function filterTouristVisa()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.manage-enquiry.tourist-visa.tourist-visa-list-component', [
            'touristVisa' => $this->getTouristVisa()
        ]);
    }
}
