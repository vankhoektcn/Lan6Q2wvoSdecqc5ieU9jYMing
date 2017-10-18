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
							<img src="/frontend/images/featured-offer1.jpg" alt="" />
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
							$ 320 000
						</div>
					</div>
					<div class="featured-offer-back">
						<div id="featured-map1" class="featured-offer-map"></div>
						<div class="button">	
							<a href="estate-details-right-sidebar.html" class="button-primary">
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
								<div class="list-offer">
									<div class="list-offer-left">
										<div class="list-offer-front">
									
											<div class="list-offer-photo">
												<img src="/frontend/images/grid-offer1.jpg" alt="" />
												<div class="type-container">
													<!-- <div class="estate-type">apartment</div> -->
													<div class="transaction-type">{{$project->projectType->name}}</div>
												</div>
											</div>
											<div class="list-offer-params">
												<div class="list-area">
													<img src="/frontend/images/area-icon.png" alt="" />54m<sup>2</sup>
												</div>
												<div class="list-rooms">
													<img src="/frontend/images/rooms-icon.png" alt="" />3
												</div>
												<div class="list-baths">
													<img src="/frontend/images/bathrooms-icon.png" alt="" />1
												</div>							
											</div>	
										</div>
										<div class="list-offer-back">
											<div id="list-map1" class="list-offer-map"></div>
										</div>
									</div>
									<a class="list-offer-right" href="estate-details-right-sidebar.html">
										<div class="list-offer-text">
											<div class="list-offer-h4"><h4 class="">{{$project->name}}</h4></div>
											<div class="clearfix"></div>
											<div class="list-offer-h4">
											<h4 class="list-offer-title"><smail><i class="fa fa-map-marker list-offer-localization hidden-xs"></i> {{$project->addressFull()}}</smail></h4></div>
											<div class="clearfix"></div>
											Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.
											<div class="clearfix"></div>
										</div>
										<div class="price-list-cont">
											<div class="list-price">
												Chi tiết
											</div>	
										</div>
									</a>
									<div class="clearfix"></div>
								</div>

								<div class="clearfix"></div>
							@endforeach
							</div>
						</div>
						
				</div>
				<div class="col-xs-12 col-md-3">
					<div class="sidebar">
						<div class="sidebar-title-cont mrgt2x">
							<h4 class="sidebar-title">Tin dự án mới<span class="special-color">.</span></h4>
							<div class="title-separator-primary"></div>
						</div>
						<div class="sidebar-featured-cont">
						@foreach($tinDuAnMoiNhat as $key=>$article)
							<div class="sidebar-featured">
								<a class="sidebar-featured-image" href="{{$article->getLink()}}">
									<img src="{{$article->getFirstAttachment('custom', 97, 87)}}" alt="{{$article->name}}" />
									<!-- <div class="sidebar-featured-type">
										<div class="sidebar-featured-estate">A</div>
										<div class="sidebar-featured-transaction">S</div>
									</div> -->
								</a>
								<div class="sidebar-featured-title"><a href="{{$article->getLink()}}">{{$article->name}}</a></div>
								<div class="sidebar-featured-price">{{$article->project->name}}</div>
								<div class="clearfix"></div>					
							</div>
						@endforeach
						</div>
						<div class="sidebar-title-cont">
							<h4 class="sidebar-title">Xem nhiều<span class="special-color">.</span></h4>
							<div class="title-separator-primary"></div>
						</div>
						<div class="sidebar-blog-cont">
						@foreach($tinDuAnXemNhieu as $key=>$article)
							<article>
								<a href="blog-right-sidebar.html"><img src="{{$article->getFirstAttachment('custom', 97, 87)}}" alt="{{$article->name}}" class="sidebar-blog-image" /></a>
								<div class="sidebar-blog-title"><a href="{{$article->getLink()}}">{{$article->name}}</a></div>
								<div class="sidebar-blog-date"><i class="fa fa-calendar-o"></i>28/09/15</div>
								<div class="clearfix"></div>					
							</article>
						@endforeach
						</div>
					</div>
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
									@endforeach
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		

@endsection