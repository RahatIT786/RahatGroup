<?php

use App\Http\Controllers\Agent\Auth\AuthController;
use App\Http\Controllers\Agent\Bookings\BookingCreateComponent;
use App\Http\Controllers\Agent\DashboardComponent;

use App\Http\Controllers\Agent\Downloads\PrintReceiptListComponent;
use App\Http\Controllers\Agent\PaymentController;
use App\Http\Controllers\Agent\PaymentResponseComponent;
use App\Http\Controllers\Agent\Pnr\PendingSeats\PendingSeatListComponent;


use App\Http\Controllers\Agent\Reports\StatementReports\StatementReportListComponent;
// use App\Http\Controllers\Agent\Settings\FaqCreateComponent;
// use App\Http\Controllers\Agent\Settings\FaqListComponent;

//Payments
use App\Http\Controllers\Agent\Payments\AllPaymentLists\PaymentListComponent;
use App\Http\Controllers\Agent\Payments\ApprovedPaymentList\ApprovedPaymentListComponent;
use App\Http\Controllers\Agent\Payments\PendingPayment\PendingPaymentList;
use App\Http\Controllers\Agent\Payments\Commissions\CommissionEarnedComponent;
use App\Http\Controllers\Agent\Payments\AddNewPayment\PaymentCreateComponent;

use App\Http\Controllers\Agent\Bookings\ApprovedBookings\ApprovedBookingListComponent;
use App\Http\Controllers\Agent\Bookings\PendingBookings\PendingBookingListComponent;
use App\Http\Controllers\Agent\Bookings\RejectedBookings\RejectedBookingListComponent;
use App\Http\Controllers\Agent\Bookings\CancelledBookings\CancelledBookingListComponent;
use App\Http\Controllers\Agent\Bookings\SuspendedBookings\SuspendedBookingListComponent;
use App\Http\Controllers\Agent\Bookings\DeleteBookings\DeleteBookingListComponent;
use App\Http\Controllers\Agent\Bookings\OnlineBookings\OnlineBookingListComponent;
use App\Http\Controllers\Agent\Bookings\Bookings\BookingListComponent;
use App\Http\Controllers\Agent\Bookings\BookingAddPaxComponent;
use App\Http\Controllers\Agent\Bookings\AdditionalPaymentsComponent;


//Quotes Requests
use App\Http\Controllers\Agent\Quotes\QuotesListComponent;
use App\Http\Controllers\Agent\Quotes\QuotesCreateComponent;
use App\Http\Controllers\Agent\Quotes\QuotesDetailsComponent;
use App\Http\Controllers\Agent\Quotes\QuotesEditComponent;
use App\Http\Controllers\Agent\Bookings\NegotiatedBookings\NegotiatedBookingComponent;


use App\Http\Controllers\Agent\Quotes\PaymentConfirmComponent;
use App\Http\Controllers\Agent\Quotes\Payment\AddPaymentComponent;
use App\Http\Controllers\Agent\Quotes\Payment\PaymentGateWayConfirmationComponent;
use App\Http\Controllers\Agent\Quotes\HajjQuoteDetailsComponent;

//Tool
use App\Http\Controllers\Agent\Resource\ResourceListComponent;
use App\Http\Controllers\Agent\Tool\ImageGallery\ImageGalleryListComponent;
use App\Http\Controllers\Agent\Tool\ImageGallery\ImageGalleryCreateComponent;
use App\Http\Controllers\Agent\Tool\ImageGallery\ImageGalleryEditComponent;
use App\Http\Controllers\Agent\Tool\VideoGallery\VideoGalleryCreateComponent;
use App\Http\Controllers\Agent\Tool\VideoGallery\VideoGalleryEditComponent;
use App\Http\Controllers\Agent\Tool\VideoGallery\VideoGalleryListComponent;

//Setting
use App\Http\Controllers\Agent\Settings\ManageContentPage\ContentCreateComponent;
use App\Http\Controllers\Agent\Settings\ManageContentPage\ContentListComponent;
use App\Http\Controllers\Agent\Settings\ManageContentPage\ContentEditComponent;

