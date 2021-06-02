<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{
    public $uuid;

    public function store($product_uuid,$product_name,$product_price)
    {
        Cart::add($product_uuid,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }
    public function render()
    {
        $product = Product::where('uuid',$this->uuid)->first();
        return view('livewire.details-component',['product'=>$product])->layout('layouts.base');
    }
}
