<?php
use App\Http\Controllers\Admin\Bookings\BookingAddPaxComponent;
use App\Http\Controllers\Admin\DashboardComponent;
use App\Http\Controllers\Admin\Payments\PaymentCreateComponent;
use App\Http\Controllers\Admin\Payments\PaymentEditComponent;
use App\Http\Controllers\Admin\Payments\PaymentListComponent;
use App\Http\Controllers\Admin\RelationshipManager\RelationshipManagerCreateComponent;
use App\Http\Controllers\Admin\Users\UserEditComponent;
use App\Http\Controllers\Admin\Users\UserListComponent;
use App\Http\Controllers\Admin\Bookings\BookingListComponent;
use App\Http\Controllers\Admin\Bookings\BookingCreateComponent;
use App\Http\Controllers\Admin\Bookings\BookingEditComponent;
use App\Http\Controllers\Admin\Bookings\ApprovedBooking\ApprovedBookingListComponent;
use App\Http\Controllers\Admin\Bookings\CancelledBooking\CancelledBookingListComponent;
use App\Http\Controllers\Admin\Bookings\Deleted\DeletedBookingListComponent;
use App\Http\Controllers\Admin\Bookings\OnlineBooking\OnlineBookingListComponent;
use App\Http\Controllers\Admin\Bookings\PendingBooking\PendingBookingListComponent;
use App\Http\Controllers\Admin\Bookings\RejectBooking\RejectBookingListComponent;
use App\Http\Controllers\Admin\Bookings\Suspended\SuspendedBookingListComponent;
use App\Http\Controllers\Admin\Bookings\UnderReviewBooking\UnderReviewBookingListComponent;
use App\Http\Controllers\Admin\Bookings\WaitingBooking\WaitingBookingListComponent;
use App\Http\Controllers\Admin\Bookings\BookingMadePayemntComponent;
use App\Http\Controllers\Admin\Bookings\NegotiatedBookings\NegotiatedBookingsListComponent;
use App\Http\Controllers\Admin\Pnr\PnrListComponent;
use App\Http\Controllers\Admin\Pnr\PnrCreateComponent;
use App\Http\Controllers\Admin\Pnr\PnrEditComponent;
use App\Http\Controllers\Admin\Quotes\QuotesListComponent;
use App\Http\Controllers\Admin\ManageEnquiry\PnrEnquiry\PnrEnquiryListComponent;
// use App\Http\Controllers\Admin\VisaMaster\VisaMastercreateComponent;
// use App\Http\Controllers\Admin\VisaMaster\VisaMasterListComponent;

//Reports
use App\Http\Controllers\Admin\Reports\AgentAccountReport\AgentAccountReportListComponent;
use App\Http\Controllers\Admin\Reports\ClientReport\ClientReportListComponent;
use App\Http\Controllers\Admin\Reports\StatementReport\StatementReportListComponent;
use App\Http\Controllers\Admin\Resources\Notification\ManageNotificationListComponent;
use App\Http\Controllers\Admin\Resources\Notification\ManageNotificationCreateComponent;
use App\Http\Controllers\Admin\Resources\Notification\ManageNotificationEditComponent;
use App\Http\Controllers\Admin\ManagePage\ManagePageCreateComponent;
use App\Http\Controllers\Admin\ManagePage\ManagePageListComponent;
use App\Http\Controllers\Admin\ManageRelation\ManageRelationListComponent;
use App\Http\Controllers\Admin\CategoryPage\CategoryPageListComponent;
use App\Http\Controllers\Admin\MiscellaneousItems\MiscellaneousItemsCreateComponent;
use App\Http\Controllers\Admin\Resources\Miscellaneous\MiscellaneousItemsListComponent;
use App\Http\Controllers\Admin\Resources\VoucherContent\VoucherContentEditComponent;
use App\Http\Controllers\Admin\Sector\SectorListComponent;
use App\Http\Controllers\Admin\Resources\ServicesType\ServicesTypeListComponent;
use App\Http\Controllers\Admin\Resources\SharingType\SharingTypeListComponent;
use App\Http\Controllers\Admin\Resources\PnrServices\PnrServicesListComponent;
use App\Http\Controllers\Admin\RelationshipManager\RelationshipManagerListComponent;
use App\Http\Controllers\Admin\Setting\ChangePasswordEditComponent;
use App\Http\Controllers\Admin\Finance\Beneficiary\BeneficiaryListComponent;
use App\Http\Controllers\Admin\Finance\Company\CompanyListComponent;
use App\Http\Controllers\Admin\Finance\ForexTransaction\ForexTransactionListComponent;
use App\Http\Controllers\Admin\Finance\Forex\ForexListComponent;
use App\Http\Controllers\Admin\Finance\Forex\ForexCreateComponent;
use App\Http\Controllers\Admin\Finance\Forex\ForexEditComponent;

//Payments
use App\Http\Controllers\Admin\Payments\ApprovedPayments\ApprovedPaymentListComponent;
use App\Http\Controllers\Admin\Payments\ApprovedPayments\ApprovedPaymentEditComponent;
use App\Http\Controllers\Admin\Payments\PendingPayments\PendingPaymentListComponent;
use App\Http\Controllers\Admin\Payments\PendingPayments\PendingPaymentEditComponent;

use App\http\Controllers\PaymentController as TestPaymentController;

//Downloads
use App\Http\Controllers\Admin\Download\Invoice\InvoiceListComponent;
use App\Http\Controllers\Admin\Download\PrintReceipt\PaymentReceiptListComponent;
use App\Http\Controllers\Admin\Download\Visa\VisaListComponent;
use App\Http\Controllers\Admin\Download\Vouchers\VoucherListComponent;
use App\Http\Controllers\Admin\Download\Ticket\TicketListComponent;

