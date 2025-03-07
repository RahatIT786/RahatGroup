<?php

namespace App\Http\Controllers\Admin\Setting\SiteFee;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class SiteFeeListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_name, $status, $id, $is_edit, $name, $price;
    public function getSiteSetting()
    {
        return SiteSetting::query()
            ->searchLike('name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
    }
    public function edit(SiteSetting $settings)
    {
        // dd($settings);
        $this->is_edit = true;
        $this->id = $settings->id;
        $this->name = $settings->name;
        $this->price = $settings->price;
    }
    public function update()
    {
        $validated = $this->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        SiteSetting::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.site_fee_update'));
        $this->dispatch('close-modal', modal: 'editModal');
        $this->is_edit = false;
        $this->resetPage();
        // return redirect()->route('admin.siteFee.index');
    }
    public function filterSetting()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    public function render()
    {
        return view('admin.setting.site-fee.site-fee-list-component', [
            'Sitesettings' => $this->getSiteSetting()
        ]);
    }
}
