<?php

namespace App\Http\Controllers\Admin\Resources\VoucherContent;

use App\Helpers\Helper;
use App\Models\VoucherContent;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;

class VoucherContentEditComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $Id, $voucher_content = null;

    public function mount(VoucherContent $voucher)
    {
        // dd($voucher);
        $this->Id = $voucher->id;
        $this->voucher_content = $voucher->voucher_content;
    }

    public function update()
    {
        // dd($this->voucher_content);
        $validated = $this->validate([
            'voucher_content' => 'required',
        ], [], [
            'voucher_content' => 'voucher content',
        ]);
        // dd($validated);
        $notify = VoucherContent::find($this->Id);
        $notify->update($validated);
        $this->alert('success', Lang::get('messages.voucher_update', [
            'timer' => 5000,
        ]));
        return to_route('admin.voucherContent.edit', 1);
    }

    public function render()
    {
        return view('admin.resources.voucher-content.voucher-content-edit-component');
    }
}
