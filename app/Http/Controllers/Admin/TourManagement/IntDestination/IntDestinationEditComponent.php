<?php

namespace App\Http\Controllers\Admin\TourManagement\IntDestination;

use Livewire\Component;
use App\Models\Country;
use App\Models\IntTourDestination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class IntDestinationEditComponent extends Component
{
    use LivewireAlert,WithFileUploads;

    public $id, $name, $countries,$country_id,$tourpackageId,$imageEdit,$image,$tourpackage;
    use LivewireAlert, WithFileUploads;

    public function mount(IntTourDestination $tourpackage)
    {   
        // dd($tourpackage->country_id);
        $this->tourpackageId = $tourpackage->id;
        $this->country_id = $tourpackage->country_id;
        $this->name = $tourpackage->name;
        $this->imageEdit = $tourpackage->image;
        $this->status = $tourpackage->is_active;
        $this->countries = Country::pluck('countryname', 'id');

        
    }
    public function rules()
    {
        // Validation rules
        return [
            'name' => 'required',
            'country_id' => 'required',

        ];
    }

    public function update()
    {

        $tourpackage = IntTourDestination::find($this->tourpackageId);

        $validated = $this->validate([
            'name' => 'required',
            'country_id' => 'required',
        ]);


        if ($this->image) {

            if ($tourpackage->image) {
                Storage::delete('public/destination_img/' . $tourpackage->image);
            }

            if (is_string($this->image)) {
                $validated['image'] = $this->image;
            } else {
                $uuid = Str::uuid();
                $imageExtension = $this->image->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/destination_img', $this->image, $imageName);
                $validated['image'] = $imageName;
            }
        } else {
            $validated['image'] = $tourpackage->image;
        }


        $tourpackage->update($validated);

        // Show success alert and redirect
        $this->alert('success', Lang::get('messages.tour_edit'));
        return to_route('admin.intDestination.index');
    }
    public function render()
    {
        return view('admin.tour-management.int-destination.int-destination-edit-component');
    }
}
