<?php

namespace App\Http\Controllers\Admin\Flight;

use App\Models\FlightMaster;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class FlightCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $flight_name, $flight_code, $carrier, $flight_logo;

    public function save()
    {
        $validated = $this->validate([
            'flight_name' => 'required',
            'flight_code' => 'required|unique:aihut_flight,flight_code',
            'carrier' => 'required',
            'flight_logo' => 'required|image|max:1024',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        $uuid = Str::uuid();
        $imageExtension = $validated['flight_logo']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;

        // Store the profile image in the storage/app/public directory
        Storage::putFileAs('public/flight_image', $validated['flight_logo'], $imageName);

        $validated['flight_logo'] = $imageName;

        FlightMaster::create($validated);
        $this->alert('success', Lang::get('messages.flight_save'));
        return redirect()->route('admin.flight.index');
    }
    

    public function render()
    {
        return view('admin.flight.flight-create-component');
    }
}
