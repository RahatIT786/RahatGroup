<?php

namespace App\Http\Controllers\Admin\Services\ManageService;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use App\Models\Services;


class ServicesListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $name, $service_img, $price, $description, $search_name, $serviceId = null;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getService()
    {
        // dd(auth()->user('agent')->id);
        return Services::query()
            // ->where('agent_id', auth()->user('agent')->id)
            ->searchLike('name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function filterService()
    {
        $this->resetPage();
    }

    public function toggleStatus(Services $service)
    {
        // dd($service);
        $this->serviceId = $service->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        // dd($this->serviceId);
        $serviceData = Services::whereId($this->serviceId);
        // dd($bannerData);
        $serviceData->update(['is_active' => !$serviceData->first()->is_active]);
        $this->alert('success', Lang::get('messages.service_status_changed'));
    }

    public function isDelete(Services $service)
    {
        // dd($service);
        $this->serviceId = $service->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }
    public function confirmDelete()
    {
        $serviceData = Services::whereId($this->serviceId);
        //   dd($serviceData);
        $serviceData->delete();
        $this->alert('success', Lang::get('messages.service_delete'));
    }

    public function render()
    {
        return view('admin.services.manage-service.services-list-component', [
            'Services' => $this->getService(),
        ]);
    }
}
