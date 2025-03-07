<?php

namespace App\Http\Controllers\UserFront\Pages;

use App\Models\AdminSetting;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;

class BookMyAssistant extends Component
{
    public $parameter_value;
    use LivewireAlert;

    public function mount()
    {
        $this->getAdminSettings();
    }

    public function getAdminSettings()
    {
        $settings = AdminSetting::active()
            ->desc()
            ->first();

        if ($settings) {
            $this->parameter_value = $settings->parameter_value;
        } else {
            $this->parameter_value = 'No active settings found.';
        }
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        $content = Content::where('page_id', 24)
            ->with('pagecontent')
            ->first();

        return view('user-front.pages.book-my-assistant', [
            'content' => $content,
            'parameter_value' => $this->parameter_value
        ]);
    }
}
