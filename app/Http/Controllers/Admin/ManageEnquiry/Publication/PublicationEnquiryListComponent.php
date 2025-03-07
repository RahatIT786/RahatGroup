<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\Publication;

use App\Models\PublicationEnquiry;
use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PublicationEnquiryListComponent extends Component
{

    use WithPagination, LivewireAlert;
    public $perPage = 10, $typesId, $modalData = null, $search_inq_no, $support_team, $modalRelationship;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getPublicationEnq()
    {
        $this->total = PublicationEnquiry::count(); // Total count of PublicationEnquiry enquiry
        $this->complete = PublicationEnquiry::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return PublicationEnquiry::query()
            ->searchLike('unique_id', $this->search_inq_no)
            ->OrderBy('status', 'ASC')
            ->paginate($this->perPage);
    }

    public function mount()
    {
        $this->staffMaster = Staff::where('role_id', 5)
            ->get()
            ->mapWithKeys(function ($staff) {
                return [$staff->id => $staff->first_name . ' ' . $staff->last_name];
            });
    }

    public function update()
    {
        $validated = $this->validate([
            'support_team' => 'required',
        ]);

        $form_data = [
            'support_team' => $this->support_team,
            'status'    => 1
        ];
        PublicationEnquiry::whereId($this->modalRelationship->id)->update($form_data);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        return redirect()->route('admin.publicationEnq.index');
    }

    public function isDelete(PublicationEnquiry $publicationenq)
    {
        // dd($enquirie);
        $this->typesId = $publicationenq->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $publicationData = PublicationEnquiry::whereId($this->typesId);
        $publicationData->delete();
        $this->alert('success', Lang::get('messages.publication_delete'));
    }

    public function getModalContent(PublicationEnquiry $publication)
    {
        $this->modalData = $publication;
    }

    public function getModalRelationship(PublicationEnquiry $publication)
    {
        $this->modalRelationship = $publication;
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterPublicationEnq()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.manage-enquiry.publication.publication-enquiry-list-component', [
            'Publications' => $this->getPublicationEnq()
        ]);
    }
}