//Package
use App\Http\Controllers\Admin\Packages\PackageListComponent;
use App\Http\Controllers\Admin\Packages\PackageCreateComponent;
use App\Http\Controllers\Admin\Packages\PackageEditComponent;
use App\Http\Controllers\Admin\PackageManagement\VisaMaster\VisaMasterListComponent;
use App\Http\Controllers\Admin\PackageManagement\VisaMaster\VisaMasterCreateComponent;
use App\Http\Controllers\Admin\PackageManagement\VisaMaster\VisaMasterEditComponent;

//PNR
use App\Http\Controllers\Admin\Flight\FlightCreateComponent;
use App\Http\Controllers\Admin\Flight\FlightListComponent;
use App\Http\Controllers\Admin\Flight\FlightEditComponent;

//Settings
use App\Http\Controllers\Admin\Setting\Admin\AdminCreateComponent;
use App\Http\Controllers\Admin\Setting\Admin\AdminEditComponent;
use App\Http\Controllers\Admin\Setting\AdminSetting\AdminSettingListComponent;
use App\Http\Controllers\Admin\Setting\SiteFee\SiteFeeListComponent;
use App\Http\Controllers\Admin\Setting\SitePage\SitePageListComponent;
use App\Http\Controllers\Admin\Setting\SiteSetting\SiteSettingsListComponent;
use App\Http\Controllers\Admin\Setting\City\CityListComponent;
use App\Http\Controllers\Admin\Setting\Admin\AdminListComponent;

//Resource
use App\Http\Controllers\Admin\Resources\Flier\ManageFlierCreateComponent;
use App\Http\Controllers\Admin\Resources\Flier\ManageFlierEditComponent;
use App\Http\Controllers\Admin\Resources\Flier\ManageFlierListComponent;

use App\Http\Controllers\Admin\Resources\HeaderNotification\HeaderNotificationCreateComponent;
use App\Http\Controllers\Admin\Resources\HeaderNotification\HeaderNotificationEditComponent;
use App\Http\Controllers\Admin\Resources\HeaderNotification\HeaderNotificationListComponent;

use App\Http\Controllers\Admin\PackageManagement\LaundryType\LaundryTypeListComponent;
use App\Http\Controllers\Admin\PackageManagement\TransportType\TransportTypeListComponent;

use App\Http\Controllers\Admin\PackageManagement\FoodType\FoodTypeListComponent;
use App\Http\Controllers\Admin\PackageManagement\FoodType\FoodTypeCreateComponent;
use App\Http\Controllers\Admin\PackageManagement\FoodType\FoodTypeEditComponent;
use App\Http\Controllers\Admin\PackageManagement\PackageType\PackageTypeListComponent;

use App\Http\Controllers\Admin\Resources\Ration\RationCreateComponent;
use App\Http\Controllers\Admin\Resources\Ration\RationEditComponent;
use App\Http\Controllers\Admin\Resources\Ration\RationListComponent;

use App\Http\Controllers\Admin\Resources\Ration\RationViewDetail\RationViewDetailEditComponent;
use App\Http\Controllers\Admin\Resources\Ration\RationViewDetail\RationViewDetailListComponent;

 // Finance
use App\Http\Controllers\Admin\Finance\BankDetails\BankDetailsCreateComponent;
use App\Http\Controllers\Admin\Finance\BankDetails\BankDetailsEditComponent;
use App\Http\Controllers\Admin\Finance\BankDetails\BankDetailsListComponent;

// PackageManagement
use App\Http\Controllers\Admin\PackageManagement\PackagesMaster\PackageMasterListComponent;
use App\Http\Controllers\Admin\PackageManagement\Hotel\HotelEditComponent;
use App\Http\Controllers\Admin\PackageManagement\Hotel\HotelListComponent;
use App\Http\Controllers\Admin\PackageManagement\Hotel\HotelCreateComponent;

use App\Http\Controllers\Admin\PackageManagement\Hotel\HotelRoomImageComponent;

// Setting
use App\Http\Controllers\Admin\Setting\Staff\StaffCreateComponent;
use App\Http\Controllers\Admin\Setting\Staff\StaffEditComponent;
use App\Http\Controllers\Admin\Setting\Staff\StaffListComponent;
use App\Http\Controllers\Admin\Setting\Staff\StaffSalaryListComponent;

// Agent List
use App\Http\Controllers\Admin\Setting\AgentList\AgentCreateComponent;
use App\Http\Controllers\Admin\Setting\AgentList\AgentEditComponent;
use App\Http\Controllers\Admin\Setting\AgentList\AgentListComponent;

//Site Settings
// faq
use App\Http\Controllers\Admin\ManageSiteSettings\ManageFaq\FaqListComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageFaq\FaqCreateComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageFaq\FaqEditComponent;

// Manage Banner
use App\Http\Controllers\Admin\ManageSiteSettings\ManageBanner\BannerCreateComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageBanner\BannerListComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageBanner\BannerEditComponent;

//Contact Us
use App\Http\Controllers\Admin\ManageSiteSettings\ManageContactUs\ContactListComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageContentPage\ContentListComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageContentPage\ContentCreateComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageContentPage\ContentEditComponent;

//Customized Umrah
use App\Http\Controllers\Admin\ManageEnquiry\CustomizedUmrah\CustomizedUmrahListComponent;
use App\Http\Controllers\Admin\ManageEnquiry\CustomizedUmrah\CustomizedUmrahEditComponent;

//Request Quote
use App\Http\Controllers\Admin\ManageSiteSettings\ManageRequestQuote\RequestQuoteListComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageRequestQuote\RequestQuoteEditComponent;

//Manage Enquiry
use App\Http\Controllers\Admin\ManageEnquiry\ManageEnquiry\ManageEnquiryListComponent;
use App\Http\Controllers\Admin\ManageEnquiry\ManageEnquiry\ManageEnquiryEditComponent;

