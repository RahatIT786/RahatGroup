<?php

namespace App\Http\Controllers\UserFront\Quotes;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Booking;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class QuotesListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    protected $listeners = ['confirmed', 'confirmDelete'];
    public $Id, $perPage = 10, $search_booking_id, $search_name, $allQuotes, $request_modal_data;
    public $search_travel_date, $search_request_id, $service_type, $search_service_type, $search_package_name, $tot_cost, $negotiate_amount, $id;

    public function getQuotes()
    {
        //  dd(auth()->user('agent')->id);
        $query = Booking::query()
            ->requests()
            ->pending()
            ->where('user_type', auth()->user()->id)
            ->with('package', 'package.pkgDetails', 'packagetype', 'servicetype')
            ->searchLike('request_id', $this->search_request_id)
            ->searchLike('mehram_name', $this->search_name)
            ->searchLike('travel_date', $this->search_travel_date)
            ->SearchLikeInRelation('servicetype.name', $this->search_service_type)
            ->SearchLikeInRelation('package.name', $this->search_package_name);
        // service_type



        // $sql = $query->toSql();
        // $bindings = $query->getBindings();

        // // Interpolating bindings into the query
        // $fullSql = vsprintf(str_replace('?', '%s', $sql), array_map(function ($binding) {
        //     return is_numeric($binding) ? $binding : "'".$binding."'";
        // }, $bindings));

        // dd($fullSql);



        $this->allQuotes = $query->get();
        // dd($this->allQuotes);
        return $query->desc()->paginate($this->perPage);
    }
    public function filterBookings()
    {
        // dd($this->search_service_type);
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

    public function confirmDelete()
    {
        $booking = Booking::where('id', $this->Id)->first();

        if ($booking) {
            $booking->delete();
            $this->alert('success', 'Request has been deleted successfully');
        } else {
            $this->alert('error', 'Booking not found');
        }
    }

    public function getRequestContent(Booking $booking)
    {

        $booking->load('agency', 'servicetype', 'pnr', 'city', 'packagetype', 'sharingtype');
        $this->request_modal_data = $booking;

        //  dd($this->request_modal_data);
    }

    public function getTotCost(Booking $booking)
    {

        $this->id = $booking->id;
        $this->tot_cost = $booking->tot_cost;
        $this->negotiate_amount = $booking->negotiated_cost;
        //   dd($this->tot_cost);
    }
    public function negotiatedAmount()
    {
        $booking = Booking::whereId($this->id)->first();

        $booking->update([
            'negotiated_cost' => $this->negotiate_amount,
            'negotiation_status' => 0,
        ]);

        $this->alert('success', 'Amount Updated Successfully and waiting for Approval');
        // return redirect()->route('agent.quotes.index');
    }

    #[Layout('user-front.layouts.app-authenticated')]
    public function render()
    {
        return view('user-front.quotes.quotes-list-component', [
            'quotes' => $this->getQuotes()
        ]);
    }
}
