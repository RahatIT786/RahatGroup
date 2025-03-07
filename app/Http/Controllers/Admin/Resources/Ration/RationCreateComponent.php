<?php

namespace App\Http\Controllers\Admin\Resources\Ration;

use App\Models\City;
use App\Models\Ration;
use App\Models\RationDetails;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class RationCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $cityData;
    public $no_item, $txn_date, $ration_title;
    public $itemDetails = [];
    public $items = [];
    public $total_rate;

    public function mount()
    {
        $this->cityData = City::pluck('city_name','id');
        if (empty($this->no_item)) {
            $this->no_item = 1;
        }
        $this->loadDetail();
    }

    public function loadDetail()
    {
        // Reset the item details array
        $this->itemDetails = [];
        for ($i = 0; $i < $this->no_item; $i++) {
            $this->itemDetails[] = [
                'main_item' => '',
                'city_id' => null,
                'weight' => '',
                'rate' => '',
                'total_rate' => '',
                'description' => ''
            ];
        }
    }

    public function save()
    {
        // Validate the form fields
        $validated = $this->validate([
            'txn_date' => 'required',
            'ration_title' => 'required',
            'itemDetails.*.main_item' => 'required',
            'itemDetails.*.city_id' => 'required',
            'itemDetails.*.weight' => 'required',
            'itemDetails.*.rate' => 'required',
            'itemDetails.*.total_rate' => 'required',
            'itemDetails.*.description' => 'required',
        ], [], [
            'txn_date' => 'Transaction Date',
            'ration_title' => 'Ration Title',
            'itemDetails.*.main_item' => 'Item Name',
            'itemDetails.*.city_id' => 'Departure City',
            'itemDetails.*.weight' => 'Weight',
            'itemDetails.*.rate' => 'Rate',
            'itemDetails.*.total_rate' => 'Total Rate',
            'itemDetails.*.description' => 'Description',
        ]);
        // dd($validated);
        // Create Ration record
        $ration = Ration::create([
            'txn_date' => $validated['txn_date'],
            'ration_title' => $validated['ration_title'],
            'is_active' => 1,
        ]);

        // Create RationDetails records
        foreach ($validated['itemDetails'] as $detail) {
            RationDetails::create([
                'ration_id' => $ration->id,
                'main_item' => $detail['main_item'],
                'description' => $detail['description'],
                'city_id' => $detail['city_id'],
                'weight' => $detail['weight'],
                'rate' => $detail['rate'],
                'total_rate' => $detail['total_rate'],
                'is_active' => 1,
            ]);
        }

        $this->reset(['txn_date', 'ration_title', 'itemDetails']);
        $this->alert('success', 'Successfully Added');
        return redirect()->route('admin.manage-ration.index');
    }

    public function calculateAmount($index)
    {
        if (isset($this->itemDetails[$index]['weight']) && isset($this->itemDetails[$index]['rate'])) {
            $weight = $this->itemDetails[$index]['weight'];
            $rate = $this->itemDetails[$index]['rate'];
            if (is_numeric($weight) && is_numeric($rate)) {
                $this->itemDetails[$index]['total_rate'] = $weight * $rate;
            } else {
                $this->itemDetails[$index]['total_rate'] = '';
            }
        }
    }

    
    public function render()
    {
        return view('admin.resources.ration.ration-create-component');
    }
}
