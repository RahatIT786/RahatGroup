<?php

/*
|--------------------------------------------------------------------------
| Web Routes for Customer
|--------------------------------------------------------------------------
|
| Here is where you can register customer routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "customers" middleware group. Make something great!
|
*/

use App\Http\Controllers\UserFront\UserHomePageComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserFront\Pages\CustomerTouristVisaComponent;
use App\Http\Controllers\UserFront\Auth\AuthController;
use App\Http\Controllers\UserFront\DashboardComponent;
use App\Http\Controllers\UserFront\Pages\UmrahPackage;
use App\Http\Controllers\UserFront\Pages\ServiceComponent;
use App\Http\Controllers\UserFront\Pages\ServiceEnquiryComponent;
use App\Http\Controllers\UserFront\Pages\ForexEnquiryComponent;
use App\Http\Controllers\UserFront\Pages\HajjKitComponent;
use App\Http\Controllers\UserFront\Pages\HajjKitListComponent;
use App\Http\Controllers\UserFront\Pages\HajjUmrahKitEnquiryComponent;
use App\Http\Controllers\UserFront\Pages\BaitulMuqaddasGuideListComponent;
use App\Http\Controllers\UserFront\Pages\FlierListComponent;
use App\Http\Controllers\UserFront\Pages\TurkeyGuideComponentListComponent;
use App\Http\Controllers\UserFront\Pages\UmrahPackageViewComponent;
use App\Http\Controllers\UserFront\Pages\HotelDetailComponent;
use App\Http\Controllers\UserFront\Profile\ProfileEditComponent;
use App\Http\Controllers\UserFront\Profile\ProfileListComponent;
use App\Http\Controllers\UserFront\Profile\Password\PasswordListComponent;

use App\Http\Controllers\UserFront\Pages\HajjPackage;
use App\Http\Controllers\UserFront\Pages\HajjPackageView;
use App\Http\Controllers\UserFront\Pages\RamzanPackagesComponent;
use App\Http\Controllers\UserFront\Pages\RamzanPackagesViewComponent;
use App\Http\Controllers\UserFront\Pages\IhramListComponent;
use App\Http\Controllers\UserFront\Pages\ZiyaratPackagesComponent;
use App\Http\Controllers\UserFront\Pages\ZiyaratPackagesViewComponent;
use App\Http\Controllers\UserFront\Pages\RewardComponent;
use App\Http\Controllers\UserFront\Pages\DirectorsSpeakComponent;
use App\Http\Controllers\UserFront\Pages\AgmComponent;
use App\Http\Controllers\UserFront\Pages\AgmDetailsComponent;
use App\Http\Controllers\UserFront\Pages\BankAccountComponent;
use App\Http\Controllers\UserFront\Pages\PayNowListComponent;
use App\Http\Controllers\UserFront\Pages\ContactUsListComponent;
use App\Http\Controllers\UserFront\Pages\TestimonialListComponent;
use App\Http\Controllers\UserFront\Pages\ImportantLinksComponent;
use App\Http\Controllers\UserFront\Pages\GuidesComponent;
use App\Http\Controllers\UserFront\Pages\EntranceToUmrahListComponent;
use App\Http\Controllers\UserFront\Pages\TravelAndAccessListComponent;
use App\Http\Controllers\UserFront\Pages\PlayListComponent;
use App\Http\Controllers\UserFront\Pages\UmrahGuideListComponent;
use App\Http\Controllers\UserFront\Pages\AccessToSanctuaryListComponent;
use App\Http\Controllers\UserFront\Pages\TawafListComponent;
use App\Http\Controllers\UserFront\Pages\SaiListComponent;
use App\Http\Controllers\UserFront\Pages\EntranceToZiyarahListComponent;
use App\Http\Controllers\UserFront\AgentRegistration\AgentRegistrationCreateComponent;
use App\Http\Controllers\UserFront\Pages\HajjGuideListComponent;
use App\Http\Controllers\UserFront\Pages\HadeesListComponent;
use App\Http\Controllers\UserFront\Pages\ShoppingListComponent;

