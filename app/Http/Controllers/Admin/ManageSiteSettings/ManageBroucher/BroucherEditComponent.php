<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageBroucher;

use App\Models\Boucher;

use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class BroucherEditComponent extends Component
{
    use LivewireAlert;
    public $brochure_content,$boucher;
    public function mount(Boucher $boucher)
    {
        $this->id = $boucher->id;
        $this->brochure_content = $boucher->brochure_content;
       
    }

    public function update()
    {
        $validated = $this->validate([
            'brochure_content' => 'required',
            
        ]);
        $validated['is_active'] = $this->status ?? 1;
        

       
        $this->alert('success', Lang::get('messages.broucher_edit'));
        return to_route('admin.brochure.index');
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-broucher.broucher-edit-component');
    }
}