//Tourist Visa
use App\Http\Controllers\Admin\ManageEnquiry\TouristVisa\TouristVisaListComponent;
use App\Http\Controllers\Admin\ManageEnquiry\TouristVisa\TouristVisaEditComponent;

use App\Http\Controllers\Admin\ManageEnquiry\ForexEnquiry\ForexEnquiryListComponent;
use App\Http\Controllers\Admin\ManageEnquiry\CallUsBack\CallUsBackListComponent;

use App\Http\Controllers\Admin\ManageEnquiry\BookingUmrah\BookingUmrahListComponent;
use App\Http\Controllers\Admin\ManageEnquiry\BookingUmrah\BookingUmrahEditComponent;

//complaintbox
use App\Http\Controllers\Admin\ManageEnquiry\ComplaintBox\ComplaintBoxListComponent;

use App\Http\Controllers\Admin\ManageEnquiry\BookingHajj\BookingHajjListComponent;
use App\Http\Controllers\Admin\ManageEnquiry\BookingHajj\BookingHajjEditComponent;

use App\Http\Controllers\Admin\ManageEnquiry\BookingRamzaan\BookingRamzaanjListComponent;
use App\Http\Controllers\Admin\ManageEnquiry\BookingRamzaan\BookingRamzaanjEditComponent;
use App\Http\Controllers\Admin\ManageEnquiry\FeedBack\FeedBackListComponent;

use App\Http\Controllers\Admin\Gallery\ImageGallery\ImageGalleryCreateComponent;
use App\Http\Controllers\Admin\Gallery\ImageGallery\ImageGalleryEditComponent;
use App\Http\Controllers\Admin\Gallery\ImageGallery\ImageGalleryListComponent;
use App\Http\Controllers\Admin\Gallery\VideoGallery\VideoGalleryCreateComponent;
use App\Http\Controllers\Admin\Gallery\VideoGallery\VideoGalleryEditComponent;
use App\Http\Controllers\Admin\Gallery\VideoGallery\VideoGalleryListComponent;
use App\Http\Controllers\Admin\Gallery\Testimonials\TestimonialCreateComponent;
use App\Http\Controllers\Admin\Gallery\Testimonials\TestimonialEditComponent;
use App\Http\Controllers\Admin\Gallery\Testimonials\TestimonialListComponent;
use App\Http\Controllers\Admin\Gallery\CustomerTestimonials\CustomerTestimonialListComponent;
use App\Http\Controllers\Admin\ManageEnquiry\HotelInquary\HotelInquaryListComponent;

//Blogs
use App\Http\Controllers\Admin\ManageSiteSettings\ManageBlog\BlogCreateComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageBlog\BlogListComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageBlog\BlogEditComponent;

//Brochure
use App\Http\Controllers\Admin\ManageSiteSettings\ManageBrochure\BroucherListComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageBrochure\BroucherCreateComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageBrochure\BroucherEditComponent;

//site Bank
use App\Http\Controllers\Admin\Finance\SiteBankInfo\SiteBankInfoListComponent;
use App\Http\Controllers\Admin\Finance\SiteBankInfo\SiteBankInfoCreateComponent;
use App\Http\Controllers\Admin\Finance\SiteBankInfo\SiteBankInfoEditComponent;

use App\Http\Controllers\Admin\ManageSiteSettings\ManageAgm\AgmListComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageAgm\AgmCreateComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageAgm\AgmEditComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageAgm\AgmImageComponent;

//Awards
use App\Http\Controllers\Admin\ManageSiteSettings\ManageAward\AwardListComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageAward\AwardCreateComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageAward\AwardEditComponent;

use App\Http\Controllers\Admin\ManageEnquiry\BookingTour\BookingTourListComponent;
use App\Http\Controllers\Admin\ManageEnquiry\BookingTour\BookingTourEditComponent;

//membership
use App\Http\Controllers\Admin\Setting\ManageMembership\MembershipListComponent;
use App\Http\Controllers\Admin\Setting\ManageMembership\MembershipEditComponent;

//newsletter
use App\Http\Controllers\Admin\Setting\NewsLetter\NewsLetterCreateComponent;

use App\Http\Controllers\Admin\Partners\ManagePartner\ManagePartnerCreateComponent;
use App\Http\Controllers\Admin\Partners\ManagePartner\ManagePartnerEditComponent;
use App\Http\Controllers\Admin\Partners\ManagePartner\ManagePartnerListComponent;

//paymentMode
use App\Http\Controllers\Admin\Setting\PaymentMode\PaymentmodeListComponent;

//location
use App\Http\Controllers\Admin\ManageSiteSettings\ManageLocationAddress\LocationListComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageLocationAddress\LocationCreateComponent;
use App\Http\Controllers\Admin\ManageSiteSettings\ManageLocationAddress\LocationEditComponent;
use App\Http\Controllers\Admin\ManageEnquiry\TourCallUsBack\TourCallUsBackListComponent;
use App\Http\Controllers\Admin\ManageTransport\ManageCarRental\CarRentalListComponent;
use App\Http\Controllers\Admin\ManageTransport\ManageCarRental\CarRentalCreateComponent;
use App\Http\Controllers\Admin\ManageTransport\ManageCarRental\CarRentalEditComponent;
use App\Http\Controllers\Admin\ManageTransport\ManageCarType\CarTypeListComponent;
use App\Http\Controllers\Admin\ManageTransport\ManageCarSector\CarSectorListComponent;
use App\Http\Controllers\Admin\Customer\CustomerListComponent;

//Tour states
use App\Http\Controllers\Admin\TourManagement\State\StateListComponent;
use App\Http\Controllers\Admin\TourManagement\State\StateEditComponent;

