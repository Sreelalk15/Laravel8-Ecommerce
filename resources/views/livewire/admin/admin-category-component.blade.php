<div>
  @if(Session::has('success_message'))
    <div class="alert alert-success">
      <strong>Success&nbsp;&nbsp;</strong>{{ Session::get('success_message') }}
    </div>
  @endif
<h2><a href="{{ route('admin.addcategories') }}">Add category</a></h2>
<h1>Categories</h1>
    <table border="1">
      <thead>
        <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Action</th>
        </tr>
      </thead>
      <tbody>
       @foreach($categories as $category)
       <tr>
           <td>{{ $category->id }}</td>
           <td>{{ $category->name }}</td>
           <td>{{ $category->slug }}</td>
           <td>
             <a href="{{ route('admin.editcategories',['uuid' => $category->uuid]) }}">Edit</a><br><br>
             <a href="#" wire:click.prevent="destroy('{{ $category->uuid }}')">Delete</a>
           </td>
         </tr>
       @endforeach
      </tbody>
    </table>
</div>
