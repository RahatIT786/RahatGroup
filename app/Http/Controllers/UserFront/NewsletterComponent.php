<?php

namespace App\Http\Controllers\UserFront;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\NewsLetter;

class NewsletterComponent extends Component
{
    public $name;
    public $email;
    public $city;
    public $mobile;
    public $successMessage;
    public $errorMessage;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|string|max:150',
        'city' => 'required|string|max:255',
        'mobile' => 'required|string|max:12',
    ];

    public function subscribe()
    {
        $validatedData = $this->validate();

        try {
            NewsLetter::create($validatedData);
            session()->flash('newsletter-success', 'Subscription submitted successful!');
            $this->reset(); // Clear the form fields

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        // dd($validatedData);
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.newsletter-component');
    }
}
