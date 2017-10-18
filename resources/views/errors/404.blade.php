@extends('frontend.layouts.master')

@section('customize.js.head')
@endsection

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')

    <section class="short-image no-padding blog-short-title">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-lg-12 short-image-title">
					<h5 class="subtitle-margin second-color">ERROR 404</h5>
					<h1 class="second-color">Không tìm thấy trang</h1>
					<div class="short-title-separator"></div>
				</div>
			</div>
		</div>
		
    </section>
	
	<section class="section-light section-top-shadow">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h1 class="huge-header">404<span class="special-color">.</span></h1>
					<h1 class="error-subtitle text-color4">Page not found</h1>
					
					<p class="margin-top-105 centered-text">Trang bạn đang tìm kiếm không tồn tại hoặc đã được gỡ bỏ.</p>
					<p class="centered-text">Trở về <strong><a href="index-2.html">TRANG CHỦ</a></strong> hoặc quay lại <strong><a href="javascript:history.back()">TRANG TRƯỚC</a></strong></p>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection