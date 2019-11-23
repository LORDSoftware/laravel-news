@extends('layouts.app')

@section('content')
	<div class="card mt-4">
		<div class="card-header">
			{{ __('admin.category_index_header') }} 
			<div class="float-right"><a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary">{{ __('admin.common_add') }}</a></div>
		</div>

		<div class="card-body">
			@if($messages = Session::get('messages'))
				<div class="alert alert-success">
					@foreach ($messages as $message)
						<div>{{ $message }}</div>
					@endforeach
				</div>
			@endif
            @if($categories->count())
                <table class="table table-striped">
                	<thead>
                		<tr>
                			<th width="10%">{{ __('admin.category_index_id') }}</th>
                			<th width="70%">{{ __('admin.category_index_title') }}</th>
                			<th width="15%" colspan="2">{{ __('admin.common_actions') }}</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($categories as $category)
                    		<tr>
                    			<td>{{ $category->id }}</td>
                    			<td>{{ str_repeat('--', $category->depth) }} {{ $category->title }}</td>
                    			<td><a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-primary">{{ __('admin.common_edit') }}</a></td>
                    			<td>
                    				<form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
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