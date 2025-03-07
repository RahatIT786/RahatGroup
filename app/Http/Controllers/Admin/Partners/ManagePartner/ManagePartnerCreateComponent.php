<?php

namespace App\Http\Controllers\Admin\Partners\ManagePartner;

use Livewire\Component;

use App\Models\Partner;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;

class ManagePartnerCreateComponent extends Component
{
    use LivewireAlert,WithFileUploads;
    public $name,$image,$website;

    public function save()
    {
        try {
            // Validate input data
            $validated = $this->validate([
                'name' => 'required',
                'website' => 'required',
                'image' => 'required|image',
            ]);
            // // dd($validated);

            // $validated['is_active'] = $this->status ?? 1;
            $uuid = Str::uuid();
            $imageExtension = $validated['image']->getClientOriginalExtension();
            $imageName = $uuid . '.' . $imageExtension;
            Storage::putFileAs('public/partner_image', $validated['image'], $imageName);
            $validated['image'] = $imageName;

            Partner::create($validated);
            $this->alert('success', Lang::get('messages.partner_save'));
            return to_route('admin.managePartner.index');

            // Redirect to the resource index page
            return redirect()->route('admin.managePartner.index');
        } catch (\Exception $e) {
            // Dump the exception message and stop execution
            // dd('Error occurred: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('admin.partners.manage-partner.manage-partner-create-component');
    }
}
