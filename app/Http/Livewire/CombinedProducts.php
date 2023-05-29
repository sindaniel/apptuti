<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductCombination;
use Livewire\Component;

class CombinedProducts extends Component
{

    public $products = [];

    public $combinations = [];

    public $product;

    public $selectedProduct;

    public $combined;


    protected $rules = [
        
        'combinations.*.name'=> 'nullable',
        'combinations.*.pivot.price'=> 'nullable',
        'combinations.*.variation_item_id'=> 'nullable',
    ];

    
    
    public function render()
    {   


        $this->loadProducts();
        return view('livewire.combined-products');
    }



    public function add(){

        $this->product->combinations()->attach($this->selectedProduct);
    
        $this->combinations = $this->product->combinations()->get();
        

    }

    public function remove($id){

       // $q = $this->searchTerm;
       $this->product->combinations()->detach($id);

       $this->combinations = $this->product->combinations()->get();

     
    }

    public function u(){
      
//   dd($this->combinations->toArray());
     // $this->product->combinations->find($product_id)->pivot->update(['price' => 123]);
        return ;
    }

    public function loadProducts(){

        $ids = $this->product->combinations()->get()->pluck('id')->toArray();
        $id = $this->product->id;
    $this->products = Product::query()
            ->with('variation', 'items')
            ->whereNot('id', $id)
            ->whereNotIn('id', $ids)
            ->whereActive(1)
            ->select(['name', 'id'])
            ->orderBy('name', 'asc')
            ->get();

      

    }
}


