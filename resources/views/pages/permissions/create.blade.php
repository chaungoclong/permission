@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('permissions.store') }}">
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
		<label for="uri">URI</label>
		<select name="uri[]" id="uri" class="form-control" multiple>
			@foreach ($routes as $route)
				<option>
					{{ implode('|', $route->methods) . ':' . $route->uri }}
				</option>
			@endforeach
		</select>
	</div>
	<button>Add</button>
</form>
@stop

@push('js')
	<script>
		;(function($, window, document) {
			$(function() {
				$('#uri').select2();
			});
		})($, window, document);
	</script>
@endpush