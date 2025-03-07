<?php

namespace App\Http\Controllers\Admin\Resources\Ration;

use App\Models\Ration;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class RationEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $cityData;
    public $no_item, $txn_date, $ration_title, $id;
    public $itemDetails = [];
    public $items = [];

    public function mount(Ration $ration)
    {
        $this->id = $ration->id;
        $this->txn_date = $ration->txn_date;
        $this->ration_title = $ration->ration_title;
    }

    public function update()
    {
        $validated = $this->validate([
            'txn_date' => 'required',
            'ration_title' => 'required',
        ], [], [
            'txn_date' => 'Transaction Date',
            'ration_title' => 'Ration Title',
        ]);

        $ration = Ration::find($this->id);
        $ration->update($validated);

        $this->alert('success', 'Successfully Updated');
        return redirect()->route('admin.manage-ration.index');
    }
    public function render()
    {
        return view('admin.resources.ration.ration-edit-component');
    }
}
