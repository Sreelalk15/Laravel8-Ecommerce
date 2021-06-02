<?php

namespace App\Http\Livewire\Admin;
use App\Models\Category;

use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{

	public function destroy($uuid)
	{
		Category::where('uuid',$uuid)->delete();
		session()->flash('success_message','category has been deleted');
    	return redirect()->route('admin.categories');
	}

    use Withpagination;
    public function render()
    {
        $categories = Category::paginate(10);
        return view('livewire.admin.admin-category-component',['categories' => $categories])->layout('layouts.base');
    }
}