use App\Http\Controllers\UserFront\Bookings\AdditionalPaymentsComponent;
use App\Http\Controllers\UserFront\Bookings\BookingAddPaxComponent;
use App\Http\Controllers\UserFront\Bookings\BookingListComponent;
use App\Http\Controllers\UserFront\Payment\AddPaymentComponent;
use App\Http\Controllers\UserFront\Quotes\PaymentConfirmComponent;
use App\Http\Controllers\UserFront\Quotes\QuotesCreateComponent;
use App\Http\Controllers\UserFront\Quotes\QuotesDetailsComponent;
use App\Http\Controllers\UserFront\Quotes\QuotesEditComponent;
use App\Http\Controllers\UserFront\Quotes\QuotesListComponent;
use App\Http\Controllers\UserFront\TravelCalendar\TravelCalendarComponent;
use App\Http\Controllers\UserFront\Payment\PaymentListComponent;
use App\Http\Controllers\UserFront\Payment\ApprovedPaymentListComponent;
use App\Http\Controllers\UserFront\Payment\PendingPaymentList;

use App\Http\Controllers\UserFront\Pages\AttractionsListComponent;
use App\Http\Controllers\UserFront\Pages\HolySitesListComponent;
use App\Http\Controllers\UserFront\Pages\AccommodationListComponent;
use App\Http\Controllers\UserFront\Pages\RestaurantsAndCafesListComponent;
use App\Http\Controllers\UserFront\Pages\BaghdadGuideListComponent;
use App\Http\Controllers\UserFront\Pages\PublicationListComponent;
use App\Http\Controllers\UserFront\Pages\LaundryListComponent;
use App\Http\Controllers\UserFront\Pages\CustomizedUmrahComponent;

//madinah
use App\Http\Controllers\UserFront\Pages\Madina\MadinaAccommodationComponent;
use App\Http\Controllers\UserFront\Pages\Madina\MadinaAttractionComponent;
use App\Http\Controllers\UserFront\Pages\Madina\MadinaProphetMosqueComponent;
use App\Http\Controllers\UserFront\Pages\Madina\MadinaRestaurantsAndCafesComponent;
use App\Http\Controllers\UserFront\Pages\Madina\MadinaShoppingComponent;
use App\Http\Controllers\UserFront\Pages\Madina\MadinaProphetMosqueServiceComponent;
use App\Http\Controllers\UserFront\Pages\Madina\GettingToMadinaComponent;
use App\Http\Controllers\UserFront\Pages\FoodMenuComponent;
use App\Http\Controllers\UserFront\Pages\FoodMenuDetailsComponent;
use App\Http\Controllers\UserFront\Pages\Madina\MadinaTransportationComponent;

//makkah
use App\Http\Controllers\UserFront\Pages\Makkah\MakkahTheGrandMosqueComponent;
use App\Http\Controllers\UserFront\Pages\Makkah\MakkahTheGrandMosqueServiceComponent;
use App\Http\Controllers\UserFront\Pages\Makkah\MakkahHollySiteComponent;
use App\Http\Controllers\UserFront\Pages\Makkah\GettingToMakkahComponent;
use App\Http\Controllers\UserFront\Pages\Makkah\MakkahAttractionsComponent;
use App\Http\Controllers\UserFront\Pages\Makkah\MakkahAccommodationComponent;
use App\Http\Controllers\UserFront\Pages\Makkah\MakkahShoppingComponent;
use App\Http\Controllers\UserFront\Pages\Makkah\MakkahRestaurantsAndCafesComponent;

