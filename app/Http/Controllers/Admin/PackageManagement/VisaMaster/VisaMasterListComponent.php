<?php

namespace App\Http\Controllers\Admin\PackageManagement\VisaMaster;

use Livewire\Component;
use App\Models\VisaCategory;
use App\Models\VisaDetails;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Livewire\WithPagination;

class VisaMasterListComponent extends Component
{
    public $modalData = null;
    use WithPagination, LivewireAlert;
    public $perPage = 10,$id,$status,$typesId,$VisaType=null, $countryname,$visa_name, $Id, $modalDateData;
    protected $listeners = ['confirmed','confirmDelete', 'confirmDuplicate'];

    public function getVisaMaster()
    {
        return VisaCategory::query()
            ->with('country')
            ->searchCountry($this->countryname)
            ->searchLike('visa_name', $this->visa_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function toggleStatus(VisaCategory $visacategory)
    {
       
        $this->typesId = $visacategory->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $typess = VisaCategory::whereId($this->typesId);
        $typess->update(['is_active' => !$typess->first()->is_active]);
        $this->alert('success', Lang::get('messages.visa_status_changed'));
        
    }


    public function isDelete(VisaCategory $visacategory)
    {
        $this->typesId = $visacategory->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $visaData = VisaCategory::whereId($this->typesId);
        $visaData->delete();
        $this->alert('success', Lang::get('messages.visa_deleted'));
    }

    public function filterSetting()
    {
        $this->resetPage();
    }
   
    public function getModalContent(VisaCategory $visacategory)
    {
        $this->modalData = $visacategory;
        
    }

    public function getDateModalContent(VisaCategory $visacategory)
    {
        $this->modalDateData = VisaDetails::where('visa_id', $visacategory->id)->get();
    }

    public function isDupicate(VisaCategory $visacategory)
    {
        $this->Id = $visacategory->id;
        $this->confirm('Are you sure to Duplicate this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDuplicate',
        ]);
    }

    public function confirmDuplicate()
    {
        try {
            $visaCategory = VisaCategory::find($this->Id);
            $newVisaCategory = VisaCategory::create([
                'countryid' => $visaCategory->countryid,
                'visa_name' => $visaCategory->visa_name,
                'is_active' => $visaCategory->is_active,
            ]);
            $visaDetails = VisaDetails::where('visa_id', $visaCategory->id)->get();
            foreach ($visaDetails as $detail) {
                VisaDetails::create([
                    'country_id' => $detail->country_id,
                    'visa_id' => $newVisaCategory->id,
                    'entry_type' => $detail->entry_type,
                    'visa_validity' => $detail->visa_validity,
                    'stay_period' => $detail->stay_period,
                    'visa_price' => $detail->visa_price,
                    'start_date' => $detail->start_date,
                    'end_date' => $detail->end_date,
                    'is_active' => 1,
                ]);
            }
            $this->alert('success', 'Visa Category Duplicated Successfully');
        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            Log::error('Error duplicating Visa Category: ' . $e->getMessage());
            $this->alert('error', 'An error occurred while duplicating the Visa Category.');
        }
    }

    public function render()
    {
        return view('admin.package-management.visa-master.visa-master-list-component' , [
            'VisaTypes' => $this->getVisaMaster()
        ]);
    }
}
