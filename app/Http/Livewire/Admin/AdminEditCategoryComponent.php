<?php

namespace App\Http\Livewire\Admin;
use App\Models\Category;
use Illuminate\Support\Str;

use Livewire\Component;

class AdminEditCategoryComponent extends Component
{
	public $uuid;
	public $name;
	public $slug;

	public function mount($uuid)
	{
		$this->uuid = $uuid;
		$category_details = Category::where('uuid',$this->uuid)->first();
		if($category_details){
			$this->name = $category_details->name;
			$this->slug = $category_details->slug;
		} else{
			session()->flash('success_message','Category not found');
			return redirect()->route('admin.categories');
		}
	}

	public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);
    }

    public function update()
    { 
    	$this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);
        
    	$category = Category::where('uuid',$this->uuid)->first();
    	$category->name = $this->name;
    	$category->slug = $this->slug;
    	$category->save();

    	session()->flash('success_message','category has been updated');
    	return redirect()->route('admin.categories');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-category-component')->layout('layouts.base');
    }
}
