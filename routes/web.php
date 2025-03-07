<?php
use App\Http\Controllers\AlterController;
use App\Http\Controllers\Agent\Website\Admin\DashboardComponent;
use App\Http\Controllers\Agent\Website\HomeComponent;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomePageComponent;
use App\Http\Controllers\UserFront\UserHomePageComponent;
use App\Http\Controllers\User\Pages\ContactUsComponent;
use App\Http\Controllers\User\Pages\AboutUsComponent;
use App\Http\Controllers\User\Pages\FaqComponent;
use App\Http\Controllers\User\Pages\BookingCalendarComponent;
use App\Http\Controllers\User\Pages\TouristVisaComponent;

use App\Http\Controllers\User\Pages\IhramComponent;
use App\Http\Controllers\User\Pages\AccessToSanctuaryComponent;
use App\Http\Controllers\User\Pages\TawafComponent;
use App\Http\Controllers\User\Pages\SaiComponent;
use App\Http\Controllers\User\Pages\EntranceToZiyarahComponent;
use App\Http\Controllers\User\Pages\HotelListingComponent;
use App\Http\Controllers\User\Pages\HoteldetailsComponent;
use App\Http\Controllers\User\Pages\BankAccountsComponent;

use App\Http\Controllers\User\Pages\Madina\GettingToMadinaComponent;
use App\Http\Controllers\User\Pages\Madina\MadinaAccommodationComponent;
use App\Http\Controllers\User\Pages\Madina\MadinaAttractionComponent;
use App\Http\Controllers\User\Pages\Madina\MadinaProphetMosqueComponent;
use App\Http\Controllers\User\Pages\Madina\MadinaProphetMosqueServiceComponent;
use App\Http\Controllers\User\Pages\Madina\MadinaRestaurantsAndCafesComponent;
use App\Http\Controllers\User\Pages\Madina\MadinaShoppingComponent;
use App\Http\Controllers\User\Pages\Madina\MadinaTransportationComponent;
use App\Http\Controllers\User\Pages\Makkah\GettingToMakkahComponent;
use App\Http\Controllers\User\Pages\Makkah\MakkahAccommodationComponent;
use App\Http\Controllers\User\Pages\Makkah\MakkahAttractionsComponent;
use App\Http\Controllers\User\Pages\Makkah\MakkahHollySiteComponent;
use App\Http\Controllers\User\Pages\Makkah\MakkahRestaurantsAndCafesComponent;
use App\Http\Controllers\User\Pages\Makkah\MakkahShoppingComponent;
use App\Http\Controllers\User\Pages\Makkah\MakkahTheGrandMosqueComponent;
use App\Http\Controllers\User\Pages\Makkah\MakkahTheGrandMosqueServiceComponent;
use App\Http\Controllers\User\Pages\BaitulMuqaddasGuideComponent;
use App\Http\Controllers\User\Pages\BaghdadGuideComponent;
use App\Http\Controllers\User\Pages\ImageGalleryComponent;
use App\Http\Controllers\User\Pages\VideoGalleryComponent;

use App\Http\Controllers\User\Pages\CustomizedUmrahComponent;
use App\Http\Controllers\User\Pages\UmrahComponent;
use App\Http\Controllers\User\Pages\UmrahLandComponent;
use App\Http\Controllers\User\Pages\UmrahItinerary;
use App\Http\Controllers\User\Pages\UmrahIndiaItinerary;
use App\Http\Controllers\User\Pages\UmrahGroundServices;
use App\Http\Controllers\User\Pages\UmrahTripComponent;
use App\Http\Controllers\User\Pages\TestimonialComponent;

use App\Http\Controllers\User\Pages\BrochureComponent;
use App\Http\Controllers\User\Pages\ShoppingComponent;

use App\Http\Controllers\User\Pages\BlogComponent;
use App\Http\Controllers\User\Pages\BlogDetailsComponent;

use App\Http\Controllers\User\Pages\AwardsComponent;
use App\Http\Controllers\User\Pages\AwardsDetailsComponent;

