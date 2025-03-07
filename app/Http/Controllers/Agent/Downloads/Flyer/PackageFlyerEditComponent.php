<?php

namespace App\Http\Controllers\Agent\Downloads\Flyer;

use App\Helpers\Helper;
use App\Models\Flyer;
use App\Models\Packages;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PackageFlyerEditComponent extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    protected $listeners = ['confirmed', 'confirmDelete'];

    public $flyer_id, $flyer_title, $package_ids, $header_image, $header_text, $footer_image, $footer_text, $important_notes, $terms_cond;
    public $packages = [], $perPage = 10, $agent;

    public function mount(Flyer $flyer)
    {
        $this->agent = auth()->user()->id;
        $this->flyer_id = $flyer->id;
        $this->flyer_title = $flyer->flyer_title;
        $this->header_image = $flyer->header_image;
        $this->header_text = $flyer->header_text;
        $this->footer_image = $flyer->footer_image;
        $this->footer_text = $flyer->footer_text;
        $this->important_notes = $flyer->important_notes;
        $this->terms_cond = $flyer->terms_cond;
        $this->package_ids = $flyer->package_ids;
        $this->packages = Packages::active()->get(); // Assuming 'active()' is a local scope
    }

    public function rules(): array
    {
        return [
            'flyer_title' => 'required|string|max:255',
            // 'header_image' => 'nullable|mimes:jpeg,jpg,png,webp|max:3072',
            // 'footer_image' => 'nullable|mimes:jpeg,jpg,png,webp|max:3072',
            'package_ids' => 'required|array|min:1',
            'important_notes' => 'nullable|string',
            'terms_cond' => 'nullable|string',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'flyer_title' => 'title',
            'header_image' => 'header image',
            'footer_image' => 'footer image',
            'package_ids' => 'packages',
            'important_notes' => 'important notes',
            'terms_cond' => 'terms and conditions',
        ];
    }

    public function messages(): array
    {
        return [
            'package_ids.min' => 'Please select a package',
        ];
    }

    public function save()
    {
        if(empty($this->package_ids)){
            // $this->alert('error', "Please select atleast one package"); 
            $this->alert('error', "Please select atleast one package.", [
                'position' => 'center',
                'toast' => false,
                'timer' => 10000,
                'showConfirmButton' => true,
                'confirmButtonText' => 'Alright',
            ]);
        }
        $validated = $this->validate();

        $validated['agency_id'] = $this->agent;
        // Update flyer details
        Flyer::whereId($this->flyer_id)->update($validated);

        // Handle file uploads
        if ($this->header_image instanceof \Illuminate\Http\UploadedFile) {
            $headerImageName = Helper::uploadFile($this->header_image, 'flyers');
            Flyer::whereId($this->flyer_id)->update(['header_image' => $headerImageName]);
        }

        if ($this->footer_image instanceof \Illuminate\Http\UploadedFile) {
            $footerImageName = Helper::uploadFile($this->footer_image, 'flyers');
            Flyer::whereId($this->flyer_id)->update(['footer_image' => $footerImageName]);
        }

        $this->alert('success', "Flyer has been updated successfully");

        return redirect()->route('agent.flyer.index');
    }

    #[\Livewire\Attributes\Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.downloads.flyer.package-flyer-edit-component');
    }
}
