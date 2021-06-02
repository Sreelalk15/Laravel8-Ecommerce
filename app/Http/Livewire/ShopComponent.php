<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class ShopComponent extends Component
{
    public function store($product_uuid,$product_name,$product_price)
    {
        Cart::add($product_uuid,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }
    use Withpagination;
    public function render()
    {
        $products = Product::paginate(10);
        return view('livewire.shop-component',['products'=>$products])->layout('layouts.base');
    }
}
