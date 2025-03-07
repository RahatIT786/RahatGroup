<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Mail\CustomerActiveEmail;
use App\Models\Customer;
use Livewire\Component;
use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Mail;
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
            'rm_staff_id' => 'required',
        ]);

        $form_data = [
            'rm_staff_id' => $this->rm_staff_id,
            'status'    => 1
        ];
        Customer::whereId($this->modalRelationship->id)->update($form_data);
        // dd($this->modalRelationship);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        // $this->resetPage();
        return redirect()->route('admin.customer.index');
    }

    public function isDelete(Customer $customer)
    {
        // dd($enquirie);
        $this->typesId = $customer->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $customerData = Customer::whereId($this->typesId);
        $customerData->delete();
        $this->alert('success', Lang::get('messages.user_delete'));
    }

    public function getModalContent(Customer $customer)
    {
        $this->modalData = $customer;
    }

    public function getModalRelationship(Customer $customer)
    {
        $this->modalRelationship = $customer;
        $this->rm_staff_id = $this->modalRelationship->rm_staff_id;
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
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.customer.customer-list-component', [
            'Customers' => $this->getCustomer()
        ]);
    }
}
