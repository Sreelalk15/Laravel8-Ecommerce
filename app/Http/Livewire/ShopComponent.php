<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class ShopComponent extends Component
{
    public $sorting;
    public $pagelimit;

    public function mount()
    {
        $this->sorting = 'default';
        $this->pagelimit = 10;
    }
    public function store($product_uuid,$product_name,$product_price)
    {
        Cart::instance('cart')->add($product_uuid,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }
    use Withpagination;
    public function render()
    {
        if($this->sorting == 'date'){
            $products = Product::orderBy('created_at','DESC')->paginate($this->pagelimit);
        } else if($this->sorting == 'price'){
            $products = Product::orderBy('price','ASC')->paginate($this->pagelimit);
        } else if($this->sorting == 'price-desc'){
            $products = Product::orderBy('price','DESC')->paginate($this->pagelimit);
        } else{ 
            $products = Product::paginate($this->pagelimit);
        }
        
        return view('livewire.shop-component',['products'=>$products])->layout('layouts.base');
    }
}
