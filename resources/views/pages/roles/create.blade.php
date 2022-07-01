@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('roles.store') }}">
	@csrf
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" placeholder="Name" 
				name="name">
		</div>
		<div class="form-group col-md-6">
			<label for="slug">Slug</label>
			<input type="text" class="form-control" id="slug" placeholder="Slug"
				name="slug">
		</div>
	</div>
	<div class="form-group">
		<label for="permissions">Permissions</label>
		<select name="permissions[]" id="permissions" class="form-control" 
			multiple>
			@foreach ($permissions as $permission)
				<option value="{{ $permission->id }}">
					{{ $permission->name }}
				</option>
			@endforeach
		</select>
	</div>
	<div class="form-check">
	  	<input class="form-check-input" type="checkbox" name="is_default" 
	  		id="isDefault">
	  	<label class="form-check-label" for="isDefault">
	   	 	Is default Role?
	  	</label>
	</div>
	
	<button>Add</button>
</form>
@stop

@push('js')
	<script>
		;(function($, window, document) {
			$(function() {
				$('#permissions').select2();
			});
		})($, window, document);
	</script>
@endpush