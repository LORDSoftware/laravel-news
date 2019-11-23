<ul>
@foreach($categories as $category)
	<li>
		<a href="{{ route('categories.show', ['slug' => $category->slug]) }}"
			@if(in_array($category->id, $selectedCategoryIDs)) 
				class="font-weight-bold" 
			@endif 
		>
			{{ $category->title }}
		</a>
		@if($category->childrenWithActiveArticles->count() > 0)
			@include('includes.category-list-inner', ['categories' => $category->childrenWithActiveArticles])
		@endif
	</li>
@endforeach
</ul>