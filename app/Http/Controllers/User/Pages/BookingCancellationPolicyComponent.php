<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;


class BookingCancellationPolicyComponent extends Component
{

    public function getBookingCancellation()
    {
        $agent =  Content::where('page_id', 15)->with('pagecontent')->first();
        // dd($agent);
        return $agent;
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.booking-cancellation-policy-component', [
            'bookingCancellation' => $this->getBookingCancellation()
        ]);
    }
}