use App\Http\Controllers\UserFront\Pages\JobOpeningsComponent;
use App\Http\Controllers\UserFront\Pages\HotelListComponent;
use App\Http\Controllers\UserFront\Pages\TransportListComponent;
use App\Http\Controllers\UserFront\Pages\TransportdetailsComponent;
use App\Http\Controllers\UserFront\Pages\TicketListComponent;
use App\Http\Controllers\UserFront\Pages\FaqListComponent;
use App\Http\Controllers\UserFront\Pages\ImageListComponent;
use App\Http\Controllers\UserFront\Pages\AgencyListComponent;
use App\Http\Controllers\Admin\Gallery\CustomerTestimonials\CustomerTestimonialCreateComponent;
use App\Http\Controllers\Admin\Gallery\CustomerTestimonials\CustomerTestimonialEditComponent;
use App\Http\Controllers\UserFront\Pages\UmrahLandComponent;
use App\Http\Controllers\UserFront\Pages\UmrahLandViewComponent;
use App\Http\Controllers\UserFront\Pages\BookMyAssistantEnquiryComponent;
use App\Http\Controllers\UserFront\Pages\BookMyAssistant;
use App\Http\Controllers\UserFront\Pages\AwardComponent;
use App\Http\Controllers\UserFront\Pages\AwardDetailsComponent;
use App\Http\Controllers\UserFront\Pages\BrochureComponent;
use App\Http\Controllers\UserFront\Pages\BlogComponent;
use App\Http\Controllers\UserFront\Pages\BlogDetailsComponent;

use App\Http\Controllers\UserFront\Pages\DayItenaryComponent;
use App\Http\Controllers\UserFront\Pages\InclusionsExclusionsComponent;
use App\Http\Controllers\UserFront\Pages\AgentSpeakComponent;
use App\Http\Controllers\UserFront\Pages\YoutubeVideosComponent;
use App\Http\Controllers\UserFront\Pages\ImportantNotesComponent;
use App\Http\Controllers\UserFront\Pages\ImportantAdviceComponent;
use App\Http\Controllers\UserFront\Pages\ThingsToCarryComponent;
use App\Http\Controllers\UserFront\Pages\BookingCancellationPolicyComponent;
use App\Http\Controllers\UserFront\Pages\ChildRefundPolicyComponent;
use App\Http\Controllers\UserFront\Pages\UzbekistanComponent;
use App\Http\Controllers\UserFront\Pages\AzerbaijanComponent;
use App\Http\Controllers\UserFront\Pages\SyriaJordanIraqComponent;
use App\Http\Controllers\UserFront\Pages\JordanPalestineEgyptComponent;
use App\Http\Controllers\UserFront\Pages\KarbalaKufaNajafComponent;
use App\Http\Controllers\UserFront\Pages\DubaiLeisureComponent;
use App\Http\Controllers\UserFront\Pages\AboutUsComponent;
use App\Http\Controllers\UserFront\Pages\MiqatComponent;

Route::get('/customer', function () {
    return to_route('login');
});

