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

class IntDestinationCreateComponent extends Component
{
    use LivewireAlert,WithFileUploads;

    public $countries,$name,$state_ut_id,$image;
    public $country_id;
    public function mount()
    {
        $this->countries = Country::pluck('countryname', 'id');
    }
    public function save()
    {

        $validated = $this->validate([
            'name' => 'required',
            'image' => 'required|image',
            'country_id' => 'required',

        ]);
        // $validated['is_active'] = $this->status ?? 1;
        $uuid = Str::uuid();
        $imageExtension = $validated['image']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;
        Storage::putFileAs('public/destination_img', $validated['image'], $imageName);
        $validated['image'] = $imageName;

        IntTourDestination::create($validated);
        $this->alert('success', Lang::get('messages.tour_create'));
        return redirect()->route('admin.intDestination.index');
   
    }

    public function render()
    {
        return view('admin.tour-management.int-destination.int-destination-create-component');
    }
}
