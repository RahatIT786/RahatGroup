<?php

namespace App\Http\Controllers\Agent\Bookings;

use Livewire\Component;
use App\Models\Booking;
use App\Models\GuestDetail;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Rules\PassportExpiry;
use App\Helpers\Helper;
use App\Services\PassportReaderService;
use Illuminate\Support\Facades\Log;

class BookingAddPaxComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    public $id, $booking, $travelDate, $total_pax, $gender, $agevalidation = [], $expiry_message = [], $mehramMessage = [];
    public $passengerDetails = [], $age = [], $bookingID;
    //     $photo_name = $detail['photo'] ?? null;
    // $passport_front = $detail['passport_front'] ?? null;
    // $passport_back = $detail['passport_back'] ?? null;


    public function mount($booking_id)
    {


        $this->id = $booking_id;
        $this->booking = Booking::where('id', $booking_id)->first();

        $this->bookingID = $this->booking->booking_id;
        // dd($this->bookingID);
        $this->total_pax = $this->booking->adult + $this->booking->child_bed + $this->booking->child + $this->booking->infant;


        $this->travelDate = $this->booking->travel_date;

        $guestDetails = GuestDetail::where('booking_id', $this->bookingID)->get();
        //    dd($guestDetails);
        $this->passengerDetails = array_fill(1, $this->total_pax, [
            'id' => '',
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
        ]);

        //  dd($this->passengerDetails);
        // $this->passengerDetails =  GuestDetail::where('booking_id', '=', $this->id)->get();

        foreach ($guestDetails as $index => $guestDetail) {

            // $photoUrl = Storage::url('photos/passenger_photo/' . $detail['photo_filename']);

            $this->passengerDetails[$index + 1] = [
                'id' => $guestDetail->id,
                'surrname' => $guestDetail->guest_last_name,
                'given_name' => $guestDetail->guest_first_name,
                'passport_num' => $guestDetail->passport_number,
                'nationality' => $guestDetail->nationality,
                'dateOfBirth' => Carbon::parse($guestDetail->date_of_birth)->format('Y-m-d'),
                'passport_exp' => Carbon::parse($guestDetail->date_of_expiry)->format('Y-m-d'),
                'gender' => $guestDetail->gender,
                'age' => $guestDetail->age,
                'passport_front' => $guestDetail->passport_scan_front, // Assuming this is not available in $guestDetail
                'photo' => $guestDetail->photo, // Assuming this is not available in $guestDetail
                'passport_back' => $guestDetail->passport_scan_back, // Assuming this is not available in $guestDetail
            ];

            $this->ageValidation($index + 1);
        }
        //    dd($this->passengerDetails);
    }

    public function onPassportDocumentChange($index)
    {
        $file = $this->passengerDetails[$index]['passport_front'];

        if ($file) {
            // Check if the file is an image or PDF
            $fileMimeType = $file->getMimeType();

            // Initialize PassportReaderService
            $passportReaderService = new PassportReaderService();
            $requestId = Helper::generateUniqueId();
            $filePath = $file->getRealPath(); // Get the path of the uploaded file

            // Check if the file is a valid image or PDF
            if (in_array($fileMimeType, ['image/jpeg', 'image/png', 'application/pdf'])) {
                // Process the file using PassportReaderService
                $initialResponse = $passportReaderService->readPassport($filePath, $requestId);
                $data = json_decode($initialResponse, true);

                // Check if processing was successful and extract data
                if ($data && isset($data['extracted_data'])) {
                    $extractedData = $data['extracted_data'];

                    $dob = $extractedData['dob'] ?? null;
                    $expiryDate = $extractedData['date_of_expiry'] ?? null;

                    if ($dob && $expiryDate) {
                        $parsedDob = Carbon::createFromFormat('d/m/Y', $dob)->format('Y-m-d');
                        $parsedExpiry = Carbon::createFromFormat('d/m/Y', $expiryDate)->format('Y-m-d');

                        // Manually assign extracted data to specific fields
                        $this->passengerDetails[$index]['surrname'] = $extractedData['last_name'] ?? '';
                        $this->passengerDetails[$index]['given_name'] = $extractedData['first_name'] ?? '';
                        $this->passengerDetails[$index]['passport_num'] = $extractedData['passport_number'] ?? '';
                        $this->passengerDetails[$index]['nationality'] = $extractedData['nationality'] ?? '';
                        $this->passengerDetails[$index]['dateOfBirth'] = $parsedDob;
                        $this->passengerDetails[$index]['passport_exp'] = $parsedExpiry;
                        $this->passengerDetails[$index]['gender'] = $extractedData['gender'] ?? '';

                        $this->ageValidation($index);
                    } else {
                        // Emit event if data extraction fails
                        $this->alert('warning', 'Failed to extract data from passport. Please upload a valid image.');
                    }
                } else {
                    // alert event if the file couldn't be processed
                    $this->alert('warning', 'Failed to extract data from passport. Please upload a valid image.');
                }
            } else {
                // Provide specific message based on the file type
                if ($fileMimeType == 'application/pdf') {
                    $this->alert('warning', 'The uploaded file is an invalid PDF. Please upload a valid passport PDF.');
                } elseif (strpos($fileMimeType, 'image/') === 0) {
                    $this->alert('warning', 'The uploaded image is invalid. Please upload a valid passport image (Jpg).');
                } else {
                    $this->alert('warning', 'Invalid file type. Please upload a valid  PDF.');
                }
            }
        } else {
            // alert event if no file is uploaded
            $this->alert('warning', 'No passport front image uploaded.');
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
        $count = count($this->passengerDetails);

        for ($i = 1; $i <= $count; $i++) {
            $this->expiry_message[$i] = "";
        }

        $expiry_check = $this->passengerDetails[$index]['passport_exp'];

        $travelDate = $this->travelDate;

        $travelDate = Carbon::parse($this->travelDate);
        $passportExpiryDate = Carbon::parse($expiry_check);

        // Check if the passport expiry date is in the past

        // Check if the passport expiry date is more than 6 months after the travel date
        if ($passportExpiryDate->lt($travelDate->copy()->addMonths(6))) {
            $this->expiry_message[$index] = 'Passport expiry date must be more than 6 months from the travel date.';
        }

        if ($passportExpiryDate->isPast()) {
            $this->expiry_message[$index] = 'Passport is already expired.';
        }
    }
    public function update()
    {
        $validatedData = $this->validate([
            'passengerDetails.*.surrname' => 'required|string|max:255',
            'passengerDetails.*.given_name' => 'required|string|max:255',
            'passengerDetails.*.passport_num' => 'required|string|max:20',
            'passengerDetails.*.nationality' => 'required|string|max:255',
            'passengerDetails.*.dateOfBirth' => 'required|date',
            'passengerDetails.*.passport_exp' => 'required|date',
            'passengerDetails.*.gender' => 'required|string|max:10',
            'passengerDetails.*.photo' => 'required',
            'passengerDetails.*.passport_front' => 'required',
            'passengerDetails.*.passport_back' => 'required',
        ]);

        foreach ($this->passengerDetails as $index => $detail) {
            // Calculate age based on date of birth
            $dob = new \DateTime($detail['dateOfBirth']);
            $now = new \DateTime();
            $interval = $now->diff($dob);
            $age = $interval->y;

            if (is_object($detail['photo'])) {
                $photo_name = Helper::generateUniqueId() . $detail['photo']->getClientOriginalName();
                Storage::putFileAs('public/photos/passenger_photo', $detail['photo'], $photo_name);
            } else {
                $photo_name = $detail['photo'];
            }

            if (is_object($detail['passport_front'])) {
                $passport_front = Helper::generateUniqueId() . $detail['passport_front']->getClientOriginalName();
                Storage::putFileAs('public/photos/passport_front', $detail['passport_front'], $passport_front);
            } else {
                $passport_front = $detail['passport_front'];
            }

            if (is_object($detail['passport_back'])) {
                $passport_back = Helper::generateUniqueId() . $detail['passport_back']->getClientOriginalName();
                Storage::putFileAs('public/photos/passport_back', $detail['passport_back'], $passport_back);
            } else {
                $passport_back = $detail['passport_back'];
            }

            // Update or create guest detail
            $guestDetails = GuestDetail::find($detail['id']);
            // dd($detail, $guestDetails);
            if ($guestDetails) {
                $guestDetails->update([
                    'booking_id' => $this->bookingID,
                    'guest_last_name' => $detail['surrname'],
                    'guest_first_name' => $detail['given_name'],
                    'passport_number' => $detail['passport_num'],
                    'nationality' => $detail['nationality'],
                    'date_of_birth' => $detail['dateOfBirth'],
                    'age' => $age,
                    'date_of_expiry' => $detail['passport_exp'],
                    'gender' => $detail['gender'],
                    'photo' => $photo_name,
                    'passport_scan_front' => $passport_front,
                    'passport_scan_back' => $passport_back,
                ]);
            } else {
                GuestDetail::create([
                    'booking_id' => $this->bookingID,
                    'guest_last_name' => $detail['surrname'],
                    'guest_first_name' => $detail['given_name'],
                    'passport_number' => $detail['passport_num'],
                    'nationality' => $detail['nationality'],
                    'date_of_birth' => $detail['dateOfBirth'],
                    'age' => $age,
                    'date_of_expiry' => $detail['passport_exp'],
                    'gender' => $detail['gender'],
                    'photo' => $photo_name,
                    'passport_scan_front' => $passport_front,
                    'passport_scan_back' => $passport_back,
                ]);
            }
        }

        // Alert success message
        $this->alert('success', 'Passenger Details Updated Successfully!');

        // Redirect to booking index
        return redirect()->route('agent.bookings.index');
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.bookings.booking-add-pax-component');
    }
}
