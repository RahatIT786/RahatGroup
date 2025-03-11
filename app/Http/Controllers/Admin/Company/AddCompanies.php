<?php

namespace App\Http\Controllers\Admin\Company;


use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\MainCompany;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class AddCompanies extends Component
{
    use WithFileUploads, LivewireAlert;

    public $companyId;
    public $company_name;
    public $company_dly_name;
    public $company_contect_person;
    public $company_mobile;
    public $company_landline_number;
    public $company_email;
    public $company_website_name;
    public $company_registered_address;
    public $company_about;
    public $company_pan;
    public $company_gst;
    public $company_state;
    public $company_city;
    public $company_logo;
    public $company_logo_path;

    // Validation Rules
    protected $rules = [
        'company_name' => 'required|string|max:250',
        'company_dly_name' => 'required|string|max:250',
        'company_contect_person' => 'required|string|max:250',
        'company_mobile' => 'required|string|max:12',
        'company_landline_number' => 'nullable|string|max:15',
        'company_email' => 'required|email|unique:main_companies,company_email',
        'company_registered_address' => 'required|string|max:500',
        'company_about' => 'required|string|max:1000',
        'company_pan' => 'nullable|string',
        'company_gst' => 'nullable|string|max:15',
        'company_state' => 'required|string',
        'company_city' => 'required|string|max:150',
        'company_logo' => 'nullable|image|max:2048', // Max 2MB file
        'company_website_name' => 'required|string|max:50|unique:main_companies,company_website_name',
    ];

    // Custom Error Messages
    protected $messages = [
        'company_name.required' => 'Company name is required.',
        'company_email.required' => 'Email is required.',
        'company_email.email' => 'Enter a valid email address.',
        'company_email.unique' => 'This email is already registered.',
        'company_logo.image' => 'The logo must be an image file.',
        'company_logo.max' => 'The logo size must not exceed 2MB.',
    ];

    // Mount Method to Fetch Data for Editing
    public function mount($id = null)
    {
        if ($id) {
            $company = MainCompany::findOrFail($id);
            $this->companyId = $company->id;
            $this->company_name = $company->company_name;
            $this->company_dly_name = $company->company_dly_name;
            $this->company_contect_person = $company->company_contect_person;
            $this->company_mobile = $company->company_mobile;
            $this->company_landline_number = $company->company_landline_number;
            $this->company_email = $company->company_email;
            $this->company_website_name = $company->company_website_name;
            $this->company_registered_address = $company->company_registered_address;
            $this->company_about = $company->company_about;
            $this->company_pan = $company->company_pan;
            $this->company_gst = $company->company_gst;
            $this->company_state = $company->company_state;
            $this->company_city = $company->company_city;
            $this->company_logo_path = $company->company_logo;
        }
    }

    // Save or Update Function
    public function save()
    {


        // Handle File Upload
        if ($this->company_logo) {
            $imageName = Str::uuid() . '.' . $this->company_logo->getClientOriginalExtension();
            $this->company_logo->storeAs('company_logos', $imageName, 'public');
            $this->company_logo_path = $imageName;
        }

        if ($this->companyId) {
            // Update existing company
            $company = MainCompany::findOrFail($this->companyId);

            // Allow same email and website for the same company
            // if (MainCompany::where('company_email', $this->company_email)
            //     ->where('id', '!=', $this->companyId)
            //     ->exists()) {
            //     session()->flash('error', 'This email is already registered with another company.');
            //     return;
            // }

            // if (MainCompany::where('company_website_name', $this->company_website_name)
            //     ->where('id', '!=', $this->companyId)
            //     ->exists()) {
            //     session()->flash('error', 'This website is already registered with another company.');
            //     return;
            // }

            $company->update([
                'company_name' => $this->company_name,
                'company_dly_name' => $this->company_dly_name,
                'company_contect_person' => $this->company_contect_person,
                'company_mobile' => $this->company_mobile,
                'company_landline_number' => $this->company_landline_number,
                'company_email' => $this->company_email,
                'company_registered_address' => $this->company_registered_address,
                'company_about' => $this->company_about,
                'company_pan' => $this->company_pan,
                'company_gst' => $this->company_gst,
                'company_state' => $this->company_state,
                'company_city' => $this->company_city,
                'company_logo' => $this->company_logo_path ?? $company->company_logo,
                'company_website_name' => $this->company_website_name, // Unchanged if same
            ]);

            session()->flash('message', 'Company details updated successfully!');
        } else {
            // Create a new company
            $this->validate();
            if (MainCompany::where('company_email', $this->company_email)->exists()) {
                session()->flash('error', 'This email is already registered.');
                return;
            }

            if (MainCompany::where('company_website_name', $this->company_website_name)->exists()) {
                session()->flash('error', 'This website is already registered.');
                return;
            }

            MainCompany::create([
                'company_name' => $this->company_name,
                'company_dly_name' => $this->company_dly_name,
                'company_contect_person' => $this->company_contect_person,
                'company_mobile' => $this->company_mobile,
                'company_landline_number' => $this->company_landline_number,
                'company_email' => $this->company_email,
                'company_registered_address' => $this->company_registered_address,
                'company_about' => $this->company_about,
                'company_pan' => $this->company_pan,
                'company_gst' => $this->company_gst,
                'company_state' => $this->company_state,
                'company_city' => $this->company_city,
                'company_logo' => $this->company_logo_path,
                'company_website_name' => $this->company_website_name,
            ]);

            session()->flash('message', 'Company details added successfully!');
        }

        // Reset Form Fields
        $this->reset([
            'company_name', 'company_dly_name', 'company_contect_person', 'company_mobile',
            'company_landline_number', 'company_email', 'company_website_name',
            'company_registered_address', 'company_about', 'company_pan', 'company_gst',
            'company_state', 'company_city', 'company_logo'
        ]);
    }


    public function render()
    {
        return view('admin.company.add-companies');
    }
}
