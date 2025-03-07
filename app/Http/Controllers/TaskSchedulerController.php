<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use App\Mail\PaymentReminder;
use Illuminate\Support\Facades\Mail;

class TaskSchedulerController extends Controller
{
    public function paymentReminder()
    {
        $today = Carbon::today();
        $bookings = Booking::query()
            ->desc()
            ->with('agency')
            ->where('travel_date', '!=', null)
            ->paid()
            ->take(3)
            ->get();
        //  dd($bookings);        
        foreach ($bookings as $booking) {
            $givenDate = Carbon::parse($booking->travel_date); // Replace with your date

            if ($givenDate->greaterThan($today)) {
                $daysDifference = $givenDate->diffInDays($today);
                if ($daysDifference <= 7) {
                    $mailData = [
                        'name' => $booking->agency->owner_name,
                        'email' => $booking->email,
                        'booking_id' => $booking->booking_id,
                    ];
                    Mail::to('nayaknarendra138@gmail.com')->send(new PaymentReminder($mailData));
                }
            }
        }
    }
}
