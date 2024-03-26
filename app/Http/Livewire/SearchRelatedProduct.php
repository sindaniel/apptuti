<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchRelatedProduct extends Component
{

    public $products = [];

    public $related = [];

    public $product;

    public $selectedProduct;

    public function render()
    {

        $this->loadProducts();
       
        return view('livewire.search-related-product');
    }

    public function add(){
            
        if($this->selectedProduct){
            $this->product->related()->attach($this->selectedProduct);
            $this->related = $this->product->related()->get();

        }
       

    }

    public function remove($id){

       // $q = $this->searchTerm;
       $this->product->related()->detach($id);

       $this->related = $this->product->related()->get();

     
    }

    public function loadProducts(){

        $ids = $this->product->related()->get()->pluck('id')->toArray();
        $id = $this->product->id;
        $this->products = Product::whereNot('id', $id)->whereNotIn('id', $ids)->whereActive(1)->select(['name', 'id'])->get();

      

    }
}
