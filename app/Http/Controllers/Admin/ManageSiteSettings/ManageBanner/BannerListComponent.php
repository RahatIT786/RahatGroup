<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageBanner;


use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use App\Models\Agent\ManageBanner;
use Livewire\Component;

class BannerListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $banner_title, $search_banner_title, $bannerId = null;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getManageBanner()
    {
        // dd(auth()->user('agent')->id);
        return ManageBanner::query()
            // ->where('agent_id', auth()->user('agent')->id)
            ->searchLike('banner_title', $this->search_banner_title)
            ->desc()
            ->paginate($this->perPage);
    }

    public function filterBannerTitle()
    {
        $this->resetPage();
    }

    public function toggleStatus(ManageBanner $manageBanner)
    {
        // dd($manageBanner);
        $this->bannerId = $manageBanner->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        // dd($this->bannerId);
        $bannerData = ManageBanner::whereId($this->bannerId);
        // dd($bannerData);
        $bannerData->update(['is_active' => !$bannerData->first()->is_active]);
        $this->alert('success', Lang::get('messages.banner_status_changed'));
    }

    public function isDelete(ManageBanner $manageBanner)
    {
        // dd($manageBanner);
        $this->bannerId = $manageBanner->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }
    public function confirmDelete()
    {
        $bannerData = ManageBanner::whereId($this->bannerId);
        //   dd($bannerData);
        $bannerData->delete();
        $this->alert('success', Lang::get('messages.banner_delete'));
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-banner.banner-list-component', [
            'manageBanners' => $this->getManageBanner(),
        ]);
    }
}
