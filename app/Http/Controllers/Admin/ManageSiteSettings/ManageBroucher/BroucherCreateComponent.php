<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageBroucher;
use App\Models\Boucher;

use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BroucherCreateComponent extends Component
{
    use LivewireAlert;
public $brochure_content;
    public function save()
    {
        $validated = $this->validate([
            'brochure_content' => 'required',
            
        ]);
        $validated['is_active'] = $this->status ?? 1;
        

        Boucher::create($validated);
        $this->alert('success', Lang::get('messages.broucher_save'));
        return to_route('admin.brochure.index');
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-broucher.broucher-create-component');
    }
}
