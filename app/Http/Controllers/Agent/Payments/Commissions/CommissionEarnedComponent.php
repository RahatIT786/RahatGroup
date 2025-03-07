<?php

namespace App\Http\Controllers\Agent\Payments\Commissions;

use App\Helpers\Helper;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Membership;
use Barryvdh\DomPDF\Facade\Pdf;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CommissionEarnedComponent extends Component
{ 
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_booking_id, $search_name, $allBookings, $booking_modal_data,$payments_modal_data,$common_parameters,$logged_agent,$commission;

    public function mount(){

        $this->logged_agent = auth()->user();
       
         $this->commission = Membership::whereId($this->logged_agent->membership)->first();
       
    }
    public function getBookings()
    {
        $query= Booking::query()
        ->where('agency_id', $this->logged_agent->id)
        ->paid()
        ->with('package')
        ->searchLike('booking_id', $this->search_booking_id)
        ->searchLike('mehram_name', $this->search_name);
        $this->allBookings = $query->get();
      
        return $query ->desc()->paginate($this->perPage);
        
    }

    public function filterBookings()
    {
        $this->resetPage();
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.payments.commissions.commission-earned-component', [
            'bookings' => $this->getBookings()
        ]);
    }
}
