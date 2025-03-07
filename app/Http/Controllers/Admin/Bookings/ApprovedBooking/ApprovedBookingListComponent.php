<?php
namespace App\Http\Controllers\Admin\Bookings\ApprovedBooking;

use App\Helpers\Helper;
use App\Models\Booking;
use App\Models\Payment;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use OpenSpout\Common\Entity\Style\Style;
use Illuminate\Support\Collection;
use Rap2hpoutre\FastExcel\FastExcel;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Fpdi;
use Carbon\Carbon;
class ApprovedBookingListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    protected $listeners = ['confirmed', 'confirmDelete'];
    public $currentSegment, $search_booking_id,$search_mehram_name, $search_name, $perPage = 10;
    public $approved_bookings, $booking_id, $booking_modal_data = null, $payments_modal_data = null,$search_start_date,$search_end_date, $total_amount,$payment_amount, $payments_modal_status = [],$total_amount_int;
    public $showConfirmation = false;
    

    public function getApprovedBooking()
    {        

            $query= Booking::query()->approved()->with('agency', 'servicetype','payment')
            ->withTrashed() // Load the agent relationship
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_mehram_name)
            ->searchAgent($this->search_name)
            ->searchTravelDate($this->search_start_date, $this->search_end_date)
            ->desc();

            $this->allBookings = $query->get();

            return $query ->paginate($this->perPage);
  
    }
    public function filterBookings()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    public function getBookingContent(Booking $booking)
    {
        $booking->load('agency', 'servicetype', 'city','pnr','packagetype','sharingtype');
        $this->booking_modal_data = $booking;
    }

    public function getPaymentContent($booking_id)

    {

        $this->payments_modal_data = Payment::where('booking_id', $booking_id)->get();

    }

    public function deleted()
    {
        $this->alert('success','Already Deleted !');
    }

    public function isDelete(Booking $booking)
    {
        $this->booking_id = $booking->id;
        if($booking->booking_status != 6){
            $this->confirm('Are you sure to delete this?', [
                'icon' => 'question',
                'confirmButtonText' => 'Yes',
                'onConfirmed' => 'confirmDelete',
            ]);
        }else{
            $this->deleted();
        }  
    }

    public function confirmDelete()
    {
        $bookingData = Booking::whereId($this->booking_id);

        if ($bookingData) {
            $bookingData->update(['deleted_at' => now(),'booking_status' => 6]);
            $this->alert('success', 'Deleted successfully');
        } else {
            $this->alert('error', 'Record not found');
        }
    }

    public function getPaymentStatus($booking_id)
    {   
        $this->payments_modal_status = Payment::where('booking_id', $booking_id)->with('booking')->get();
        // dd($this->payments_modal_status);
        $this->booking_id = $booking_id;
        $view_booking = Booking::where('booking_id', $booking_id)->first();
        $this->total_amount = number_format($view_booking->tot_cost,2);

        $this->total_amount_int = $view_booking->tot_cost;

        // dd($this->total_amount_int);
    }

    public function paymentSave()
    {
        $last_record = Payment::withTrashed()->orderBy('receipt_id','desc')->first();
        $receipt_id = $last_record->receipt_id + 1 ;
        // dd($this->booking_id,$this->payment_amount);
        $today = Carbon::today();
      
        Payment::create([
            'booking_id' => $this->booking_id,
            'receipt_id' => $receipt_id,
            'deposite_type' => 'Cashfree',
            'amount' => $this->payment_amount,
            'txn_date' => $today,
            'is_paid' => 0,
            'payment_status' => 0,
            
        ]);

        $this->alert('success', 'Booking Added Successfully');
        return redirect()->route('admin.booking.made.payment');
    }

    public function exportToExcel()
    {   
        $resultArray = $this->allBookings->map(function($all_bookings, $index){
            $tot_payments = 0;
            foreach($all_bookings->payment as $payment){
                $tot_payments += $payment->amount;
            }

            return  [
                'Serial No.'            => $index + 1,
                'Booking ID'            => $all_bookings->booking_id,
                'Name'                  => $all_bookings-> mehram_name,
                'Total Passengers'      => $all_bookings->adult + $all_bookings->child_bed + $all_bookings->child + $all_bookings->infant,
                'Agency Name'           => $all_bookings->agency != null ? $all_bookings->agency->agency_name : '-',
                'Travel Date'           => $all_bookings->travel_date == '1970-01-01' || $all_bookings->travel_date == '' || $all_bookings->travel_date == null ? '-' : date('d-M-Y', strtotime($all_bookings->travel_date)),
                'Total Cost'            => $all_bookings->tot_cost ?? '-',
                'Balance'               => $all_bookings->tot_cost - $tot_payments,
                'Booking Status'        => $all_bookings->booking_status == 0 ? 'Pending' : 
                            ($all_bookings->booking_status == 1 ? 'Approved' : 
                            ($all_bookings->booking_status == 2 ? 'Rejected' : 
                            ($all_bookings->booking_status == 3 ? 'Cancelled' : 
                            ($all_bookings->booking_status == 4 ? 'Suspended' : 
                            ($all_bookings->booking_status == 5 ? 'UnderReview' : 
                            ($all_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
            ];
        })->toArray();
        return Helper::exportToExcel($resultArray, 'All Approved Bookings.xlsx');
    }
    public function download()
    {   
        ini_set('max_execution_time', '3600');
        $data = [
            'Booking_Data' => $this->approved_bookings
        ];
        $pdf = Pdf::loadView('admin.bookings.all-bookings-pdf', $data);
        $docName = "All Approved Bookings" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }
    public function render()
    {
        return view('admin.bookings.approved-booking.approved-booking-list-component', ['approvedBookings' => $this->getApprovedBooking()]);
    }
}
