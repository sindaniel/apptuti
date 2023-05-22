<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchCombinedProduct extends Component
{

    public $products = [];

    public $combinations = [];

    public $product;

    public $selectedProduct;

    public function render()
    {

        $this->loadProducts();
       
        return view('livewire.search-combined-product');
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

    public function loadProducts(){

        $ids = $this->product->combinations()->get()->pluck('id')->toArray();
        $id = $this->product->id;
        $this->products = Product::whereNot('id', $id)->whereNotIn('id', $ids)->whereActive(1)->select(['name', 'id'])->get();

      

    }
}
