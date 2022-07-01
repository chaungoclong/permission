@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('register.process') }}">
	@csrf

	<div class="form-group">
		<label for="name">Name</label>
		<input type="name" class="form-control" id="name" 
			placeholder="Name" name="name">
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" 
			placeholder="Email" name="email">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" id="password" 
			placeholder="Password"name="password">
	</div>
	

	<button>Register</button>
</form>
@stop
