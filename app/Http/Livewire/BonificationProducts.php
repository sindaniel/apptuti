<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BonificationProducts extends Component
{

    public $products = [];

    public $bonification;

    public $bonifications = [];

    public $selectedProduct;

    public function render()
    {

        // $ids = $this->product->related()->get()->pluck('id')->toArray();
        // $id = $this->product->id;
        // $this->products = Product::whereNot('id', $id)->whereNotIn('id', $ids)->whereActive(1)->select(['name', 'id'])->get();
        $this->bonifications = $this->bonification->products()->get();

        return view('livewire.bonification-products');
    }

    public function add(){
            
        $this->bonification->products()->attach($this->selectedProduct);
    
        $this->bonifications = $this->bonification->products()->get();

    }

    public function remove($id){

        $this->bonification->products()->detach($id);
        
        $this->bonifications = $this->bonification->products()->get();
 
      
     }

  
}
