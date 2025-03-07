<?php

namespace App\Http\Controllers\Admin\Partners\ManagePartner;

use Livewire\Component;
use App\Models\Partner;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class ManagePartnerEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $name, $website, $image, $id, $imageEdit, $partner;

    public function mount(Partner $partner)
    {
        $this->id = $partner->id;
        $this->name = $partner->name;
        $this->website = $partner->website;
        $this->imageEdit = $partner->image;
    }

    public function update()
    {
        try {
            $partner = Partner::whereId($this->id)->first();
            $validated = $this->validate([
                'name' => 'required',
                'website' => 'required',
            ]);

            if ($this->image) {
                if ($partner->image) {
                    Storage::delete('public/partner_image/' . $partner->image);
                }
                if (is_string($this->image)) {
                    $validated['image'] = $this->image;
                } else {                     
                    $uuid = Str::uuid();
                    $imageExtension = $this->image->getClientOriginalExtension();
                    $imageName = $uuid . '.' . $imageExtension;
                    Storage::putFileAs('public/partner_image', $this->image, $imageName);
                    $validated['image'] = $imageName;
                }
            } else {
                $validated['image'] = $partner->image;
            }

            Partner::whereId($this->id)->update($validated);
            $this->alert('success', Lang::get('messages.partner_edit'));
            return to_route('admin.managePartner.index');
        } catch (\Exception $e) {
            // Dump the exception message and stop execution
            // dd('Error occurred: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('admin.partners.manage-partner.manage-partner-edit-component');
    }
}
