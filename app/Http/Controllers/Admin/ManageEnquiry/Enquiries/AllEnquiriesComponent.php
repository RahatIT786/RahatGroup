<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\Enquiries;

use App\Models\AssistantEnquiry;
use Livewire\Component;

use App\Models\Bookingenquiry;
use App\Models\CallUsBack;
use App\Models\ComplaintBox;
use App\Models\Enquiry;
use App\Models\FeedBack;
use App\Models\FoodEnquiry;
use App\Models\ForexEnquiry;
use App\Models\HajjKitEnquiry;
use App\Models\HotelEnquiries;
use App\Models\Laundry;
use App\Models\PublicationEnquiry;
use App\Models\ServiceEnquiry;
use App\Models\ShoppingEnquiry;
use App\Models\TicketEnquiry;
use App\Models\TourCallUsBack;
use App\Models\TouristVisa;
use App\Models\TransportEnquiry;
use App\Models\Umrah;

class AllEnquiriesComponent extends Component
{
    public $umrahTotalEnquiry, $callUsBackTotalEnquiry, $complaintBoxTotalEnquiry, $bookingTotalEnquiry, $foodTotalEnquiry, $forexTotalEnquiry, $hajjKitTotalEnquiry, $touristVisaTotalEnquiry;
    public $hotelTotalEnquiry, $laundryTotalEnquiry, $enquiryTotalEnquiry, $publicationEnquiry, $serviceTotalEnquiry, $shoppingTotalEnquiry, $tourCallUsBackTotalEnquiry, $transportTotalEnquiry;
    public $feedBackTotalEnquiry, $assistantTotalEnquiry, $pnrTotalEnquiry;

    public function mount()
    {
        $this->umrahTotalEnquiry = Umrah::count();
        $this->callUsBackTotalEnquiry = CallUsBack::count();
        $this->complaintBoxTotalEnquiry = ComplaintBox::count();
        $this->bookingTotalEnquiry = Bookingenquiry::count();
        $this->foodTotalEnquiry = FoodEnquiry::count();
        $this->forexTotalEnquiry = ForexEnquiry::count();
        $this->hajjKitTotalEnquiry = HajjKitEnquiry::count();
        $this->hotelTotalEnquiry = HotelEnquiries::count();
        $this->laundryTotalEnquiry = Laundry::count();
        $this->enquiryTotalEnquiry = Enquiry::count();
        $this->publicationEnquiry = PublicationEnquiry::count();
        $this->serviceTotalEnquiry = ServiceEnquiry::count();
        $this->shoppingTotalEnquiry = ShoppingEnquiry::count();
        $this->tourCallUsBackTotalEnquiry = TourCallUsBack::count();
        $this->touristVisaTotalEnquiry = TouristVisa::count();
        $this->transportTotalEnquiry = TransportEnquiry::count();
        $this->feedBackTotalEnquiry = FeedBack::count();
        $this->assistantTotalEnquiry = AssistantEnquiry::count();
        $this->pnrTotalEnquiry = TicketEnquiry::count();

    }
    public function render()
    {
        return view('admin.manage-enquiry.enquiries.all-enquiries-component');
    }
}
