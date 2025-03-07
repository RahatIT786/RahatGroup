<?php

namespace App\Http\Controllers\Admin\Resources\Ration\RationViewDetail;

use App\Models\City;
use App\Models\RationDetails;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class RationViewDetailEditComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $rationDetailId;
    public $rationId;
    public $mainItem;
    public $description;
    public $cityId;
    public $weight;
    public $rate;
    public $total_rate;
    public $isActive;
    public $total;
    public $cityData;

    protected $rules = [
        'mainItem' => 'required',
        'description' => 'required',
        'cityId' => 'required',
        'weight' => 'required',
        'rate' => 'required',
    ];

    public function mount(RationDetails $rationdetails)
    {
        $this->rationDetailId = $rationdetails->id;
        $this->rationId = $rationdetails->ration->id;
        $this->mainItem = $rationdetails->main_item;
        $this->description = $rationdetails->description;
        $this->cityId = $rationdetails->city_id;
        $this->weight = $rationdetails->weight;
        $this->rate = $rationdetails->rate;
        $this->total_rate = $rationdetails->total_rate;
        $this->isActive = $rationdetails->is_active;

        $this->cityData = City::pluck('city_name','id');
    }

    public function calculateAmount()
    {
        if (!empty($this->weight) && !empty($this->rate)) {
            $this->total_rate = $this->weight * $this->rate;
        }else{
            $this->total_rate = '';
        }
    }

    public function update()
    {
        $this->validate();
        $ration = RationDetails::find($this->rationDetailId);
        $ration->update([
            'main_item' => $this->mainItem,
            'description' => $this->description,
            'city_id' => $this->cityId,
            'weight' => $this->weight,
            'rate' => $this->rate,
            'total_rate' => $this->total_rate,
        ]);
        $this->alert('success', 'Successfully Updated');
        return redirect()->route('admin.manageRationView.index', $this->rationId);
    }

    public function render()
    {
        return view('admin.resources.ration.ration-view-detail.ration-view-detail-edit-component');
    }
}
