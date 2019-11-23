@extends('layouts.app')

@section('content')
	<div class="card mt-4">
		<div class="card-header">{{ __('admin.article_create_header') }}</div>

		<div class="card-body">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
						<div>{{ $error }}</div>
					@endforeach
				</div>
			@endif
			<form method="post" action="{{ route('admin.articles.store') }}">
				@csrf
				<div class="form-group">
					<label for="title">{{ __('admin.article_create_title') }}</label>
					<input type="text" class="form-control" name="title" value="{{ old('title') }}"/>
				</div>
				<div class="form-group">
					<label for="description">{{ __('admin.article_create_description') }}</label>
					<textarea rows="5" class="form-control" name="description">{{ old('description') }}</textarea>
				</div>
				<div class="form-group">
					<label for="content">{{ __('admin.article_create_content') }}</label>
					<textarea rows="10" class="form-control" name="content">{{ old('content') }}</textarea>
				</div>
				<div class="form-group">
					<label for="slug">{{ __('admin.article_create_slug') }}</label>
					<input type="text" class="form-control" name="slug" value="{{ old('slug') }}"/>
				</div>
				<div class="form-group">
					<label for="content">{{ __('admin.article_create_category') }}</label>
					<select class="form-control" name="category_id">
						<option value=""></option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}" 
								@if($category->id == old('category_id'))
									selected
								@endif
								>
								{{ str_repeat('--', $category->depth) }} {{ $category->title }}
							</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<select name="active" class="form-control">
						<option value="1" @if(old('active')) selected @endif>{{ __('admin.article_create_active') }}</option>
						<option value="0" @if(!old('active')) selected @endif>{{ __('admin.article_create_inactive') }}</option>
					</select>
				</div>
				<button type="submit" class="btn btn-primary">{{ __('admin.common_add') }}</button>
			</form>
		</div>
	</div>
@endsection