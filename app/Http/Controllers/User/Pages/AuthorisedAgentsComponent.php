<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent;
use App\Models\State;

class AuthorisedAgentsComponent extends Component
{
    public $states,$state, $state_id, $agents = [];

    protected $listeners = ['setStateForChange'];
 
    public function mount()
    {
       
        $this->states = State::query()->active()->get();
        // dd($this->states);
    }
   
    public function getAgent()
    {   
        // dd($this->state_id);
        $this->agents = Agent::active()->desc()->where('state_id', $this->state_id)->with('state')->get(); 
        $this->state  = State::find($this->state_id);
    //   $agents = Agent::active()->desc()->where('state_id', $this->state_id)->with('state')->get(); 
        // dd($this->agents);           
    }

    public function setStateForChange($code)
    {
        dd($code);
        // $state = State::where('state_code',$code)->first();
        // if($state){
        //     $this->state_id = $state->id;
        // }
    }


   

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.authorised-agents-component');
    }
}


