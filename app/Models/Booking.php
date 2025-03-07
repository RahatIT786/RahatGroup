<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use App\Traits\SortScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Booking extends Model
{

    use HasFactory, SoftDeletes, CommonScopes, SearchScopes, SortScopes;



    protected $table = 'aihut_booking';



    protected $fillable = [
        'request_id',

        'booking_id',

        'company_id',

        'agency_id',

        'actual_agent_id',

        'user_type',

        'city_id',

        'travel_date',

        'days',

        'service_type',

        'umrah_type',

        'hajj_kit_id',
        
        'service_value',

        'service_details',

        'pnr_id',

        'package_name',

        'package_type',

        'spe_package_type',

        'shairing_type',

        'spe_shairing_type',

        'no_of_repeater',

        'no_of_mahram',

        'mehram_name',

        'adult',

        'child_bed',

        'child',

        'infant',

        'contact',

        'tot_user_cost',

        'agent_cost_breackup',

        'emr_contact',

        'address',

        'email_id',

        'passport_no',

        'tot_cost',

        'negotiated_cost',

        'negotiation_status',

        'gst',

        'user_cost',

        'agent_cost',

        'cost_breackup',

        'special_request',

        'full_payment_discount',

        'hotel_id',

        'checkin_date',

        'checkout_date',

        'nights',

        'rooms',

        'room_type_id',

        'country_id',

        'visa_type_id',

        'visa_date',

        'qr_code_img',

        'is_paid',

        'txn_date',

        'booking_status',

        'payable_amount',

        'reference_id',

        'payment_type',

        'payment_date',

        'booking_exp_date',

        'payment_amount',

        'payment_mode',

        'transction_date',

        'payment_status',

        'status_desc',

        'release_tkt',

        'release_visa',

        'suspend_time',

        'delete_time',

        'flight_details',

        'makka_hotel',

        'makka_hotel_days',

        'madina_hotel',

        'madina_hotel_days',

        'is_active',

    ];

    //Relationship
    public function agency(): BelongsTo
    {

        return $this->belongsTo(Agency::class, 'agency_id');

    }

    public function packagetype(): BelongsTo
    {
        return $this->belongsTo(PackageType::class, 'package_type');
    }


    public function payment(): HasMany
    {

        return $this->hasMany(Payment::class, 'booking_id', 'id');

    }
    public function servicetype(): BelongsTo
    {

        return $this->belongsTo(ServiceType::class, 'service_type');

    }

    public function pnr(): BelongsTo
    {

        return $this->belongsTo(Pnr::class, 'pnr_id');

    }

    public function city(): BelongsTo
    {

        return $this->belongsTo(City::class, 'city_id');

    }



    //Scope
    public function scopePaymentAmountSum($query)
    {
        return $query->whereHas('payment', function ($query) {
            $query->where('is_paid', 1)
                ->where('payment_status', 1);
        })->withSum('payment', 'amount');
    }
    public function scopeSearchAgent($q, $value)
    {

        return $q->when(!empty($value), function ($qr) use ($value) {

            $qr->whereHas('agency', function ($query) use ($value) {

                $query->where('agency_name', "LIKE", "%{$value}%");

            });

        });

    }

    public function scopePaid($query)
    {

        return $query->where('booking_id', '!=', null);

    }

    public function scopeActive($query)
    {

        return $query->where('is_active', 1);

    }



    public function scopeDesc($query)
    {

        return $query->OrderBy('id', 'DESC');

    }

    public function scopePending($query)
    {

        return $query->where('booking_status', '0');

    }

    public function scopeApproved($query)
    {

        return $query->where('booking_status', 1);

    }

    public function scopeRejected($query)
    {

        return $query->where('booking_status', '2');

    }

    public function scopeCancelled($query)
    {

        return $query->where('booking_status', '3');

    }

    public function scopeSuspended($query)
    {

        return $query->where('booking_status', '4');

    }

    public function scopeUnderReview($query)
    {

        return $query->where('booking_status', '5');

    }

    public function scopeDeleted($query)
    {

        return $query->where('booking_status', '6');

    }

    public function scopeWaitingList($query)
    {

        return $query->where('booking_status', '7');

    }

    public function scopeRequests($query)
    {
        return $query->where('booking_id', '=', null);
    }

    public function scopeNegotiated($query)
    {
        return $query->where('negotiated_cost', '!=', null);
    }




    public function scopeSearchTravelDate($q, $from, $to)
    {

        return $q->when(!empty($from) && !empty($to), function ($qr) use ($from, $to) {

            $qr->whereDate('travel_date', '>=', $from)->whereDate('travel_date', '<=', $to);

        });

    }

    public function scopeSearchRaisedDate($q, $from, $to)
    {

        return $q->when(!empty($from) && !empty($to), function ($qr) use ($from, $to) {

            $qr->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);

        });

    }

    public function scopeAgentFilter($q)
    {
        return $q->where('agency_id', auth()->guard('agent')->user()->id);
    }

    public function scopeUserFilter($q)
    {
        return $q->where('user_type', auth()->guard('customer')->user()->id);
    }


    //Relations

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }



    public function sharingtype(): BelongsTo
    {

        return $this->belongsTo(SharingType::class, 'shairing_type');

    }

    public function visatype(): BelongsTo
    {

        return $this->belongsTo(VisaCategory::class, 'visa_type_id');

    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function guestdetail(): HasMany
{
    return $this->hasMany(GuestDetail::class, 'booking_id', 'booking_id');
}


    public function package(): BelongsTo
    {
        return $this->belongsTo(Packages::class, 'package_name');
    }

}

