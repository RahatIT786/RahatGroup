<?php

namespace App\Http\Controllers\Agent\Downloads\Flyer;

use App\Helpers\Helper;
use App\Models\Flyer;
use App\Models\Packages;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;


class PackageFlyerCreateComponent extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public $flyer_title, $package_ids, $header_image, $header_text, $footer_image, $footer_text, $important_notes, $terms_cond;
    public $packages = [], $perPage = 10, $agent;

    public function mount()
    {
        $this->agent = auth()->user()->id;
        $this->packages = Packages::active()->get();
        $this->important_notes = '<ul style="padding-left: 18px;list-style: decimal;font-weight:700;color:#000000;margin:0px;font-size: 14px;">
                            <li>Please activate ROAMING on your Sim before leaving India.</li>
                            <li>Download IMO, SKYPE, BOTIM for your VIDEO & AUDIO CALLS.</li>
                            <li>Please take Printout (HARD COPY) of your Ticket, Visa, Insurance.</li>
                            <li>Please wear EHRAM before crossing Meeqat.</li>
                            <li>Please Buy Saudi RIYAL from INDIA before reaching AIRPORT.</li>
                            <li>PLEASE keep 50-100 sar change with you handy in pockets.</li>
                            <li>Make sure to Keep your medicine handy with you in hand bags.</li>
                            <li>Do Not Carry INDIAN or ANY POLITICAL FLAGS with you.</li>
                            <li>Watch UMRAH Tutorials on YOUTUBE Before leaving.</li>
                            <li>For Mobile Recharges carry Extension board and Universal Adapter.</li>
                            <li>Carry your own Wheelchairs.</li>
                            <li>Water is available only on Buffet Not in Rooms.</li>
                        </ul>';
        $this->terms_cond = '<ul style="padding-left: 18px;list-style: decimal;font-weight:700;color:#372d72;margin:0px;font-size: 14px;">
                        <li>Visa and Tickets Fees are Non Refundable.</li>
                        <li>No Refunds if Tour Cancelled within 21 Days of Travel.</li>
                        <li>50% Advance to Confirm Bookings.</li>
                        <li>Balance 50% to be paid 21 Days before Travel.</li>
                        <li>Airfare is considered of Economy class.</li>
                        <li>No Cash Deposits in our Bank Accounts.</li>
                        <li>Food in Executive, Esteem will be in Parcel.</li>
                        <li>Hotel may Change to Similar or Same Category Hotels.</li>
                        <li>Bucket and Tubs will not be available in hotels.</li>
                        <li>No Fans are not available in Rooms Only AC.</li>
                        <li>Indian Toilets are not available only English Toilets.</li>
                    </ul>';
    }

    public function rules(): array
    {
        return [
            'flyer_title' => 'required|string|max:255',
            'header_image' => 'nullable|max:3072|required_without:header_text',
            'header_text' => 'nullable|string|max:255|required_without:header_image',
            'footer_image' => 'nullable|max:3072|required_without:footer_text',
            'footer_text' => 'nullable|string|max:255|required_without:footer_image',
            'package_ids' => 'required|array',
            'important_notes' => 'nullable|string',
            'terms_cond' => 'nullable|string',
        ];
    }

    public function validationAttributes()
    {
        return [
            'flyer_title' => 'title',
            'header_image' => 'header image',
            'header_text' => 'header text',
            'footer_image' => 'footer image',
            'footer_text' => 'footer text',
            'package_ids' => 'packages',
            'important_notes' => 'important notes',
            'terms_cond' => 'terms and conditions',
        ];
    }

    public function messages()
    {
        return [
            'package_ids.required' => 'Please select a package',
        ];
    }

    public function getFlyers()
    {
        return Flyer::query()
            ->desc()
            ->paginate($this->perPage);
    }

    public function filteFlyers()
    {
        $this->resetPage();
    }

    public function save()
    {   
            if(empty($this->package_ids)){
                // $this->alert('error', "Please select atleast one package"); 
                $this->alert('error', "Please select atleast one package.", [
                    'position' => 'center',
                    'toast' => false,
                    'timer' => 10000,
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Alright',
                ]);
            }
            $validated = $this->validate();
            
            
            $validated['agency_id'] = $this->agent;
            $flyer = Flyer::create($validated);
            if ($flyer && $this->header_image) {
                $headerImageName = Helper::uploadFile($this->header_image, 'flyers');
                Flyer::whereId($flyer->id)->update(['header_image' => $headerImageName]);
            }
            if ($flyer && $this->footer_image) {
                $footerImageName = Helper::uploadFile($this->footer_image, 'flyers');
                Flyer::whereId($flyer->id)->update(['footer_image' => $footerImageName]);
            }

            $this->alert('success', "Flyer has been created successfully");
            return redirect()->route('agent.flyer.index');
    }

    public function changeInput()
    {
        //
    }


    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.downloads.flyer.package-flyer-create-component');
    }
}
