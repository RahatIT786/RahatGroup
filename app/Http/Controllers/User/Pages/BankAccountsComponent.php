<?php
namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use App\Models\SiteBankInfo;
use Livewire\Attributes\Layout;
use Illuminate\Http\Request;

class BankAccountsComponent extends Component
{
    public function getBankAccounts()
    {
        // $account =  BankDetail::where('page_id', 10)->with('pagecontent')->first();
        // return $account;

        return SiteBankInfo::active()->desc()->get();
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.bank-accounts-component', [
            'bankaccounts' => $this->getBankAccounts()
        ]);
    }
}
