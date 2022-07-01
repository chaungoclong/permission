@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('users.update', $user) }}">
	@csrf
	@method('PUT')
	<div class="form-group">
		<label for="name">Name</label>
		<input type="name" class="form-control" id="name" 
			placeholder="Name" name="name" value="{{ $user->name }}">
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" 
			placeholder="Email" name="email" value="{{ $user->email }}">
	</div>
	<div class="form-group">
		<label for="roleSelect">Role</label>
		<select name="role_id" id="roleSelect" class="form-control">
			@foreach ($roles as $role)
				<option value="{{ $role->id }}">{{ $role->name }}</option>
			@endforeach
		</select>
	</div>
	

	<button>Save</button>
</form>
@stop

@section('dataTransfer')
	<input type="hidden" id="userRoleId" value="{{ $user->role->id ?? '' }}">
@stop

@push('js')
	<script>
		(function($, document) {
            $(function() {
                let $roleSelect = $('#roleSelect');
                
                $roleSelect.select2()
                	.val($('#userRoleId').val())
                	.trigger('change');
            });
		})($, document);
	</script>
@endpush
