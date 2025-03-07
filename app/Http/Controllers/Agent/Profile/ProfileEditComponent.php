<?php



namespace App\Http\Controllers\Agent\Profile;



use Livewire\Component;

use App\Models\State;

use App\Models\Country;

use App\Models\Agent;

use Livewire\WithFileUploads;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use Illuminate\Support\Facades\Lang;

use Illuminate\Support\Str;

use Livewire\Attributes\Layout;

use Illuminate\Support\Facades\Storage;



class ProfileEditComponent extends Component
{

    use LivewireAlert, WithFileUploads;

    public $id, $countries, $country, $state, $agency_name, $owner_name, $country_id, $state_id, $city, $mobile, $landline, $email, $website, $login_id, $password, $confirm_password, $profile_logoEdit;

    public $profileImgEdit, $ownerImgEdit, $aadharImgEdit, $ownersPancardImgEdit, $cancelledChequeImgEdit, $officeAddressImgEdit, $companyProofImgEdit, $officeBoardImgEdit, $receptionImgEdit, $bossCabinImgEdit;

    public $owners_adhaar, $profile_img, $owners_passport, $owners_pancard, $cancelled_cheque, $office_address_proof, $company_name_proof, $office_board, $reception, $boss_cabin, $gst, $pan, $address, $company_logo, $companyImgEdit;



    public function mount(Agent $agent)
    {

        $agent = auth()->user();

        $this->country = Country::pluck('countryname', 'id');

        $this->state = State::pluck('state_name', 'id');



        $this->id = $agent->id;

        $this->agency_name = $agent->agency_name;

        $this->owner_name = $agent->owner_name;

        $this->country_id = $agent->country_id;

        $this->state_id = $agent->state_id;

        $this->city = $agent->city;

        $this->mobile = $agent->mobile;

        $this->landline = $agent->landline;

        $this->email = $agent->email;

        $this->website = $agent->website_name;

        $this->login_id = $agent->login_id;

        $this->ownerImgEdit = $agent->owners_passport;

        $this->profileImgEdit = $agent->profile_img;

        $this->aadharImgEdit = $agent->owners_adhaar;

        $this->ownersPancardImgEdit = $agent->owners_pancard;

        $this->cancelledChequeImgEdit = $agent->cancelled_cheque;

        $this->officeAddressImgEdit = $agent->office_address_proof;

        $this->companyProofImgEdit = $agent->company_name_proof;

        $this->officeBoardImgEdit = $agent->office_board;

        $this->receptionImgEdit = $agent->reception;

        $this->bossCabinImgEdit = $agent->boss_cabin;

        $this->gst = $agent->gst;

        $this->pan = $agent->pan;

        $this->address = $agent->address;

        $this->companyImgEdit = $agent->company_logo;

    }



