<?php

namespace App\Http\Controllers\Agent\Package;

use Livewire\Attributes\Layout;
use Livewire\Component;

class PackagePricesListComponent extends Component
{
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.package.package-prices-list-component');
    }
}
