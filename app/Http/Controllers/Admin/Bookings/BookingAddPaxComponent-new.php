<?php

namespace App\Http\Controllers\Admin\Bookings;

use Livewire\Component;
use App\Models\Booking;
use App\Models\GuestDetail;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BookingAddPaxComponent extends Component
{   

    use WithFileUploads;

    public $id,$booking,$total_pax,$gender;
    public $passengerDetails = [];

    public function mount($booking_id){
        $this->id = $booking_id;
        $this->booking = Booking::where('id',$booking_id)->first();
        $this->bookingID = $this->booking->booking_id;
        $this->total_pax =  $this->booking->adult + $this->booking->child_bed + $this->booking->child + $this->booking->infant;
       
        $guestDetails = GuestDetail::where('booking_id', '=', $this->id)->get();
        
        $this->passengerDetails = array_fill(1, $this->total_pax, [
            'surrname' => '',
            'given_name' => '',
            'passport_num' => '',
            'nationality' => 'Indian',
            'dateOfBirth' => '',
            'passport_exp' => '',
            'gender' => '',
            'passport_front' => null,
            'photo' => null,
            'passport_back' => null,
        ]);
        
        foreach ($guestDetails as $index => $guestDetail) {
            $this->passengerDetails[$index + 1 ] = [
                'surrname' => $guestDetail->guest_last_name,
                'given_name' => $guestDetail->guest_first_name,
                'passport_num' => $guestDetail->passport_number,
                'nationality' => $guestDetail->nationality,
                'dateOfBirth' => Carbon::parse($guestDetail->date_of_birth)->format('Y-m-d'),
                'passport_exp' => Carbon::parse($guestDetail->date_of_expiry)->format('Y-m-d'),
                'gender' => $guestDetail->gender,
                'age'   => $guestDetail->age,
                'passport_front' => $guestDetail->passport_scan_front, 
                'photo' => $guestDetail->photo, 
                'passport_back' => $guestDetail->passport_scan_back, 
            ];
        }
    }

    public function updated($propertyName)
    {   
        dd('hi');
        if (preg_match('/passengerDetails\.\d+\.dateOfBirth/', $propertyName)) {
            $index = explode('.', $propertyName)[1];
            $date_of_birth = $this->passengerDetails[$index]['dateOfBirth'];
            $gender = $this->passengerDetails[$index]['gender'] ?? null;

            if (!$date_of_birth) {
                $this->validationMessages[$index] = 'Please choose a valid date of birth';
                return;
            }

            $dob = Carbon::createFromFormat('Y-m-d', $date_of_birth);
            $current = Carbon::now();
            $age = $current->diffInYears($dob);

            if (is_nan($age)) {
                $this->validationMessages[$index] = 'Please choose a valid date of birth';
            } else {
                $this->validationMessages[$index] = $this->determineMehramRequirement($age, $gender);
            }
        }
    }

    public function determineMehramRequirement($age, $gender)
    {
        if ($age < 17) {
            return 'Gents Mehram Required';
        } elseif ($age >= 17 && $age < 18) {
            return 'Ladies Mehram Required';
        } elseif ($gender == 'male') {
            if ($age >= 18 && $age < 40) {
                return 'Ladies Mehram Required';
            } elseif ($age >= 40) {
                return 'Ladies Mehram NOT Required';
            }
        } elseif ($gender == 'female') {
            if ($age >= 18 && $age < 45) {
                return 'Gents Mehram Required';
            } elseif ($age >= 45) {
                return 'Gents Mehram NOT Required';
            }
        }

        return 'Invalid data';
    }

    public function save()
    {
        foreach ($this->passengerDetails as $index => $detail) {
            $dob = new \DateTime($detail['dateOfBirth']);
            $now = new \DateTime();
            $interval = $now->diff($dob);
            $age = $interval->y;

            $photo_id = Str::uuid();
            $photo_name = $photo_id .$detail['photo']->getClientOriginalName();
            $passport_front = $photo_id .$detail['passport_front']->getClientOriginalName();
            $passport_back = $photo_id .$detail['passport_back']->getClientOriginalName();
            if ($detail['passport_front']) {
                $detail['passport_front'] = $detail['passport_front']->storeAs('photos/passport_front', $passport_front);
            }
            if ($detail['photo']) {
                $detail['photo'] = $detail['photo']->storeAs('photos/passenger_photo', $photo_name);
            }
            if ($detail['passport_back']) {
                $detail['passport_back'] = $detail['passport_back']->storeAs('photos/passport_back', $passport_back);
            }

            $guest_add = GuestDetail::create([
                'booking_id' => $this->id,
                'guest_last_name' => $detail['surrname'],
                'guest_first_name' => $detail['given_name'],
                'gender' => $detail['gender'],
                'passport_number' => $detail['passport_num'],
                'nationality' => $detail['nationality'],
                'date_of_birth' => $detail['dateOfBirth'],
                'age' => $age,
                'date_of_expiry' => $detail['passport_exp'],
                'photo' =>$photo_name,
                'passport_scan_front' => $passport_front,
                'passport_scan_back' => $passport_back,
            ]);  
        }
        $this->alert('success','Passenger Details Added Successfully !');
        return redirect()->route('admin.booking.index');
    }

    public function update()
    {
        foreach ($this->passengerDetails as $index => $detail) {
            $dob = new \DateTime($detail['dateOfBirth']);
            $now = new \DateTime();
            $interval = $now->diff($dob);
            $age = $interval->y;

            $guestDetails = GuestDetail::where('booking_id', $this->id)->get();

            foreach ($guestDetails as $guestDetail) {
                $guestDetail->update([
                    'guest_last_name' => $detail['surrname'],
                    'guest_first_name' => $detail['given_name'],
                    'passport_number' => $detail['passport_num'],
                    'nationality' => $detail['nationality'],
                    'date_of_birth' => $detail['dateOfBirth'],
                    'age' => $age,
                    'date_of_expiry' => $detail['passport_exp'],
                    'gender' => $detail['gender'],
                ]);
            }
        }
        $this->alert('success','Passenger Details Updated Successfully !');
        return redirect()->route('admin.booking.index');
    }

    public function render()
    {
        return view('admin.bookings.booking-add-pax-component');
    }
}
