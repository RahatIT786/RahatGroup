<?php

namespace App\Http\Controllers\Agent\Settings\UserContactList;

use App\Models\Agent\Contact;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ContactListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $typesId, $search_name, $search_email, $contact_modal_data;
    protected $listeners = ['confirmDelete'];


    public function getcontactList()
    {
        return Contact::query()
            ->where('agent_id', auth()->user()->id)
            ->searchLike('name', $this->search_name)
            ->searchLike('email', $this->search_email)
            ->desc()
            ->paginate($this->perPage);
    }

    public function filterContact()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    public function isDelete(Contact $contact)
    {
        // dd($contact);
        $this->typesId = $contact->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $hotelData = Contact::whereId($this->typesId);
        $hotelData->delete();
        $this->alert('success', Lang::get('messages.contact_deleted'));
    }
    public function getContact(Contact $contact)
    {
        $this->contact_modal_data = $contact;
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.settings.user-contact-list.contact-list-component', [
            'contactList' => $this->getcontactList()
        ]);
    }
}
