<?php

namespace App\Http\Controllers\Admin\Setting\PaymentMode;

use App\Models\PaymentMode;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PaymentmodeListComponent extends Component
{
    use WithPagination, LivewireAlert;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public $perPage = 10,$id, $is_edit,$payment_mode,$typesId;

    public function getpaymentmode()
    {
        return PaymentMode::query()
      
        ->desc()
        ->paginate($this->perPage);

    } 

    public function filterPaymentmode()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    } 

    // public function isDelete(Membership $membership)
    // {
    //     // dd($enquirie);
    //     $this->typesId = $membership->id;
    //     $this->confirm('Are you sure to delete this?', [
    //         'icon' => 'question',
    //         'confirmButtonText' => 'Yes',
    //         'onConfirmed' => 'confirmDelete',
    //     ]);
    // }

    // public function confirmDelete()
    // {
    //     $hotelData = Membership::whereId($this->typesId);
    //     $hotelData->delete();
    //     $this->alert('success', Lang::get('messages.member_deleted'));
    // }


    public function edit(PaymentMode $paymentmode)
    {
        // dd($settings);
        $this->is_edit = true;
        $this->id = $paymentmode->id;
        $this->payment_mode = $paymentmode->payment_mode;
       
    }
    public function update()
    {
        $validated = $this->validate([
            'payment_mode' => 'required',
          
        ]);
        PaymentMode::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.paymentmode_update'));
        $this->dispatch('close-modal', modal: 'editModal');
        $this->is_edit = false;
        $this->resetPage();
        // return redirect()->route('admin.siteFee.index');
    }



    public function toggleStatus(PaymentMode $paymentmode)
    {
        // dd($enquirie);
        $this->typesId = $paymentmode->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        

        $agentData = PaymentMode::whereId($this->typesId);
        // dd($faqData);
        $agentData->update(['is_active' => !$agentData->first()->is_active]);
        $this->alert('success', Lang::get('messages.paymentmode_changed'));
    }





    public function render()
    {
        return view('admin.setting.payment-mode.paymentmode-list-component', [
            'Paymentmode' => $this->getpaymentmode()
        ]);
    }
}
