<article class="archive-item zoom-cont2  @if($key != 0) margin-top-90 @endif">
	<a href="{{ $article->getLink()}}" class="title-link" title="{{ $article->name}}"><h2 class="title-negative-margin">{{ $article->name}}<span class="special-color">.</span></h2>
	</a>
	<!-- <a href="#" class="title-link"><div class="blog-top-icon pull-left"><i class="fa fa-user"></i>Joshua Smith</div></a> -->
	<a href="#" class="title-link"><div class="blog-top-icon pull-left"><i class="fa fa-calendar-o"></i>{{ $article->getCreatedAtFormat() }}</div></a>
	<a href="{{$article->firstArticleCategories()->getLink()}}" class="title-link"><div class="blog-top-icon pull-left"><i class="fa fa-folder-open-o"></i>{{$article->firstArticleCategories()->name}}</div></a>
	<!-- <a href="#" class="title-link"><div class="blog-top-icon pull-left"><i class="fa fa-comment-o"></i>2</div></a> -->
	<div class="clearfix"></div>						
	<div class="title-separator-primary"></div>
	<figure><a href="blog-right-sidebar.html"><img src="{{ $article->getFirstAttachment("custom", 936, 400) }}" alt="{{ $article->name}}" class="zoom" /></a></figure>
	<div class="blog-text">
	{{ $article->summary }}
	</div>
	<a href="blog-right-sidebar.html" class="button-primary pull-right">
			<span>Xem thêm</span>
			<div class="button-triangle"></div>
			<div class="button-triangle2"></div>
			<div class="button-icon"><i class="fa fa-search"></i></div>
		</a>
	<div class="clearfix"></div>	
</article>