<?php

namespace App\Http\Controllers\Admin\Quotes;

use App\Helpers\Helper;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\ServiceType;
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

class QuotesListComponent extends Component
{   
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    protected $listeners = ['confirmed', 'confirmDelete'];
    public $currentSegment, $search_request_id,$search_mehram_name, $search_name,$search_req_type,$search_status, $perPage = 10;
    public $allBookings, $booking_id, $booking_modal_data = null, $payments_modal_data = null,$search_start_date,$search_end_date, $total_amount,$payment_amount, $payments_modal_status = [],$total_amount_int;
    public $showConfirmation = false;
    public $req_types;
    public $sort_request = false;

    public function mount(){
        $this->req_types = ServiceType::get();
    }

    public function getQuotes()
    {   
        
        $query= Booking::query()->with('agency', 'servicetype','payment')
        ->where('request_id','!=',0)
        ->pending()
        ->searchLike('request_id', $this->search_request_id)
        ->searchLike('mehram_name', $this->search_mehram_name)
        ->when($this->search_req_type, function ($query) {
            $query->where('service_type', $this->search_req_type);  // Example condition
        })
        ->when($this->search_status != null, function ($query) {
            $query->where('booking_status', $this->search_status);  // Example condition
        })
        ->searchAgent($this->search_name)
        ->sort('request_id', $this->sort_request)
        ->searchRaisedDate($this->search_start_date, $this->search_end_date)
        ->desc();

        $this->allBookings = $query->get();

        return $query ->paginate($this->perPage);
    }

    public function filterBookings()
    {   

        // $this->resetPage(); // Reset pagination when the search term changes
    }

    public function sortBookings()
    {   
    //    dd($this->search_status);
        $this->sort_request = !$this->sort_request;
        
        $this->resetPage(); // Reset pagination when the search term changes
    }

    


    public function render()
    {
        return view('admin.quotes.quotes-list-component', [
            'quotes' => $this->getQuotes()
        ]);
    }
   
}
