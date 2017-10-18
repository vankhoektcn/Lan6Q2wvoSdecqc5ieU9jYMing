@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
			<div class="page">
				<div class="page_header clearfix page_margin_top">
					<div class="page_header_left">
						<h1 class="page_title">Tìm kiếm "{{ Request::input('keyword') }}"</h1>
					</div>
					<div class="page_header_right">
						<ul class="bread_crumb">
							<li>
								<a title="Home" href="home.html">
									Trang chủ
								</a>
							</li>
							<li class="separator icon_small_arrow right_gray">
								&nbsp;
							</li>
							<li>
								Tìm kiếm "{{ Request::input('keyword') }}"
							</li>
						</ul>
					</div>
				</div>
				<div class="page_layout clearfix">
					<div class="divider_block clearfix">
						<hr class="divider first">
						<hr class="divider subheader_arrow">
						<hr class="divider last">
					</div>
					<div class="row">
						<div class="column column_2_3">
							<div class="row">
								@include('frontend.partials1.blogBigArticles')
							</div>
							<ul class="pagination clearfix page_margin_top_section">
								<li class="left">
									<a href="#" title="">&nbsp;</a>
								</li>
								<li class="selected">
									<a href="#" title="">
										1
									</a>
								</li>
								<li>
									<a href="#" title="">
										2
									</a>
								</li>
								<li>
									<a href="#" title="">
										3
									</a>
								</li>
								<li class="right">
									<a href="#" title="">&nbsp;</a>
								</li>
							</ul>
						</div>
						<div class="column column_1_3 page_margin_top">
							@if($parentCategory)
								<h4 class="box_header">{{$parentCategory->name}}</h4>
								@foreach($parentCategory->childrens()->where('published', 1)->get() as $key => $category)
								@include('frontend.partials1.parentCategoryBox')				
								@endforeach
							@endif

							<h4 class="box_header @if($parentCategory)page_margin_top_section @endif">Mới nhất</h4>
							@include('frontend.partials1.newPosts13')
							@if(isset($myPublic))
								<h4 class="box_header page_margin_top_section"><a href="{{$myPublic->getLink()}}" title="{{$myPublic->name}}">{{$myPublic->name}}</a></h4>
								@foreach($myPublic->childrens()->where('published', 1)->get() as $key => $category)
								@include('frontend.partials1.parentCategoryBox')				
								@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>
@endsection