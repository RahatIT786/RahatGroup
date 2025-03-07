<?php

namespace App\Http\Controllers\UserFront\Quotes;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Mail\NegotiationSubmittedMail; // Import the Mailable class
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use App\Models\Booking;
use App\Models\Pnr;

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

    // public function negotiatedAmount()
    // {
    //     $booking = Booking::whereId($this->quoteId)->first();

    //     $booking->update([
    //         'negotiated_cost' => $this->negotiate,
    //         'negotiation_status' => 0,
    //     ]);
    //     // Send email to admin and cc
    //     Mail::to('admin@example.com')
    //         ->cc('rkanjandas05@gmail.com')
    //         ->send(new NegotiationSubmittedMail($booking));
    //     $this->alert('success', 'Amount Updated Successfully and waiting for Approval');
    //     return redirect()->route('agent.quotes.index');
    // }

    public function rejectQuote()
    {
        $booking = Booking::whereId($this->quoteId)->first();

        $booking->update([
            'booking_status' => 3
        ]);

        $this->alert('success', 'Qoute Has been rejected');
        return redirect()->route('agent.quotes.index');
    }
    #[Layout('user-front.layouts.app-authenticated')]
    public function render()
    {
        return view('user-front.quotes.quotes-details-component');
    }
}