//When Not LoggedIn
Route::group(['as' => 'customer.'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [AuthController::class, 'submitForgetPasswordForm'])->name('ForgotPasswordPost');
    Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('showResetPasswordForm');
    Route::post('/reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('submitResetPasswordForm');
    Route::get('/reset-password/{token}', [AuthController::class, 'emailCallback'])->name('callbackEmail');
	Route::get('/hotel-detail/{id}', HotelDetailComponent::class)->name('hotel-detail');
    Route::get('/tourist-visa', CustomerTouristVisaComponent::class)->name('customer-tour-visa');
	Route::get('/umrah-package', UmrahPackage::class)->name('umrahPackage');
	Route::get('/service/{slug}', ServiceComponent::class)->name('service');
    Route::get('/service-enquiry/{slug}', ServiceEnquiryComponent::class)->name('serviceEnquiry');
    Route::get('/forex-enquiry/{slug}', ForexEnquiryComponent::class)->name('forexEnquiry');
    Route::get('/hajj-kit/{slug}', HajjKitComponent::class)->name('hajjKit');
    Route::get('/hajj-kit', HajjKitListComponent::class)->name('HajjKit');
	Route::get('/umrah-kit', HajjKitListComponent::class)->name('UmrahKit');
	Route::get('/bags-and-kit', HajjKitListComponent::class)->name('BagsKit');
    Route::get('/hajj-umarh-kit-enquiry/{slug}', HajjUmrahKitEnquiryComponent::class)->name('hajjumrahKitEnquiry');
    Route::get('/baitul-muqaddas-guide', BaitulMuqaddasGuideListComponent::class)->name('BaitulMuqaddasGuide');
	Route::get('/fliers', FlierListComponent::class)->name('fliers');
    Route::get('/turkey-guide', TurkeyGuideComponentListComponent::class)->name('TurkeyGuide');
    Route::get('/umrah-package-view/{id}/{type?}', UmrahPackageViewComponent::class)->name('umrahPackageView');
    Route::get('/download-umrah-packages-pdf/{packages_id}', [UmrahPackageViewComponent::class, 'downloadUmrahPackage'])->name('downloadUmrahPackage');
    Route::get('/ihram', IhramListComponent::class)->name('Ihram');
    Route::get('/rewards', RewardComponent::class)->name('Reward');
    Route::get('/directors-speak', DirectorsSpeakComponent::class)->name('DirectorsSpeak');
    Route::get('/agm', AgmComponent::class)->name('Agm');
    Route::get('/agm-details/{id}', AgmDetailsComponent::class)->name('AgmDetails');
    Route::get('/bank-accounts', BankAccountComponent::class)->name('BankAccount');
    Route::get('/pay-now', PayNowListComponent::class)->name('PayNow');
    Route::get('/Contact-us', ContactUsListComponent::class)->name('ContactUs');
    Route::get('/testimonials', TestimonialListComponent::class)->name('Testimonial');
    Route::get('/important-links', ImportantLinksComponent::class)->name('ImportantLinks');
    Route::get('/guides_&_pdfs', GuidesComponent::class)->name('Guides');
    Route::get('/entrance_to_umrah', EntranceToUmrahListComponent::class)->name('EntranceToUmrah');
    Route::get('/travel_&_access', TravelAndAccessListComponent::class)->name('TravelAndAccess');
    Route::get('/play-list-tutorials', PlayListComponent::class)->name('PlayListTutorials');
    Route::get('/umrah-guide', UmrahGuideListComponent::class)->name('UmrahGuide');
    Route::get('/access-to-sanctuary', AccessToSanctuaryListComponent::class)->name('AccessToSanctuary');
    Route::get('/tawaf', TawafListComponent::class)->name('Tawaf');
    Route::get('/sai', SaiListComponent::class)->name('Sai');
    Route::get('/entrance-to-ziyarah', EntranceToZiyarahListComponent::class)->name('EntranceToZiyarah');

    //Hajj package
    Route::get('/hajj-packages', HajjPackage::class)->name('hajjPackage');
    Route::get('/hajj-packages-view/{id}/{type?}', HajjPackageView::class)->name('hajjPackageView');
    Route::get('/download-hajj-packages-pdf/{packages_id}', [HajjPackageView::class, 'downloadPackage'])->name('downloadHajjPackage');

    //Publication
    Route::get('/publication', PublicationListComponent::class)->name('publication');

    //Ramzan Package
    Route::get('ramzan-packages', RamzanPackagesComponent::class)->name('ramzanPackages');
    Route::get('ramzan-packages-view/{id}/{type}', RamzanPackagesViewComponent::class)->name('ramzanPackagesView');
    Route::get('/download-ramjan-packages-pdf/{packages_id}', [RamzanPackagesViewComponent::class, 'downloadRamzanPackage'])->name('downloadRamzanPackage');

    //Ziyarat
    Route::get('ziyarat-packages', ZiyaratPackagesComponent::class)->name('ziyaratPackages');
    Route::get('ziyarat-packages-view/{id}/{type?}', ZiyaratPackagesViewComponent::class)->name('ziyaratPackagesView');
    Route::get('/download-ziyarat-packages-pdf/{packages_id}', [ZiyaratPackagesViewComponent::class, 'downloadZiyaratPackage'])->name('downloadZiyaratPackage');

    Route::get('/agent-registration', AgentRegistrationCreateComponent::class)->name('AgentRegistration');
    Route::get('/hajj-guide', HajjGuideListComponent::class)->name('HajjGuide');
    Route::get('/hadees', HadeesListComponent::class)->name('Hadees');
    Route::get('/shopping', ShoppingListComponent::class)->name('Shopping');

    Route::get('/attractions', AttractionsListComponent::class)->name('Attractions');
    Route::get('/holy-sites', HolySitesListComponent::class)->name('HolySites');
    Route::get('/accommodation', AccommodationListComponent::class)->name('Accommodation');
    Route::get('/restaurants-and-cafes', RestaurantsAndCafesListComponent::class)->name('RestaurantsAndCafes');
    Route::get('/baghdad-guide', BaghdadGuideListComponent::class)->name('BaghdadGuide');

    Route::get('/guides_&_pdfs', GuidesComponent::class)->name('Guides');
    Route::get('/entrance_to_umrah', EntranceToUmrahListComponent::class)->name('EntranceToUmrah');
    Route::get('/travel_&_access', TravelAndAccessListComponent::class)->name('TravelAndAccess');
    Route::get('/play-list-tutorials', PlayListComponent::class)->name('PlayListTutorials');
    Route::get('/laundry', LaundryListComponent::class)->name('laundry');
    Route::get('/customized-umrah', CustomizedUmrahComponent::class)->name('customizedUmrah');

    // Makkah
    Route::get('/makkah/grand-mosque', MakkahTheGrandMosqueComponent::class)->name('makkahTheGrandMosque');
    Route::get('/makkah/grand-mosque-service', MakkahTheGrandMosqueServiceComponent::class)->name('makkahTheGrandMosquesService');
    Route::get('/makkah/holy-sites', MakkahHollySiteComponent::class)->name('makkahHolySite');
    Route::get('/makkah/getting-to-makkah', GettingToMakkahComponent::class)->name('gettingToMakkah');
    Route::get('/makkah/attraction', MakkahAttractionsComponent::class)->name('makkahAttraction');
    Route::get('/makkah/accommodation', MakkahAccommodationComponent::class)->name('makkahAccommodation');
    Route::get('/makkah/shopping', MakkahShoppingComponent::class)->name('makkahShopping');
    Route::get('/makkah/restaurants-and-cafes', MakkahRestaurantsAndCafesComponent::class)->name('makkahRestaurantsAndCafes');

    // Madina
    Route::get('/madina/prophet-mosque', MadinaProphetMosqueComponent::class)->name('madinaProphetMosque');
    Route::get('/madina/attraction', MadinaAttractionComponent::class)->name('madinaAttraction');
    Route::get('/madina/accommodation', MadinaAccommodationComponent::class)->name('madinaAccommodation');
    Route::get('/madina/shopping', MadinaShoppingComponent::class)->name('madinaShopping');
    Route::get('/madina/restaurants-and-cafes', MadinaRestaurantsAndCafesComponent::class)->name('madinaRestaurantsAndCafes');
    Route::get('/madina/prophet-mosque-service', MadinaProphetMosqueServiceComponent::class)->name('madinaProphetMosqueService');
    Route::get('/madina/transportation', MadinaTransportationComponent::class)->name('madinaTransportation');
    Route::get('/madina/getting-to-madina', GettingToMadinaComponent::class)->name('gettingToMadina');
	//Food-menu
    Route::get('/food-menu', FoodMenuComponent::class)->name('foodMenu');
    Route::get('/food-menu-details/{id}', FoodMenuDetailsComponent::class)->name('foodMenu-details');

    //land-umrah
    Route::get('/umrah-land-packages', UmrahLandComponent::class)->name('umrahLandPackages');
    Route::get('/umrah-land-packages-view/{id}/{type?}', UmrahLandViewComponent::class)->name('umrahLandPackagesView');

    Route::get('/job-openings', JobOpeningsComponent::class)->name('Jobopenings');
    Route::get('/hotels', HotelListComponent::class)->name('hotels');
    Route::get('/transports', TransportListComponent::class)->name('transport');
    Route::get('/transport-detail/{id}', TransportdetailsComponent::class)->name('transportDetail');
    Route::get('/tickets', TicketListComponent::class)->name('ticket');
    Route::get('/faq-pages', FaqListComponent::class)->name('faqPage');
    Route::get('images', ImageListComponent::class)->name('image');
    Route::get('agencies', AgencyListComponent::class)->name('agency');
    Route::get('/book-my-assistant', BookMyAssistant::class)->name('bookMyAssistant');
    Route::get('/book-my-assistant-enquiry', BookMyAssistantEnquiryComponent::class)->name('bookMyAssistantEnquiry');
    Route::get('/award', AwardComponent::class)->name('Award');
    Route::get('/award-details/{id}', AwardDetailsComponent::class)->name('AwardDetails');
    Route::get('/brochure', BrochureComponent::class)->name('brochure');
    Route::get('/blog', BlogComponent::class)->name('Blog');
    Route::get('/blog-details/{id}', BlogDetailsComponent::class)->name('BlogDetails');

    Route::get('/day-itenary', DayItenaryComponent::class)->name('dayItenary');
    Route::get('/inclusions-exclusions', InclusionsExclusionsComponent::class)->name('inclusionsExclusion');
    Route::get('/agent-speak', AgentSpeakComponent::class)->name('agent-speak');
    Route::get('/youtube-video', YoutubeVideosComponent::class)->name('youtube-video');
    Route::get('/important-notes', ImportantNotesComponent::class)->name('importantNotes');
    Route::get('/important-advice', ImportantAdviceComponent::class)->name('importantAdvice');
    Route::get('/things-to-carry', ThingsToCarryComponent::class)->name('thingstoCarry');
    Route::get('/booking-cancellation-policy', BookingCancellationPolicyComponent::class)->name('bookingCancellationPolicy');
    Route::get('/child-refund-policy', ChildRefundPolicyComponent::class)->name('childRefundPolicy');
    Route::get('/uzbekistan', UzbekistanComponent::class)->name('uzbekistan');
    Route::get('/azerbaijan', AzerbaijanComponent::class)->name('azerbaijan');
    Route::get('/syria-jordan-iraq', SyriaJordanIraqComponent::class)->name('syriajordaniraq');
    Route::get('/jordan-palestine-egypt', JordanPalestineEgyptComponent::class)->name('jordanpalestineegypt');
    Route::get('/karbala-kufa-najaf', KarbalaKufaNajafComponent::class)->name('karbalakufanajaf');
    Route::get('/dubai-leisure', DubaiLeisureComponent::class)->name('dubaileisure');
    Route::get('/about-us', AboutUsComponent::class)->name('aboutUs');
    Route::get('/miqats', MiqatComponent::class)->name('miqat');
});

