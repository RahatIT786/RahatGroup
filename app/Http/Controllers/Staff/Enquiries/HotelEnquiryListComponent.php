<?php

namespace App\Http\Controllers\Staff\Enquiries;

use App\Models\HotelEnquiries;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class HotelEnquiryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $cust_name, $hotel_id, $support_team, $hotelEnquiriesId, $modalData, $comment, $status, $modalRelationship;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmedCompleted', 'confirmedReject'];

    public function getHotelEnquiries()
    {
        $this->total = HotelEnquiries::where('support_team', auth()->user()->id)->count(); // Total count of HotelEnquiries
        $this->complete = HotelEnquiries::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        $enquiry = HotelEnquiries::query()
            ->where('support_team', auth()->user()->id)
            ->with('hotel', 'country')
            ->searchLike('cust_name', $this->cust_name)
            ->searchHotel($this->hotel_id)
            ->OrderBy('status', 'ASC')
            ->paginate($this->perPage);
        return $enquiry;
    }

    public function changestatus(HotelEnquiries $hotelenquiry)
    {
        $this->status = $hotelenquiry->status;
        $this->comment = $hotelenquiry->comment; // Load the comment
        $this->hotelEnquiriesId = $hotelenquiry->id;
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $hotelenquiry = HotelEnquiries::find($this->hotelEnquiriesId);

        if ($hotelenquiry) {
            $hotelenquiry->update($validatedData);
            $this->dispatch('reload-page');

            // Success message
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
            $this->reset(); // Reset form fields
        } else {
            $this->alert('error', 'Enquiry not found.');
        }
        return redirect()->route('staff.hotelEnquiry');
    }

    public function rules()
    {
        return [
            'status' => 'required',
            'comment' => 'required',
        ];
    }

    public function validationAttributes()
    {
        return [
            'status' => 'Status',
            'comment' => 'Comment',
        ];
    }

    public function getModalContent(HotelEnquiries $hotelenquiries)
    {

        $this->modalData = $hotelenquiries;
        // dd($hotelenquiries);
    }
    public function filterHotel()
    {
        $this->resetPage();
    }


    public function completed(HotelEnquiries $hotelenquiries)
    {
        $this->hotelEnquiriesId = $hotelenquiries->id;
        $this->comment = ''; // Reset comment field
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedCompleted',
            'input' => 'text', // Show an input field
            'inputPlaceholder' => 'Enter your comment here...',
        ]);
    }

    public function confirmedCompleted()
    {

        $hotelData = HotelEnquiries::find($this->hotelEnquiriesId);
        if ($hotelData) {
            $hotelData->update([
                'status' => 2,              // Update the status
                'comment' => $this->comment, // Use the Livewire comment property
            ]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    public function rejected(HotelEnquiries $hotelenquiries)
    {

        $this->hotelEnquiriesId = $hotelenquiries->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedReject',
        ]);
    }

    public function confirmedReject()
    {
        $hotelData = HotelEnquiries::find($this->hotelEnquiriesId);
        if ($hotelData) {
            $hotelData->update(['status' => 3]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.enquiries.hotel-enquiry-list-component', [
            'hotelEnquirys' => $this->getHotelEnquiries()
        ]);
    }
}
