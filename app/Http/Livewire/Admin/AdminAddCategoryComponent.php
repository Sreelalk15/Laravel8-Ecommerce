<?php

namespace App\Http\Livewire\Admin;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;
use App\Models\Category;
use Carbon\Carbon;

use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddCategoryComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $image;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function generateCategoryUUID()
    {
        do{
            $uuid = Uuid::generate()->string;
        } 
        while(Category::where('uuid',$uuid)->first());

        return  $uuid;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required',
            'image' => 'required',
            'slug' => 'required|unique:categories'
        ]);
    }

    public function store()
    { 
        $this->validate([
            'name' => 'required',
            'image' => 'required',
            'slug' => 'required|unique:categories'
        ]);

    	$category = new Category();
    	$category->uuid = $this->generateCategoryUUID();
    	$category->name = $this->name;
    	$category->slug = $this->slug;
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('category',$imageName); 
    	$category->save();

    	session()->flash('success_message','category has been added');
    	return redirect()->route('admin.categories');
    }
    
    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base');
    }
}