use App\Http\Controllers\User\Pages\HajjPackagesComponent;
use App\Http\Controllers\User\Pages\HajjPackagesViewComponent;
use App\Http\Controllers\User\Pages\RamzanPackagesComponent;
use App\Http\Controllers\User\Pages\RamzanPackagesViewComponent;
use App\Http\Controllers\User\Pages\AgmListComponent;
use App\Http\Controllers\User\Pages\AgmDetailsListComponent;
use App\Http\Controllers\User\Pages\RewardListComponent;
use App\Http\Controllers\User\Pages\DirectorsSpeakListComponent;
use App\Http\Controllers\User\Pages\ImportantLinkListComponent;
use App\Http\Controllers\User\Pages\AuthorisedAgentsListComponent;
use App\Http\Controllers\User\Pages\PlayListTutorialsComponent;

use App\Http\Controllers\User\Pages\UmrahComponentViewComponent;
use App\Http\Controllers\User\Pages\UmrahLandViewComponent;
use App\Http\Controllers\User\Pages\ZiyaratPackagesComponent;
use App\Http\Controllers\User\Pages\ZiyaratPackagesViewComponent;
use App\Http\Controllers\User\Pages\UmrahGuideComponent;
use App\Http\Controllers\User\Pages\UmrahKitComponent;
use App\Http\Controllers\User\Pages\TurkeyGuideComponent;
use App\Http\Controllers\User\Pages\HadeesComponent;
use App\Http\Controllers\User\Pages\HajjGuideComponent;
use App\Http\Controllers\User\Pages\FoodMenuComponent;
use App\Http\Controllers\User\Pages\FoodMenuDetailsComponent;
use App\Http\Controllers\User\Pages\GuidesListComponent;
use App\Http\Controllers\User\Pages\AuthorisedAgentsComponent;
use App\Http\Controllers\User\Pages\TransportListComponent;
use App\Http\Controllers\User\Pages\TransportdetailsComponent;
use App\Http\Controllers\UserFront\Pages\HotelListComponent;

use App\Http\Controllers\User\AgentRegistration\AgentRegistrationCreateComponent;
use App\Http\Controllers\UserFront\Pages\UmrahCalendarComponent;
use App\Http\Controllers\UserFront\Pages\AgencyListComponent;
use App\Http\Controllers\UserFront\Pages\FaqListComponent;
use App\Http\Controllers\UserFront\Pages\TicketListComponent;
use App\Http\Controllers\UserFront\Pages\ImageListComponent;
use App\Http\Controllers\User\Pages\PayNowComponent;
use App\Http\Controllers\User\Pages\FlierListComponent;
use App\Http\Controllers\User\Pages\DomesticTourPackagesComponent;
use App\Http\Controllers\User\Pages\DomesticTourListingComponent;
use App\Http\Controllers\User\Pages\DomesticTourDetailsLComponent;

use App\Http\Controllers\User\Pages\GrandsMosqueServicesComponent;
use App\Http\Controllers\User\Pages\TravelAndAccessComponent;
use App\Http\Controllers\User\Pages\TicketsListComponent;
use App\Http\Controllers\User\Pages\EntranceToUmrahComponent;
use App\Http\Controllers\User\Pages\MiqatComponent;
use App\Http\Controllers\User\Pages\GrandsMosqueComponent;
use App\Http\Controllers\User\Pages\JobOpeningsComponent;
use App\Http\Controllers\User\Pages\DayItenaryComponent;
use App\Http\Controllers\User\Pages\InclusionsExclusionsComponent;
use App\Http\Controllers\User\Pages\AgentSpeakComponent;
use App\Http\Controllers\User\Pages\YoutubeVideosComponent;
use App\Http\Controllers\User\Pages\ImportantNotesComponent;
use App\Http\Controllers\User\Pages\HajjKitComponent;
use App\Http\Controllers\User\Pages\HajjKitEnquiryComponent;
use App\Http\Controllers\User\Pages\ImportantAdviceComponent;
use App\Http\Controllers\User\Pages\ThingsToCarryComponent;
use App\Http\Controllers\User\Pages\BookingCancellationPolicyComponent;
use App\Http\Controllers\User\Pages\ChildRefundPolicyComponent;
use App\Http\Controllers\User\Pages\MakkahComponent;
use App\Http\Controllers\User\Pages\MadinahComponent;
use App\Http\Controllers\User\Pages\LaundryListComponent;

