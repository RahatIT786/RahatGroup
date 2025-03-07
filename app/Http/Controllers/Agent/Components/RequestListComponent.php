<?php

namespace App\Http\Controllers\Agent\Components;

use App\Models\Booking;
use Livewire\Component;

class RequestListComponent extends Component
{

    public function getQuotes()
    {
        return Booking::query()
            ->desc()
            ->requests()
            ->pending()
            ->where('agency_id', auth()->user()->id)
            ->with('package', 'package.pkgDetails', 'packagetype', 'servicetype')
            ->get()->take(5);
    }
    public function render()
    {
        return view('agent.components.request-list-component', [
            'requestQuotes' => $this->getQuotes()
        ]);
    }
}
