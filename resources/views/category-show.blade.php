@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-4">
			@include('includes.category-list')
		</div>
    	<div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $category->title }}</div>
        
                <div class="card-body">
                	@include('includes.article-list', ['articles' => $articles])
                </div>
            </div>
        </div>
    </div>
@endsection