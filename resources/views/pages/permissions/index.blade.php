@extends('layouts.app')

@section('title', 'List Permission')

@section('content')
	<div>
		<a href="{{ route('permissions.create') }}">ADD</a>
	</div>
	<div class="table-responsive">
		<table class="table table-striped">
		  <caption>List of permissions</caption>
		  <thead class="thead-dark|thead-light">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Name</th>
		      <th scope="col">Slug</th>
		      <th scope="col">URI</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($permissions as $permission)
		    	<tr>
		    		<td>{{ $permission->id }}</td>
		    		<td>{{ $permission->name }}</td>
		    		<td>{{ $permission->slug }}</td>
		    		<td>
		    			@foreach (json_decode($permission->uri) as $uri)
		    				<p>{{ $uri }}</p>
		    			@endforeach
		    		</td>
		    	</tr>
		    @endforeach
		  </tbody>
		</table>
	</div>
@stop