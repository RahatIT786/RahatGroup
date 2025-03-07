<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageBrochure;

use App\Models\Boucher;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class BroucherEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $name, $boucher, $image, $id, $imageEdit, $status;
    public function mount(Boucher $boucher)
    {
        $this->id = $boucher->id;
        $this->name = $boucher->name;
        $this->imageEdit = $boucher->image;
        $this->status = $boucher->is_active;
    }

    public function update()
    {
        $boucher = Boucher::whereId($this->id)->first();
        $validated = $this->validate([
            'name' => 'required',
        ]);


        if ($this->image) {
            if ($boucher->image) {
                Storage::delete('public/profile_image/' . $boucher->image);
            }
            if (is_string($this->image)) {
                $validated['image'] = $this->image;
            } else {
                $uuid = Str::uuid();
                $imageExtension = $this->image->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/profile_image', $this->image, $imageName);
                $validated['image'] = $imageName;
            }
        } else {
            $validated['image'] = $boucher->image;
        }


        Boucher::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.broucher_edit'));
        return to_route('admin.brochure.index');
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-brochure.broucher-edit-component');
    }
}
