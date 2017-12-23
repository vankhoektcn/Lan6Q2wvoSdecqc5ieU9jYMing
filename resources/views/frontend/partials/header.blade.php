@inject('config', '\App\Config')
@inject('projectCategory', '\App\ProjectCategory')
@inject('articleCategory', '\App\ArticleCategory')

<?php 
	$sangNhuong = $projectCategory::findByKey('can-ho-sang-nhuong')->first();
	$choThue = $projectCategory::findByKey('can-ho-cho-thue')->first();
	$parentArticleCategories = $articleCategory::where('published', 1)->where('parent_id', 0)->orderBy('priority')->get();
?>
<!-- Page header -->
	<header>
		<div class="top-bar-wrapper">
			<div class="container top-bar">
				<div class="row">
					<div class="col-xs-5 col-sm-8">
						<div class="top-mail pull-left hidden-xs">
							<span class="top-icon-circle">
								<i class="fa fa-envelope fa-sm"></i>
							</span>
							<span class="top-bar-text">{{ $config->getValueByKey('address_received_mail') }}</span>
						</div>
						<div class="top-phone pull-left hidden-xxs">
							<span class="top-icon-circle">
								<i class="fa fa-phone"></i>
							</span>
							<span class="top-bar-text">{{ $config->getValueByKey('hot_line') }}</span>
						</div>
						<div class="top-localization pull-left hidden-sm hidden-md hidden-xs">
							<span class="top-icon-circle pull-left">
								<i class="fa fa-map-marker"></i>
							</span>
							<span class="top-bar-text">{{ $config->getFullAddress() }}</span>
						</div>
					</div>
					<div class="col-xs-7 col-sm-4">
						<div class="top-social-last top-dark pull-right" data-toggle="tooltip" data-placement="bottom" title="Login/Register">
							<a class="top-icon-circle" href="#login-modal" data-toggle="modal">
								<i class="fa fa-lock"></i>
							</a>
						</div>
						
						<div class="top-social pull-right">
							<a class="top-icon-circle" href="{{ $config->getValueByKey('facebook_page') }}">
								<i class="fa fa-facebook"></i>
							</a>
						</div>
						<div class="top-social pull-right">
							<a class="top-icon-circle" href="{{ $config->getValueByKey('twitter_page') }}">
								<i class="fa fa-twitter"></i>
							</a>
						</div>
						<div class="top-social pull-right">
							<a class="top-icon-circle" href="{{ $config->getValueByKey('plus_google') }}">
								<i class="fa fa-google-plus"></i>
							</a>
						</div>
						<div class="top-social pull-right">
							<a class="top-icon-circle" href="{{ $config->getValueByKey('linkedin_page') }}">
								<i class="fa fa-skype"></i>
							</a>
						</div>
					</div>
				</div>
			</div><!-- /.top-bar -->	
		</div><!-- /.Page top-bar-wrapper -->	
		<nav class="navbar main-menu-cont">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar icon-bar1"></span>
						<span class="icon-bar icon-bar2"></span>
						<span class="icon-bar icon-bar3"></span>
					</button>
					<a href="/" title="" class="navbar-brand">
						<img src="/frontend/images/logo-landing.png" style="max-height: 100px;" alt="Landing Viêt Nam" />
					</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="{{route('landingArticle', 'gioi-thieu')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Landing</a>
							<ul class="dropdown-menu">
								<li><a href="{{route('landingArticle', 'gioi-thieu')}}">Giới thiệu</a></li>
								<li><a href="{{route('landingArticle', 'goc-nhin-landing-ve-bat-dong-san')}}">Góc nhìn Landing về bất động sản</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dự án</a>
							<ul class="dropdown-menu">
								@foreach($projectCategory->where('published', 1)->orderBy('priority')->get() as $category)
								<li class="">
									<a tabindex="-1" href="{{$category->getLink()}}">{{$category->name}}</a>
								</li>
								@endforeach
							</ul>
						</li>
						<li class="">
							<a href="{{$sangNhuong->getLink()}}" class="">Sang nhượng</a>
						</li>
						<li class="">
							<a href="{{$choThue->getLink()}}" class="">Cho thuê</a>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tin tức</a>
							<ul class="dropdown-menu">
								@foreach($parentArticleCategories as $pACategory)
								<li class="@if($pACategory->hasChildrens()) dropdown-submenu @endif">								
									<a tabindex="-1" href="{{$pACategory->getLink()}}">{{$pACategory->name}}</a>
									@if($pACategory->hasChildrens())
									<ul class="dropdown-menu">
										@foreach($pACategory->childrens as $aCategory)
										<li><a href="{{$aCategory->getLink()}}">{{$aCategory->name}}</a></li>
										@endforeach
									</ul>
									@endif
								</li>
								@endforeach
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="" >Tuyển dụng</a>
						</li>
						<li><a href="submit-property.html" class="special-color">Liên hệ</a></li>
					</ul>
				</div>
			</div>
		</nav><!-- /.mani-menu-cont -->	
    </header>