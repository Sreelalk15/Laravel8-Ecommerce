<div style="margin-left:38%;">
<h1>Add Category</h1>
    <form wire:submit.prevent="store" enctype="multipart/form-data">
    	<input type="text" autocomplete="off" wire:model="name" wire:keyup="generateSlug"><br>
    	@error('name') <p class="text-danger">{{ $message }} @enderror
    	<br>
    	<input type="text" autocomplete="off" readonly="true" name="slug" wire:model="slug"><br>
    	@error('slug') <p class="text-danger">{{ $message }} @enderror
    	<br>
    	<input type="file" wire:model="image"><br>
    	@error('image') <p class="text-danger">{{ $message }} @enderror<br>
    	<button type="submit" >Submit</button>
    </form>
</div>
