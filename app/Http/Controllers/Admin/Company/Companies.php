<?php

namespace App\Http\Controllers\Admin\Company;

use Livewire\Component;
use App\Models\MainCompany;


class Companies extends Component
{
    public function confirmDelete($id){
        $company = MainCompany::find($id);
        if ($company) {
            $company->delete_status = 2; // Mark as trashed
            $company->save();

            // Refresh the list
            // $this->companies = MainCompany::where('delete_status', 1)->get();

            session()->flash('message', 'Company moved to trash successfully!');
        }
    }
    public function render()
    {
        $company_details = MainCompany::where('delete_status',1)->get();
        return view('admin.company.companies',['company_details' => $company_details]);
    }
}
