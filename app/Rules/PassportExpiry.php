<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class PassportExpiry implements Rule
{
    protected $travelDate;
    protected $message;

    public function __construct($travelDate)
    {
        $this->travelDate = $travelDate;
    }

    public function passes($attribute, $value)
    {
        // Convert dates to Carbon instances
        $travelDate = Carbon::parse($this->travelDate);
        $passportExpiryDate = Carbon::parse($value);

        // Check if the passport expiry date is in the past
        if ($passportExpiryDate->isPast()) {
            $this->message = 'Passport date of expiry is already expired.';
            return false;
        }

        // Check if the passport expiry date is more than 6 months after the travel date
        if ($passportExpiryDate->lt($travelDate->copy()->addMonths(6))) {
            $this->message = 'Passport date of expiry must be more than 6 months from the travel date.';
            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->message;
    }
}

