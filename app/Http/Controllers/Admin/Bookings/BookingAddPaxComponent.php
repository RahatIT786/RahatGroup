<?php

namespace App\Http\Controllers\Admin\Bookings;


use Livewire\Component;
use App\Models\Booking;
use App\Models\GuestDetail;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class BookingAddPaxComponent extends Component
{   

    use LivewireAlert, WithFileUploads;

    public $id,$booking,$travelDate,$total_pax,$gender,$agevalidation = [],$expiry_message = [] ,$mehramMessage = [];
    public $passengerDetails = [],$age = [],$bookingID;

    public function mount($booking_id){

        
        $this->id = $booking_id;
        $this->booking = Booking::where('id',$booking_id)->first();
        $this->bookingID = $this->booking->booking_id;
        $this->total_pax =  $this->booking->adult + $this->booking->child_bed + $this->booking->child + $this->booking->infant;
       

        $this->travelDate = $this->booking->travel_date;

        $guestDetails = GuestDetail::where('booking_id', $this->bookingID)->get();
        //  dd($guestDetails);
        $this->passengerDetails = array_fill(1, $this->total_pax, [
            'id'    => '',
            'surrname' => '',
            'given_name' => '',
            'passport_num' => '',
            'nationality' => 'Indian',
            'dateOfBirth' => '',
            'passport_exp' => '',
            'gender' => '',
            'age' => '',
            'passport_front' => '',
            'photo' => '',
            'passport_back' => '',
            // Add other fields here as needed
        ]);
        // dd($this->passengerDetails);
        // $this->passengerDetails =  GuestDetail::where('booking_id', '=', $this->id)->get();

        foreach ($guestDetails as $index => $guestDetail) {

            // $photoUrl = Storage::url('photos/passenger_photo/' . $detail['photo_filename']);
            
            $this->passengerDetails[$index + 1 ] = [
                'id'    => $guestDetail->id,
                'surrname' => $guestDetail->guest_last_name,
                'given_name' => $guestDetail->guest_first_name,
                'passport_num' => $guestDetail->passport_number,
                'nationality' => $guestDetail->nationality,
                'dateOfBirth' => Carbon::parse($guestDetail->date_of_birth)->format('Y-m-d'),
                'passport_exp' => Carbon::parse($guestDetail->date_of_expiry)->format('Y-m-d'),
                'gender' => $guestDetail->gender,
                'age'   => $guestDetail->age,
                'passport_front' => $guestDetail->passport_scan_front, // Assuming this is not available in $guestDetail
                'photo' => $guestDetail->photo, // Assuming this is not available in $guestDetail
                'passport_back' => $guestDetail->passport_scan_back, // Assuming this is not available in $guestDetail
            ];

            $this->ageValidation($index + 1);

        }
       
        $count = count($this->passengerDetails);

        for($i=1; $i<= $count ; $i++){
            $this->expiry_message[$i]  = "";
        }
        
        
    }


    public function ageValidation($index)
    {
        $dateOfBirth = $this->passengerDetails[$index]['dateOfBirth'];
        
        // Validate if the date of birth is not empty
        if (!$dateOfBirth) {
            $this->agevalidation[$index] = 'Please enter a valid date of birth.';
            return;
        }
        // Calculate age
        $age = Carbon::parse($dateOfBirth)->age;

        // If age is not a number (NaN), display an error message
        if (!is_numeric($age)) {
            $this->agevalidation[$index] = 'Invalid date of birth.';
            return;
        }
        // Display the computed age in years
        $this->agevalidation[$index] = "Your age is $age years.";
        
        // Set the value of a hidden input field with the id #age concatenated with type to the computed age
        $this->age[$index] = $age;

        // Retrieve the selected gender from radio buttons
        $gender = $this->passengerDetails[$index]['gender'];
        
        // Determine if a Mehram (a male or female guardian) is required
        if ($age < 17) {
            $this->mehramMessage[$index] = 'A male guardian (Gents Mehram) is required.';
        } elseif ($age >= 17 && $age < 18 && $gender === 'Male') {
            $this->mehramMessage[$index] = 'A female guardian (Ladies Mehram) is required.';
        } elseif ($age >= 18 && $age < 40 && $gender === 'Male') {
            $this->mehramMessage[$index] = 'A female guardian (Ladies Mehram) is required.';
        } elseif ($age >= 17 && $age < 45 && $gender === 'Female') {
            $this->mehramMessage[$index] = 'A male guardian (Gents Mehram) is required.';
        } else {
            $this->mehramMessage[$index] = 'No specific guardian requirement.';
        }

       
    }

    public function expiryCheck($index)
    {   
       
        $expiry_check = $this->passengerDetails[$index]['passport_exp'];
       
        $travelDate = $this->travelDate;

        $travelDate = Carbon::parse($this->travelDate);
        $passportExpiryDate = Carbon::parse($expiry_check);

        // Check if the passport expiry date is in the past
      
        // Check if the passport expiry date is more than 6 months after the travel date
        if ($passportExpiryDate->lt($travelDate->copy()->addMonths(6))) {
            $this->expiry_message[$index] = 'Passport expiry date must be more than 6 months from the travel date.';
           
        }elseif ($passportExpiryDate->isPast()) {
            $this->expiry_message[$index] = 'Passport is already expired.';    
        }else{
            $this->expiry_message[$index] = ''; 
        }

        
        
    }
    public function update()
    {   
        $travelDate = $this->travelDate;
        $validatedData = $this->validate([
            // 'passengerDetails.*.id' => 'required|exists:guest_details,id',
            'passengerDetails.*.surrname' => 'required|string|max:255',
            'passengerDetails.*.given_name' => 'required|string|max:255',
            'passengerDetails.*.passport_num' => 'required|string|max:20',
            'passengerDetails.*.nationality' => 'required|string|max:255',
            'passengerDetails.*.dateOfBirth' => 'required|date',
            'passengerDetails.*.passport_exp' => 'required|date',
            'passengerDetails.*.gender' => 'required|string|max:10',
            // 'passengerDetails.*.photo' => 'nullable|image|max:10240', // Optional photo, must be an image, max size 10MB
            // 'passengerDetails.*.passport_front' => 'nullable|image|max:10240', // Optional passport front scan
            // 'passengerDetails.*.passport_back' => 'nullable|image|max:10240', // Optional passport back scan
        ],[
            'passengerDetails.*.surrname.required' => 'Surname is required.',
            'passengerDetails.*.surrname.string' => 'Surname must be a string.',
            'passengerDetails.*.surrname.max' => 'Surname may not be greater than 255 characters.',
            'passengerDetails.*.given_name.required' => 'Given name is required.',
            'passengerDetails.*.given_name.string' => 'Given name must be a string.',
            'passengerDetails.*.given_name.max' => 'Given name may not be greater than 255 characters.',
            'passengerDetails.*.passport_num.required' => 'Passport number is required.',
            'passengerDetails.*.passport_num.string' => 'Passport number must be a string.',
            'passengerDetails.*.passport_num.max' => 'Passport number may not be greater than 20 characters.',
            'passengerDetails.*.nationality.required' => 'Nationality is required.',
            'passengerDetails.*.nationality.string' => 'Nationality must be a string.',
            'passengerDetails.*.nationality.max' => 'Nationality may not be greater than 255 characters.',
            'passengerDetails.*.dateOfBirth.required' => 'Date of birth is required.',
            'passengerDetails.*.dateOfBirth.date' => 'Date of birth must be a valid date.',
            'passengerDetails.*.passport_exp.required' => 'Passport expiry date is required.',
            'passengerDetails.*.passport_exp.date' => 'Passport expiry date must be a valid date.',
            'passengerDetails.*.gender.required' => 'Gender is required.',
            'passengerDetails.*.gender.string' => 'Gender must be a string.',
            'passengerDetails.*.gender.max' => 'Gender may not be greater than 10 characters.',
            // 'passengerDetails.*.photo.image' => 'Photo must be an image file.',
            // 'passengerDetails.*.photo.max' => 'Photo may not be greater than 10MB.',
            // 'passengerDetails.*.passport_front.image' => 'Passport front scan must be an image file.',
            // 'passengerDetails.*.passport_front.max' => 'Passport front scan may not be greater than 10MB.',
            // 'passengerDetails.*.passport_back.image' => 'Passport back scan must be an image file.',
            // 'passengerDetails.*.passport_back.max' => 'Passport back scan may not be greater than 10MB.',
        ]);


        foreach ($this->passengerDetails as $index => $detail) {
           
            // Initialize variables for file names
            $photo_name = '';
            $passport_front = '';
            $passport_back ='';
            
            // Generate UUIDs for file names
            $photo_id = Str::uuid();
            $passport_front_id = Str::uuid();
            $passport_back_id = Str::uuid();
            
            // Check if photo is uploaded and not a string
            if($detail['photo'] != '' && !is_string($detail['photo'])){
                $photo_name = $photo_id . $detail['photo']->getClientOriginalName();
                // Store photo
                Storage::putFileAs('public/photos/passenger_photo', $detail['photo'], $photo_name);
            }
            
            // Check if passport front is uploaded and not a string
            if($detail['passport_front'] != '' && !is_string($detail['passport_front'])){
                $passport_front = $passport_front_id . $detail['passport_front']->getClientOriginalName();
                // Store passport front
                Storage::putFileAs('public/photos/passport_front', $detail['passport_front'], $passport_front);
            }
            
            // Check if passport back is uploaded and not a string
            if($detail['passport_back'] != '' && !is_string($detail['passport_back'])){
                $passport_back = $passport_back_id . $detail['passport_back']->getClientOriginalName();
                // Store passport back
                Storage::putFileAs('public/photos/passport_back', $detail['passport_back'], $passport_back);
            }
           
            // Calculate age based on date of birth
            $dob = new \DateTime($detail['dateOfBirth']);
            $now = new \DateTime();
            $interval = $now->diff($dob);
            $age = $interval->y;
          
            // Retrieve guest detail
            $guestDetails = GuestDetail::find($detail['id']);
    
            // Update or create guest detail
            if ($guestDetails) {
                $guestDetails->update([
                    'booking_id'            => $this->bookingID,
                    'guest_last_name'       => $detail['surrname'],
                    'guest_first_name'      => $detail['given_name'],
                    'passport_number'       => $detail['passport_num'],
                    'nationality'           => $detail['nationality'],
                    'date_of_birth'         => $detail['dateOfBirth'],
                    'age'                   => $age,
                    'date_of_expiry'        => $detail['passport_exp'],
                    'gender'                => $detail['gender'],
                    'photo'                 => $photo_name == "" ? $detail['photo'] : $photo_name,
                    'passport_scan_front'   => $passport_front == "" ? $detail['passport_front'] : $passport_front,
                    'passport_scan_back'    => $passport_back == "" ? $detail['passport_back'] : $passport_back,
                ]);
            } else {
                GuestDetail::create([
                    'booking_id'            => $this->bookingID,
                    'guest_last_name'       => $detail['surrname'],
                    'guest_first_name'      => $detail['given_name'],
                    'passport_number'       => $detail['passport_num'],
                    'nationality'           => $detail['nationality'],
                    'date_of_birth'         => $detail['dateOfBirth'],
                    'age'                   => $age,
                    'date_of_expiry'        => $detail['passport_exp'],
                    'gender'                => $detail['gender'],
                    'photo'                 => $photo_name == "" ? $detail['photo'] : $photo_name,
                    'passport_scan_front'   => $passport_front == "" ? $detail['passport_front'] : $passport_front,
                    'passport_scan_back'    => $passport_back == "" ? $detail['passport_back'] : $passport_back,
                ]);
            }
        }
        
        // Alert success message
        $this->alert('success','Passenger Details Updated Successfully !');
        
        // Redirect to booking index
        return redirect()->route('admin.booking.index');
    }
    

    public function render()
    {
        return view('admin.bookings.booking-add-pax-component');
    }
}
