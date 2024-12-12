@extends('layouts.app-pages')
@section('title', "Блог / $post->name")

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
							<div class="grid_12 alpha">
								<div class="grid-inner">
                                <a href="{{ route('pages', 'blog') }}">Назад</a>
								<h2 class="h-pad h-indent">{{ $post->name }} </h2>

								<div class="block">
                                <div class="post">
                                    <div class="wrapper">
                                        <div class="info">
                                            <div class="wrapper">
                                                <div class="date">
                                                    <span>{{ date('M', strtotime($post->created_at)); }}</span>
													<strong>{{ date('d', strtotime($post->created_at)); }}</strong>
                                                </div>
                                            Автор: <strong>{{ \App\Models\User::getName($post->user_id) }}</strong>
                                            </div>
                                            
                                        </div>
                                        <div class="comments">
                                            ({{ $post->getComments()->count(); }}) комментариев <span></span>
                                        </div>
                                    </div>
                                    <figure><a href="#"><img src="{{ $post->preview }}" alt=""></a><figure>
                                        <p>{{ $post->description }}</p>
                                </div>

								<hr/>
								<h2>Комментарии</h2>
								<p>Создайте свой первый комментарий!</p>
								<form action="{{ route('addComment') }}" method="POST">
									@csrf

									<input type="hidden" name="post_id" value="{{ $post->id }}" />

									@auth 
										<input type="text" readonly placeholder="Введите ваше имя" value="{{ auth()->user()->name }} (#{{ auth()->id() }})" name="author" />
									@else 
										<input type="text" placeholder="Введите ваше имя" name="author" />
									@endauth
									
									<textarea name="description" placeholder="Описание"></textarea>
									<button type="submit">Отправить</button>
								</form>

								@foreach($post->getComments() as $comment)

									@auth 
										@if(auth()->user()->role === 'admin')
											<p>
												(<small>{{ $comment->created_at }}</small>)
											</p>

											<form action="{{ route('editComment', $comment->id) }}" method="POST">
												@csrf
			
												<input type="text" placeholder="Введите ваше имя" value="{{ $comment->author }}" name="author" />
												<textarea name="description" placeholder="Описание">{{ $comment->description }}</textarea>

												<button type="submit">Сохранить</button>
												<a href="{{ route('deleteComment', $comment->id) }}" style="color: red;">Удалить</a>
											</form>
										@else 
											<p>
												<b>{{ $comment->author }}</b>: 
												{{ $comment->description }} (<small>{{ $comment->created_at }}</small>)
											</p>
										@endif
									@else 
										<p>
											<b>{{ $comment->author }}</b>: 
											{{ $comment->description }} (<small>{{ $comment->created_at }}</small>)
										</p>
									@endif

									
								@endforeach

                            </div>
								
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>

@endsection