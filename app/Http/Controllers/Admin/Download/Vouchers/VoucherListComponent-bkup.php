<?php

namespace App\Http\Controllers\Admin\Download\Vouchers;

use App\Models\Booking;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class VoucherListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10, $start_date, $end_date;

    public function getVoucher()
    {
        return Payment::select(
            'aihut_payments.*',
            'aihut_booking.booking_id as bookingId',
            'aihut_booking.user_type',
            'aihut_booking.tot_cost',
            'aihut_booking.mehram_name',
            'aihut_booking.service_type as booking_service_type',
            'aihut_booking.checkin_date',
            'aihut_booking.visa_date',
            'aihut_booking.travel_date',
            'aihut_booking.agency_id',
            'aihut_booking.created_at',
            'aihut_agent.id as aihut_agent_id',
            'aihut_agent.agency_name',
            'aihut_service_type.name','aihut_booking.adult', 
            'aihut_booking.child',
            'aihut_booking.child_bed',
            'aihut_booking.infant',
        )
        ->join('aihut_booking', 'aihut_payments.booking_id', '=', 'aihut_booking.booking_id')
        ->join('aihut_agent', 'aihut_booking.agency_id', '=', 'aihut_agent.id')
        ->join('aihut_service_type', 'aihut_booking.service_type', '=', 'aihut_service_type.id')
        ->when($this->search_booking_id, function ($query) {
            return $query->where('aihut_booking.booking_id', 'like', '%' . $this->search_booking_id . '%');
        })
        ->when($this->search_name, function ($query) {
            return $query->where('aihut_booking.mehram_name', 'like', '%' . $this->search_name . '%');
        })
        ->when($this->start_date && $this->end_date, function ($query) {
            return $query->whereBetween('aihut_booking.created_at', [$this->start_date, $this->end_date]);
        })
        ->orderBy('id', 'desc')
        ->paginate($this->perPage);
    }

    public function filterBookings()
    {
        $this->resetPage();
    }

    public function downloadVoucher($vouchersId)
    {

        // Retrieve exam data
        $voucherData = Booking::where('booking_id', $vouchersId)->first();
        if (!$voucherData) {
            return response()->json(['error' => 'not found'], 404);
        }
        // Prepare data for the PDF view
        $data = [
            'agency' => $voucherData->agency->agency_name ?? '',
            'agency_mail' => $voucherData->agency->email ?? '',
            'agency_website' => $voucherData->agency->website ?? '',
            'agency_tel' => $voucherData->agency->mobile ?? '',
            'agency_city' => $voucherData->agency->city ?? '',
            'booking_id' => $voucherData->booking_id ?? '',
            'meheram_name' => $voucherData->mehram_name ?? '',
            'visa_type' => $voucherData->visatype->visa_name ?? '',
            'country' => $voucherData->country->countryname ?? '',
            'no_of_person' => $voucherData->adult + $voucherData->child + $voucherData->child_bed + $voucherData->infant ?? '',
            'adult' => $voucherData->adult ?? '',
            'children' => $voucherData->child + $voucherData->child_bed ?? '',
            'infant' => $voucherData->infant ?? '',
            'visa_date' => $voucherData->visa_date ?? '',
            'payable_amount' => $voucherData->tot_cost ?? '',
        ];
        $pdf = Pdf::loadView('admin.download.vouchers.voucher-report-pdf-component', $data);
        $docName = "Voucher_Report_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }
    public function render()
    {
        // dd($this->getVoucher());
        return view('admin.download.vouchers.voucher-list-component', [
            'Vouchers' => $this->getVoucher()
        ]);
    }
}
