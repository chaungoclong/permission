@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('login.process') }}">
	@csrf

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
	<div class="form-check">
	  	<input class="form-check-input" type="checkbox" name="remember" 
	  		id="remember">
	  	<label class="form-check-label" for="remember">
	   	 	Remember
	  	</label>
	</div>

	<button>Login</button>
</form>
@stop