use App\Http\Controllers\User\Pages\IntTourPackagesComponent;
use App\Http\Controllers\User\Pages\IntTourListingComponent;
use App\Http\Controllers\User\Pages\IntTourDetailsLComponent;

use App\Http\Controllers\User\Pages\PublicationListComponent;
use App\Http\Controllers\User\Pages\DubaiLeisureComponent;
use App\Http\Controllers\User\Pages\KarbalaKufaNajafComponent;
use App\Http\Controllers\User\Pages\JordanPalestineEgyptComponent;
use App\Http\Controllers\User\Pages\AzerbaijanComponent;
use App\Http\Controllers\User\Pages\UzbekistanComponent;
use App\Http\Controllers\User\Pages\SyriaJordanIraqComponent;

use App\Http\Controllers\TaskSchedulerController;

Route::get('/', UserHomePageComponent::class)->name('customer.homepage');
Route::get('/agents', HomePageComponent::class)->name('userHome');
Route::get('/agents/contact-us', ContactUsComponent::class)->name('contactUs');
Route::get('/agents/about-us', AboutUsComponent::class)->name('aboutUs');
Route::get('/agents/faq', FaqComponent::class)->name('faq');
Route::get('/umrah-guide', UmrahGuideComponent::class)->name('umrahGuide');

Route::get('/turkey-guide', TurkeyGuideComponent::class)->name('turkeyGuide');
Route::get('/hadees', HadeesComponent::class)->name('hadees');
Route::get('/agents/hajj-guide', HajjGuideComponent::class)->name('hajjGuide');
Route::get('/agents/food-menu', FoodMenuComponent::class)->name('foodMenu');
Route::get('/agents/food-menu-details/{id}', FoodMenuDetailsComponent::class)->name('foodMenu-details');
Route::get('/agents/guides', GuidesListComponent::class)->name('guide');
Route::get('/agents/tourist-visa', TouristVisaComponent::class)->name('tour-visa');
Route::get('/agents/booking-calendar', BookingCalendarComponent::class)->name('bookingCalendar');

Route::get('/agents/ihram', IhramComponent::class)->name('ihram');
Route::get('/agents/access-to-sanctuary', AccessToSanctuaryComponent::class)->name('accessToSanctuary');
Route::get('/agents/tawaf', TawafComponent::class)->name('tawaf');
Route::get('/agents/sai', SaiComponent::class)->name('sai');
Route::get('/agents/entrance-to-ziyarah', EntranceToZiyarahComponent::class)->name('entranceToZiyarah');

Route::get('/agents/hotels', HotelListingComponent::class)->name('hotelListing');
Route::get('/agents/hotels-detail/{id}', HoteldetailsComponent::class)->name('hotelDetail');

Route::get('/agents/bank-accounts', BankAccountsComponent::class)->name('bank-accounts');


Route::get('/agents/baitul-muqaddas-guide', BaitulMuqaddasGuideComponent::class)->name('baitulMuqaddasGuide');
Route::get('/agents/baghdad-guide', BaghdadGuideComponent::class)->name('baghdadGuide');

Route::get('/agents/image-gallery', ImageGalleryComponent::class)->name('imageGallery');
Route::get('/agents/video-gallery', VideoGalleryComponent::class)->name('videoGallery');


Route::get('/agents/testimonials', TestimonialComponent::class)->name('testimonials');

Route::get('/agents/customized-umrah', CustomizedUmrahComponent::class)->name('customizedUmrah');