use App\Http\Controllers\Agent\Settings\UserContactList\ContactListComponent;

use App\Http\Controllers\Agent\Settings\ManageFaq\FaqCreateComponent;
use App\Http\Controllers\Agent\Settings\ManageFaq\FaqListComponent;
use App\Http\Controllers\Agent\Settings\ManageFaq\FaqEditComponent;

use App\Http\Controllers\Agent\Settings\ManageSettings\SettingListComponent;
use App\Http\Controllers\Agent\Settings\ManageSettings\SettingCreateComponent;
use App\Http\Controllers\Agent\Settings\ManageSettings\SettingEditComponent;

use App\Http\Controllers\Agent\Downloads\Invoices\InvoicesListComponent;
use App\Http\Controllers\Agent\Downloads\Vouchers\VouchersListComponent;
use App\Http\Controllers\Agent\Downloads\Ticket\TicketListComponent;
use App\Http\Controllers\Agent\Reports\ClientReport\ClientReportListComponent;

use App\Http\Controllers\Agent\Tool\MakeCustomize\MakeCustomizeListComponent;
use App\Http\Controllers\Agent\Tool\CompaintBox\CompaintBoxListComponent;
use App\Http\Controllers\Agent\Tool\AddFeedback\AddFeedbackListComponent;

use App\Http\Controllers\Agent\Settings\Banner\BannerListComponent;
use App\Http\Controllers\Agent\Settings\Banner\BannerCreateComponent;
use App\Http\Controllers\Agent\Settings\Banner\BannerEditComponent;
use App\Http\Controllers\Agent\Settings\Subscribers\SubscribersListComponent;
use App\Http\Controllers\Agent\Pnr\PnrFlightDetails\PnrFlightDetailsListComponent;
use App\Http\Controllers\Agent\Settings\SubAgentList\SubAgentListComponent;

use App\Http\Controllers\Agent\Downloads\PrintReceipts\PrintReceiptsListComponent;
use App\Http\Controllers\Agent\Downloads\Visa\VisaListComponent;
use App\Http\Controllers\Agent\Downloads\ICards\IDCardsComponent;

use App\Http\Controllers\Agent\Packages\PackagePrices\PackagePricesListComponent;

use App\Http\Controllers\Agent\Profile\ProfileListComponent;
use App\Http\Controllers\Agent\Profile\Password\PasswordListComponent;
use App\Http\Controllers\Agent\Profile\ProfileEditComponent;

use App\Http\Controllers\Agent\Packages\PackageDetails\PackageDetailsListComponent;
use App\Http\Controllers\Agent\Packages\PackageDetails\PackageDescriptionListComponent;

use App\Http\Controllers\Agent\TravelCalendar\TravelCalendarComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Agent\Downloads\Flyer\PackageFlyerComponent;
use App\Http\Controllers\Agent\Downloads\Flyer\PackageFlyerCreateComponent;
use App\Http\Controllers\Agent\Downloads\Flyer\PackageFlyerEditComponent;

// user
use App\Http\Controllers\Agent\User\UserEnquiryComponent;
use App\Http\Controllers\Agent\Website\HomeComponent;

