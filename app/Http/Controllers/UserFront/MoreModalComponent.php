<?php

namespace App\Http\Controllers\UserFront;

use App\Helpers\Helper;
use App\Models\KitItem;
use App\Models\KitCategory;
use Livewire\Component;
use Livewire\Attributes\Layout;

class MoreModalComponent extends Component
{
    public $kit;
    public $kitItems;
    public function mount($id)
    {
        // Fetch the kit category by ID
        $this->kit = KitCategory::active()->findOrFail($id);
        // dd($this->kit->kit_item_id);
        // dd($itemIds);
        $this->kitItems = KitItem::whereIn('id', $this->kit->kit_item_id)->get();
        // dd($this->kitItems);
    }
    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.more-modal-component', ['items' => $this->kitItems]);
    }
}
