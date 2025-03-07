<?php

namespace App\Http\Controllers\Admin\Components;

use App\Models\Booking;
use Livewire\Component;

class InvoicesComponent extends Component
{
    public $perPage;
    public function mount()
    {
        $this->perPage = 5;
    }
    public function getInvoices()
    {
        $records = Booking::with('payment', 'agency')
            ->approved()
            ->paymentAmountSum()
            ->orderByDesc('id')
            ->get();

        $filteredRecords = $records->filter(function ($compare) {
            return $compare->tot_cost <= $compare->payment_sum_amount;
        });

        return $filteredRecords;
    }

    public function render()
    {
        return view('admin.components.invoices-component', [
            'invoices' => $this->getInvoices(),
        ]);
    }
}
