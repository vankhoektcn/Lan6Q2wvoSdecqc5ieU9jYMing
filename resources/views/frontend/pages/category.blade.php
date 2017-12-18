@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
	@include('frontend.partials.breadcrumb')
	
	<section class="section-light padt3x">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-9">
							<div class="masonry-grid masonry-grid-short">
									<!-- width of .grid-sizer used for columnWidth -->
									<div class="masonry-grid-sizer"></div>
									@foreach($mainArticles as $key => $article)
									@include('frontend.partials.gridArticles')
									@endforeach
								</div>
								{!! $mainArticles->render() !!}
						<!-- <div class="offer-pagination margin-top-15">
							<a href="#" class="prev"><i class="jfont">&#xe800;</i></a>
							<a class="active">1</a><a href="#">2</a>
							<a href="#">3</a><a href="#">4</a>
							<a href="#" class="next"><i class="jfont">&#xe802;</i></a>
							<div class="clearfix"></div>
						</div> -->
				</div>
				<div class="col-xs-12 col-md-3">
					<div class="sidebar">
						@include('frontend.partials.sidebarCategories')

						@include('frontend.partials.sidebarLastestNews')
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection