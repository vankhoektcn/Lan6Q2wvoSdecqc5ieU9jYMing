
						<div class="sidebar-title-cont">
							<h4 class="sidebar-title">Tin mới<span class="special-color">.</span></h4>
							<div class="title-separator-primary"></div>
						</div>
						<div class="sidebar-blog-cont">
						@foreach($lastestNews as $key => $article)
							<article>
								<a href="{{ $article->getLink()}}"><img src="{{ $article->getFirstAttachment("custom", 400, 337) }}" alt="{{$article->name}}" class="sidebar-blog-image" /></a>
								<div class="sidebar-blog-title"><a href="{{ $article->getLink()}}" title="{{$article->name}}">{{$article->name}}</a></div>
								<div class="sidebar-blog-date"><i class="fa fa-calendar-o"></i>{{ $article->getCreatedAtFormat() }}</div>
								<div class="clearfix"></div>					
							</article>
						@endforeach
						</div>