//Tour Destinations
use App\Http\Controllers\Admin\TourManagement\Destination\DestinationListComponent;
use App\Http\Controllers\Admin\TourManagement\Destination\DestinationCreateComponent;
use App\Http\Controllers\Admin\TourManagement\Destination\DestinationEditCompone;

//Internation Destination
use App\Http\Controllers\Admin\TourManagement\IntDestination\IntDestinationListComponent;
use App\Http\Controllers\Admin\TourManagement\IntDestination\IntDestinationCreateComponent;
use App\Http\Controllers\Admin\TourManagement\IntDestination\IntDestinationEditComponent;

//Tour Category or Themes
use App\Http\Controllers\Admin\TourManagement\TourCategory\TourCategoryListComponent;

// Tours package
use App\Http\Controllers\Admin\Holidays\ToursManagement\ToursListComponent;
use App\Http\Controllers\Admin\Holidays\ToursManagement\ToursCreateComponent;
use App\Http\Controllers\Admin\Holidays\ToursManagement\ToursEditComponent;

// Int Tours package
use App\Http\Controllers\Admin\Holidays\ToursManagement\IntToursListComponent;
use App\Http\Controllers\Admin\Holidays\ToursManagement\IntToursCreateComponent;
use App\Http\Controllers\Admin\Holidays\ToursManagement\IntToursEditComponent;

use App\Http\Controllers\Admin\Setting\SubAgentList\SubAgentListComponent;
use App\Http\Controllers\Admin\Services\ManageService\ServicesListComponent;
use App\Http\Controllers\Admin\Services\ManageService\ServicesCreateComponent;
use App\Http\Controllers\Admin\Services\ManageService\ServicesEditComponent;
use App\Http\Controllers\Admin\ManageEnquiry\ServiceEnquiry\ServiceEnquiryListComponent;
use App\Http\Controllers\Admin\ManageHajjKit\KitItem\KitItemListComponent;
use App\Http\Controllers\Admin\ManageHajjKit\KitItem\KitItemCreateComponent;
use App\Http\Controllers\Admin\ManageHajjKit\KitItem\KitItemEditComponent;
use App\Http\Controllers\Admin\ManageHajjKit\KitCategory\KitCategoryListComponent;
use App\Http\Controllers\Admin\ManageHajjKit\KitCategory\KitCategoryCreateComponent;
use App\Http\Controllers\Admin\ManageHajjKit\KitCategory\KitCategoryEditComponent;
use App\Http\Controllers\Admin\ManageEnquiry\HajjEnquiry\HajjKitEnquiryListComponent;

use App\Http\Controllers\Admin\Services\ManagePublication\PublicationCreateComponent;
use App\Http\Controllers\Admin\Services\ManagePublication\PublicationEditComponent;
use App\Http\Controllers\Admin\Services\ManagePublication\PublicationListComponent;
use App\Http\Controllers\Admin\ManageEnquiry\Publication\PublicationEnquiryListComponent;

//shopping
use App\Http\Controllers\Admin\ManageHajjKit\Shopping\ShoppingListComponent;
use App\Http\Controllers\Admin\ManageHajjKit\Shopping\ShoppingCreateComponent;
use App\Http\Controllers\Admin\ManageHajjKit\Shopping\ShoppingEditComponent;

//shopping enquiry
use App\Http\Controllers\Admin\ManageEnquiry\ShoppingEnquiry\ShoppingEnquiryListComponent;
use App\Http\Controllers\Admin\ManageEnquiry\FoodEnquiry\FoodEnquiryListComponent;
use App\Http\Controllers\Admin\Services\ManageLaundry\LaundryListComponent;
use App\Http\Controllers\Admin\ManageEnquiry\TransportEnquiry\TransportEnquiryListComponent;

use App\Http\Controllers\Admin\Gallery\CustomerTestimonials\CustomerTestimonialCreateComponent;
use App\Http\Controllers\Admin\Gallery\CustomerTestimonials\CustomerTestimonialEditComponent;
use App\Http\Controllers\Admin\ManageEnquiry\AssistantEnquiry\AssistantEnquiryListComponent;

use App\Http\Controllers\Admin\ManageEnquiry\Enquiries\EnquiriesComponent;
use App\Http\Controllers\Agent\PaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*

|--------------------------------------------------------------------------

| Web Routes for Admin

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider and all of them will

| be assigned to the "web" middleware group. Make something great!

|

*/

// ['register' => false, 'reset' => false]

// dd(Hash::make("info@magadhacabs.com"));

