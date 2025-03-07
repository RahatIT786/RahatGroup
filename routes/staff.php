<?php

use App\Http\Controllers\Staff\Auth\AuthController;
use App\Http\Controllers\Staff\DashboardComponent;
use App\Http\Controllers\Staff\Earnings\EarningListComponent;
use App\Http\Controllers\Staff\Enquiries\EnquiriesListComponent;
use App\Http\Controllers\Staff\Leads\LeadCreateComponent;
use App\Http\Controllers\Staff\Leads\LeadListComponent;
use App\Http\Controllers\Staff\Profile\ProfileComponent;
use App\Http\Controllers\Staff\ManageAgent\AgentListComponent;
use App\Http\Controllers\Staff\ManageAgent\AgentEditComponent;
use App\Http\Controllers\Staff\ChangePassword\ChangePasswordComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\Enquiries\CustomizedUmrahListComponent;
use App\Http\Controllers\Staff\Enquiries\ManageEnquiryListComponent;
use App\Http\Controllers\Staff\Enquiries\TouristVisaListComponent;
use App\Http\Controllers\Staff\Enquiries\HotelEnquiryListComponent;
use App\Http\Controllers\Staff\StaffSheet\StaffSheetListComponent;
use App\Http\Controllers\Staff\Enquiries\CallUsBackListComponent;
use App\Http\Controllers\Staff\Enquiries\ForexEnquiryListComponent;
use App\Http\Controllers\Staff\Enquiries\TourCallUsBackListComponent;
use App\Http\Controllers\Staff\Enquiries\ServiceEnquiryListComponent;
use App\Http\Controllers\Staff\Customer\CustomerListComponent;
use App\Http\Controllers\Staff\Enquiries\HajjKitEnquiryListComponent;
use App\Http\Controllers\Staff\Enquiries\ShoppingListComponent;
use App\Http\Controllers\Staff\Enquiries\PublicationEnquiryListComponent;
use App\Http\Controllers\Staff\Enquiries\TransportEnquiryListComponent;
use App\Http\Controllers\Staff\Enquiries\LaundryListComponent;
use App\Http\Controllers\Staff\Enquiries\FoodEnquiryListComponent;
use App\Http\Controllers\Staff\Enquiries\ComplaintBoxListComponent;
use App\Http\Controllers\Staff\Enquiries\EnquiriesComponent;

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
Route::group(['as' => 'staff.'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [AuthController::class, 'submitForgetPasswordForm'])->name('ForgotPasswordPost');
    Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('showResetPasswordForm');
    Route::post('/reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('submitResetPasswordForm');
    // Route::get('/register', [AuthController::class, 'registerFrom'])->name('registerFrom');
    // Route::post('/register', [AuthController::class, 'register'])->name('register');
    // Route::get('/send-otp', [AuthController::class, 'sendOTP'])->name('sendotp');
    // Auth::routes();
});
Route::group(['middleware' => ['auth:staff'], 'as' => 'staff.'], function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', DashboardComponent::class)->name('home');
    Route::get('/dashboard', DashboardComponent::class)->name('dashboard');

    //Leads
    Route::get('/leads', LeadListComponent::class)->name('leads');
    Route::get('/leads-create', LeadCreateComponent::class)->name('leads-create');

    Route::get('/profile/{staff}', ProfileComponent::class)->name('profile.edit');
    Route::get('/change-password/{user}', ChangePasswordComponent::class)->name('change-password.edit');

    //Enquiries
    Route::get('/enquiry', EnquiriesComponent::class)->name('enquiry');

    Route::get('/enquiries', EnquiriesListComponent::class)->name('enquiries');
	Route::get('/manageEnquiry', ManageEnquiryListComponent::class)->name('manageEnquiry');
	Route::get('/touristVisa', TouristVisaListComponent::class)->name('touristVisa');
    Route::get('/hotelEnquiry', HotelEnquiryListComponent::class)->name('hotelEnquiry');
    Route::get('/publication-enquiry', PublicationEnquiryListComponent::class)->name('publicationEnquiry');
    Route::get('/transport-enquiry', TransportEnquiryListComponent::class)->name('transportEnquiry');
    //Eanings
    Route::get('/earnings', EarningListComponent::class)->name('earnings');
    //Manage Agents
    Route::get('/manage-agent', AgentListComponent::class)->name('manageAgent');
    Route::get('/manage-agent/edit/{agent}', AgentEditComponent::class)->name('manageAgent.edit');
	//customized Umrah
    Route::get('/umrah', CustomizedUmrahListComponent::class)->name('umrah');
	Route::get('/tour-callus-back', TourCallUsBackListComponent::class)->name('tourcallusback');
	Route::get('/service-enquiry', ServiceEnquiryListComponent::class)->name('serviceEnquiry');
    Route::get('/staff-sheet', StaffSheetListComponent::class)->name('staffsheet');

	Route::get('/callus-back', CallUsBackListComponent::class)->name('callusback');
	Route::get('/forex-enquiry', ForexEnquiryListComponent::class)->name('forexenquiry');
    Route::get('/laundry', LaundryListComponent::class)->name('laundry');

    //Manage User
    Route::get('/customer', CustomerListComponent::class)->name('customer');
    Route::get('/hajj-kit-enquiry', HajjKitEnquiryListComponent::class)->name('hajjKitEnquiry');

    //Shopping
    Route::get('/shopping', ShoppingListComponent::class)->name('shopping');

    //food
    Route::get('/food-enquiry', FoodEnquiryListComponent::class)->name('foodenquiry');

    //complaintbox
    Route::get('/complaint-box', ComplaintBoxListComponent::class)->name('complaintBox');

});
