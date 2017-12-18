									@if($key == 0)
									<article class="masonry-grid-item masonry-grid-item-big big-blog-grid2-item zoom-cont">
									@else
									<article class="masonry-grid-item blog-grid2-item zoom-cont">
									@endif
										<figure><a href="{{$article->getLink()}}"><img src="{{ $article->getFirstAttachment("custom", 400, 337) }}" alt="{{ $article->name}}" class="zoom" /></a></figure>
										<div class="blog-grid2-post-content">
											
											<a href="{{$article->getLink()}}" class="blog-grid1-title"><h4>{{ $article->name}}</h4></a>
											<div class="blog-grid2-separator"></div>
											<p>{{ $article->summary }}</p>
											<div class="blog-grid2-bottom">
												<div class="blog-grid1-author pull-left">
												<a href="{{$article->firstArticleCategories()->getLink()}}" alt="{{$article->firstArticleCategories()->name}}"><i class="fa fa-tags"></i>{{$article->firstArticleCategories()->name}}</a></div>
												<div class="blog-grid1-date pull-right"><i class="fa fa-calendar-o"></i>{{ $article->getCreatedAtFormat() }}</div>
												<div class="clearfix"></div>
											</div>
										</div>
									</article>