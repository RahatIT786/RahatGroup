<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageLocationAddress;

use Livewire\Component;
use App\Models\Location;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use App\Helpers\Helper;
use App\Traits\CommonScopes;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class LocationListComponent extends Component
{
    use WithPagination, CommonScopes, LivewireAlert;

    public $perPage = 10,$search_email,$typesId,$location,$location_modal_data;
    protected $listeners = ['confirmed','confirmDelete'];

    public function getLocation()
    {
        return Location::query()
        ->with('country', 'city')
        ->searchLike('email', $this->search_email)
        // ->desc()
        ->paginate($this->perPage);
    }

    public function filterLocation()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    public function view(Location $location)
    {
        $this->location_modal_data = $location;
    }

    public function isDelete(Location $location)
    {
        // dd($contact);
        $this->typesId = $location->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $locationAddress = Location::whereId($this->typesId);
        $locationAddress->delete();
        $this->alert('success', Lang::get('messages.location_deleted'));
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-location-address.location-list-component', [
            'locations' => $this->getLocation()
        ]);
    }
}
