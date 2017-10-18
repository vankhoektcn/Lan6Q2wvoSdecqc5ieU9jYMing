@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
	@include('frontend.partials.breadcrumb')
	
	<section class="section-light padt3x">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-9">
					<article class="archive-item zoom-cont2">
						<h2 class="title-negative-margin"><a href="{{$article->getLink()}}" alt="{{$article->name}}">{{$article->name}}</a><span class="special-color">.</span></h2>
						<!-- <a href="#" class="title-link"><div class="blog-top-icon pull-left"><i class="fa fa-user"></i>Joshua Smith</div></a> -->
						<a href="#" class="title-link"><div class="blog-top-icon pull-left"><i class="fa fa-calendar-o"></i>{{ $article->getCreatedAtFormat() }}</div></a>
						<a href="{{$article->firstArticleCategories()->getLink()}}" class="title-link"><div class="blog-top-icon pull-left"><i class="fa fa-folder-open-o"></i>{{$article->firstArticleCategories()->name}}</div></a>
						<!-- <a href="#" class="title-link"><div class="blog-top-icon pull-left"><i class="fa fa-comment-o"></i>2</div></a> -->
						<div class="clearfix"></div>						
						<div class="title-separator-primary"></div>
						<div class="mrgt3x">
							{{ $article->summary }} 
						</div>
						<figure><a href="#"><img src="{{ $article->getFirstAttachment() }}" alt="{{$article->name}}" class="zoom" /></a></figure>

						<div class="blog-text">
						{!! $article->content !!} 
						</div>
						<div class="agent-social-bar margin-top-30">
							<div class="pull-left icon-margin blog-big-icon">
								<i class="fa fa-tag fa-2x"></i>
							</div>
							@foreach($article->tags()->where('published', 1)->get() as $key => $tag)
								<a class="pull-left tag-div" href="{{$tag->getLink()}}">
									<span>{{$tag->name}}</span>
									<div class="button-triangle2"></div>
								</a>
							@endforeach
							<div class="pull-right">
								<div class="pull-right">
									<a class="agent-icon-circle" href="#">
										<i class="fa fa-facebook"></i>
									</a>
								</div>
								<div class="pull-right">
									<a class="agent-icon-circle icon-margin" href="#">
										<i class="fa fa-twitter"></i>
									</a>
								</div>
								<div class="pull-right">
									<a class="agent-icon-circle icon-margin" href="#">
										<i class="fa fa-google-plus"></i>
									</a>
								</div>
								<div class="pull-right">
									<a class="agent-icon-circle icon-margin" href="#">
										<i class="fa fa-envelope fa-sm"></i>
									</a>
								</div>
								<div class="pull-right icon-margin blog-big-icon">
									<i class="fa fa-share-alt fa-2x"></i>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</article>
					
				</div>
				<div class="col-xs-12 col-md-3">
					<div class="sidebar">
						<h4 class="sidebar-title">categories<span class="special-color">.</span></h4>
						<div class="title-separator-primary"></div>
						<div class="margin-top-30"></div>
						<ul class="blue-ul">
							<li><span class="custom-ul-bullet"></span><a href="#">Category 1</a></li>
							<li><span class="custom-ul-bullet"></span><a href="#">Category 2</a></li>
							<li><span class="custom-ul-bullet"></span><a href="#">Category 3</a></li>
							<li class="ap-submenu">
								<ul class="blue-ul">
									<li><span class="custom-ul-bullet"></span><a href="#">Category 4</a></li>
									<li><span class="custom-ul-bullet"></span><a href="#">Category 5</a></li>
								</ul>
							</li>
							<li><span class="custom-ul-bullet"></span><a href="#">Category 6</a></li>
							<li><span class="custom-ul-bullet"></span><a href="#">Category 7</a></li>
							<li><span class="custom-ul-bullet"></span><a href="#">Category 8</a></li>
						</ul>
						<div class="sidebar-title-cont">
							<h4 class="sidebar-title">featured offers<span class="special-color">.</span></h4>
							<div class="title-separator-primary"></div>
						</div>
						<div class="sidebar-featured-cont">
							<div class="sidebar-featured">
								<a class="sidebar-featured-image" href="estate-details-right-sidebar.html">
									<img src="/frontend/images/sidebar-featured1.jpg" alt="" />
									<div class="sidebar-featured-type">
										<div class="sidebar-featured-estate">A</div>
										<div class="sidebar-featured-transaction">S</div>
									</div>
								</a>
								<div class="sidebar-featured-title"><a href="estate-details-right-sidebar.html">Fort Collins, Colorado 80523, USA</a></div>
								<div class="sidebar-featured-price">$ 320 000</div>
								<div class="clearfix"></div>						
							</div>
							<div class="sidebar-featured">
								<a class="sidebar-featured-image" href="estate-details-right-sidebar.html">
									<img src="/frontend/images/sidebar-featured2.jpg" alt="" />
									<div class="sidebar-featured-type">
										<div class="sidebar-featured-estate">A</div>
										<div class="sidebar-featured-transaction">S</div>
									</div>
								</a>
								<div class="sidebar-featured-title"><a href="estate-details-right-sidebar.html">West Fourth Street, New York 10003, USA</a></div>
								<div class="sidebar-featured-price">$ 350 000</div>
								<div class="clearfix"></div>						
							</div>
							<div class="sidebar-featured">
								<a class="sidebar-featured-image" href="estate-details-right-sidebar.html">
									<img src="/frontend/images/sidebar-featured3.jpg" alt="" />
									<div class="sidebar-featured-type">
										<div class="sidebar-featured-estate">A</div>
										<div class="sidebar-featured-transaction">S</div>
									</div>
								</a>
								<div class="sidebar-featured-title"><a href="estate-details-right-sidebar.html">E. Elwood St. Phoenix, AZ 85034, USA</a></div>
								<div class="sidebar-featured-price">$ 410 000</div>
								<div class="clearfix"></div>					
							</div>
						</div>
						<div class="sidebar-title-cont">
							<h4 class="sidebar-title">latest news<span class="special-color">.</span></h4>
							<div class="title-separator-primary"></div>
						</div>
						<div class="sidebar-blog-cont">
							<article>
								<a href="blog-right-sidebar.html"><img src="/frontend/images/footer-blog1.jpg" alt="" class="sidebar-blog-image" /></a>
								<div class="sidebar-blog-title"><a href="blog-right-sidebar.html">This post title, lorem ipsum dolor sit</a></div>
								<div class="sidebar-blog-date"><i class="fa fa-calendar-o"></i>28/09/15</div>
								<div class="clearfix"></div>					
							</article>
							<article>
								<a href="blog-right-sidebar.html"><img src="/frontend/images/footer-blog2.jpg" alt="" class="sidebar-blog-image" /></a>
								<div class="sidebar-blog-title"><a href="blog-right-sidebar.html">This post title, lorem ipsum dolor sit</a></div>
								<div class="sidebar-blog-date"><i class="fa fa-calendar-o"></i>28/09/15</div>
								<div class="clearfix"></div>					
							</article>
							<article>
								<a href="blog-right-sidebar.html"><img src="/frontend/images/footer-blog3.jpg" alt="" class="sidebar-blog-image" /></a>
								<div class="sidebar-blog-title"><a href="blog-right-sidebar.html">This post title, lorem ipsum dolor sit</a></div>
								<div class="sidebar-blog-date"><i class="fa fa-calendar-o"></i>28/09/15</div>
								<div class="clearfix"></div>					
							</article>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection