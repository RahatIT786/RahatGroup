<?php

namespace App\Http\Controllers\Staff\Enquiries;

use App\Models\Bookingenquiry;
use App\Models\CallUsBack;
use App\Models\ComplaintBox;
use App\Models\Enquiry;
use App\Models\FoodEnquiry;
use App\Models\ForexEnquiry;
use App\Models\HajjKitEnquiry;
use App\Models\HotelEnquiries;
use App\Models\Laundry;
use App\Models\PublicationEnquiry;
use App\Models\ServiceEnquiry;
use App\Models\ShoppingEnquiry;
use App\Models\TourCallUsBack;
use App\Models\TouristVisa;
use App\Models\TransportEnquiry;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Umrah;

class EnquiriesComponent extends Component
{
    public $umrahTotalEnquiry, $complaintBoxTotalEnquiry, $callUsBackTotalEnquiry, $bookingTotalEnquiry, $foodTotalEnquiry, $forexTotalEnquiry, $hajjKitTotalEnquiry, $touristVisaTotalEnquiry;
    public $hotelTotalEnquiry, $laundryTotalEnquiry, $enquiryTotalEnquiry, $publicationEnquiry, $serviceTotalEnquiry, $shoppingTotalEnquiry, $tourCallUsBackTotalEnquiry, $transportTotalEnquiry;

    public function mount()
    {
        $this->umrahTotalEnquiry = Umrah::where('support_team', auth()->user()->id)->count();
        $this->callUsBackTotalEnquiry = CallUsBack::where('support_team', auth()->user()->id)->count();
        $this->complaintBoxTotalEnquiry = ComplaintBox::where('support_team', auth()->user()->id)->count();
        $this->bookingTotalEnquiry = Bookingenquiry::where('support_team', auth()->user()->id)->count();
        $this->foodTotalEnquiry = FoodEnquiry::where('support_team', auth()->user()->id)->count();
        $this->forexTotalEnquiry = ForexEnquiry::where('support_team', auth()->user()->id)->count();
        $this->hajjKitTotalEnquiry = HajjKitEnquiry::where('support_team', auth()->user()->id)->count();
        $this->hotelTotalEnquiry = HotelEnquiries::where('support_team', auth()->user()->id)->count();
        $this->laundryTotalEnquiry = Laundry::where('support_team', auth()->user()->id)->count();
        $this->enquiryTotalEnquiry = Enquiry::where('support_team', auth()->user()->id)->count();
        $this->publicationEnquiry = PublicationEnquiry::where('support_team', auth()->user()->id)->count();
        $this->serviceTotalEnquiry = ServiceEnquiry::where('support_team', auth()->user()->id)->count();
        $this->shoppingTotalEnquiry = ShoppingEnquiry::where('support_team', auth()->user()->id)->count();
        $this->tourCallUsBackTotalEnquiry = TourCallUsBack::where('support_team', auth()->user()->id)->count();
        $this->touristVisaTotalEnquiry = TouristVisa::where('support_team', auth()->user()->id)->count();
        $this->transportTotalEnquiry = TransportEnquiry::where('support_team', auth()->user()->id)->count();

    }

    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.enquiries.enquiries-component');
    }
}
