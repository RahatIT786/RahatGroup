<?php

namespace App\Http\Controllers\Agent\Bookings\NegotiatedBookings;



use App\Helpers\Helper;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class NegotiatedBookingComponent extends Component
{   
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_booking_id, $search_name, $allQuotes, $request_modal_data;

    public function getQuotes()
    {   
        //  dd(auth()->user('agent')->id);
        $query= Booking::query()
        ->requests()
        ->pending()
        ->negotiated()
        ->where('agency_id', auth()->user()->id)
        ->with('package.pkgDetails','packagetype')
        ->searchLike('booking_id', $this->search_booking_id)
        ->searchLike('mehram_name', $this->search_name);

        $this->allQuotes = $query->get();
            // dd($this->allQuotes);
        return $query ->desc()->paginate($this->perPage);
        
    }
    public function filterBookings()
    {
        
    }

    public function isDelete(Booking $booking)
    {
        $this->Id = $booking->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function getRequestContent(Booking $booking)
    {   
        
        $booking->load('agency', 'servicetype', 'pnr', 'city','packagetype','sharingtype');
        $this->request_modal_data = $booking;

        //  dd($this->request_modal_data);
    }

    public function confirmDelete()
    {
        $packageMasterData = Booking::whereId($this->Id);
        $packageMasterData->delete();
        $this->alert('success', 'Record has been deleted successfully');
    }
    

    #[Layout('agent.layouts.app')]

    public function render()
    {
        return view('agent.bookings.negotiated-bookings.negotiated-booking-component', [
            'quotes' => $this->getQuotes()
        ]);
    }
}
