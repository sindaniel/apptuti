<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectCombinedProduct extends Component
{

    public $type = 0;

    public $variations;

 

    public function render()
    {
        return view('livewire.select-combined-product');
    }


}
