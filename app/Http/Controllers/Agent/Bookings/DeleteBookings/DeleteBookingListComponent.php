<?php

namespace App\Http\Controllers\Agent\Bookings\DeleteBookings;

use Livewire\Component;
use App\Models\Booking;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Helpers\Helper;
use Barryvdh\DomPDF\Facade\Pdf;

class DeleteBookingListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_booking_id, $search_name;
    public $deleted_bookings, $booking_modal_data = null;
    
    public function mount(){
        $all_bookings = Booking::where('booking_id','!=', null)->get();

        foreach($all_bookings as $booking){
            $booking->update([
                'booking_id' =>$booking->booking_id + 10000
            ]);
        }
        $all_bookings = Booking::where('booking_id','!=', null)->get();
        dd($all_bookings );
    }
    // public function getDeletedBookings()
    // {
    //     $this->deleted_bookings = Booking::query()->deleted()
    //         ->with('agency', 'servicetype', 'payment')
    //         ->where('agency_id', auth()->user('agents')->id)
    //         ->searchLike('booking_id', $this->search_booking_id)
    //         ->searchLike('mehram_name', $this->search_name)
    //         ->get();

    //     return Booking::query()->deleted()
    //         ->with('agency', 'servicetype', 'city')
    //         ->where('agency_id', auth()->user('agents')->id)
    //         ->searchLike('booking_id', $this->search_booking_id)
    //         ->searchLike('mehram_name', $this->search_name)
    //         ->desc()
    //         ->paginate($this->perPage);
    // }

    // public function getBookingContent(Booking $booking)
    // {
    //     $booking->load('agency', 'servicetype', 'pnr', 'city');
    //     $this->booking_modal_data = $booking;
    // }

    // public function exportToExcel()
    // {
    //     $serialNumber = 1;
    //     $resultArray = $this->deleted_bookings->map(function ($dele_bookings) use (&$serialNumber) {
    //         $tot_payments = 0;
    //         foreach ($dele_bookings->payment as $payment) {

    //             $tot_payments += $payment->amount;
    //         }

    //         return  [
    //             'Serial No.'            => $serialNumber++,
    //             'Booking ID'            => $dele_bookings->booking_id,
    //             'Name'                  => $dele_bookings->mehram_name,
    //             'Pax'      => $dele_bookings->adult + $dele_bookings->child_bed + $dele_bookings->child + $dele_bookings->infant,
    //             // 'Agency Name'           => $rej_bookings->agency->agency_name ?? '-',
    //             'Travel Date'           => $dele_bookings->travel_date == '1970-01-01' || $dele_bookings->travel_date == '' || $dele_bookings->travel_date == null ? '-' : date('d-M-Y', strtotime($dele_bookings->travel_date)),
    //             'Total Cost'            => $dele_bookings->tot_cost ?? '-',
    //             'Balance'               => $dele_bookings->tot_cost - $tot_payments,
    //             'Status'        => $dele_bookings->booking_status == 0 ? 'Pending' : ($dele_bookings->booking_status == 1 ? 'Approved' : ($dele_bookings->booking_status == 2 ? 'Rejected' : ($dele_bookings->booking_status == 3 ? 'Cancelled' : ($dele_bookings->booking_status == 4 ? 'Suspended' : ($dele_bookings->booking_status == 5 ? 'UnderReview' : ($dele_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
    //         ];
    //     })->toArray();

    //     return Helper::exportToExcel($resultArray, 'All Deleted Bookings.xlsx');
    // }

    // public function downloadBooking()
    // {
    //     ini_set('max_execution_time', '360');
    //     // $booking =  $this->deleted_bookings = Booking::query()->deleted()->limit(800)->get();
    //     $booking = Booking::query()->deleted()
    //         ->where('agency_id', auth()->user('agent')->id)
    //         ->get();
    //     // dd($booking);
    //     if (!$booking) {
    //         return response()->json(['error' => 'not found'], 404);
    //     }
    //     $data = [
    //         'bookingData' => $booking,
    //     ];
    //     $pdf = Pdf::loadView('agent.bookings.all_bookings_pdf', $data);
    //     $docName = "All_Booking_List_" . time() . ".pdf";
    //     return response()->streamDownload(function () use ($pdf) {
    //         echo $pdf->stream();
    //     }, $docName);
    // }

    // public function filterBookings()
    // {
    //     $this->resetPage();
    // }
    // #[Layout('agent.layouts.app')]
    // public function render()
    // {
    //     return view('agent.bookings.delete-bookings.delete-booking-list-component', [
    //         'deletedbookings' => $this->getDeletedBookings()
    //     ]);
    // }
}
