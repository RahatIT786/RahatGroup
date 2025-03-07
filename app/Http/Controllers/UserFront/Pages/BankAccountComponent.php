<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use App\Models\SiteBankInfo;
use Livewire\Attributes\Layout;
use Illuminate\Http\Request;

class BankAccountComponent extends Component
{

    public function getBankAccounts()
    {
        // $account =  BankDetail::where('page_id', 10)->with('pagecontent')->first();
        // return $account;

        return SiteBankInfo::active()->desc()->get();
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.bank-account-component', [
            'bankaccounts' => $this->getBankAccounts()
        ]);
    }
}
