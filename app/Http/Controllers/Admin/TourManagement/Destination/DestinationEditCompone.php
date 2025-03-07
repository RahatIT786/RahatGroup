<?php

namespace App\Http\Controllers\Admin\TourManagement\Destination;

use Livewire\Component;
use App\Models\TourState;
use App\Models\TourDestination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class DestinationEditCompone extends Component
{
    public $id, $name, $tourstate,$tourpackageId,$state_ut_id,$imageEdit,$image,$tourpackage;




    use LivewireAlert, WithFileUploads;

    public function mount(TourDestination $tourpackage)
    {
        $this->tourpackageId = $tourpackage->id;
        $this->state_ut_id = $tourpackage->state_ut_id;
        $this->name = $tourpackage->name;
        $this->imageEdit = $tourpackage->image;
        $this->status = $tourpackage->is_active;
        $this->tourstate = TourState::pluck('name', 'id');

        // dd($this->tourstate);
    }


    public function rules()
    {
        // Validation rules
        return [
            'name' => 'required',
            'state_ut_id' => 'required',

        ];
    }


    public function update()
{

    $tourpackage = TourDestination::find($this->tourpackageId);

    $validated = $this->validate([
        'name' => 'required',
        'state_ut_id' => 'required',
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
    return to_route('admin.destination.index');
}


    public function render()
    {
        return view('admin.tour-management.destination.destination-edit-compone');
    }
}
