@extends('layouts.app')

@section('title', 'List Roles')

@section('content')
	<div>
		<a href="{{ route('roles.create') }}">ADD</a>
	</div>

	<div class="table-responsive">
		<table class="table table-striped">
		  <caption>List of Roles</caption>
		  <thead class="thead-dark|thead-light">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Name</th>
		      <th scope="col">Slug</th>
		      <th scope="col">Permissions</th>
		      <th scope="col">Default</th>
		      <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($roles as $role)
		    	<tr>
		    		<td>{{ $role->id }}</td>
		    		<td>{{ $role->name }}</td>
		    		<td>{{ $role->slug }}</td>
		    		<td>
		    			@foreach ($role->permissions as $permission)
		    				<p>{{ $permission->name }}</p>
		    			@endforeach
		    		</td>
		    		<th>{{ $role->is_default }}</th>
		    		<td>
		    			<a href="{{ route('roles.edit', $role) }}"
		    				class="btn btn-primary">
		    				EDIT
		    			</a>
		    		</td>
		    	</tr>
		    @endforeach
		  </tbody>
		</table>
	</div>
@stop