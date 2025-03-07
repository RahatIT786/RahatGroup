<?php

namespace App\Http\Controllers\Agent\Quotes;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Helpers\Helper;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Mail\NegotiationSubmittedMail; // Import the Mailable class
use Illuminate\Support\Facades\Mail; 

use App\Models\Booking;
use App\Models\Pnr;
use App\Models\AdminSetting;

class QuotesDetailsComponent extends Component
{
    use LivewireAlert;

    public $quote, $quoteId, $validity, $text_class, $negotiate;

    public function mount($quote_id)
    {
        $this->quoteId = $quote_id;
        $this->quote = Booking::whereId($quote_id)->with('package')->first();

        $total_pax = $this->quote->adult + $this->quote->child_bed + $this->quote->child;
       
        if ($this->quote->service_type == 2 && $this->quote->package->umrah_type == 1) {
            $availale_seats = Pnr::select('avai_seats')->where('id', $this->quote->pnr_id)->first();
            $this->validity = ($availale_seats->avai_seats > $total_pax) ? 'Valid' : 'Invalid';
        } else {
            $this->validity = 'Valid';
        }
        $this->text_class = $this->validity === 'Valid' ? 'text-success' : 'text-danger';
    }

    public function negotiatedAmount()
    {
        $booking = Booking::whereId($this->quoteId)->first();

        $booking->update([
            'negotiated_cost' => $this->negotiate,
            'negotiation_status' => 0,
        ]);
        $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
        $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
        Mail::to($booking->agency->email)->cc($adminEmail)->send(new NegotiationSubmittedMail($booking));
        $this->alert('success', 'Amount Updated Successfully and waiting for Approval');
        return redirect()->route('agent.quotes.index');
    }

    public function rejectQuote()
    {
        $booking = Booking::whereId($this->quoteId)->first();

        $booking->update([
            'booking_status' => 3
        ]);

        $this->alert('success', 'Quote Has been rejected');
        return redirect()->route('agent.quotes.index');
    }



    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.quotes.quotes-details-component');
    }
}