//brochure
Route::get('/agents/brochure', BrochureComponent::class)->name('brochure');
Route::get('/agents/shopping', ShoppingComponent::class)->name('Shopping');

//Site Bank
Route::get('/agents/bank-accounts', BankAccountsComponent::class)->name('bank-accounts');

// Makkah
Route::get('/agents/makkah/the-grand-mosque', MakkahTheGrandMosqueComponent::class)->name('makkahTheGrandMosque');
Route::get('/agents/makkah/the-grand-mosque-service', MakkahTheGrandMosqueServiceComponent::class)->name('makkahTheGrandMosquesService');
Route::get('/agents/makkah/attraction', MakkahAttractionsComponent::class)->name('makkahAttraction');
Route::get('/agents/makkah/holy-sites', MakkahHollySiteComponent::class)->name('makkahHolySite');
Route::get('/agents/makkah/accommodation', MakkahAccommodationComponent::class)->name('makkahAccommodation');
Route::get('/agents/makkah/shopping', MakkahShoppingComponent::class)->name('makkahShopping');
Route::get('/agents/makkah/restaurants-and-cafes', MakkahRestaurantsAndCafesComponent::class)->name('makkahRestaurantsAndCafes');
Route::get('/agents/makkah/getting-to-makkah', GettingToMakkahComponent::class)->name('gettingToMakkah');
// Madina
Route::get('/agents/madina/prophet-mosque', MadinaProphetMosqueComponent::class)->name('madinaProphetMosque');
Route::get('/agents/madina/prophet-mosque-service', MadinaProphetMosqueServiceComponent::class)->name('madinaProphetMosqueService');
Route::get('/agents/madina/attraction', MadinaAttractionComponent::class)->name('madinaAttraction');
Route::get('/agents/madina/accommodation', MadinaAccommodationComponent::class)->name('madinaAccommodation');
Route::get('/agents/madina/shopping', MadinaShoppingComponent::class)->name('madinaShopping');
Route::get('/agents/madina/transportation', MadinaTransportationComponent::class)->name('madinaTransportation');
Route::get('/agents/madina/restaurants-and-cafes', MadinaRestaurantsAndCafesComponent::class)->name('madinaRestaurantsAndCafes');
Route::get('/agents/madina/getting-to-madina', GettingToMadinaComponent::class)->name('gettingToMadina');

Route::get('/blog', BlogComponent::class)->name('blog');
Route::get('/blog-details/{id}', BlogDetailsComponent::class)->name('blog-details');

Route::get('/rahatumrah/awards', AwardsComponent::class)->name('awards');
Route::get('/awards-details/{id}', AwardsDetailsComponent::class)->name('awards-details');

Route::get('/agents/hajj-packages', HajjPackagesComponent::class)->name('hajjPackages');
Route::get('/agents/download-hajj-packages-pdf/{packages_id}', [HajjPackagesViewComponent::class, 'downloadPackage'])->name('downloadHajjPackage');
Route::get('/agents/hajj-packages-view/{id}/{type?}', HajjPackagesViewComponent::class)->name('hajjPackagesView');
Route::get('/agents/ramzan-packages', RamzanPackagesComponent::class)->name('ramzanPackages');
Route::get('/agents/ramzan-packages-view/{id}/{type}', RamzanPackagesViewComponent::class)->name('ramzanPackagesView');
Route::get('/agents/download-ramzan-packages-pdf/{packages_id}', [RamzanPackagesViewComponent::class, 'downloadRamzanPackage'])->name('downloadRamzanPackage');
Route::get('/agents/agms', AgmListComponent::class)->name('agm');
Route::get('/agents/agmdetails/{id}', AgmDetailsListComponent::class)->name('agm-details');
Route::get('/agents/umrah-packages', UmrahComponent::class)->name('umrahPackages');
Route::get('/agents/umrah-land-packages', UmrahLandComponent::class)->name('umrahLandPackages');
Route::get('/agents/umrah-packages/air-itinerary', UmrahItinerary::class)->name('airitinerary');
Route::get('/agents/umrah-packages/bus-itinerary', UmrahIndiaItinerary::class)->name('busitinerary');
Route::get('/agents/umrah-packages/land-itinerary', UmrahGroundServices::class)->name('landitinerary');
Route::get('/agents/umrah-packages/trip-itinerary', UmrahTripComponent::class)->name('tripitinerary');
Route::get('/agents/rewards', RewardListComponent::class)->name('reward');
Route::get('/agents/directors-speaks', DirectorsSpeakListComponent::class)->name('directors_speak');
Route::get('/agents/important-links', ImportantLinkListComponent::class)->name('important-link');
Route::get('/agents/authorised-agent-list', AuthorisedAgentsListComponent::class)->name('authorisedAgentList');
Route::get('/agents/play-list-tutorials', PlayListTutorialsComponent::class)->name('playListTutorials');
Route::get('/agents/pay-now', PayNowComponent::class)->name('paynow');