Auth::routes();

    Route::get('/vouchers-pdf/{vouchers_id}', [VoucherListComponent::class, 'downloadVoucher'])->name('downloadVoucher');
    Route::group(['middleware' => ['auth'], 'as' => 'admin.'], function () {
    Route::get('/', DashboardComponent::class)->name('dashboard');

    // Booking Management
    Route::get('/bookings', BookingListComponent::class)->name('booking.index');
    Route::get('/bookings/approved', ApprovedBookingListComponent::class)->name('booking.approved');
    Route::get('/bookings/pending', PendingBookingListComponent::class)->name('booking.pending');
    Route::get('/bookings/rejected', RejectBookingListComponent::class)->name('booking.rejected');
    Route::get('/bookings/cancelled', CancelledBookingListComponent::class)->name('booking.cancelled');
    Route::get('/bookings/suspended', SuspendedBookingListComponent::class)->name('booking.suspended');
    Route::get('/bookings/deleted', DeletedBookingListComponent::class)->name('booking.deleted');
    Route::get('/bookings/online', OnlineBookingListComponent::class)->name('booking.online');
    Route::get('/bookings/waiting', WaitingBookingListComponent::class)->name('booking.waiting');
    Route::get('/bookings/under-review', UnderReviewBookingListComponent::class)->name('booking.review');
    Route::get('/bookings-create', BookingCreateComponent::class)->name('booking.create');
    Route::get('/bookings/edit/{booking_id}', BookingEditComponent::class)->name('booking.edit');
    Route::get('/bookings-add-pax/{booking_id}', BookingAddPaxComponent::class)->name('booking.add.pax');
    Route::get('/bookings-payment', BookingMadePayemntComponent::class)->name('booking.made.payment');

    Route::get('/quotes', QuotesListComponent::class)->name('quotes.index');
    Route::get('/negotiated-requests', NegotiatedBookingsListComponent::class)->name('quotes.negotiated');

    /*****************************   Payment Management *****************************************/

    // Payment Management
    Route::get('/payments', PaymentListComponent::class)->name('payment.index');
    Route::get('/payments/create', PaymentCreateComponent::class)->name('payment.create');
    Route::get('/payments/edit/{payment}', PaymentEditComponent::class)->name('payment.edit');
    Route::get('/payments/online', ApprovedPaymentListComponent::class)->name('payment.approved');
    Route::get('/payments/online/edit/{payment}', ApprovedPaymentEditComponent::class)->name('payment.approved.edit');
    Route::get('/payments/offline', PendingPaymentListComponent::class)->name('payment.pending');
    Route::get('/payments/offline/edit/{payment}', PendingPaymentEditComponent::class)->name('payment.pending.edit');

    /*****************************   PNR Management *****************************************/

    // PNR Management
    Route::get('/pnr', PnrListComponent::class)->name('pnr.index');
    Route::get('/pnr-create', PnrCreateComponent::class)->name('pnr.create');
    Route::get('/pnr/edit/{pnr}', PnrEditComponent::class)->name('pnr.edit');
    Route::get('/pnr-enquiry', PnrEnquiryListComponent::class)->name('pnrEnquiry');

    //Flight Add And Listing
    Route::get('/flight', FlightListComponent::class)->name('flight.index');
    Route::get('/flight/create', FlightCreateComponent::class)->name('flight.create');
    Route::get('/flight/edit/{flightmaster}', FlightEditComponent::class)->name('flight.edit');

    //Sector
    Route::get('/sector', SectorListComponent::class)->name('addSector.index');

    // Download Management
    Route::get('/invoices', InvoiceListComponent::class)->name('invoices.index');
    Route::get('/download-invoice-pdf/{invoice_id}', [InvoiceListComponent::class, 'downloadInvoice'])->name('downloadInvoice');
    Route::get('/vouchers', VoucherListComponent::class)->name('vouchers.index');

    Route::get('/print-receipt', PaymentReceiptListComponent::class)->name('printReceipt.index');
    Route::get('/print-receipt-pdf/{print_receipt_id}', [PaymentReceiptListComponent::class, 'downloadReceipt'])->name('downloadReceipt');
    Route::get('/ticket', TicketListComponent::class)->name('ticket.index');
    Route::get('/visa', VisaListComponent::class)->name('visa.index');

    // Reports Management
    // Route::get('/client-report', ClientReportListComponent::class)->name('clientReport.index');
    // Route::get('/agent-account-report', AgentAccountReportListComponent::class)->name('agentAccountReport.index');
    Route::get('/client-report', ClientReportListComponent::class)->name('clientReport.index');
    Route::get('/client-report-pdf/{client_report_id}', [ClientReportListComponent::class, 'downloadReport'])->name('downloadReport');
    Route::get('/agent-account-report', AgentAccountReportListComponent::class)->name('agentAccountReport.index');
    Route::get('/statement-report', StatementReportListComponent::class)->name('statementReport.index');

    //Package Management
    Route::get('/package-type', PackageTypeListComponent::class)->name('packageType.index');
    Route::get('/laundry-type', LaundryTypeListComponent::class)->name('laundryType.index');
    Route::get('/food-type', FoodTypeListComponent::class)->name('foodType.index');
    Route::get('/food-type-create', FoodTypeCreateComponent::class)->name('foodType.create');
    Route::get('/food-type-edit/{foodMaster}', FoodTypeEditComponent::class)->name('foodType.edit');
    Route::get('/transport-type', TransportTypeListComponent::class)->name('transportType.index');
    // Route::get('/visa-master', VisaMasterListComponent::class)->name('visaMaster.index');

    // Route::get('/visa-master-create', VisaMastercreateComponent::class)->name('visaMaster.create');
    Route::get('/visa-master', VisaMasterListComponent::class)->name('visaMaster.index');
    Route::get('/visa-master/create', VisaMasterCreateComponent::class)->name('visaMaster.create');
    Route::get('/visa-master/edit/{visacategory}', VisaMasterEditComponent::class)->name('visaMaster.edit');
    Route::get('/packages', PackageListComponent::class)->name('package.index');
    Route::get('/packages/create', PackageCreateComponent::class)->name('package.create');
    Route::get('/packages/edit/{package}', PackageEditComponent::class)->name('package.edit');
    Route::get('/packagemaster', PackageMasterListComponent::class)->name('packageMaster.index');
    Route::get('/hotels', HotelListComponent::class)->name('hotel.index');
    Route::get('/hotels/create', HotelCreateComponent::class)->name('hotel.create');
    Route::get('/hotels/edit/{hotel}', HotelEditComponent::class)->name('hotel.edit');
    Route::get('/hotels/room-images/{hotel}', HotelRoomImageComponent::class)->name('hotel.room-images');

    // Resources Management
    // Route::get('/category-page', CategoryPageListComponent::class)->name('categoryPage.index');
    Route::get('/manage-notification', ManageNotificationListComponent::class)->name('manageNotification.index');
    Route::get('/manage-notification/create', ManageNotificationCreateComponent::class)->name('manageNotification.create');
    Route::get('/manage-notification/edit/{notification}', ManageNotificationEditComponent::class)->name('manageNotification.edit');
    Route::get('/header-notification', HeaderNotificationListComponent::class)->name('headerNotification.index');
    Route::get('/header-notification/create', HeaderNotificationCreateComponent::class)->name('headerNotification.create');
    Route::get('/header-notification/edit/{headernotification}', HeaderNotificationEditComponent::class)->name('headerNotification.edit');
    Route::get('/manage-relation', ManageRelationListComponent::class)->name('manageRelation.index');
    Route::get('/manage-page', ManagePageListComponent::class)->name('managePage.index');
    Route::get('/manage-page-create', ManagePageCreateComponent::class)->name('managePage.create');
    Route::get('/manage-ration', RationListComponent::class)->name('manage-ration.index');
    Route::get('/manage-ration/create', RationCreateComponent::class)->name('manage-ration.create');
    Route::get('/manage-ration/edit/{ration}', RationEditComponent::class)->name('manage-ration.edit');
    Route::get('/manage-ration/view-detail/{ration}', RationViewDetailListComponent::class)->name('manageRationView.index');
    Route::get('/manage-ration/view-detail/edit/{rationdetails}', RationViewDetailEditComponent::class)->name('manageRationView.edit');

    //Flier
    Route::get('/manage-flier', ManageFlierListComponent::class)->name('manageFlier.index');
    Route::get('/manage-flier/create', ManageFlierCreateComponent::class)->name('manageFlier.create');
    Route::get('/manage-flier/edit/{flier}', ManageFlierEditComponent::class)->name('manageFlier.edit');

    //Miscellaneous Items
    Route::get('/miscellaneous-items', MiscellaneousItemsListComponent::class)->name('miscellaneousItems.index');
    Route::get('/miscellaneous-items-create', MiscellaneousItemsCreateComponent::class)->name('miscellaneousItems.create');
    Route::get('/voucher-content/edit/{voucher}', VoucherContentEditComponent::class)->name('voucherContent.edit');
    Route::get('/manage-services', ServicesTypeListComponent::class)->name('manageServices.index');
    Route::get('/pnr-services', PnrServicesListComponent::class)->name('pnrServices.index');
    Route::get('/sharing-type', SharingTypeListComponent::class)->name('sharingType.index');
    Route::get('/relationship-manager', RelationshipManagerListComponent::class)->name('relationshipManager.index');
    Route::get('/relationship-manager-create', RelationshipManagerCreateComponent::class)->name('relationshipManager.create');
    Route::get('/forex/edit/{forex}', ForexEditComponent::class)->name('forex.edit');

    // Finance Management
    Route::get('/bank-details', BankDetailsListComponent::class)->name('bankDetails.index');
    Route::get('/bank-details/create', BankDetailsCreateComponent::class)->name('bankDetails.create');
    Route::get('/bank-details/edit/{bankDetail}', BankDetailsEditComponent::class)->name('bankDetails.edit');
    Route::get('/beneficiary', BeneficiaryListComponent::class)->name('beneficiary.index');
    Route::get('/company', CompanyListComponent::class)->name('company.index');
    Route::get('/forex', ForexListComponent::class)->name('forex.index');
    Route::get('/forex-create', ForexCreateComponent::class)->name('forex.create');
    Route::get('/forex-transaction', ForexTransactionListComponent::class)->name('forexTransaction.index');

    // Settings Management
    Route::get('/change-password/{user}', ChangePasswordEditComponent::class)->name('change-password.edit');
    Route::get('/agent-list', AgentListComponent::class)->name('agentlist.index');
    Route::get('/agent-list/create', AgentCreateComponent::class)->name('agentlist.create');
    Route::get('/agent-list/edit/{agent}', AgentEditComponent::class)->name('agentlist.edit');
    Route::get('/sub-agent-list', SubAgentListComponent::class)->name('subagentlist.index');
    Route::get('/admin-list', AdminListComponent::class)->name('admin.index');
    Route::get('/admin-list/create', AdminCreateComponent::class)->name('admin.create');
    Route::get('/admin-list/edit/{admin}', AdminEditComponent::class)->name('admin.edit');
    Route::get('/city', CityListComponent::class)->name('city.index');
    Route::get('/site-setting', SiteSettingsListComponent::class)->name('sitesettings.index');
    Route::get('/site-page', SitePageListComponent::class)->name('sitePage.index');
    Route::get('/admin-setting', AdminSettingListComponent::class)->name('adminSetting.index');
    Route::get('/site-fee', SiteFeeListComponent::class)->name('siteFee.index');
    Route::get('/staff', StaffListComponent::class)->name('staff.index');
	Route::get('/staff-create', StaffCreateComponent::class)->name('staff.create');
	Route::get('/staff/edit/{staff}', StaffEditComponent::class)->name('staff.edit');
	Route::get('/staffsalary', StaffSalaryListComponent::class)->name('staff-salary.index');

    // User Management
    Route::get('/users', UserListComponent::class)->name('users.index');
    Route::get('/profile/{admin}', UserEditComponent::class)->name('user.edit');

    // Site Settings
    //FAQ
    Route::get('/faq', FaqListComponent::class)->name('faq.index');
    Route::get('/faq/create', FaqCreateComponent::class)->name('faq.create');
    Route::get('/faq/edit/{manageFaq}',FaqEditComponent::class)->name('faq.edit');

    Route::get('/banner', BannerListComponent::class)->name('banner.index');
    Route::get('/banner/create', BannerCreateComponent::class)->name('banner.create');
    Route::get('/banner/edit{manageBanner}', BannerEditComponent::class)->name('banner.edit');

    Route::get('/contact',ContactListComponent::class)->name('contact.index');
    Route::get('/content', ContentListComponent::class)->name('content.index');
    Route::get('/content/create', ContentCreateComponent::class)->name('content.create');
    Route::get('/content/edit/{content}', ContentEditComponent::class)->name('content.edit');

    //customized Umrah
    Route::get('/umrah',CustomizedUmrahListComponent::class)->name('umrah.index');
    Route::get('/umrah/edit/{umrah}',CustomizedUmrahEditComponent::class)->name('umrah.edit');

    //complaint-box
    Route::get('/complaint-box', ComplaintBoxListComponent::class)->name('complaintBox.index');

    //Request Quote
    Route::get('/request',RequestQuoteListComponent::class)->name('request.index');
    Route::get('/request/edit/{enquirie}',RequestQuoteEditComponent::class)->name('request.edit');

    // Manage Enquiry
    Route::get('/manage-enquiry', ManageEnquiryListComponent::class)->name('manageEnquiry.index');
    Route::get('/manage-enquiry/edit/{manageEnquiry}', ManageEnquiryEditComponent::class)->name('manageEnquiry.edit');
	Route::get('feed-back',FeedBackListComponent::class)->name('feedback.index');

    // Turist Visa
    Route::get('/tourist-visa', TouristVisaListComponent::class)->name('touristVisa.index');
    Route::get('/tourist-visa/edit/{touristVisa}', TouristVisaEditComponent::class)->name('touristVisa.edit');

    //Booking Umrah
    Route::get('/booking-enquiry',BookingUmrahListComponent::class)->name('bookingEnquiry.index');
    Route::get('/booking-enquiry/edit/{bookingenquiry}',BookingUmrahEditComponent::class)->name('bookingumrah.edit');
    //Booking hajj
    Route::get('/booking-hajj',BookingHajjListComponent::class)->name('bookinghajj.index');
    Route::get('/booking-hajj/edit/{bookinghajj}',BookingHajjEditComponent::class)->name('bookinghajj.edit');

    //Booking ramzaan
    Route::get('/booking-ramzaan',BookingRamzaanjListComponent::class)->name('bookingramzaan.index');
    Route::get('/booking-ramzaan/edit/{bookingramzaan}',BookingRamzaanjEditComponent::class)->name('bookingramzaan.edit');

    Route::get('/hotel-inquary', HotelInquaryListComponent::class)->name('hotelInquary.index');

	//Gallery Management
    Route::get('/image-gallery', ImageGalleryListComponent::class)->name('imageGallery.index');
    Route::get('/image-gallery/create', ImageGalleryCreateComponent::class)->name('imageGallery.create');
    Route::get('/image-gallery/edit/{image}', ImageGalleryEditComponent::class)->name('imageGallery.edit');
    Route::get('/video-gallery', VideoGalleryListComponent::class)->name('videoGallery.index');
    Route::get('/video-gallery/create', VideoGalleryCreateComponent::class)->name('videoGallery.create');
    Route::get('/video-gallery/edit/{video}', VideoGalleryEditComponent::class)->name('videoGallery.edit');
    Route::get('/testimonials', TestimonialListComponent::class)->name('testimonial.index');
    Route::get('/testimonials/create', TestimonialCreateComponent::class)->name('testimonial.create');
    Route::get('/testimonials/edit/{testimonial}', TestimonialEditComponent::class)->name('testimonial.edit');

    //Blogs
    Route::get('/blog', BlogListComponent::class)->name('blog.index');
    Route::get('/blog/create', BlogCreateComponent::class)->name('blog.create');
    Route::get('/blog/edit{manageBlog}', BlogEditComponent::class)->name('blog.edit');

    //Brochure
    Route::get('/brochure',BroucherListComponent::class)->name('brochure.index');
    Route::get('/brochure/create', BroucherCreateComponent::class)->name('brochure.create');
    Route::get('/brochure/edit/{boucher}',BroucherEditComponent::class)->name('brochure.edit');

    //Site Bank
    Route::get('/site-bank-info', SiteBankInfoListComponent::class)->name('siteBankInfo.index');
    Route::get('/site-bank-info/create', SiteBankInfoCreateComponent::class)->name('siteBankInfo.create');
    Route::get('/site-bank-info/edit/{siteBankInfo}', SiteBankInfoEditComponent::class)->name('siteBankInfo.edit');

    Route::get('/agm', AgmListComponent::class)->name('agm.index');
    Route::get('/agm/create', AgmCreateComponent::class)->name('agm.create');
    Route::get('/agm/edit/{agms}',AgmEditComponent::class)->name('agm.edit');
    Route::get('/agm/image',AgmImageComponent::class)->name('agm.image');

    //Awards
    Route::get('/award',AwardListComponent::class)->name('award.index');
    Route::get('/award/create',AwardCreateComponent::class)->name('award.create');
    Route::get('/award/edit/{award}',AwardEditComponent::class)->name('award.edit');

	Route::get('/booking-tour', BookingTourListComponent::class)->name('bookingtour.index');
	Route::get('/booking-tour/edit/{bookingtour}',BookingTourEditComponent::class)->name('bookingtour.edit');

    //membership
    Route::get('/membership',MembershipListComponent::class)->name('membership.index');

    //newsletter
    Route::get('/newsletter/create',NewsLetterCreateComponent::class)->name('newsletter.create');

    //PaymentMode
    Route::get('/payment-mode',PaymentmodeListComponent::class)->name('paymentmode.index');

	Route::get('/callus-back', CallUsBackListComponent::class)->name('callusback.index');
	Route::get('/enquiry-forex', ForexEnquiryListComponent::class)->name('enquiryforex.index');
	Route::get('/enquiry-assistant', AssistantEnquiryListComponent::class)->name('enquiryassistant.index');

	//location
	Route::get('/location', LocationListComponent::class)->name('location.index');
	Route::get('/location/create', LocationCreateComponent::class)->name('location.create');
	Route::get('/location/edit/{location}', LocationEditComponent::class)->name('location.edit');

    //Tour-State
    Route::get('/state', StateListComponent::class)->name('state.index');
    Route::get('/state/edit/{tourstate}', StateEditComponent::class)->name('state.edit');

    //Tour-package
    Route::get('/destination', DestinationListComponent::class)->name('destination.index');
    Route::get('/destination/create', DestinationCreateComponent::class)->name('destination.create');
    Route::get('/destination/edit/{tourpackage}', DestinationEditCompone::class)->name('destination.edit');

    //Tour-category
    Route::get('/tour-category', TourCategoryListComponent::class)->name('tourCategory.index');

    //Tour-Package
    Route::get('/domestic-tour', ToursListComponent::class)->name('tours.index');
    Route::get('/domestic-tour/create', ToursCreateComponent::class)->name('tours.create');
    Route::get('/domestic-tour/edit/{id}', ToursEditComponent::class)->name('tours.edit');

    //Int-destination
    Route::get('/int-destination', IntDestinationListComponent::class)->name('intDestination.index');
    Route::get('/int-destination/create', IntDestinationCreateComponent::class)->name('intDestination.create');
    Route::get('/int-destination/edit/{tourpackage}', IntDestinationEditComponent::class)->name('intDestination.edit');

    //Int-Tour-Package
    Route::get('/international-tour', IntToursListComponent::class)->name('intTours.index');
    Route::get('/international-tour/create', IntToursCreateComponent::class)->name('intTours.create');
    Route::get('/international-tour/edit/{id}', IntToursEditComponent::class)->name('intTours.edit');

    //Customer
    Route::get('/customer', CustomerListComponent::class)->name('customer.index');

    Route::get('/tour-callus-back', TourCallUsBackListComponent::class)->name('tourcallusback.index');
    Route::get('/car-rental', CarRentalListComponent::class)->name('manageCarRental.index');
    Route::get('/car-rental-create', CarRentalCreateComponent::class)->name('manageCarRental.create');
    Route::get('/car-rental-edit/{cars}', CarRentalEditComponent::class)->name('manageCarRental.edit');
    Route::get('/car-type', CarTypeListComponent::class)->name('manageCarType.index');
    Route::get('/car-sector', CarSectorListComponent::class)->name('manageCarSector.index');
    Route::get('/services', ServicesListComponent::class)->name('services.index');
    Route::get('/services-create', ServicesCreateComponent::class)->name('services.create');
    Route::get('/services-edit/{service}', ServicesEditComponent::class)->name('services.edit');
    Route::get('/service-enquiry', ServiceEnquiryListComponent::class)->name('serviceEnquiry.index');
    Route::get('/kit-item', KitItemListComponent::class)->name('kitItem.index');
    Route::get('/kit-item-create', KitItemCreateComponent::class)->name('kitItem.create');
    Route::get('/kit-item-edit/{kititems}', KitItemEditComponent::class)->name('kitItem.edit');
    Route::get('/kit-category', KitCategoryListComponent::class)->name('kitCategory.index');
    Route::get('/kit-category-create', KitCategoryCreateComponent::class)->name('kitCategory.create');
    Route::get('/kit-category-edit/{category}', KitCategoryEditComponent::class)->name('kitCategory.edit');
    Route::get('/hajj-kit-enquiry', HajjKitEnquiryListComponent::class)->name('hajjKitEnquiry.index');

    Route::get('/manage-partner', ManagePartnerListComponent::class)->name('managePartner.index');
    Route::get('/manage-partner/create', ManagePartnerCreateComponent::class)->name('managePartner.create');
    Route::get('/manage-partner/edit/{partner}', ManagePartnerEditComponent::class)->name('managePartner.edit');

    //Publications
    Route::get('/publication', PublicationListComponent::class)->name('publication.index');
    Route::get('/publication/create', PublicationCreateComponent::class)->name('publication.create');
    Route::get('/publication/edit/{publication}', PublicationEditComponent::class)->name('publication.edit');
    Route::get('/publication-enquiry', PublicationEnquiryListComponent::class)->name('publicationEnq.index');

    //Shopping
    Route::get('/shopping', ShoppingListComponent::class)->name('shopping.index');
    Route::get('/shopping-create', ShoppingCreateComponent::class)->name('shopping.create');
    Route::get('/shopping-edit/{shopping}', ShoppingEditComponent::class)->name('shopping.edit');

    Route::get('/laundry', LaundryListComponent::class)->name('laundry.index');

    // Shopping Enquiry
    Route::get('/shopping-enquiry', ShoppingEnquiryListComponent::class)->name('shoppingenquiry.index');
    Route::get('/trawnsport-enquiry', TransportEnquiryListComponent::class)->name('trnsportEnquiry.index');

    //Food-enquiry
    Route::get('/food-enquiry', FoodEnquiryListComponent::class)->name('foodenquiry.index');

    //Customer Testimonial
    Route::get('/cust-testimonials', CustomerTestimonialListComponent::class)->name('custTestimonial.index');
    Route::get('/cust-testimonials/create', CustomerTestimonialCreateComponent::class)->name('custTestimonial.create');
    Route::get('/cust-testimonials/edit/{testimonial}', CustomerTestimonialEditComponent::class)->name('custTestimonial.edit');

    //Enquiries
    Route::get('/enquiries', EnquiriesComponent::class)->name('enquiries.index');

    // Coming soon
    // Route::get('/coming-soon', RationCreateComponent::class)->name('manage-ration.create');
    Route::get('/coming-soon', function () {
        return view('coming-soon');
    })->name('comingSoon');

    Route::post('payment/request', [TestPaymentController::class, 'requestPayment'])->name('payment.request');
Route::post('payment/response', [TestPaymentController::class, 'paymentResponse'])->name('payment.response');
});
