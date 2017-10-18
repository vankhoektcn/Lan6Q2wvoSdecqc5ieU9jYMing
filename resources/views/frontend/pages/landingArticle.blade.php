@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
	<section class="section-dark no-padding">
		<div class="container">
			<div class="row">
				<ol class="breadcrumb mrgb0">
				    <li><a href="/">Trang chủ</a></li>
				    @if($landingArticle)
				    <li class="active">{{$landingArticle->name}}</li>
				    @endif
				  </ol>
			</div>
		</div>
    </section>
	@if($landingArticle)
		{!! $landingArticle->content !!} 
	@endif
@endsection