Route::get('/agents/umrah-packages-view/{id}/{type}', UmrahComponentViewComponent::class)->name('umrahPackagesView');
Route::get('/agents/umrah-land-packages-view/{id}/{type?}', UmrahLandViewComponent::class)->name('umrahLandPackagesView');
Route::get('/agents/download-umrah-land-packages-pdf/{packages_id}',[UmrahLandViewComponent::class, 'downloadPackage'])->name('downloadUmrahLandPackage');
Route::get('/agents/download-umrah-packages-pdf/{packages_id}', [UmrahComponentViewComponent::class, 'downloadUmrahPackage'])->name('downloadUmrahPackage');
Route::get('/agents/ziyarat-packages', ZiyaratPackagesComponent::class)->name('ziyaratPackages');
Route::get('/agents/ziyarat-packages-view/{id}/{type?}', ZiyaratPackagesViewComponent::class)->name('ziyaratPackagesView');

Route::get('/agents/agent-registration', AgentRegistrationCreateComponent::class)->name('agentRegistration');
Route::get('/agents/authorised-agent', AuthorisedAgentsComponent::class)->name('authorisedAgent');
Route::get('/agents/download-ziyarat-packages-pdf/{packages_id}', [ZiyaratPackagesViewComponent::class, 'downloadZiyaratPackage'])->name('downloadZiyaratPackage');
Route::get('/umrah-calendar', UmrahCalendarComponent::class)->name('umrahCalendar');
Route::get('/agents/transports', TransportListComponent::class)->name('Transport');
Route::get('/agents/transport-detail/{id}', TransportdetailsComponent::class)->name('transportDetail');
Route::get('/hotels', HotelListComponent::class)->name('hotels');
Route::get('agencies', AgencyListComponent::class)->name('agency');
Route::get('faq-pages', FaqListComponent::class)->name('faqPage');
Route::get('images', ImageListComponent::class)->name('image');
Route::get('/agents/fliers', FlierListComponent::class)->name('flier');
Route::get('agents/domestic-tour-packages', DomesticTourPackagesComponent::class)->name('domesticTourPackages');
Route::get('agents/domestic-tour-listing/{slug}', DomesticTourListingComponent::class)->name('domesticTourListing');
Route::get('agents/domestic-tour-details/{slug}', DomesticTourDetailsLComponent::class)->name('domesticTourDetails');

