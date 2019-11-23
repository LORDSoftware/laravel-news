@extends('layouts.app')

@section('content')
	<div class="card mt-4">
		<div class="card-header">{{ __('admin.category_edit_header') }}</div>

		<div class="card-body">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
						<div>{{ $error }}</div>
					@endforeach
				</div>
			@endif
			<form method="post" action="{{ route('admin.categories.update', $category->id) }}">
				@method('PATCH')
				@csrf
				<div class="form-group">
					<label for="title">{{ __('admin.category_edit_title') }}</label>
					<input type="text" class="form-control" name="title" value="{{ $category->title }}"/>
				</div>
				<div class="form-group">
					<label for="title">{{ __('admin.category_edit_slug') }}</label>
					<input type="text" class="form-control" name="slug" value="{{ $category->slug }}"/>
				</div>
				<div class="form-group">
					<label for="content">{{ __('admin.category_edit_parent') }}</label>
					<select class="form-control" name="parent_id">
						<option value=""></option>
						@foreach($categories as $parent)
							<option value="{{ $parent->id }}" 
								@if($parent->id == $category->parent_id)
									selected
								@endif
								@if($parent->id == $category->id)
									disabled
								@endif
								>
								{{ str_repeat('--', $parent->depth) }} {{ $parent->title }}
							</option>
						@endforeach
					</select>
				</div>
				<button type="submit" class="btn btn-primary">{{ __('admin.common_update') }}</button>
			</form>
		</div>
	</div>
@endsection