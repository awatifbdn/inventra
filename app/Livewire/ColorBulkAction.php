<?php

namespace App\Livewire;

use Livewire\Component;

class ColorBulkAction extends Component
{
    public function render()
    {
        return view('livewire.color-bulk-action');
    }

    public $selected = [];
public $colorIds = [];
public $productId;

public function mount($productId, $colorIds)
{
    $this->productId = $productId;
    $this->colorIds = $colorIds;
}

public function toggleAll($value)
{
    $this->selected = $value ? $this->colorIds : [];
}

public function toggleItem($id)
{
    if (in_array($id, $this->selected)) {
        $this->selected = array_diff($this->selected, [$id]);
    } else {
        $this->selected[] = $id;
    }
}

}
