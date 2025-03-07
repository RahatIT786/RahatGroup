<x-mail::message>
# Payment Reminder for your Bookings

Dear {{ $name }},

The Travel Date for your Booking bearing booking ID {{ $booking_id }} is approaching. In order to avoid deactivation of your booking, please pay the remaining amount.

{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

