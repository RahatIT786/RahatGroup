<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Agency;
use App\Models\Staff;
use App\Models\Services;
use App\Models\KitCategory;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['agent.layouts.nav'], function ($view) {
            $agent = auth()->user();
            
            $manager = Staff::whereId($agent->rm_staff_id)->first();
            $view->with([
                'agent_profile_img' => $agent->profile_img,
				'agent_company_logo' => $agent->company_logo,
				'manager_name' 	=> $manager->first_name.' '.$manager->last_name,
                'manager_email' 	=> $manager->email,
                'manager_phone' 	=> $manager->office_no,
                'agency_name' => $agent->agency_name
			]);
        });
		
		View::composer(['user-front.layouts.nav'], function ($view) {
            $customer = auth()->user();
            $manager = Staff::whereId($customer->rm_staff_id)->first();
            $view->with([
                // 'customer_profile_img' => $customer->profile_img,
                // 'customer_company_logo' => $customer->company_logo,
                // 'manager_name'     => $manager->first_name . ' ' . $manager->last_name,
                // 'manager_email'     => $manager->email,
                // 'manager_phone'     => $manager->office_no,
                // 'name' => $customer->name
            ]);
        });
 
		View::composer('user-front.includes.header', function ($view) {
            $services = Services::all();
            $view->with('services', $services);
        });

        View::composer('user-front.includes.header', function ($view) {
            $kits = KitCategory::where('category_id', 1)->get();
            $view->with('kits', $kits);
        });
    }
}