<?php

namespace App\Http\Controllers\Admin\Services\ManagePublication;

use App\Models\Publication;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class PublicationListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $name, $image, $description, $price, $search_name, $publicationstatusId, $publicationDeleteId, $desc_modal_data;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getPublication()
    {
        return Publication::query()
            ->searchLike('name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function filterPublication()
    {
        $this->resetPage();
    }

    public function toggleStatus(Publication $publication)
    {
        $this->publicationstatusId = $publication->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $publicationsData = Publication::whereId($this->publicationstatusId);
        $publicationsData->update(['is_active' => !$publicationsData->first()->is_active]);
        $this->alert('success', Lang::get('messages.publication_status_changed'));
    }

    public function isDelete(Publication $service)
    {
        // dd($service);
        $this->publicationDeleteId = $service->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }
    public function confirmDelete()
    {
        $publicationDeleteData = Publication::whereId($this->publicationDeleteId);
        $publicationDeleteData->delete();
        $this->alert('success', Lang::get('messages.publication_delete'));
    }

    public function getDesc(Publication $publication)
    {
        $this->desc_modal_data = $publication;
    }

    public function render()
    {
        return view('admin.services.manage-publication.publication-list-component', [
            'Publications' => $this->getPublication(),
        ]);
    }
}
