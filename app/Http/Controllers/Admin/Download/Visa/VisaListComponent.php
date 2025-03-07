<?php

namespace App\Http\Controllers\Admin\Download\Visa;

use App\Models\Booking;
use App\Models\GuestDetail;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class VisaListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert, WithFileUploads;
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10;
    public $guests= [],$booking = null;
    public $showModal = false;
    public $files = [];

    public function getVisaBooking()
    {
        return Booking::query()
            ->where('booking_status', '1')
            ->where('release_visa', '1')
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->whereNotIn('service_type', ['12', '14', 'customised'])
            ->desc()
            ->with('pnr')
            ->paginate($this->perPage);
    }
    public function filterBookings()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }


    public function viewVisa($id)
    {   
        
        $this->booking = Booking::whereId($id)->with('guestdetail')->first();
        $this->guests = GuestDetail::where('booking_id', $this->booking->booking_id)->get();
      
        if ($this->guests->isEmpty()) {
           
            $this->alert('error', "Please enter passenger details to upload Visa files.", [
                'position' => 'center',
                'toast' => false,
                'timer' => 5000,
                'showConfirmButton' => true,
                'confirmButtonText' => 'Alright',
            ]);
        } else {
            $this->showModal = true;  // Show the modal only if guests exist
        }
    }

    public function uploadFile()
    {
        if (!empty($this->files)) {
            foreach ($this->files as $key => $uploadedFile) {
                $fileName = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
                $filePath = $uploadedFile->storeAs('visa-documents', $fileName, 'public');
                $guest = GuestDetail::find($key);
                if ($guest) {
                    $guest->update([
                        'visa_file' => $fileName,
                    ]);
                }
            }
            $this->files = [];
            $this->alert('success', 'Visa uploaded and updated successfully.');
        } else {
            $this->alert('error', 'Please select a file to upload.');
        }
        return redirect()->route('admin.visa.index'); 
    }
    
    public function render()
    {
        // dd($this->getVisaBooking());
        return view('admin.download.visa.visa-list-component', [
            'VisaBooking' => $this->getVisaBooking()
        ]);
    }
}
