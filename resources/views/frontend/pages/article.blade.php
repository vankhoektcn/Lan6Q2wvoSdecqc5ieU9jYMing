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
						@if($article->firstArticleCategories())
						<a href="{{$article->firstArticleCategories()->getLink()}}" class="title-link"><div class="blog-top-icon pull-left"><i class="fa fa-folder-open-o"></i>{{$article->firstArticleCategories()->name}}</div></a>
						@endif
						<!-- <a href="#" class="title-link"><div class="blog-top-icon pull-left"><i class="fa fa-comment-o"></i>2</div></a> -->
						<div class="clearfix"></div>						
						<div class="title-separator-primary"></div>
						<div class="mrgt3x">
							{{ $article->summary }} 
						</div>
						<figure><a href="#"><img src="{{ $article->getFirstAttachment() }}" alt="{{$article->name}}" class="zoom" /></a></figure>

						<div class="blog-text article-content">
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
						@include('frontend.partials.sidebarCategories')

						@include('frontend.partials.sidebarLastestNews')
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection