<?php

namespace App\Http\Controllers\Agent\Website;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Packages;
use \Illuminate\Validation\ValidationException;

class HomeComponent extends Component
{

    public $email, $password;
    public $packages;

    public function mount(){

        $this->packages = Packages::where([
                                ['is_active', 1],
                                ['service_id', 2],
                                ['umrah_type', 1]
                            ])->select('id', 'name')->get();


    }

    public function loginPost()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        // dd($this->email, $this->password);

        if (auth()->guard('agent')->attempt([$this->email, $this->password])) {
            return redirect()->route('agent-website.dashboard');
        } else {
            throw ValidationException::withMessages([
                $this->email => [trans('auth.failed')],
            ]);
        }
    }



    #[Layout('agent.website.layouts.app')]
    public function render()
    {
        // dd(request()->agent);
        return view('agent.website.home-component', [
            'agent' => request()->agent,
            'packages' => $this->packages,
        ]);
    }
}
