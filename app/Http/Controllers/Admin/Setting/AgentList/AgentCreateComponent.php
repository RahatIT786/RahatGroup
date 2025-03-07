<?php

namespace App\Http\Controllers\Admin\Setting\AgentList;

use App\Models\Agent;
use App\Models\City;
use App\Models\Country;
use App\Models\Staff;
use App\Models\Membership;
use App\Models\State;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use ZipArchive;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use App\Mail\AdminRegisterEmail;
use App\Models\AdminSetting;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AgentCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads, WithFileUploads;
    public $countries, $cities = [], $staffs = [], $membership = [], $state, $agency_name, $owner_name, $state_id, $city, $mobile, $email, $password, $website, $pan, $gst, $is_paid, $rm_country_id, $rm_city_id, $rm_staff_id, $url_link, $s_url_link, $company_logo, $is_website, $membership_id, $is_create_website;
    public  $rmstaff, $website_name;

    public $zipFilePath;


    public function mount()
    {
        $this->membership = Membership::pluck('membership', 'id');
        // dd( $this->membership);
        $this->countries = Country::pluck('countryname', 'id');
        $this->state = State::pluck('state_name', 'id');
        $this->rmstaff = Staff::where('role_id', 5)
            ->get()
            ->mapWithKeys(function ($staff) {
                return [$staff->id => $staff->first_name . ' ' . $staff->last_name];
            });

        $this->zipFilePath = storage_path('app/mothership.zip'); //get into the spaceship
    }



    public function setCities()
    {
        $this->cities = City::active()->where('country_id', $this->rm_country_id)->pluck('city_name', 'id');
        // dd($this->country_id, $this->cities);
    }

    // public function setStaffs()
    // {
    //     $this->rmstaff = Staff::where('role_id', 5)
    //     ->get()
    //     ->mapWithKeys(function($staff) {
    //         return [$staff->id => $staff->first_name . ' ' . $staff->last_name];
    //     });
    //     dd($this->rmstaff);
    //     // $this->rm_staff_id = $this->staffs->keys()->first();
    // }

    public function prettyWebsite()
    {
        $this->s_url_link = Str::slug($this->url_link);
        $this->checkUniqueUrlLink();
    }

    public function changeWebsite()
    {
        //
    }

    public function changeInput()
    {
        //
    }

    public function checkUniqueUrlLink()
    {
        $existingAgent = Agent::where('website_name', $this->s_url_link)->first();
        if ($existingAgent) {
            $this->alert('error', 'The URL link is already taken. Please choose a different one.');
            $this->s_url_link = '';
        }
    }

    public function changeStaff()
    {
        //
    }

    // public function save()
    // {
    //     $validated = $this->validate([
    //         'agency_name' => 'required|string|max:150',
    //         'owner_name' => 'required|string|max:150',
    //         'state_id' => 'required',
    //         'is_paid' => 'required',
    //         'rm_staff_id' => 'required',
    //         // 'website_name' => 'required',
    //         'city' => 'required|string|max:150',
    //         'mobile' => 'required|string|max:12',
    //         'email' => 'required|email|string|max:150',
    //         'password' => 'required|string|max:150',
    //         'pan' => 'required|string|max:45',
    //         'gst' => 'required|string|max:45',
    //         'company_logo' => 'required|image|max:2048', // Ensure this matches your form field
    //     ]);

    //     // Handle file upload
    //     $imageName = Str::uuid() . '.' . $validated['company_logo']->getClientOriginalExtension();
    //     Storage::putFileAs('storage/company_logo', $validated['company_logo'], $imageName);

    //     // Modify validated data if needed
    //     $validated['company_logo'] = $imageName;
    //     $validated['email'] = strtolower($validated['email']); // Ensure email is lowercased if needed

    //     // Create Agent record
    //     Agent::create($validated);

    //     // Show success message
    //     $this->alert('success', __('messages.agent_save'));

    //     // Redirect or do any other necessary action after saving
    //     return redirect()->route('admin.agentlist.index');
    // }

    public function save()
    {
        $validated = $this->validate([
            'agency_name' => 'required|string|max:150',
            'owner_name' => 'required|string|max:150',
            'state_id' => 'required',
            'membership_id' => 'required',
            'rm_staff_id' => 'required',
            'city' => 'required|string|max:150',
            'mobile' => 'required|string|unique:aihut_agent,mobile|max:12',
            'email' => 'required|email|string|unique:aihut_agent,email|max:150',
            'password' => 'required|string|max:150',
            // 'pan' => 'required|string|max:45',
            // 'gst' => 'required|string|max:45',
            'company_logo' => 'required|image|max:2048', // Ensure this matches your form field
            'website_name' => 'required|string|max:50|unique:aihut_agent,website_name|max:50', // Make website_name unique
        ]);
        // dd($validated);
        $validated['pan'] = $this->pan;
        $validated['gst'] = $this->gst;
        unset($validated['membership_id']);
        $validated['is_active'] = $this->status ?? 1;
        $validated['membership'] = $this->membership_id;
        $validated['password'] = Hash::make($this->password);

        // Handle file upload
        if ($this->company_logo) {
            $imageName = Str::uuid() . '.' . $this->company_logo->getClientOriginalExtension();
            $this->company_logo->storeAs('company_logo', $imageName, 'public');
            $validated['company_logo'] = $imageName;
        }

        // $validated['email'] = strtolower($validated['email']); // Ensure email is lowercased if needed
        // if (is_array($validated['membership'])) {
        //     $validated['membership'] = implode(',', $validated['membership']);
        // // }
        // dd($validated);
        // Create Agent record
        // Agent::create($validated);


        // // Show success message
        // $this->alert('success', __('messages.agent_save'));

        // // Redirect or do any other necessary action after saving
        // return redirect()->route('admin.agentlist.index');
        try {
            // Create the agent with all validated data, including membership_id
            // Agent::create($validated);
            $agent = Agent::create($validated);
            $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';

            Mail::to($agent->email)
            ->cc($adminEmail)
            ->send(new AdminRegisterEmail($agent, $agent->mobile, $adminSetting, $adminwhatsapp));

            if ($this->website_name) {
                if ($this->createFolderAndExtract()) {
                    // Show success message
                    $this->alert('success', __('messages.agent_save'));
                } else {
                    $this->alert('error', 'Something wrong happened while creating the website.');
                }
            }
            // Redirect to the agent list
            return redirect()->route('admin.agentlist.index');
        } catch (\Exception $e) {
            // Handle the exception
            $this->alert('error', 'There was an error saving the agent: ' . $e->getMessage());

            // Optionally, you can log the error for debugging
            \Log::error('Agent creation failed: ' . $e->getMessage());
        }
        // dd($e->getMessage());
    }

    public function createFolderAndExtract()
    {
        set_time_limit(0);
        $currentPath = base_path(); // Get current project path (e.g., D:\LaravelProjects\neo_aihut)
        $parentPath = dirname($currentPath); // Parent directory (e.g., D:\LaravelProjects)
        $newFolderName = $this->website_name ? strtolower(preg_replace('/[^a-zA-Z0-9-]/', '', $this->website_name)) : 'com.aihut.project'; // Specify the new folder name
        $newFolderPath = $parentPath . DIRECTORY_SEPARATOR . $newFolderName;
        // dd($currentPath, $parentPath, $newFolderName, $newFolderPath);
        // Check if the folder already exists
        if (!File::exists($newFolderPath)) {
            File::makeDirectory($newFolderPath, 0755, true);
        }

        // Ensure the zip file exists
        if (File::exists($this->zipFilePath)) {
            $zip = new ZipArchive;
            if ($zip->open($this->zipFilePath) === TRUE) {
                $zip->extractTo($newFolderPath);
                $zip->close();

                // Update .env file inside the new folder
                $envFilePath = $newFolderPath . DIRECTORY_SEPARATOR . '.env';
                if (File::exists($envFilePath)) {
                    $this->updateEnvFile($envFilePath, $newFolderName);
                    // $this->optimizeWebsite($newFolderName);
                }
                return true;
                // $this->alert('success', 'Folder created and zip extracted successfully!');
            } else {
                // $this->alert('error', 'Failed to open the zip file.');
                return false;
            }
        } else {
            // $this->alert('error', 'Zip file does not exist.');
            return false;
        }
    }

    protected function updateEnvFile($envFilePath, $newFolderName)
    {
        $currentUrl = request()->getHost();
        $protocol = request()->getScheme();

        $domainParts = explode('.', $currentUrl);

        if (count($domainParts) > 2 && $domainParts[1] === 'www') {
            unset($domainParts[1]);
        }

        $domainName = implode('.', $domainParts);
        $newAppUrl = "{$protocol}://{$newFolderName}.{$domainName}";


        if (!is_writable($envFilePath)) {
            chmod($envFilePath, 0755);
        }


        $envContent = File::get($envFilePath);
        $updatedEnvContent = preg_replace(
            '/^APP_URL=.*$/m',
            "APP_URL={$newAppUrl}",
            $envContent
        );

        File::put($envFilePath, $updatedEnvContent);
    }

    public function optimizeWebsite($newFolderName)
    {
        // Set the new folder path
        $newFolderPath = base_path('../' . $newFolderName);

        if (File::exists($newFolderPath)) {
            $previousPath = getcwd();
            chdir($newFolderPath);

            // Run Artisan commands
            Artisan::call('optimize');
            Artisan::call('config:cache');
            Artisan::call('cache:clear');
            Artisan::call('view:clear');

            chdir($previousPath);
        }
    }

    public function render()
    {
        return view('admin.setting.agent-list.agent-create-component');
    }
}
