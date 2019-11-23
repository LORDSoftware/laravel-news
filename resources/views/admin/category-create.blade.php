@extends('layouts.app')

@section('content')
	<div class="card mt-4">
		<div class="card-header">{{ __('admin.category_create_header') }}</div>

		<div class="card-body">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
						<div>{{ $error }}</div>
					@endforeach
				</div>
			@endif
			<form method="post" action="{{ route('admin.categories.store') }}">
				@csrf
				<div class="form-group">
					<label for="title">{{ __('admin.category_create_title') }}</label>
					<input type="text" class="form-control" name="title" value="{{ old('title') }}"/>
				</div>
				<div class="form-group">
					<label for="title">{{ __('admin.category_create_slug') }}</label>
					<input type="text" class="form-control" name="slug" value="{{ old('slug') }}"/>
				</div>
				<div class="form-group">
					<label for="content">{{ __('admin.category_create_parent') }}</label>
					<select class="form-control" name="parent_id">
						<option value=""></option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}" 
								@if($category->id == old('parent_id'))
									selected
								@endif
								>
								{{ str_repeat('--', $category->depth) }} {{ $category->title }}
							</option>
						@endforeach
					</select>
				</div>
				<button type="submit" class="btn btn-primary">{{ __('admin.common_add') }}</button>
			</form>
		</div>
	</div>
@endsection