    public function update()
    {
        // Base validation rules
        $rules = [
            'agency_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'gst' => 'required',
            'pan' => 'required',
            'address' => 'required',
        ];
// biswajita
        // Conditional validation rules for files/images
        // $conditionalRules = [
        //     'owners_passport' => !$this->ownerImgEdit,
        //     'owners_adhaar' => !$this->aadharImgEdit,
        //     'owners_pancard' => !$this->ownersPancardImgEdit,
        //     'cancelled_cheque' => !$this->cancelledChequeImgEdit,
        //     'office_address_proof' => !$this->officeAddressImgEdit,
        //     'company_name_proof' => !$this->companyProofImgEdit,
        //     'office_board' => !$this->officeBoardImgEdit,
        //     'reception' => !$this->receptionImgEdit,
        //     'boss_cabin' => !$this->bossCabinImgEdit,
        // ];

        // // Merge conditional rules
        // foreach ($conditionalRules as $field => $condition) {
        //     if ($condition) {
        //         $rules[$field] = 'required';
        //     }
        // }

        // Validate
        // $this->validate($rules);



        try {

            $user = Agent::find($this->id);

            $validated = [
                'agency_name' => $this->agency_name,
                'owner_name' => $this->owner_name,
                'country_id' => $this->country_id,
                'state_id' => $this->state_id,
                'city' => $this->city,
                'mobile' => $this->mobile,
                'email' => $this->email,
                'website' => $this->website,
                'gst' => $this->gst,
                'pan' => $this->pan,
                'address' => $this->address,
                'landline' => $this->landline,
            ];

            // Function to handle PDF file uploads
            $handlePdfFileUpload = function ($field, $storagePath) use (&$validated, $user) {
                //  dd($this->owners_passport,$field, $storagePath,$validated, $user);
                if ($this->$field) {
                    // dd($field,$this->$field);
                    if ($user->$field) {
                        // dd($storagePath,$user->$field);
                        Storage::delete('public/' . $storagePath . '/' . $user->$field);

                    }

                    $extension = $this->$field->getClientOriginalExtension();
                    // dd($extension);
                    // if ($extension != 'pdf') {

                    //     throw new \Exception('Only PDF files are allowed for ' . $field);
                        if (!in_array($extension, ['pdf', 'jpg'])) {
                            throw new \Exception('Only PDF and JPG files are allowed for ' . $field);

                    }

                    $uuid = Str::uuid();
                    $fileName = $uuid . '.' . $extension;
                    Storage::putFileAs('public/' . $storagePath, $this->$field, $fileName);
                    $validated[$field] = $fileName;

                } else {
                    $validated[$field] = $user->$field;
                }

            };
            // Handle specific fields that should only store PDF files
            $handlePdfFileUpload('owners_passport', 'owners_passport');
            $handlePdfFileUpload('owners_adhaar', 'owners_adhaar');
            $handlePdfFileUpload('office_address_proof', 'office_address_proof');
            $handlePdfFileUpload('company_name_proof', 'company_name_proof');
            $handlePdfFileUpload('office_board', 'office_board');
            $handlePdfFileUpload('reception', 'reception');
            $handlePdfFileUpload('boss_cabin', 'boss_cabin');
            $handlePdfFileUpload('cancelled_cheque', 'cancelled_cheque');
            $handlePdfFileUpload('owners_pancard', 'owners_pancard');
            // Handle profile image upload (as in previous example)
            if ($this->profile_img) {
                if ($user->profile_img) {
                    Storage::delete('public/profile_image/' . $user->profile_img);
                }
                if (is_string($this->profile_img)) {
                    $validated['profile_img'] = $this->profile_img;
                } else {
                    $uuid = Str::uuid();
                    $imageExtension = $this->profile_img->getClientOriginalExtension();
                    $imageName = $uuid . '.' . $imageExtension;
                    Storage::putFileAs('public/profile_image', $this->profile_img, $imageName);
                    $validated['profile_img'] = $imageName;

                }

            } else {
                $validated['profile_img'] = $user->profile_img;
            }
            // Handle company image upload (as in previous example)
            if ($this->company_logo) {
                if ($user->company_logo) {
                    Storage::delete('public/company_logo/' . $user->company_logo);
                }
                if (is_string($this->company_logo)) {
                    $validated['company_logo'] = $this->company_logo;
                } else {
                    $uuid = Str::uuid();
                    $imageExtension = $this->company_logo->getClientOriginalExtension();
                    $imageName = $uuid . '.' . $imageExtension;
                    Storage::putFileAs('public/company_logo', $this->company_logo, $imageName);
                    $validated['company_logo'] = $imageName;
                }
            } else {
                $validated['company_logo'] = $user->company_logo;
            }

            // Update the user with validated data
            $user->update($validated);
            $this->alert('success', Lang::get('messages.user_update'));
            return redirect()->route('agent.profile.index');
        } catch (\Exception $e) {
            //   dd($e->getMessage());
            $this->alert('error', $e->getMessage());
        }
    }

    #[Layout('agent.layouts.app')]

    public function render()
    {

        return view('agent.profile.profile-edit-component');

    }

}

