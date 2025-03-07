<?php

namespace App\Http\Controllers\UserFront\Profile;

use App\Models\Customer;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProfileListComponent extends Component
{
    use LivewireAlert;

    public $customer;

    public function mount()
    {
        $customerId = auth()->user('customer')->id;
        $this->customer = Customer::find($customerId);
    }

    #[Layout('user-front.layouts.app-authenticated')]
    public function render()
    {
        return view('user-front.profile.profile-list-component');
    }
}
