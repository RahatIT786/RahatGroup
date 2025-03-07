<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\CustomizedUmrah;

use App\Models\Umrah;

use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CustomizedUmrahEditComponent extends Component
{
   
    use WithPagination;
    public $manageumrahtId;
    public $nights_makkah;
    public $nights_medina;
    public $hotel_type;
    public $adults;
    public $sharing_type;
    public $travel_date;
    public $support_team;
   

    protected $rules = [
        'nights_makkah' => 'required',
        'nights_medina' => 'required',
        'hotel_type' => 'required',
        'adults' => 'required',
        'sharing_type' => 'required',
        'travel_date' => 'required',
        'support_team' => 'required',
       
    ];

    public function mount(Umrah $umrah)
    {
        $this->manageumrahtId = $umrah->id;
        $this->nights_makkah = $umrah->nights_makkah;
        $this->nights_medina = $umrah->nights_medina;
        $this->hotel_type = $umrah->hotel_type;
        $this->adults = $umrah->adults;
        $this->sharing_type = $umrah->sharing_type;
        $this->travel_date = $umrah->travel_date;
        $this->support_team = $umrah->support_team;
       
    }
    public function update()
    {
        $validated = $this->validate();
// dd($validated);
Umrah::whereId($this->manageumrahtId)->update([
            'nights_makkah' => $this->nights_makkah,
            'nights_medina' => $this->nights_medina,
            'hotel_type' => $this->hotel_type,
            'adults' => $this->adults,
            'sharing_type' => $this->sharing_type,
            'travel_date' => $this->travel_date,
            'support_team' => $this->support_team,
            
        ]);

        session()->flash('success', Lang::get('messages.customized_update'));
        return redirect()->route('admin.umrah.index');
    }

    public function render()
    {
        return view('admin.manage-enquiry.customized-umrah.customized-umrah-edit-component');
    }
}
