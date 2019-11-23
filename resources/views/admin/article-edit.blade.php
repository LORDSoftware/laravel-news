@extends('layouts.app')

@section('content')
	<div class="card mt-4">
		<div class="card-header">{{ __('admin.article_edit_header') }}</div>

		<div class="card-body">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
						<div>{{ $error }}</div>
					@endforeach
				</div>
			@endif
			<form method="post" action="{{ route('admin.articles.update', $article->id) }}">
				@method('PATCH')
				@csrf
				<div class="form-group">
					<label for="title">{{ __('admin.article_edit_title') }}</label>
					<input type="text" class="form-control" name="title" value="{{ $article->title }}"/>
				</div>
				<div class="form-group">
					<label for="description">{{ __('admin.article_edit_description') }}</label>
					<textarea rows="5" class="form-control" name="description">{{ $article->description }}</textarea>
				</div>
				<div class="form-group">
					<label for="content">{{ __('admin.article_edit_content') }}</label>
					<textarea rows="10" class="form-control" name="content">{{ $article->content }}</textarea>
				</div>
				<div class="form-group">
					<label for="title">{{ __('admin.article_edit_slug') }}</label>
					<input type="text" class="form-control" name="slug" value="{{ $article->slug }}"/>
				</div>
				<div class="form-group">
					<label for="content">{{ __('admin.article_edit_category') }}</label>
					<select class="form-control" name="category_id">
						<option value=""></option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}" 
								@if($category->id == $article->category_id)
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
						<option value="1" @if($article->active) selected @endif>{{ __('admin.article_edit_active') }}</option>
						<option value="0" @if(!$article->active) selected @endif>{{ __('admin.article_edit_inactive') }}</option>
					</select>
				</div>
				<button type="submit" class="btn btn-primary">{{ __('admin.common_update') }}</button>
			</form>
		</div>
	</div>
@endsection