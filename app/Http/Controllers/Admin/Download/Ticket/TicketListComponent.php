<?php

namespace App\Http\Controllers\Admin\Download\Ticket;

use App\Models\Booking;
use App\Models\GuestDetail;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class TicketListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert, WithFileUploads;
    public $currentSegment, $search_booking_id, $search_name, $search_travel_date, $perPage = 10;
    public $guests= [],$booking = null;
    public $showModal = false;
    public $files = [];
    public function getTicket()
    {   
        return Booking::query()
            ->with('pnr')
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->searchLike('travel_date', $this->search_travel_date)
            ->where('booking_status', 1)
            ->where('release_tkt', 1)
            ->whereNotIn('service_type', ['12', '14', 'customised'])
            ->desc()
            ->paginate($this->perPage);
    }
    public function filterBookings()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    public function viewTicket($id)
    {   
        $this->booking = Booking::whereId($id)->with('guestdetail')->first();
        $this->guests = GuestDetail::where('booking_id', $this->booking->booking_id)->get();
      
        if ($this->guests->isEmpty()) {
           
            $this->alert('error', "Please enter passenger details to upload Tickets.", [
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
                $filePath = $uploadedFile->storeAs('ticket-documents', $fileName, 'public');
                $guest = GuestDetail::find($key);
                if ($guest) {
                    $guest->update([
                        'tkt_file' => $fileName,
                    ]);
                }
            }
            $this->files = [];
            $this->alert('success', 'Ticket uploaded and updated successfully.');
        } else {
            $this->alert('error', 'Please select a file to upload.');
        }
        return redirect()->route('admin.ticket.index'); 
    }

    public function goToPayments()
    {
        
    }


    public function closeModal()
    {
        $this->showModal = false;
    }


    public function render()
    {
        return view('admin.download.ticket.ticket-list-component', [
            'TicketsBookings' => $this->getTicket()
        ]);
    }
}
