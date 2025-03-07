<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agm;

class AgmDetailsListComponent extends Component
{
    public $agm;

    public function mount($id)
    {
        $this->agm = Agm::active()->desc()->where('id', $id)->first();
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.agm-details-list-component');
    }
}
