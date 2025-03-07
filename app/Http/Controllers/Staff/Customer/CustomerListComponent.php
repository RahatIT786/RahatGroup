<?php

namespace App\Http\Controllers\Staff\Customer;

use App\Mail\CustomerActiveEmail;
use App\Models\Customer;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;

class CustomerListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $typesId, $modalData = null, $search_name, $rm_staff_id, $modalRelationship, $customerId;
    public $staffMaster, $customer_id;
    protected $listeners = ['confirmed', 'confirmDelete', 'customerLogin'];

    public function getCustomer()
    {
        return Customer::query()
            ->where('rm_staff_id', auth()->user()->id)
            ->searchLike('name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function toggleStatus(Customer $customer)
    {
        $this->customerId = $customer->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        // Fetch the Customer model instance
        $customer = Customer::find($this->customerId);

        if ($customer) {
            // Check if we are activating the customer (from inactive to active)
            $wasInactive = !$customer->is_active;

            // Toggle the is_active status
            $customer->update(['is_active' => !$customer->is_active]);

            // Send an email only if the user is being activated (was inactive before)
            if ($wasInactive && $customer->is_active) {
                Mail::to($customer->email)->cc('joddhajitputel143@gmail.com')->send(new CustomerActiveEmail($customer));
            }

            // Show success message
            $this->alert('success', Lang::get('messages.user_status_changed'));
        } else {
            $this->alert('error', 'Customer not found');
        }
    }

    public function getModalContent(Customer $customer)
    {
        $this->modalData = $customer;
    }

    public function askToLogin(Customer $customer)
    {
        $this->customer_id = $customer->id;
        $this->confirm('Are you sure to login?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'customerLogin',
        ]);
    }

    public function customerLogin()
    {
        $customer = Customer::find($this->customer_id);
        if ($customer) {
            Auth::guard('customer')->login($customer);
            $this->dispatch('user-logged-in', url: route('customer.dashboard'));
        } else {
            $this->alert('success', 'User not found');
        }
    }

    public function filterCustomer()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.customer.customer-list-component', [
            'Customers' => $this->getCustomer()
        ]);
    }
}