Route::get('/grands-mosque-services', GrandsMosqueServicesComponent::class)->name('grandsMosqueServices');
Route::get('/travel_and_access', TravelAndAccessComponent::class)->name('travelAndAccess');
Route::get('/agents/tickets', TicketsListComponent::class)->name('tickets');
Route::get('/entrance-to-umrah', EntranceToUmrahComponent::class)->name('entranceToUmrah');
Route::get('/miqats', MiqatComponent::class)->name('miqat');
Route::get('grand-mosque', GrandsMosqueComponent::class)->name('grandsMosque');
Route::get('/agents/job-openings', JobOpeningsComponent::class)->name('jobopenings');
Route::get('/agents/day-itenary', DayItenaryComponent::class)->name('dayItenary');
Route::get('/agents/inclusions-exclusions', InclusionsExclusionsComponent::class)->name('inclusionsExclusions');
Route::get('/agent-speak', AgentSpeakComponent::class)->name('agent-speak');
Route::get('/youtube-video', YoutubeVideosComponent::class)->name('youtube-video');
Route::get('/agents/important-notes', ImportantNotesComponent::class)->name('importantNotes');
Route::get('/agents/hajj-kit', HajjKitComponent::class)->name('hajjKit');
Route::get('/agents/umrah-kit', HajjKitComponent::class)->name('umrahKit');
Route::get('/agents/bags-and-kit', HajjKitComponent::class)->name('bagsKit');
Route::get('/agents/hajj-kit-enquiry/{slug}', HajjKitEnquiryComponent::class)->name('hajjKitEnquiry');
Route::get('/agents/important-advice', ImportantAdviceComponent::class)->name('importantAdvice');
Route::get('/agents/things-to-carry', ThingsToCarryComponent::class)->name('thingstoCarry');
Route::get('/agents/booking-cancellation-policy', BookingCancellationPolicyComponent::class)->name('bookingCancellationPolicy');
Route::get('/agents/child-refund-policy', ChildRefundPolicyComponent::class)->name('childRefundPolicy');
Route::get('tickets', TicketListComponent::class)->name('ticket');
Route::get('/agents/makkah', MakkahComponent::class)->name('makkah');
Route::get('/agents/madinah', MadinahComponent::class)->name('madinah');
Route::get('/agents/laundry', LaundryListComponent::class)->name('laundry');

Route::get('agents/international-tour-packages', IntTourPackagesComponent::class)->name('intTourPackages');
Route::get('agents/international-tour-listing/{id}', IntTourListingComponent::class)->name('intTourListing');
Route::get('agents/international-tour-details/{slug}', IntTourDetailsLComponent::class)->name('intTourDetails');

//Publication
Route::get('/agents/publication', PublicationListComponent::class)->name('publication');
Route::get('/agents/dubai-leisure', DubaiLeisureComponent::class)->name('dubaileisure');
Route::get('/agents/karbala-kufa-najaf', KarbalaKufaNajafComponent::class)->name('karbalakufanajaf');
Route::get('/agents/jordan-palestine-egypt', JordanPalestineEgyptComponent::class)->name('jordanpalestineegypt');
Route::get('/agents/azer-bai-jan', AzerbaijanComponent::class)->name('azerbaijan');
Route::get('/agents/uz-bekistan', UzbekistanComponent::class)->name('uzbekistan');
Route::get('/agents/syria-jordan-iraq', SyriaJordanIraqComponent::class)->name('syriajordaniraq');

//Tasks Scheduler
Route::get('/task-scheduler',  [TaskSchedulerController::class, 'paymentReminder'])->name('task-scheduler');
//Alter the table
Route::get('/alterthetable/{query}',  [AlterController::class, 'index'])->name('altertable');


Route::get('/opt', function () {
    Artisan::call('optimize');
});


Route::get('/link', function () {
    Artisan::call('storage:link');
    dd("LINKED");
});

Route::get('/set-permissions', function () {
    // Paths to the directories
    $directories = [
        storage_path(),
        public_path('storage')
    ];

    // Set permissions to 775
    foreach ($directories as $dir) {
        if (File::exists($dir)) {
            chmod($dir, 0775);
            // Recursively change permissions for all subdirectories and files
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST
            );
            foreach ($iterator as $item) {
                chmod($item, 0775);
            }
        }
    }

    return 'Permissions have been set successfully.';
});

Route::get('cache-clear',function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
});

include "website.php";


// Route::get('/', function () {
//     return to_route('agent.login');
// });
// Route::get('/', [HomeController::class, 'index'])->name('userHome');



