<?php

namespace App\Http\Controllers\User;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\AdminSetting;

class FooterComponent extends Component
{

    public $footerSettings;
    public function abc()
    {
        dd("GOT IT");
    }
    public function getFooterSettings()
 {
    return AdminSetting::whereIn('parameter_name', ['WhatsApp', 'Youtube','Facebook', 'Twitter', 'Instagram', 'Linkedin'])
                       ->pluck('parameter_value', 'parameter_name');
  }

    public function mount()
  {
    $this->footerSettings = $this->getFooterSettings();
   }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.footer-component');
    }
}
