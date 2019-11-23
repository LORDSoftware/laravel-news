@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-4">
			@include('includes.category-list')
		</div>
    	<div class="col-md-8">
    		<div class="card">
    			<div class="card-header">{{ $article->title }}</div>
    	
    			<div class="card-body">
    				<small>{{ $article->created_at->format('d.m.Y') }}</small>
    		 			<p>{!! nl2br($article->content) !!}</p>	
    			</div>
    		</div>
    		
    		<div class="card mt-4">
    			<div class="card-header">{{ __('public.article_show_comments') }}</div>
    	
    			<div class="card-body">
    				@if($article->comments->count())
    					@foreach($article->comments as $comment)
    						<div class="well">
    							<h4>{{ $comment->author }}</h4>
    							<small>{{ $comment->created_at->format('d.m.Y') }}</small>
    							<p>{!! nl2br($comment->content) !!}</p>	
    						</div>
    					@endforeach
    				@else
    					{{ __('public.common_empty') }}
    				@endif
    			</div>
    		</div>
    		
    		<div class="card mt-4">
    			<div class="card-header">{{ __('public.article_show_write_your_comment') }}</div>
    	
    			<div class="card-body">
    				@if(count($errors) > 0)
    					<div class="alert alert-danger">
    						@foreach ($errors->all() as $error)
    							<div>{{ $error }}</div>
    						@endforeach
    					</div>
    				@endif
    				@if($messages = Session::get('messages'))
    					<div class="alert alert-success">
    						@foreach ($messages as $message)
    							<div>{{ $message }}</div>
    						@endforeach
    					</div>
    				@endif
    				<form method="post" action="{{ route('comments.store') }}">
    					@csrf
    					<div class="form-group">
    						<label for="author">{{ __('public.article_show_comment_author') }}</label>
    						<input type="text" class="form-control" name="author" value="{{ old('author') }}"/>
    					</div>
    					<div class="form-group">
    						<label for="content">{{ __('public.article_show_comment_content') }}</label>
    						<textarea class="form-control" name="content" rows="5">{{ old('content') }}</textarea>
    					</div>
    					<input type="hidden" name="article_id" value="{{ $article->id }}" />
    					<button type="submit" class="btn btn-primary">{{ __('public.article_show_comment_send') }}</button>
    				</form>
    			</div>
    		</div>
    	</div>
	</div>
@endsection