//When LoggedIn
    Route::group(['middleware' => ['auth:customer'], 'as' => 'customer.'], function () {
    //after logged in
    Route::get('/customer-dashboard', DashboardComponent::class)->name('dashboard');
    Route::get('/profile', ProfileListComponent::class)->name('profile.index');
    Route::get('/profile/edit', ProfileEditComponent::class)->name('profile.edit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/change-password', PasswordListComponent::class)->name('password.index');
    //Reqeust Quotes
    Route::get('/quotes', QuotesListComponent::class)->name('quotes.index');
    Route::get('/quotes/create', QuotesCreateComponent::class)->name('quotes.create');
    Route::get('/quotes/edit/{quote_id}', QuotesEditComponent::class)->name('quotes.edit');
    Route::get('/quotes/details/{quote_id}', QuotesDetailsComponent::class)->name('quotes.details');
    Route::get('/quotes/payment-confirmation/{quote_id}', PaymentConfirmComponent::class)->name('quotes.payment-confirmation');
    // Offline Payment
    Route::get('/quotes/offline-payment/{quote_id}', AddPaymentComponent::class)->name('quotes.offline-payment');
    // Bookings
    Route::get('/bookings', BookingListComponent::class)->name('bookings.index');
    Route::get('/booking-add-pax/{booking_id}', BookingAddPaxComponent::class)->name('bookings.add.pax');
    Route::get('/bookings/payment/{booking_id}', AdditionalPaymentsComponent::class)->name('bookings.add.payment');
    //Travel Calendar
    Route::get('/travel-calendar', TravelCalendarComponent::class)->name('travel-calendar.index');
    // Payments
    Route::get('/payment', PaymentListComponent::class)->name('payment.index');
    Route::get('/approved-payment', ApprovedPaymentListComponent::class)->name('approvedPayment.index');
    Route::get('/pending-payment', PendingPaymentList::class)->name('pendingPayment.index');
});
