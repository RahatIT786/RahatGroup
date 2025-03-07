<?php

namespace App\Http\Controllers\Agent\Tool\CompaintBox;

use App\Helpers\Helper;
use App\Models\ComplaintBox;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Booking;
use App\Models\Staff;
use App\Models\Agent;
use App\Models\HotelMaster;
use Illuminate\Support\Facades\Mail;
use App\Mail\UmrahPackageInquiryEmail;
use App\Models\AdminSetting;
use Illuminate\Support\Facades\Auth;

class CompaintBoxListComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $departure_date,$agency_name,$bookings,$hotels ,$booking_id, $hotel_id, $cities = [], $city_id, $nights_medina, $hotel_type, $airport, $guest_name, $description, $room_no, $mobile, $validated;

    public function save()
    {
        $validated = $this->validate([
            'departure_date' => 'required',
            'booking_id' => 'required',
            'hotel_id' => 'required',
            'airport' => 'required',
            'room_no' => 'required',
            'mobile' => 'required',
            'guest_name' => 'required',
            'agency_name' => 'required',
            'description' => 'required',

        ], [], [
            'departure_date' => 'Nights in Makkah',
            'booking_id' => 'Nights in Medina',
            'hotel_id' => 'Hotel Type',
            'airport' => 'airport',
            'room_no' => 'room_no',
            'mobile' => 'mobile',
            'guest_name' => 'Travel Date',
            'agency_name' => 'Travel Date',
            'description' => 'Name',

        ]);


        $validated = [];
        try {
            $validated = $this->validate([
                'departure_date' => 'required',
                'booking_id' => 'required',
                'hotel_id' => 'required',
                'airport' => 'required',
                'room_no' => 'required',
                'mobile' => 'required',
                'guest_name' => 'required',
                'agency_name' => 'required',
                'description' => 'required',

            ], [], []);
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }


        $validated['unique_id'] = Helper::generateUniqueId();


        $rmStaffId = Auth::user()->rm_staff_id;

        $agency = Staff::find($rmStaffId);
        $validated['support_team'] = $agency->id;
        $validated['status'] = 1; 


        // Create Umrah record
        if ($validated) {
            $umrahInquiry = ComplaintBox::create($validated);
            // Flash success message
            session()->flash('umrah_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
                ' and <strong style="color: blue;">' . $agency->first_name . ' ' . $agency->last_name . '</strong>' .
                ' has been assigned this query. Mobile : <strong style="color: blue;">' . $agency['mobile'] . '</strong><br> They will call you soon.');

            $this->reset(); // Optionally, reset form fields

            // Redirect to the customizedUmrah route (adjust according to your routes)
            return redirect()->route('agent.complaintBox.index');
        }
    }

    public function mount(Agent $agent)
    {
        $agent = auth()->user();

        // $this->generateCaptcha();
        $this->bookings = Booking::whereNotNull('booking_id')->where('agency_id',$agent->id)->pluck('booking_id', 'id');
        $this->hotels = HotelMaster::all()->pluck('hotel_name', 'id');

        $this->agency_name = $agent->agency_name;


    }


    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.tool.compaint-box.compaint-box-list-component');
    }
}
