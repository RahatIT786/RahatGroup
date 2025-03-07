<?php

namespace App\Http\Controllers\Admin\Setting\SitePage;

use App\Models\SettingPage;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class SitePageListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_page_name, $status, $id, $is_edit, $page_name;
    public function getSitePage()
    {
        return SettingPage::query()
            ->searchLike('page_name', $this->search_page_name)
            ->desc()
            ->paginate($this->perPage);
    }
    public function filterSetting()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    public function edit(SettingPage $settings)
    {
        // dd($settings);
        $this->is_edit = true;
        $this->id = $settings->id;
        $this->page_name = $settings->page_name;
        // $this->status = $settings->is_active;
    }

    public function update()
    {
        $validated = $this->validate([
            'page_name' => 'required',
        ]);
        // $validated['is_active'] = $this->status;
        SettingPage::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.pagelist_update'));
        $this->dispatch('close-modal', modal: 'editModal');
        $this->is_edit = false;
        $this->resetPage();
    }
    public function render()
    {
        return view('admin.setting.site-page.site-page-list-component', [
            'SitePages' => $this->getSitePage()
        ]);
    }
}
