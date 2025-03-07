<?php

namespace App\Http\Controllers\Staff\Leads;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LeadCreateComponent extends Component
{
    use LivewireAlert;
    public $name, $email, $phone, $message;

    public function store()
    {
        $validated = $this->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|min:3|unique:staffs,email',
            'phone' => 'required|max:10|unique:staffs,phone',
        ]);
    }

    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.leads.lead-create-component');
    }
}
