@inject('config', '\App\Config')
@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')

	<!-- <section class="short-image no-padding contact-short-title">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-lg-12 short-image-title">
					<h5 class="subtitle-margin second-color">get in touch</h5>
					<h1 class="second-color">Contact Us</h1>
					<div class="short-title-separator"></div>
				</div>
			</div>
		</div>
		
    </section> -->
    <section style="padding: 0;">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.0895370892677!2d106.71763667726546!3d10.804454180648413!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528a0d0de077b%3A0xfade8754d66c0878!2zODIgVW5nIFbEg24gS2hpw6ptLCBQaMaw4budbmcgMjUsIELDrG5oIFRo4bqhbmgsIEjhu5MgQ2jDrSBNaW5oLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1514048909356" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
	</section>
	
	<section class="section-light section-both-shadow top-padding-45">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-6 margin-top-45">
					<p class="negative-margin">Landing Việt Nam, nơi mà khách hàng không phải đau đầu bất cứ một vấn đề gì dù là nhỏ nhất về đầu tư, mua bán, sang nhượng, cho thuê bất động sản…. Tất cả mọi công việc đau đầu đó đã có Landing Việt Nam đảm nhận thay cho khách hàng. Đến với Landing Việt Nam khách hàng sẽ tiết kiệm được rất nhiều thời gian, tiền bạc, công sức, và được cung cấp đầy đủ, chân thật mọi thông tin về dự án nói riêng và thị trường bất động sản nói chung. </p>
					<img src="images/contact-image.jpg" alt="" class="pull-left margin-top-45" />
					<address class="contact-info pull-left">
						<span><i class="fa fa-map-marker"></i>{{ $config->getFullAddress() }}</span>
						<span><i class="fa fa-envelope"></i><a href="#">{{ $config->getValueByKey('address_received_mail') }}</a></span>
						<span><i class="fa fa-phone"></i><a href="tel:{{ $config->getValueByKey('hot_line') }}">{{ $config->getValueByKey('hot_line') }}</a></span>
						<span><i class="fa fa-globe"></i><a href="/">http://landing.com.vn</a></span>
						<span><i class="fa fa-clock-o"></i>mon-fri: 8:00 - 18:00</span>
						<span class="span-last">sat: 10:00 - 16:00</span>
					</address>
				</div>
				<div class="col-xs-12 col-md-6 margin-top-45">
					<form name="contact-from" id="contact-form" action="#" method="get">
								<div id="form-result"></div>
								<input type="hidden" name="csrf-token" id="csrf-token" value="{{ csrf_token() }}">
								<input name="name" id="name" type="text" class="input-short main-input required,all" placeholder="Họ tên" />
								<input name="phone" id="phone" type="text" class="input-short pull-right main-input required,all" placeholder="Điện thoại" />
								<input name="mail" id="mail" type="email" class="input-full main-input required,email" placeholder="Email" />
								<input name="subject" id="subject" type="text" class="input-full main-input required,all" placeholder="Tiêu đề" />
								<textarea name="message" id="message" class="input-full contact-textarea main-input required,email" placeholder="Nội dung"></textarea>
								<div class="form-submit-cont">
									<a href="#" class="button-primary pull-right" id="form-submit">
										<span>Gửi yêu cầu</span>
										<div class="button-triangle"></div>
										<div class="button-triangle2"></div>
										<div class="button-icon"><i class="fa fa-paper-plane"></i></div>
									</a>
									<div class="clearfix"></div>
								</div>
							</form>
				</div>
				
				
			</div>
		</div>
	</section>
	
	<!-- <section class="contact-map2" id="contact-map2">
	</section> -->

@section('plugins.js')
@endsection

@section('customize.js')
	<!-- google maps initialization -->	
	<!-- <script type="text/javascript">
            google.maps.event.addDomListener(window, 'load', init);
			function init() {						
				mapInit(41.6926,-87.6021,"contact-map2","images/pin-contact.png", true);
			}
	</script>-->	
@endsection

@endsection