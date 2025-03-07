<?php

namespace App\Http\Controllers\User;

use Livewire\Component;

class BookingModalComponent extends Component
{
    public $q_name;

    public function abc()
    {
        dd("FINALLLLLLLYYYYY", $this->q_name);
    }
    public function render()
    {
        return view('user.booking-modal-component');
    }
}
