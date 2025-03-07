<?php

namespace App\Export;

use App\Models\Payment;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Collection;

class PaymentExport
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function export()
    {
        $users = Payment::all();
        
        (new FastExcel($users))->download('Payments.xlsx');
    }
}


