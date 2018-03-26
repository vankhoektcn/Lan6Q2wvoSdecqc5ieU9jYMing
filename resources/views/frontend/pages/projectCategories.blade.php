@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
	@include('frontend.partials.breadcrumb')

    @foreach($projectCategory as $key=>$category)
    <section class="featured-offers parallax">
		
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-9">
					<!-- <h5 class="subtitle-margin second-color">highly recommended</h5> -->
					<h1 class="second-color">{{$category->name}}<span class="special-color">.</span></h1>
				</div>
				<div class="col-xs-12 col-sm-3">
					<a href="#" class="navigation-box navigation-box-next" id="featured-offers-owl-{{$key}}-next"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
					<a href="#" class="navigation-box navigation-box-prev" id="featured-offers-owl-{{$key}}-prev"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>								
				</div>
				<div class="col-xs-12">
					<div class="title-separator-secondary"></div>
				</div>
			</div>
		</div>
		<div class="featured-offers-container">
			<div class="owl-carousel" id="featured-offers-owl-{{$key}}">
			@foreach($category->projects()->where('published', 1)->orderBy('priority')->take(5)->get() as $key1=>$project)
                @include('frontend.partials.gridProjects')
			@endforeach

			</div>
		</div>
    </section>
    @endforeach

	<section class="section-light padt3x">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-9">
						<div class="row">
							<div class="col-xs-12 col-lg-6">
								<!-- <h5 class="subtitle-margin">apartments for sale, colorodo, usa</h5> -->
								<h1><a href="{{$sangNhuong->getLink()}}">{{$sangNhuong->name}}</a><span class="special-color">.</span></h1>
							</div>						
							<div class="col-xs-12">
								<div class="title-separator-primary"></div>
							</div>
						</div>
						<div class="row list-offer-row">
							<div class="col-xs-12">
							@foreach($sangNhuongProject as $key=>$project)
								@include('frontend.partials.listProjects')
							@endforeach
							<div class="margin-top-45"></div>
							</div>
						</div>
						
				</div>
				<div class="col-xs-12 col-md-3">
                    @include('frontend.partials.projectArticleSidebar')                
				</div>
			</div>
		</div>
	</section>
	

	<section class="section-light padt3x">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-9">
						<div class="row">
							<div class="col-xs-12 col-lg-6">
								<!-- <h5 class="subtitle-margin">apartments for sale, colorodo, usa</h5> -->
								<h1><a href="{{$choThue->getLink()}}">{{$choThue->name}}</a><span class="special-color">.</span></h1>
							</div>						
							<div class="col-xs-12">
								<div class="title-separator-primary"></div>
							</div>
						</div>
						<div class="row list-offer-row">
							<div class="col-xs-12">
							@foreach($choThueProject as $key=>$project)
								@include('frontend.partials.listProjects')
							@endforeach
							<div class="margin-top-45"></div>
							</div>
						</div>
						
				</div>
				<div class="col-xs-12 col-md-3">
                    @include('frontend.partials.projectArticleSidebar')                
				</div>
			</div>
		</div>
	</section>
@endsection

@section('customize.js')
	<script type="text/javascript" src="/frontend/js/projectCategories.js"></script>
@endsection