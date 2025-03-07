<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\BookingUmrah;

use App\Models\Bookingenquiry;
use App\Models\ServiceType;
use App\Models\PackageType;
use App\Models\Packages;
use App\Models\Staff;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BookingUmrahListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $typesId, $search_name, $modalData, $modalRelationship, $support_team, $service_type;
    public $selectedServiceType;
    public $serviceTypes, $packageMaster, $packageType, $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getBookingumrah()
    {
        $this->total = Bookingenquiry::count(); // Total count of Bookingenquiry enquiry
        $this->complete = Bookingenquiry::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return Bookingenquiry::query()

            ->searchLike('cust_name', $this->search_name)
            ->searchCategory($this->service_type)
            // ->orderByRaw('support_team IS NULL DESC')
            ->OrderBy('status', 'ASC')
            ->paginate($this->perPage);
    }

    public function mount()
    {
        $this->serviceTypes = ServiceType::pluck('name', 'id');
        $this->packageMaster = Packages::pluck('name', 'id');
        $this->packageType = PackageType::pluck('package_type', 'id');
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
        Bookingenquiry::whereId($this->modalRelationship->id)->update($form_data);
        // dd($this->modalRelationship);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        // $this->resetPage();
        return redirect()->route('admin.bookingEnquiry.index');
    }

    public function isDelete(Bookingenquiry $bookingenquiry)
    {
        // dd($enquirie);
        $this->typesId = $bookingenquiry->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $bookingData = Bookingenquiry::whereId($this->typesId);
        $bookingData->delete();
        $this->alert('success', Lang::get('messages.booking_enquiry_deleted', [
            'timer' => 5000,
        ]));
    }

    public function getModalContent(Bookingenquiry $bookingenquiry)
    {
        $this->modalData = $bookingenquiry;
    }

    public function getModalRelationship(Bookingenquiry $bookingenquiry)
    {

        $this->modalRelationship = $bookingenquiry;
        // dd($this->modalRelationship);
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterBooking()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.manage-enquiry.booking-umrah.booking-umrah-list-component', [
            'Bookingumrah' => $this->getBookingumrah()
        ]);
    }
}
