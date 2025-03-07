<?php

namespace App\Http\Controllers\Admin\Setting\Staff;

use App\Helpers\Helper;
use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class StaffListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    public $perPage = 10, $staff_modal_data, $staffStsId, $staffDeleteId, $search_name, $search_email, $staffDataExcel, $id, $password;

    public function getStaff()
    {
        $this->staffDataExcel = Staff::with('staffrole', 'staffdepartment', 'country', 'city')
            ->searchLike('first_name', $this->search_name)
            ->searchLike('email', $this->search_email)
            ->asc()
            ->get();

        return Staff::query()
            ->with('staffrole', 'staffdepartment', 'country', 'city')
            ->searchLike('first_name', $this->search_name)
            ->searchLike('email', $this->search_email)
            ->desc()
            ->paginate($this->perPage);
    }

    public function isDelete(Staff $staffdelete)
    {
        $this->staffDeleteId = $staffdelete->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $staffDltData = Staff::whereId($this->staffDeleteId);
        $staffDltData->delete();
        $this->alert('success', Lang::get('messages.staff_delete'));
    }

    public function toggleStatus(Staff $staffsts)
    {
        $this->staffStsId = $staffsts->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $staffStsData = Staff::whereId($this->staffStsId);
        $staffStsData->update(['is_active' => !$staffStsData->first()->is_active]);
        $this->alert('success', Lang::get('messages.staff_status_changed'));
    }

    public function getStaffContent(Staff $staff)
    {
        $staff->load('staffrole', 'staffdepartment', 'country', 'city');
        $this->staff_modal_data = $staff;
    }

    public function downloadStaffList()
    {
        // Retrieve data
        ini_set('max_execution_time', '360');
        $staffData = Staff::get();

        if (!$staffData) {
            return response()->json(['error' => 'not found'], 404);
        }
        $data = [
            'staffData' => $staffData,
        ];
        $pdf = Pdf::loadView('admin.setting.staff.staff-pdf-component', $data);

        $docName = "Staff_List_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    public function exportToExcel()
    {
        $serialNumber = 1;

        $resultArray = $this->staffDataExcel->map(function ($staffDataExcel) use (&$serialNumber) {
            return  [
                'Serial No.'            => $serialNumber++,
                'Staff Name' => $staffDataExcel->first_name . ' ' . ($staffDataExcel->last_name ?? '---'),
                'Email'                 => $staffDataExcel->email ?? '---',
                'Mobile'                => $staffDataExcel->mobile ?? '---',
                'Role'                  => $staffDataExcel->staffrole->staff_role ?? '---',
                'Department'            => $staffDataExcel->staffdepartment->department_name ?? '---',
                'Office No'            => $staffDataExcel->office_no ?? '---',
            ];
        })->toArray();
        return Helper::exportToExcel($resultArray, 'All Staff.xlsx');
    }

    public function filterStaff()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
	
	public function resetForm()
    {
        $this->id = null; // Reset the staff ID
        $this->password = ''; // Reset the password
    }

    public function openChangePasswordModal($staffId)
    {
        $this->id = $staffId; // Store the staff ID to use it when updating the password
        $this->password = '';  // Reset the password field
    }
    public function update()
    {
        $this->validate([
            'password' => 'required|string|min:6', // Adjust validation as necessary
        ]);
        // Update the password for the specified staff member
        Staff::whereId($this->id)->update(['password' => Hash::make($this->password)]);

        $this->alert('success', Lang::get('messages.password')); // Show success alert
        $this->resetForm(); // Reset the form fields
        // $this->dispatchBrowserEvent('close-modal');
        return to_route('admin.staff.index');
    }
	
    public function render()
    {
        return view('admin.setting.staff.staff-list-component', [
            'staffs' => $this->getStaff(),
        ]);
    }
}
