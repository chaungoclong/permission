@extends('layouts.app')

@section('title', 'List Users')

@section('content')
	<div>
		<a href="{{ route('users.create') }}">ADD</a>
	</div>

	<div class="table-responsive">
		<table class="table table-striped">
		  <caption>List of Users</caption>
		  <thead class="thead-dark|thead-light">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Role</th>
		      <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		    @foreach ($users as $user)
		    	<tr>
		    		<td>{{ $user->id }}</td>
		    		<td>{{ $user->name }}</td>
		    		<td>{{ $user->email }}</td>
		    		<td>{{ $user->role->name ?? '' }}</td>
		    		<td>
		    			<a href="{{ route('users.edit', $user) }}"
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