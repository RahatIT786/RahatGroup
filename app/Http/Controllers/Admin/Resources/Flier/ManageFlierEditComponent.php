<?php

namespace App\Http\Controllers\Admin\Resources\Flier;

use App\Models\Flier;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class ManageFlierEditComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert, WithFileUploads;
    public $flier_code, $service_name, $image, $imageEdit, $comments, $Id;
    public function mount(Flier $flier)
    {
        // dd($admin);
        $this->Id = $flier->id;
        $this->flier_code = $flier->flier_code;
        $this->service_name = $flier->service_name;
        $this->imageEdit = $flier->image;
        $this->comments = $flier->comments;
    }
    public function update()
    {
        $validated = $this->validate([
            'flier_code' => 'required',
            'service_name' => 'required',
            'comments' => 'required',
        ]);
        $flierData = Flier::whereId($this->Id)->first();

        if ($this->image) {
            if ($flierData->image) {
                Storage::delete('public/fliers/' . $flierData->image);
            }
            if (is_string($this->image)) {
                $validated['image'] = $this->image;
            } else {
                $uuid = Str::uuid();
                $imageExtension = $this->image->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/fliers', $this->image, $imageName);
                $validated['image'] = $imageName;
            }
        } else {
            $validated['image'] = $flierData->image;
        }
        // dd($validated['image']);
        Flier::whereId($this->Id)->update($validated);
        // $flierData->update($validated);
        $this->alert('success', Lang::get('messages.flier_update'));
        return to_route('admin.manageFlier.index');
    }
    public function render()
    {
        return view('admin.resources.flier.manage-flier-edit-component');
    }
}
