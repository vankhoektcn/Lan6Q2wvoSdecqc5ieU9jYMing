@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
	@if(count($projectSlideshow) > 0)
    <section class="no-padding adv-search-section">
		<!-- Slider main container -->
		<div id="swiper1" class="swiper-container">
			<!-- Additional required wrapper -->
			<div class="swiper-wrapper">
				<!-- Slides -->
				@foreach($projectSlideshow as $key=>$project)
				<div class="swiper-slide">
					<div class="slide-bg swiper-lazy" data-background="{{ $project->getFirstAttachment() }}"></div>
					
					<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
					<div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 col-sm-offset-2 col-md-offset-4 col-lg-offset-6 slide-desc-col animated fadeInDown slide-desc-1">
								<div class="slide-desc pull-right">
									<div class="slide-desc-text">
										
										<!-- <div class="estate-type">apartment</div> -->
										<div class="transaction-type"><a href="{{$project->projectType->getLink()}}" alt="{{$project->projectType->name}}" style="color: #fff">{{$project->projectType->name}}</a></div>
										<h4><a href="{{$project->getLink()}}" alt="{{$project->name}}">{{$project->name}}</a></h4>
										<div class="clearfix"></div>
										
										<p style="color: red;"><i class="fa fa-map-marker mrgr05" aria-hidden="true"></i><em>{{$project->addressFull()}}</em>
										</p>
										<p class="padt0">{{$project->summary}}
										</p>
									</div>
									<!-- <div class="slide-desc-params">	
										<div class="slide-desc-area">
											<img src="/frontend/images/area-icon.png" alt="" />54m<sup>2</sup>
										</div>
										<div class="slide-desc-rooms">
											<img src="/frontend/images/rooms-icon.png" alt="" />3
										</div>
										<div class="slide-desc-baths">
											<img src="/frontend/images/bathrooms-icon.png" alt="" />1
										</div>	
										<div class="slide-desc-parking">
											<img src="/frontend/images/parking-icon.png" alt="" />1
										</div>	
									</div> -->
									<div class="slide-desc-price">
										{{$project->price_description}}
									</div>
									<div class="clearfix"></div>
								</div>
								<!-- <div class="slide-buttons slide-buttons-right">
									<a href="#" class="navigation-box navigation-box-next slide-next"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
									<a href="{{$project->getLink()}}" class="navigation-box navigation-box-more slide-more"><div class="navigation-triangle"></div><div class="navigation-box-icon">
									Chi tiết
									</div></a>
									<a href="#" class="navigation-box navigation-box-prev slide-prev"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>
								</div> -->
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>

    </section>
    @endif
    
	
	<section class="section-dark">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-lg-12">
					<!-- <h5 class="subtitle-margin">latest from</h5> -->
							<h1 class="">Tin tức<span class="special-color">.</span></h1>
				</div>
			
				<div class="col-xs-12">
					<div class="title-separator-primary"></div>
				</div>
			</div>
		</div>
		<div class="container blog-grid1-container">
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-12">
								<div class="masonry-grid">
									<!-- width of .grid-sizer used for columnWidth -->
									<div class="masonry-grid-sizer"></div>

									@foreach($news as $key => $article)
									@include('frontend.partials.gridArticles')
									@endforeach
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

    @if($chuyenMuc->published)
    {!! $chuyenMuc->content !!}
    @endif
    <section class="featured-offers parallax">
		
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-9">
					<!-- <h5 class="subtitle-margin second-color">highly recommended</h5> -->
					<h1 class="second-color">Dự án nổi bật<span class="special-color">.</span></h1>
				</div>
				<div class="col-xs-12 col-sm-3">
					<a href="#" class="navigation-box navigation-box-next" id="featured-offers-owl-next"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
					<a href="#" class="navigation-box navigation-box-prev" id="featured-offers-owl-prev"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>								
				</div>
				<div class="col-xs-12">
					<div class="title-separator-secondary"></div>
				</div>
			</div>
		</div>
		<div class="featured-offers-container">
			<div class="owl-carousel" id="featured-offers-owl">
			@foreach($duAnNoiBat as $key=>$project)
				<div class="featured-offer-col">
					<div class="featured-offer-front">
						<div class="featured-offer-photo">
							<img src="{{ $project->getFirstAttachment("custom", 360, 270) }}" alt="" />
							<div class="type-container">
								<!-- <div class="estate-type">{{$project->name}}</div> -->
								<div class="transaction-type">{{$project->name}}</div>
							</div>
						</div>
						<div class="featured-offer-text">
							<h4 class="featured-offer-title" style="color: #ee7e23"><i class="fa fa-map-marker mrgr05" aria-hidden="true"></i>{{$project->addressFull()}}</h4>
							<p>{{$project->summary}}</p>
						</div>
						<!-- <div class="featured-offer-params">
							<div class="featured-area">
								<img src="/frontend/images/area-icon.png" alt="" />54m<sup>2</sup>
							</div>
							<div class="featured-rooms">
								<img src="/frontend/images/rooms-icon.png" alt="" />3
							</div>
							<div class="featured-baths">
								<img src="/frontend/images/bathrooms-icon.png" alt="" />1
							</div>							
						</div> -->
						<div class="featured-price">
							{{$project->price_description}}
						</div>
					</div>
					<div class="featured-offer-back">
						<div id="featured-map1" class="featured-offer-map"></div>
						<div class="button">	
							<a href="{{$project->getLink()}}" class="button-primary">
								<span>Xem thêm</span>
								<div class="button-triangle"></div>
								<div class="button-triangle2"></div>
								<div class="button-icon"><i class="fa fa-search"></i></div>
							</a>
						</div>
					</div>
				</div>
			@endforeach

			</div>
		</div>
    </section>

	<section class="section-light section-top-shadow">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-9">
						<div class="row">
							<div class="col-xs-12 col-lg-6">
								<!-- <h5 class="subtitle-margin">apartments for sale, colorodo, usa</h5> -->
								<h1>Dự án mới nhất<span class="special-color">.</span></h1>
							</div>						
							<div class="col-xs-12">
								<div class="title-separator-primary"></div>
							</div>
						</div>
						<div class="row list-offer-row">
							<div class="col-xs-12">
							@foreach($duAnMoiNhat as $key=>$project)
								@include('frontend.partials.listProjects')
							@endforeach
							</div>
						</div>
						
				</div>
				<div class="col-xs-12 col-md-3">
					@include('frontend.partials.projectArticleSidebar')        
				</div>
			</div>
		</div>
	</section>
	
	<section class="testimonials parallax">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-9">
					<!-- <h5 class="subtitle-margin second-color">recommendations</h5> -->
							<h1 class="second-color">Cảm nhận khách hàng<span class="special-color">.</span></h1>
				</div>
				<div class="col-xs-12 col-sm-3">
					<a href="#" class="navigation-box navigation-box-next" id="testimonials-owl-next"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
					<a href="#" class="navigation-box navigation-box-prev" id="testimonials-owl-prev"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>
				</div>
				<div class="col-xs-12">
					<div class="title-separator-secondary"></div>
				</div>
			</div>
		</div>

			<div class="container margin-top-90">
				<div class="row">
					<div class="col-xs-12 owl-carousel" id="testimonials-owl">
					@foreach($camNhanKh as $key=>$testimonial)
						<div class="testimonial {{$testimonial->hasAttachments()}}">
						@if($testimonial->hasAttachments())
							<img src="{{ $testimonial->getFirstAttachment("custom", 472, 338) }}" alt="{{$testimonial->job_title}}" class="testimonials-photo" />
						@endif
							<!-- @if($testimonial->getFirstAttachment() != '')
								<img src="{{$testimonial->getFirstAttachment()}}" alt="" class="testimonials-photo" />
							@else
								<img src="/frontend/images/testimonials1.jpg" alt="" class="testimonials-photo" />
							@endif -->
							<div class="testimonials-content">							
								<p class="lead">{{$testimonial->job_title}}
									<small class="padl1x" style="font-weight: normal;">(<em>{{$testimonial->full_name}}</em>)</small>
								</p>
								<p>{{$testimonial->content}}</p>
								
							</div>
							<div class="big-triangle">							
								</div>
								<div class="big-icon"><i class="fa fa-quote-right fa-lg"></i></div>
						</div>
					@endforeach
					</div>
				</div>
			</div>
	</section>
	
	@if($doiTacLanding && $doiTacLanding->published)
    {!! $doiTacLanding->content !!}
    @endif
		

@endsection