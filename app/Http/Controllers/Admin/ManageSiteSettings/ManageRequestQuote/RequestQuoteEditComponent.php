<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageRequestQuote;

use App\Models\Bookingenquiry;
use App\Models\ServiceType;
use App\Models\PackageMaster;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;

class RequestQuoteEditComponent extends Component
{
    use WithPagination;

    public $manageEnquirietId;
    public $cust_name;
    public $cust_email;
    public $cust_num;
    public $travel_date;
    public $support_team;
    public $food;
    public $visa;
    public $air_ticket;
    public $cat_id;
    public $pkg_type_id; // Add this property

    protected $rules = [
        'cust_name' => 'required',
        'cust_email' => 'required|email',
        'cust_num' => 'required',
        'travel_date' => 'required',
        'food' => 'required',
        'visa' => 'required',
        'air_ticket' => 'required',
        'cat_id' => 'required',
        'pkg_type_id' => 'required', // Add validation rule for pkg_type_id
    ];

    public function mount(Bookingenquiry $enquirie)
    {
        $this->manageEnquirietId = $enquirie->id;
        $this->cust_name = $enquirie->cust_name;
        $this->cust_email = $enquirie->cust_email;
        $this->cust_num = $enquirie->cust_num;
        $this->travel_date = $enquirie->travel_date;
        $this->support_team = $enquirie->support_team;
        $this->food = $enquirie->food;
        $this->visa = $enquirie->visa;
        $this->air_ticket = $enquirie->air_ticket;
        $this->cat_id = $enquirie->cat_id;
        $this->pkg_type_id = $enquirie->pkg_type_id; // Initialize pkg_type_id

        // $this->servicetypes = ServiceType::pluck('name', 'id');
        $this->packagemaster = PackageMaster::pluck('package_name', 'id');
    }

    public function update()
    {
        $validated = $this->validate();
// dd($validated);
Bookingenquiry::whereId($this->manageEnquirietId)->update([
            'pkg_type_id' => $this->pkg_type_id,
            'cust_name' => $this->cust_name,
            'cust_email' => $this->cust_email,
            'cust_num' => $this->cust_num,
            'travel_date' => $this->travel_date,
            'support_team' => $this->support_team,
            'food' => $this->food,
            'visa' => $this->visa,
            'air_ticket' => $this->air_ticket,
            'cat_id' => $this->cat_id,
        ]);

        session()->flash('success', Lang::get('messages.content_update'));
        return redirect()->route('admin.request.index');
    }

    public function render()
    {
        $servicetypes = ServiceType::pluck('name', 'id');
        $packagemaster = PackageMaster::pluck('package_name', 'id');

        return view('admin.manage-site-settings.manage-request-quote.request-quote-edit-component', compact('servicetypes', 'packagemaster'));
    }
}
