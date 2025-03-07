<?php

namespace App\Http\Controllers\Agent\Bookings;

use App\Models\Agent\Booking;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class BookingListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    public $search_title, $search_location, $search_status, $perPage = 5;

    public $modalData = null;
    public $userId = null;

    protected $listeners = ['confirmed', 'confirmDelete'];
    public function getBookings()
    {
        // return Booking::query()
        //     ->searchLike('title',$this->search_title)
        //     ->searchLike('location',$this->search_location)
        //     ->searchStatus('is_active',$this->search_status)
        //     ->paginate($this->perPage);
    }

    
    public function filterBookings()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }


    #[Layout('agent.layouts.app')]
    public function render()
    {
        // dd($this->getBookings());
        // return view('agent.bookings.booking-list-component',[
        //     'bookings' => $this->getBookings()
        // ]);
        return view('agent.bookings.booking-list-component');
    }
}
