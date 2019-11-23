<div class="text-right">
	{{ __('public.include_article_list_sort_by') }} 
	@if($articlesOrderData['order_field'] == 'created_at' && $articlesOrderData['order_direction'] == 'asc')
		<a href="{{ request()->fullUrlWithQuery(['order_field' => 'created_at', 'order_direction' => 'desc']) }}">{{ __('public.include_article_list_sort_by_created') }} &#9650;</a>
	@else
		<a href="{{ request()->fullUrlWithQuery(['order_field' => 'created_at', 'order_direction' => 'asc']) }}">{{ __('public.include_article_list_sort_by_created') }} &#9660;</a>
	@endif
</div>

@foreach($articles as $article)
	<div class="mb-15 mt-15">
		<h3><a href="{{ route('articles.show', ['slug' => $article->slug]) }}">{{ $article->title }}</a></h3>
		<small>{{ $article->created_at->format('d.m.Y') }}</small>
		@if($article->description)
			<p>{{ $article->description }}</p>	
		@endif
	</div>
@endforeach

<div class="text-center">
	{{ $articles->appends($articlesOrderData)->links() }}
</div>
        