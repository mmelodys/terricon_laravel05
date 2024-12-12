@extends('layouts.app-pages')
@section('title', 'Блог')

@section('content')

<div id="content">
	<div class="ic">More Website Templates @ TemplateMonster.com - April 15, 2013!</div>
	<div class="inner">
		<div class="container_12">
			<div class="wrapper">
				<div class="grid_12">
					<div class="block">
						<div class="info-block">
							<a href="https://t.me/mazaretto" rel="nofollow" class="link">Закажите</a> разработку у меня и получите скидку 15% на все услуги до Нового года.
                                *Только для новых клиентов.
						</div>
						<a href="https://t.me/mazaretto" class="button" rel="nofollow">Заказать</a>
					</div>
				</div>
			</div>
			<div class="wrapper">
				<div class="grid_12">
						<div class="wrapper">
							<div class="grid_8 alpha">
								<div class="grid-inner">
								<h2 class="h-pad h-indent">Последние посты ({{ count($posts) }})</h2>

								@if(count($posts))
									@foreach($posts as $post)
										<div class="block">
											<div class="post">
												<div class="wrapper">
													<div class="info">
														<div class="wrapper">
															<div class="date">
																<span>{{ date('M', strtotime($post->created_at)); }}</span>
																<strong>{{ date('d', strtotime($post->created_at)); }}</strong>
															</div>
															<a href="{{ route('pages', ['name' => 'post', 'post_id' => $post->id]) }}"><strong>{{ $post->name }}</strong></a><br>
														Автор: <strong>{{ \App\Models\User::getName($post->user_id) }}</strong>
														</div>
														
													</div>
													<div class="comments">
														({{ $post->getComments()->count(); }}) комментариев<span></span>
													</div>
												</div>
												<figure>
													<a href="{{ route('pages', ['name' => 'post', 'post_id' => $post->id]) }}">
														<img src="{{ $post->preview }}" alt="">
													</a>
												<figure>
													<p>{{ $post->description }}</p>
													<a href="{{ route('pages', ['name' => 'post', 'post_id' => $post->id]) }}" class="button1">Подробнее</a>
											</div>
										</div>
									@endforeach
								@else 
									<p>Постов в данной категории не найдено.</p>
								@endif
								
							</div>
						</div>
							<div class="grid_4 omega">
								<div class="block block-pad">
									<h2>Категории</h2>
									<ul class="list">	
										@if($categories)
											@foreach($categories as $category)
												<li><a href="{{ route('pages', [
													'name' => 'blog',
													'category_id' => $category->id
												]) }}">{{ $category->name }} ({{ \App\Models\Post::where('category_id', $category->id)->count(); }})</a></li>
											@endforeach
										@endif
									</ul>
								</div>
								<a href="{{ route('pages', 'blog') }}" class="button1">Сбросить</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>

@endsection