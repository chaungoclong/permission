@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('roles.update', $role) }}">
	@csrf
	@method('PUT')
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" placeholder="Name" 
				name="name" value="{{ $role->name }}">
		</div>
		<div class="form-group col-md-6">
			<label for="slug">Slug</label>
			<input type="text" class="form-control" id="slug" placeholder="Slug"
				name="slug" value="{{ $role->slug }}">
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
	  		id="isDefault" @if ($role->is_default) checked @endif>
	  	<label class="form-check-label" for="isDefault">
	   	 	Is default Role?
	  	</label>
	</div>
	<button>Add</button>
</form>
@stop

@section('dataTransfer')
	<input type="hidden" id="permissionsSelectedId" 
		value="{{ json_encode($role->permissions->pluck('id')->toArray()) }}">
@stop

@push('js')
	<script>
		;(function($, window, document) {
			$(function() {
				let $permissionsSelect = $('#permissions');
				$permissionsSelect.select2();
				$permissionsSelect.val(
					JSON.parse($('#permissionsSelectedId').val())
				);
				$permissionsSelect.trigger('change')
			});
		})($, window, document);
	</script>
@endpush