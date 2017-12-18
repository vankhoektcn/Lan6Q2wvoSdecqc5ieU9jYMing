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
					@if(count($mainArticles) > 0)
						@foreach($mainArticles as $key => $article)
						@include('frontend.partials.listArticles')
						@endforeach
						{!! $mainArticles->render() !!}
						<div class="margin-top-45"></div>
					@endif	

					@foreach($category->childrens()->where('published', 1)->get() as $key => $category)
					<div class="row">
						<div class="col-xs-12 col-lg-12">
							<!-- <h5 class="subtitle-margin">latest from</h5> -->
							<a href="{{$category->getLink()}}"><h1 class="">{{$category->name}}<span class="special-color">.</span></h1></a>
						</div>					
						<div class="col-xs-12">
							<div class="title-separator-primary"></div>
						</div>
						
					</div>
					<div class="row margin-top-30">
						<div class="masonry-grid masonry-grid-short">
							<!-- width of .grid-sizer used for columnWidth -->
							<div class="masonry-grid-sizer"></div>
							@foreach($category->articles()->where('published', 1)->orderBy('id','desc')->take(5)->get() as $key => $article)
							@include('frontend.partials.gridArticles')
							@endforeach
						</div>
					</div>
					@endforeach
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