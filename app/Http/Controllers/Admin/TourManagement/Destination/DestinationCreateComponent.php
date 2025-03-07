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
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class DestinationCreateComponent extends Component
{
    use LivewireAlert,WithFileUploads;

public $tourstate,$name,$state_ut_id,$image;



public function mount()
    {
        $this->tourstate = TourState::pluck('name', 'id');
        // dd($this->tourstate);
    }

    // public function rules()
    // {
    //     // Validation rules
    //     return [
    //         'name' => 'required',
    //         // 'state_ut_id'  => 'required',
    //     ];
    // }



    public function save()
    {

            $validated = $this->validate([
                'name' => 'required',
                'image' => 'required|image',
                'state_ut_id' => 'required',

            ]);
            // $validated['is_active'] = $this->status ?? 1;
            $uuid = Str::uuid();
            $imageExtension = $validated['image']->getClientOriginalExtension();
            $imageName = $uuid . '.' . $imageExtension;
            Storage::putFileAs('public/destination_img', $validated['image'], $imageName);
            $validated['image'] = $imageName;

            TourDestination::create($validated);
            $this->alert('success', Lang::get('messages.tour_create'));
            return redirect()->route('admin.destination.index');

        // dd($food);

        $this->alert('success', Lang::get('messages.foodtype_create'));

        return redirect()->route('admin.destination.index');
    }

    public function render()
    {
        return view('admin.tour-management.destination.destination-create-component');
    }
}
