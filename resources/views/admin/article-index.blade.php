@extends('layouts.app')

@section('content')
	<div class="card mt-4">
		<div class="card-header">
			{{ __('admin.article_index_header') }} 
			<div class="float-right"><a href="{{ route('admin.articles.create') }}" class="btn btn-sm btn-primary">{{ __('admin.common_add') }}</a></div>
		</div>

		<div class="card-body">
			@if($messages = Session::get('messages'))
				<div class="alert alert-success">
					@foreach ($messages as $message)
						<div>{{ $message }}</div>
					@endforeach
				</div>
			@endif
            @if($articles->count())
                <table class="table table-striped">
                	<thead>
                		<tr>
                			<th width="5%">{{ __('admin.article_index_id') }} </th>
                			<th width="40%">{{ __('admin.article_index_title') }} </th>
                			<th width="15%">{{ __('admin.article_index_category') }} </th>
                			<th width="15%">{{ __('admin.article_index_created') }} </th>
                			<th width="5%">{{ __('admin.article_index_active') }} </th>
                			<th width="15%" colspan="2">{{ __('admin.common_actions') }} </th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($articles as $article)
                    		<tr>
                    			<td>{{ $article->id }}</td>
                    			<td>{{ $article->title }}</td>
                    			<td>{{ $article->category['title'] }}</td>
                    			<td>{{ $article->created_at->format('d.m.Y') }}</td>
                    			<td>{{ $article->active }}</td>
                    			<td><a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-primary">{{ __('admin.common_edit') }}</a></td>
                    			<td>
                    				<form action="{{ route('admin.articles.destroy', $article->id) }}" method="post">
                    					@method('DELETE')
                    					@csrf
                    					<button class="btn btn-sm btn-danger" type="submit">{{ __('admin.common_delete') }}</button>
                    				</form>
                    			</td>
                    		</tr>
                		@endforeach
                	</tbody>
                </table>
            @else
            	<div class="alert alert-success">{{ __('admin.common_empty') }}</div>
            @endif
		</div>
	</div>
@endsection