/*
|--------------------------------------------------------------------------
| Web Routes for Agents
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ['register' => false, 'reset' => false]
// dd(auth()->guard('agent')->user());
Route::get('/', function () {
    return to_route('login');
});

Route::get('/vouchers-pdf/{vouchers_id}', [VouchersListComponent::class, 'downloadVoucher'])->name('agentDownloadVoucher');

Route::group(['as' => 'agent.'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
	Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [AuthController::class, 'submitForgetPasswordForm'])->name('ForgotPasswordPost');
    Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('showResetPasswordForm');
    Route::post('/reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('submitResetPasswordForm');
    Route::get('/reset-password/{token}', [AuthController::class, 'emailCallback'])->name('callbackEmail');
    Route::post('/quotes/payment-confirmation/response',[PaymentController::class,'agentPaymentResponse'])->name('payment.response');
});

Route::group(['middleware' => ['auth:agent'], 'as' => 'agent.'], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', DashboardComponent::class)->name('dashboard');

    // Bookings
    Route::get('/bookings', BookingListComponent::class)->name('bookings.index');
    Route::get('/bookings/create', BookingCreateComponent::class)->name('booking.create');
    Route::get('approved/bookings', ApprovedBookingListComponent::class)->name('approved.index');
    Route::get('pending/bookings', PendingBookingListComponent::class)->name('pending.index');
    Route::get('rejected/bookings', RejectedBookingListComponent::class)->name('rejected.index');
    Route::get('cancelled/bookings', CancelledBookingListComponent::class)->name('cancelled.index');
    Route::get('suspended/bookings', SuspendedBookingListComponent::class)->name('suspended.index');
    Route::get('delete/bookings', DeleteBookingListComponent::class)->name('delete.index');
    Route::get('all-online/bookings', OnlineBookingListComponent::class)->name('online.index');
    Route::get('/booking-add-pax/{booking_id}', BookingAddPaxComponent::class)->name('bookings.add.pax');
    Route::get('/bookings/payment/{booking_id}', AdditionalPaymentsComponent::class)->name('bookings.add.payment');

     //Reqeust Quotes
     Route::get('/quotes', QuotesListComponent::class)->name('quotes.index');
     Route::get('/quotes/create', QuotesCreateComponent::class)->name('quotes.create');
     Route::get('/quotes/details/{quote_id}', QuotesDetailsComponent::class)->name('quotes.details');
     Route::get('/quotes/edit/{quote_id}', QuotesEditComponent::class)->name('quotes.edit');
     Route::get('/negotiated/requests', NegotiatedBookingComponent::class)->name('negotiated.quotes.index');
    Route::get('/payment-response', PaymentResponseComponent::class)->name('payment.response.view');
     Route::get('/quotes/payment-confirmation/{quote_id}', PaymentConfirmComponent::class)->name('quotes.payment-confirmation');
     Route::get('/quotes/payment-gateway/{quote_id}', PaymentGateWayConfirmationComponent::class)->name('quotes.payment-gateway');
     Route::get('/quotes/payment-details/{quote_id}', HajjQuoteDetailsComponent::class)->name('quotes.hajj.payment-details');

     // CATCH Response
     Route::get('/quotes/offline-payment/{quote_id}', AddPaymentComponent::class)->name('quotes.offline-payment');

    // Payments
    Route::get('/payment', PaymentListComponent::class)->name('payment.index');
    Route::get('/payment/create', PaymentCreateComponent::class)->name('payment.create');
    Route::get('/approved-payment', ApprovedPaymentListComponent::class)->name('approvedPayment.index');
    Route::get('/pending-payment', PendingPaymentList::class)->name('pendingPayment.index');

    //Agent Commissions
    Route::get('/commission-earned', CommissionEarnedComponent::class)->name('commission.index');

    // Reports
    Route::get('/client-report', ClientReportListComponent::class)->name('clientReport.index');
    Route::get('/statement-report', StatementReportListComponent::class)->name('statementReport.index');


    // Download Management
    Route::get('/invoices', InvoicesListComponent::class)->name('invoices.index');
    Route::get('/vouchers', VouchersListComponent::class)->name('vouchers.index');

    // Route::get('/print-receipt', PrintReceiptListComponent::class)->name('printReceipt.index');
    Route::get('/ticket', TicketListComponent::class)->name('ticket.index');
    Route::get('/visa', VisaListComponent::class)->name('visa.index');

    Route::get('/print-receipt', PrintReceiptsListComponent::class)->name('printReceipt.index');
    Route::get('/visa', VisaListComponent::class)->name('visa.index');
    Route::get('/i-cards', IDCardsComponent::class)->name('icard.index');
      Route::get('/flyer', PackageFlyerComponent::class)->name('flyer.index');
    Route::get('/flyer/create', PackageFlyerCreateComponent::class)->name('flyer.create');
    Route::get('/flyer/edit/{flyer}', PackageFlyerEditComponent::class)->name('flyer.edit');

    Route::get('/banner', BannerListComponent::class)->name('banner.index');
    Route::get('/banner/create', BannerCreateComponent::class)->name('banner.create');
    Route::get('/banner/edit{manageBanner}', BannerEditComponent::class)->name('banner.edit');

    // PNR Management
    Route::get('/pending-seat', PendingSeatListComponent::class)->name('pendingSeat.index');
    Route::get('/flight-details', PnrFlightDetailsListComponent::class)->name('flightDetails.index');

    //Package Management
    Route::get('/package-price', PackagePricesListComponent::class)->name('packagePrice.index');

    //Tool
    Route::get('/image-gallery', ImageGalleryListComponent::class)->name('imageGallery.index');
    Route::get('/image-gallery/create', ImageGalleryCreateComponent::class)->name('imageGallery.create');
    Route::get('/image-gallery/edit/{eventmaster}', ImageGalleryEditComponent::class)->name('imageGallery.edit');
    Route::get('/video-gallery', VideoGalleryListComponent::class)->name('videoGallery.index');
    Route::get('/video-gallery/create', VideoGalleryCreateComponent::class)->name('videoGallery.create');
    Route::get('/video-gallery/edit/{video}', VideoGalleryEditComponent::class)->name('videoGallery.edit');

    //Setting
    Route::get('/content', ContentListComponent::class)->name('content.index');
    Route::get('/content/create', ContentCreateComponent::class)->name('content.create');
    Route::get('/content/edit/{content}', ContentEditComponent::class)->name('content.edit');
    Route::get('/banner', BannerListComponent::class)->name('banner.index');
    Route::get('/banner/create', BannerCreateComponent::class)->name('banner.create');
    Route::get('/banner/edit{manageBanner}', BannerEditComponent::class)->name('banner.edit');
    Route::get('/subscribers', SubscribersListComponent::class)->name('subscribers.index');
    Route::get('/sub-agent', SubAgentListComponent::class)->name('subAgent.index');
    Route::get('/contact', ContactListComponent::class)->name('contact.index');
    Route::get('/faq', FaqListComponent::class)->name('faq.index');
    Route::get('/faq/create', FaqCreateComponent::class)->name('faq.create');
    Route::get('/faq/edit/{manageFaq}', FaqEditComponent::class)->name('faq.edit');
    Route::get('/setting', SettingListComponent::class)->name('setting.index');
    Route::get('/setting/create', SettingCreateComponent::class)->name('setting.create');
    Route::get('/setting/edit/{manageSetting}', SettingEditComponent::class)->name('setting.edit');

    Route::get('/banner', BannerListComponent::class)->name('banner.index');
    Route::get('/banner/create', BannerCreateComponent::class)->name('banner.create');
    Route::get('/banner/edit{manageBanner}', BannerEditComponent::class)->name('banner.edit');
    Route::get('/subscribers', SubscribersListComponent::class)->name('subscribers.index');
    Route::get('/flight-details', PnrFlightDetailsListComponent::class)->name('flightDetails.index');


    Route::get('/change-password', PasswordListComponent::class)->name('password.index');
    Route::get('/profile', profileListComponent::class)->name('profile.index');

    Route::get('/profile/edit', ProfileEditComponent::class)->name('profile.edit');

    //Resources
    Route::get('/resources', ResourceListComponent::class)->name('resource.index');

    //User Enquiry
    Route::get('/user-enquiry',UserEnquiryComponent::class)->name('user.enquiry');

    //Travel Calendar
    Route::get('/travel-calendar', TravelCalendarComponent::class)->name('travel-calendar.index');

    Route::get('/make-customize', MakeCustomizeListComponent::class)->name('makeCustomize.index');
    Route::get('/complaint-box', CompaintBoxListComponent::class)->name('complaintBox.index');
    Route::get('/add-feedback', AddFeedbackListComponent::class)->name('addFeedback.index');
    Route::get('/package-details', PackageDetailsListComponent::class)->name('packageDetails.index');
    Route::get('/package-description/{pkgid}', PackageDescriptionListComponent::class)->name('packageDescription');

    //user
    Route::post('/submit-enquiry', [HomeComponent::class, 'submitEnquiry'])->name('submit.enquiry');


    // Coming soon
    Route::get('/coming-soon', function () {
        return view('coming-soon');
    })->name('comingSoon');
});
