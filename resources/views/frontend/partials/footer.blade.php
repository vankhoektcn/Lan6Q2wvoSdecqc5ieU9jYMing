	<footer class="large-cont">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-lg-6">
					<!-- <h4 class="second-color">Landing<span class="special-color">.</span></h4> -->
					<div class="">
						<img src="/frontend/images/logo-landing.png" alt="" class="img-responsive">
					</div>
					<div class="footer-title-separator">
					</div>
					<div class="quote-box">
						<p>Landing Việt Nam, nơi mà khách hàng không phải đau đầu bất cứ một vấn đề gì dù là nhỏ nhất về  đầu tư, mua bán, sang nhượng, cho thuê bất động sản…. Tất cả mọi công việc đau đầu đó đã có Landing Việt Nam đảm nhận thay cho khách hàng. Đến với Landing Việt Nam khách hàng sẽ tiết kiệm được rất nhiều thời gian, tiền bạc, công sức, và được cung cấp đầy đủ, chân thật mọi thông tin về dự án nói riêng và thị trường bất động sản nói chung. Những quyết định mua bán của khách hàng đưa ra sẽ chính xác nhất mà không phải hối tiếc về sau. “Đó Cũng Chính Là Kim Chỉ Nam Của Landing Việt Nam Từ Ngày Thành Lập.</p>
						<div class="small-triangle"></div>
						<div class="small-icon"><i class="fa fa-quote-right"></i></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="col-xs-12 col-sm-6 col-lg-3">
					<h4 class="second-color">Tin cập nhật<span class="special-color">.</span></h4>
					<div class="footer-title-separator"></div>
					<div class="row">
					@if(isset($newArticleType))
						@foreach($newArticleType->articles()->take(3)->get() as $key=>$article)
						<div class="col-xs-6 col-sm-12">
							<article>
								<div class=""><a href="{{$article->getLink()}}">{{$article->name}}</a></div>
								<div class="clearfix"></div>					
							</article>
							<div class="footer-blog-separator hidden-xs"></div>
						</div>
						@endforeach
					@endif
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-lg-3">
					<h4 class="second-color">Lịch làm việc<span class="special-color">.</span></h4>
					<div class="footer-title-separator"></div>
					<div class="textwidget">
						<p>Chúng tôi luôn hỗ trợ Quý khách 24/24<br> 
						<i class="fa fontawesome-icon fa-phone-square circle-no" style="font-size:18px;margin-right:9px;color:#ec8d38;"></i> Hotline: {{ $config->getValueByKey('hot_line') }}<br> 
						<i class="fa fontawesome-icon fa-fax circle-no" style="font-size:18px;margin-right:9px;color:#ec8d38;"></i> CSKH: {{ $config->getValueByKey('headquarter_phone_number') }}</p>
						<i class="fa fontawesome-icon fa-phone-square circle-no" style="font-size:18px;margin-right:9px;color:#ec8d38;"></i> Địa chỉ: {{ $config->getFullAddress() }}<br> 
						<i class="fa fontawesome-icon fa-envelope circle-no" style="font-size:18px;margin-right:9px;color:#ec8d38;"></i> Email: <a href="mailto:{{ $config->getValueByKey('address_received_mail') }}">{{ $config->getValueByKey('address_received_mail') }}</a>
						</p>
						<h5 style="margin-top: 1em; margin-bottom: 0.5em;" data-fontsize="16" data-lineheight="22"><span style="font-weight: 400; color: #ddd;">GIỜ MỞ CỬA</span></h5>
						<p>Chúng tôi luôn hỗ trợ Quý khách 24/24<br> 
						<ul>
							<li><strong><span style="color: #ec8d38;">Thứ 2-Thứ 6:</span> </strong>8h00' đến 17h30'</li>
							<li><strong><span style="color: #ec8d38;">Thứ 7:</span> </strong>8h00' đến 17h30'</li>
							<li><strong><span style="color: #ec8d38;">Chủ nhật:</span> </strong>8h00' đến 17h30'</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
    </footer>
	<footer class="small-cont">
		<div class="container">
			<div class="row">
				<!-- <div class="col-xs-12 col-md-6 small-cont">
					<img src="/frontend/images/logo-light.png" alt="" class="img-responsive footer-logo" />
				</div> -->
				<div class="col-xs-12 col-md-6 footer-copyrights">
					&copy; Copyright 2018  Website by <a href="/" target="blank">Landing Việt Nam</a>. All rights reserved.
				</div>
			</div>
		</div>
	</footer>