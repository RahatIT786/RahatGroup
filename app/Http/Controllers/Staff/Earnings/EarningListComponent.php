<?php

namespace App\Http\Controllers\Staff\Earnings;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EarningListComponent extends Component
{
    use LivewireAlert;
    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.earnings.earning-list-component');
    }
}
