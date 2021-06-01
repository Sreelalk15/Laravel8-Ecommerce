<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use Withpagination;
    
    public function render()
    {
        $products = Product::paginate(10);
        return view('livewire.shop-component',['products'=>$products])->layout('layouts.base');
    }
}
