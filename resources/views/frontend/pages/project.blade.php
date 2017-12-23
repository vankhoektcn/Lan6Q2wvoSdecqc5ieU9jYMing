@inject('config', '\App\Config')

@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
	@include('frontend.partials.breadcrumb')
	
	<section class="section-dark no-padding">
		<!-- Slider main container -->
		<div id="swiper-gallery" class="swiper-container">
			<!-- Additional required wrapper -->
			<div class="swiper-wrapper">
				<!-- Slides -->
				@foreach($project->getVisibleAttachments() as $key => $attachment)
				<div class="swiper-slide">
					<div class="slide-bg swiper-lazy" data-background="{{$attachment->getLink()}}" data-sub-html="<strong>{{$project->name}}</strong><br/>..."></div>
					<!-- Preloader image -->
					<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
					<div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-9 col-lg-8 slide-desc-col animated fadeInUp gallery-slide-desc-1">
								<div class="gallery-slide-cont">
									<div class="gallery-slide-cont-inner">	
										<div class="gallery-slide-title pull-right">
											<!-- <h5 class="subtitle-margin">{{$project->firstProjectCategories()->name}}</h5> -->
											<h3>{{$project->name}}<span class="special-color">.</span></h3>
										</div>
										<div class="gallery-slide-estate pull-right hidden-xs">
											<i class="fa fa-home"></i>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="clearfix"></div>
									<div class="gallery-slide-desc-price pull-right">
										{{$project->price_description}}
									</div>	
									<div class="clearfix"></div>
								</div>	
							</div>			
						</div>
					</div>
					
				</div>
				@endforeach
			</div>
			
			<div class="slide-buttons slide-buttons-center">
				<a href="#" class="navigation-box navigation-box-next slide-next"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
				<div id="slide-more-cont"></div>
				<a href="#" class="navigation-box navigation-box-prev slide-prev"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>
			</div>
			
		</div>
		
    </section>
	<section class="thumbs-slider section-both-shadow">
		<div class="container">
			<div class="row">
				<div class="col-xs-1">
					<a href="#" class="thumb-box thumb-prev pull-left"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>
				</div>
				<div class="col-xs-10">
					<!-- Slider main container -->
					<div id="swiper-thumbs" class="swiper-container">
						<!-- Additional required wrapper -->
						<div class="swiper-wrapper">
							<!-- Slides -->
							@foreach($project->getVisibleAttachments() as $key => $attachment)
							<div class="swiper-slide">
								<img class="slide-thumb" src="{{$attachment->getLink("custom", 140, 80)}}" alt="">
							</div>
							@endforeach
						</div>
					</div>
				</div>
				<div class="col-xs-1">
					<a href="#" class="thumb-box thumb-next pull-right"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
				</div>
			</div>
		</div>
	</section>
	<section class="section-light no-bottom-padding">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 project-content">
							<div class="details-image pull-left hidden-xs">
								<i class="fa fa-home"></i>
							</div>
							<div class="details-title pull-left">
								<h5 class="subtitle-margin">{{$project->firstProjectCategories()->name}}</h5>
								<h3>{{$project->name}}<span class="special-color">.</span></h3>
							</div>
							<div class="clearfix"></div>	
							<div class="title-separator-primary"></div>
							<p class="details-desc">{!! $project->content !!} </p>
						</div>
						<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
							<div class="details-parameters-price">{{$project->price_description}}</div>
							<div class="details-parameters">
								<div class="details-parameters-cont">
									<div class="details-parameters-name">Diện tích</div>
									<div class="details-parameters-val">...<sup></sup></div>
									<div class="clearfix"></div>	
								</div>
								<div class="details-parameters-cont">
									<div class="details-parameters-name">Phòng ngủ</div>
									<div class="details-parameters-val">...</div>
									<div class="clearfix"></div>	
								</div>
								<div class="details-parameters-cont">
									<div class="details-parameters-name">Toilet</div>
									<div class="details-parameters-val">...</div>
									<div class="clearfix"></div>	
								</div>
								<div class="details-parameters-cont">
									<div class="details-parameters-name">Bãi giữ xe</div>
									<div class="details-parameters-val">...</div>
									<div class="clearfix"></div>	
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="row margin-top-45">
						<div class="col-xs-6 col-sm-4">
							<ul class="details-ticks">
								<li><i class="jfont">&#xe815;</i>Air conditioning</li>
								<li><i class="jfont">&#xe815;</i>Internet</li>
								<li><i class="jfont">&#xe815;</i>Cable TV</li>
								<li><i class="jfont">&#xe815;</i>Balcony</li>
							</ul>
						</div>
						<div class="col-xs-6 col-sm-4">
							<ul class="details-ticks">
								<li><i class="jfont">&#xe815;</i>Garage</li>
								<li><i class="jfont">&#xe815;</i>Lift</li>
								<li><i class="jfont">&#xe815;</i>High standard</li>
								<li><i class="jfont">&#xe815;</i>City Centre</li>
							</ul>
						
						</div>
						<div class="col-xs-6 col-sm-4">
							<ul class="details-ticks">
								<li><i class="jfont">&#xe815;</i>nostrud exercitation</li>
								<li><i class="jfont">&#xe815;</i>nostrud exercitation</li>
								<li><i class="jfont">&#xe815;</i>nostrud exercitation</li>
								<li><i class="jfont">&#xe815;</i>nostrud exercitation</li>
							</ul>
						</div>
					</div>
					<div class="row margin-top-45">
						<div class="col-xs-12 apartment-tabs">
							
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#tab-map" aria-controls="tab-map" role="tab" data-toggle="tab">
										<span>Map</span>
										<div class="button-triangle2"></div>
									</a>
								</li>
								<li role="presentation">
									<a href="#tab-street-view" aria-controls="tab-street-view" role="tab" data-toggle="tab">
										<span>Street view</span>
										<div class="button-triangle2"></div>
									</a>
								</li>
							</ul>
								
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="tab-map">
									<div id="estate-map" class="details-map"></div>
								</div>
								<div role="tabpanel" class="tab-pane" id="tab-street-view">
									<div id="estate-street-view" class="details-map"></div>
								</div>
							</div>
						</div>
					</div> -->
					<div class="row margin-top-60">
						<div class="col-xs-12">
							<h3 class="title-negative-margin">Liên hệ môi giới<span class="special-color">.</span></h3>
							<div class="title-separator-primary"></div>
						</div>
					</div>
					<div class="row margin-top-60">
						<div class="col-xs-8 col-xs-offset-2 col-sm-3 col-sm-offset-0">
							<h5 class="subtitle-margin">Quản lý</h5>
							<h3 class="title-negative-margin">Ms. Vân<span class="special-color">.</span></h3>
							<!-- <a href="agent-right-sidebar.html" class="agent-photo">
								<img src="/frontend/images/agent3.jpg" alt="" class="img-responsive" />
							</a> -->
						</div>
						<div class="col-xs-12 col-sm-9">
							<div class="agent-social-bar">
								<div class="pull-left">
									<span class="agent-icon-circle">
										<i class="fa fa-phone"></i>
									</span>
									<a href="tel:{{ $config->getValueByKey('hot_line') }}"><span class="agent-bar-text">{{ $config->getValueByKey('hot_line') }}</span></a>
								</div>
								<div class="pull-left">
									<span class="agent-icon-circle">
										<i class="fa fa-envelope fa-sm"></i>
									</span>
									<a href="mailto:{{ $config->getValueByKey('address_received_mail') }}"><span class="agent-bar-text">{{ $config->getValueByKey('address_received_mail') }}</span></a>
								</div>
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
											<i class="fa fa-skype"></i>
										</a>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<form name="contact-from" action="#">
								<input name="name" type="text" class="input-long main-input" placeholder="Your name" />
								<input name="phone" type="text" class="input-short pull-right main-input" placeholder="Your phone" />
								<input name="mail" type="email" class="input-full main-input" placeholder="Your email" />
								<textarea name="message" class="input-full agent-textarea main-input" placeholder="Your question"></textarea>
								<div class="form-submit-cont">
									<a href="#" class="button-primary pull-right">
										<span>send</span>
										<div class="button-triangle"></div>
										<div class="button-triangle2"></div>
										<div class="button-icon"><i class="fa fa-paper-plane"></i></div>
									</a>
									<div class="clearfix"></div>
								</div>
							</form>
						</div>
					</div>
					
					<!-- <div class="row margin-top-90">
						<div class="col-xs-12 col-sm-9">
							<h5 class="subtitle-margin">hot</h5>
									<h1>new listings<span class="special-color">.</span></h1>
						</div>
						<div class="col-xs-12 col-sm-3">
							<a href="#" class="navigation-box navigation-box-next" id="grid-offers-owl-next"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
							<a href="#" class="navigation-box navigation-box-prev" id="grid-offers-owl-prev"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>
						</div>
						<div class="col-xs-12">
							<div class="title-separator-primary"></div>
						</div>
					</div>
					
					<div class="grid-offers-container">
						<div class="owl-carousel" id="grid-offers-owl">
							<div class="grid-offer-col">
								<div class="grid-offer">
									<div class="grid-offer-front">
									
										<div class="grid-offer-photo">
											<img src="/frontend/images/grid-offer1.jpg" alt="" />
											<div class="type-container">
												<div class="estate-type">apartment</div>
												<div class="transaction-type">sale</div>
											</div>
										</div>
										<div class="grid-offer-text">
											<i class="fa fa-map-marker grid-offer-localization"></i>
											<div class="grid-offer-h4"><h4 class="grid-offer-title">34 Fort Collins, Colorado 80523, USA</h4></div>
											<div class="clearfix"></div>
											<p>Lorem ipsum dolor sit amet, conse ctetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et [...]</p>
											<div class="clearfix"></div>
										</div>
										<div class="price-grid-cont">
											<div class="grid-price-label pull-left">Price:</div>
											<div class="grid-price pull-right">
												$ 320 000
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="grid-offer-params">
											<div class="grid-area">
												<img src="/frontend/images/area-icon.png" alt="" />54m<sup>2</sup>
											</div>
											<div class="grid-rooms">
												<img src="/frontend/images/rooms-icon.png" alt="" />3
											</div>
											<div class="grid-baths">
												<img src="/frontend/images/bathrooms-icon.png" alt="" />1
											</div>							
										</div>	
										
									</div>
									<div class="grid-offer-back">
										<div id="grid-map1" class="grid-offer-map"></div>
										<div class="button">	
											<a href="estate-details-right-sidebar.html" class="button-primary">
												<span>read more</span>
												<div class="button-triangle"></div>
												<div class="button-triangle2"></div>
												<div class="button-icon"><i class="fa fa-search"></i></div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="grid-offer-col">
								<div class="grid-offer">
									<div class="grid-offer-front">
										<div class="grid-offer-photo">
											<img src="/frontend/images/grid-offer2.jpg" alt="" />
											<div class="type-container">
												<div class="estate-type">apartment</div>
												<div class="transaction-type">sale</div>
											</div>
										</div>
										<div class="grid-offer-text">
											<i class="fa fa-map-marker grid-offer-localization"></i>
											<div class="grid-offer-h4"><h4 class="grid-offer-title">West Fourth Street, New York 10003, USA</h4></div>
											<div class="clearfix"></div>
											<p>Lorem ipsum dolor sit amet, conse ctetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et [...]</p>
											<div class="clearfix"></div>
										</div>
										<div class="price-grid-cont">
											<div class="grid-price-label pull-left">Price:</div>
											<div class="grid-price pull-right">
												$ 299 000
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="grid-offer-params">
											<div class="grid-area">
												<img src="/frontend/images/area-icon.png" alt="" />48m<sup>2</sup>
											</div>
											<div class="grid-rooms">
												<img src="/frontend/images/rooms-icon.png" alt="" />2
											</div>
											<div class="grid-baths">
												<img src="/frontend/images/bathrooms-icon.png" alt="" />1
											</div>							
										</div>	
									</div>
									<div class="grid-offer-back">
										<div id="grid-map2" class="grid-offer-map"></div>
										<div class="button">	
											<a href="estate-details-right-sidebar.html" class="button-primary">
												<span>read more</span>
												<div class="button-triangle"></div>
												<div class="button-triangle2"></div>
												<div class="button-icon"><i class="fa fa-search"></i></div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="grid-offer-col">
								<div class="grid-offer">
									<div class="grid-offer-front">
										<div class="grid-offer-photo">
											<img src="/frontend/images/grid-offer3.jpg" alt="" />
											<div class="type-container">
												<div class="estate-type">apartment</div>
												<div class="transaction-type">sale</div>
											</div>
										</div>
										<div class="grid-offer-text">
											<i class="fa fa-map-marker grid-offer-localization"></i>
											<div class="grid-offer-h4"><h4 class="grid-offer-title">E. Elwood St. Phoenix, AZ 85034, USA</h4></div>
											<div class="clearfix"></div>
											<p>Lorem ipsum dolor sit amet, conse ctetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et [...]</p>
											<div class="clearfix"></div>
										</div>
										<div class="price-grid-cont">
											<div class="grid-price-label pull-left">Price:</div>
											<div class="grid-price pull-right">
												$ 400 000
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="grid-offer-params">
											<div class="grid-area">
												<img src="/frontend/images/area-icon.png" alt="" />93m<sup>2</sup>
											</div>
											<div class="grid-rooms">
												<img src="/frontend/images/rooms-icon.png" alt="" />4
											</div>
											<div class="grid-baths">
												<img src="/frontend/images/bathrooms-icon.png" alt="" />2
											</div>							
										</div>	
									</div>
									<div class="grid-offer-back">
										<div id="grid-map3" class="grid-offer-map"></div>
										<div class="button">	
											<a href="estate-details-right-sidebar.html" class="button-primary">
												<span>read more</span>
												<div class="button-triangle"></div>
												<div class="button-triangle2"></div>
												<div class="button-icon"><i class="fa fa-search"></i></div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="grid-offer-col">
								<div class="grid-offer">
									<div class="grid-offer-front">
										<div class="grid-offer-photo">
											<img src="/frontend/images/grid-offer4.jpg" alt="" />
											<div class="type-container">
												<div class="estate-type">house</div>
												<div class="transaction-type">sale</div>
											</div>
										</div>
										<div class="grid-offer-text">
											<i class="fa fa-map-marker grid-offer-localization"></i>
											<div class="grid-offer-h4"><h4 class="grid-offer-title">N. Willamette Blvd., Portland, OR 97203, USA</h4></div>
											<div class="clearfix"></div>
											<p>Lorem ipsum dolor sit amet, conse ctetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et [...]</p>
											<div class="clearfix"></div>
										</div>
										<div class="price-grid-cont">
											<div class="grid-price-label pull-left">Price:</div>
											<div class="grid-price pull-right">
												$ 800 000
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="grid-offer-params">
											<div class="grid-area">
												<img src="/frontend/images/area-icon.png" alt="" />300m<sup>2</sup>
											</div>
											<div class="grid-rooms">
												<img src="/frontend/images/rooms-icon.png" alt="" />8
											</div>
											<div class="grid-baths">
												<img src="/frontend/images/bathrooms-icon.png" alt="" />3
											</div>							
										</div>	
									</div>
									<div class="grid-offer-back">
										<div id="grid-map4" class="grid-offer-map"></div>
										<div class="button">	
											<a href="estate-details-right-sidebar.html" class="button-primary">
												<span>read more</span>
												<div class="button-triangle"></div>
												<div class="button-triangle2"></div>
												<div class="button-icon"><i class="fa fa-search"></i></div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="grid-offer-col">
								<div class="grid-offer">
									<div class="grid-offer-front">
										<div class="grid-offer-photo">
											<img src="/frontend/images/grid-offer5.jpg" alt="" />
											<div class="type-container">
												<div class="estate-type">apartment</div>
												<div class="transaction-type">sale</div>
											</div>
										</div>
										<div class="grid-offer-text">
											<i class="fa fa-map-marker grid-offer-localization"></i>
											<div class="grid-offer-h4"><h4 class="grid-offer-title">One Brookings Drive St. Louis, Missouri 63130, USA</h4></div>
											<div class="clearfix"></div>
											<p>Lorem ipsum dolor sit amet, conse ctetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et [...]</p>
											<div class="clearfix"></div>
										</div>
										<div class="price-grid-cont">
											<div class="grid-price-label pull-left">Price:</div>
											<div class="grid-price pull-right">
												$ 320 000
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="grid-offer-params">
											<div class="grid-area">
												<img src="/frontend/images/area-icon.png" alt="" />50m<sup>2</sup>
											</div>
											<div class="grid-rooms">
												<img src="/frontend/images/rooms-icon.png" alt="" />2
											</div>
											<div class="grid-baths">
												<img src="/frontend/images/bathrooms-icon.png" alt="" />1
											</div>							
										</div>	
									</div>
									<div class="grid-offer-back">
										<div id="grid-map5" class="grid-offer-map"></div>
										<div class="button">	
											<a href="estate-details-right-sidebar.html" class="button-primary">
												<span>read more</span>
												<div class="button-triangle"></div>
												<div class="button-triangle2"></div>
												<div class="button-icon"><i class="fa fa-search"></i></div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="grid-offer-col">
								<div class="grid-offer">
									<div class="grid-offer-front">
										<div class="grid-offer-photo">
											<img src="/frontend/images/grid-offer7.jpg" alt="" />
											<div class="type-container">
												<div class="estate-type">house</div>
												<div class="transaction-type">sale</div>
											</div>
										</div>
										<div class="grid-offer-text">
											<i class="fa fa-map-marker grid-offer-localization"></i>
											<div class="grid-offer-h4"><h4 class="grid-offer-title">One Neumann Drive Aston, Philadelphia 19014, USA</h4></div>
											<div class="clearfix"></div>
											<p>Lorem ipsum dolor sit amet, conse ctetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et [...]</p>
											<div class="clearfix"></div>
										</div>
										<div class="price-grid-cont">
											<div class="grid-price-label pull-left">Price:</div>
											<div class="grid-price pull-right">
												$ 500 000
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="grid-offer-params">
											<div class="grid-area">
												<img src="/frontend/images/area-icon.png" alt="" />210m<sup>2</sup>
											</div>
											<div class="grid-rooms">
												<img src="/frontend/images/rooms-icon.png" alt="" />6
											</div>
											<div class="grid-baths">
												<img src="/frontend/images/bathrooms-icon.png" alt="" />2
											</div>							
										</div>	
									</div>
									<div class="grid-offer-back">
										<div id="grid-map6" class="grid-offer-map"></div>
										<div class="button">	
											<a href="estate-details-right-sidebar.html" class="button-primary">
												<span>read more</span>
												<div class="button-triangle"></div>
												<div class="button-triangle2"></div>
												<div class="button-icon"><i class="fa fa-search"></i></div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<div class="margin-top-45"></div>
				</div>
			</div>
		</div>
	</section>
@endsection