<?php

namespace App\Http\Controllers\Admin\Flight;

use App\Models\FlightMaster;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class FlightEditComponent extends Component
{
    public $id;
    public $flight_name, $flight_code, $carrier, $flight_logo, $flight_logoEdit;
    use LivewireAlert, WithFileUploads;

    public function mount(FlightMaster $flightmaster)
    {
        // dd($flightmaster);
        $this->id = $flightmaster->id;
        $this->flight_name = $flightmaster->flight_name;
        $this->flight_code = $flightmaster->flight_code;
        $this->carrier = $flightmaster->carrier;
        $this->flight_logoEdit = $flightmaster->flight_logo;
    }

    public function update()
    {
        $flightMaster = FlightMaster::whereId($this->id)->first();
        // Validate input fields
        $validated = $this->validate([
            'flight_name' => 'required',
            'flight_code' => [
                'required',
                Rule::unique('aihut_flight', 'flight_code')->ignore($flightMaster->id),
            ],
            'carrier' => 'required',
        ]);
        
        if ($this->flight_logo) {
            if ($flightMaster->flight_logo) {
                Storage::delete('public/flight_image/' . $flightMaster->flight_logo);
            }
            if (is_string($this->flight_logo)) {
                $validated['flight_logo'] = $this->flight_logo;
            } else {
                $uuid = Str::uuid();
                $imageExtension = $this->flight_logo->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/flight_image', $this->flight_logo, $imageName);
                $validated['flight_logo'] = $imageName;
            }
        } else {
            $validated['flight_logo'] = $flightMaster->flight_logo;
        }
    
        FlightMaster::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.flight_update'));
        return redirect()->route('admin.flight.index');
    }
    
    public function render()
    {

        return view('admin.flight.flight-edit-component');
    }
}
