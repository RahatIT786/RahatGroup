<?php

namespace App\Http\Controllers\Admin\TourManagement\State;
use Livewire\Component;
use App\Models\TourState;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class StateEditComponent extends Component
{
    public $id, $name, $tourstate,$tourstateId,$state_ut_id,$imageEdit,$image;




    use LivewireAlert, WithFileUploads;

    public function mount(TourState $tourstate)
    {
        // dd($tourstate);
        $this->tourstateId = $tourstate->id;
        $this->name = $tourstate->name;
        $this->imageEdit = $tourstate->image;
        $this->status = $tourstate->is_active;

        // dd($this->tourstate);
    }


    public function rules()
    {
        // Validation rules
        return [
            'name' => 'required',

        ];
    }


    public function update()
{

    $tourstate = TourState::find($this->tourstateId);

    $validated = $this->validate([
        'name' => 'required',

    ]);
    if ($this->image) {
        if ($tourstate->image) {
            Storage::delete('public/state_img/' . $tourstate->image);
        }
        if (is_string($this->image)) {
            $validated['image'] = $this->image;
        } else {
            $uuid = Str::uuid();
            $imageExtension = $this->image->getClientOriginalExtension();
            $imageName = $uuid . '.' . $imageExtension;
            Storage::putFileAs('public/state_img', $this->image, $imageName);
            $validated['image'] = $imageName;
        }
    } else {
        $validated['image'] = $tourstate->image;
    }
    $tourstate->update($validated);
    // Show success alert and redirect
    $this->alert('success', Lang::get('messages.state_edit'));
    return to_route('admin.state.index');
}
    public function render()
    {
        return view('admin.tour-management.state.state-edit-component');
    }
}
