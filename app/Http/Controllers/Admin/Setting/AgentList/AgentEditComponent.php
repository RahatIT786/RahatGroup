<?php

namespace App\Http\Controllers\Admin\Setting\AgentList;

use App\Models\State;
use App\Models\Agent;
use App\Models\Staff;
use App\Models\Membership;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use ZipArchive;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;


class AgentEditComponent extends Component
{
    public $state, $profile_img, $agency_name, $owner_name, $state_id, $city, $mobile, $email, $password, $website, $pan, $gst, $is_paid, $agent, $id, $company_logoEdit, $rmstaff, $company_logo;
    public $membership, $rm_staff_id, $website_name, $membership_id, $zipFilePath, $isAlreadyExists;
    use LivewireAlert, WithFileUploads;

    // public function mount(Agent $agent)
    // {
    //     $this->id = $agent->id;
    //     $this->agency_name = $agent->agency_name;
    //     $this->owner_name = $agent->owner_name;
    //     $this->state_id = $agent->state_id;
    //     $this->city = $agent->city;
    //     $this->mobile = $agent->mobile;
    //     $this->email = $agent->email;
    //     $this->password = $agent->password;
    //     $this->website = $agent->website;
    //     $this->pan = $agent->pan;
    //     $this->gst = $agent->gst;
    //     $this->is_paid = $agent->is_paid;
    //     $this->rm_staff_id = $agent->rm_staff_id;
    //     $this->website_name = $agent->website_name;
    //     $this->company_logoEdit = $agent->company_logoEdit;

    //     $this->state = State::pluck('state_name', 'id');
    //     $this->rmstaff = Staff::where('role_id', 5)
    //         ->get()
    //         ->mapWithKeys(function ($staff) {
    //             return [$staff->id => $staff->first_name . ' ' . $staff->last_name];
    //         });
    // }

    // public function update()
    // {
    //     $validated = $this->validate([
    //         'agency_name' => 'required|max:150',
    //         'owner_name' => 'required|max:150',
    //         'state_id' => 'required',
    //         'city' => 'required|max:150',
    //         'mobile' => 'required|max:12',
    //         'email' => 'required|email|max:150',
    //         // 'password' => 'required|max:150',
    //         'website_name' => 'required|max:150',
    //         'pan' => 'required|max:45',
    //         'gst' => 'required|max:45',
    //         'is_paid' => 'require',
    //         'rm_staff_id' => 'required',
    //         // 'company_logo' => 'image|max:2048', // Example: max size of 2MB
    //     ]);
    //     // Handle file upload
    //     if ($this->company_logo) {
    //         $imageName = $this->company_logo->store('storage/company_logo');
    //         $validated['company_logo'] = basename($imageName);
    //     }

    //     $validated['is_active'] = 1; // Assuming this is a default value or logic for activation

    //     Agent::whereId($this->id)->update($validated);

    //     $this->alert('success', Lang::get('messages.agent_update'));
    //     return redirect()->route('admin.agentlist.index');
    // }

    public function mount(Agent $agent)
    {
        $this->id = $agent->id;
        $this->agency_name = $agent->agency_name;
        $this->owner_name = $agent->owner_name;
        $this->state_id = $agent->state_id;
        $this->city = $agent->city;
        $this->mobile = $agent->mobile;
        $this->email = $agent->email;
        $this->password = $agent->password;
        $this->website = $agent->website;
        $this->pan = $agent->pan;
        $this->gst = $agent->gst;
        $this->membership_id = $agent->membership;
        $this->rm_staff_id = $agent->rm_staff_id;
        $this->website_name = $agent->website_name;
        $this->isAlreadyExists = !empty($agent->website_name) ? true : false;
        $this->company_logoEdit = $agent->company_logo; // Ensure this is the correct attribute
        $this->membership = Membership::pluck('membership', 'id');

        $this->state = State::pluck('state_name', 'id');
        $this->rmstaff = Staff::where('role_id', 5)
            ->get()
            ->mapWithKeys(function ($staff) {
                return [$staff->id => $staff->first_name . ' ' . $staff->last_name];
            });
        $this->zipFilePath = storage_path('app/mothership.zip'); // zip zip zip
    }


    public function update()
    {
        $valArray = [
            'agency_name' => 'required|string|max:150',
            'owner_name' => 'required|string|max:150',
            'state_id' => 'required',
            'rm_staff_id' => 'required',
            'city' => 'required|string|max:150',
            'mobile' => 'required|string|max:12',
            'email' => 'required|email|string|max:150',
            'password' => 'required|string|max:150',
            'pan' => 'required|string|max:45',
            'gst' => 'required|string|max:45',
            // 'company_logo' => 'required|image|max:2048', // Ensure this matches your form field
            // 'website_name' => 'required|string|max:150', // Added validation for website_name
            // 'membership_id' => 'required',
            // 'company_logo' => 'image|max:2048', // Example: max size of 2MB
        ];

        if ($this->isAlreadyExists == false && !empty($this->website_name)) {
            $valArray['website_name'] = 'nullable|string|max:150';

        }
        $validated = $this->validate($valArray);
        // dd($validated);
        // Handle file upload
        $validated['gst'] = $this->gst;
        $validated['pan'] = $this->pan;
        if ($this->company_logo) {
            $imageName = $this->company_logo->store('public/company_logo'); // Adjusted to 'public'
            $validated['company_logo'] = basename($imageName);
        }
        unset($validated['membership_id']);
        $validated['membership'] = $this->membership_id; // Ensure this line is included


        if (Agent::whereId($this->id)->update($validated)) {
            if ($this->isAlreadyExists == false && !empty($this->website_name)) {
                $this->createFolderAndExtract();
            }
            $this->alert('success', Lang::get('messages.agent_update'));
            return redirect()->route('admin.agentlist.index');
        } else {
            $this->alert('error', 'Something went wrong');
        }
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
        return view('admin.setting.agent-list.agent-edit-component');
    }
}
