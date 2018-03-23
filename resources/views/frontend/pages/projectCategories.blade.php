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
						<div class="row">
							<div class="col-xs-12 col-lg-6">
								<!-- <h5 class="subtitle-margin">apartments for sale, colorodo, usa</h5> -->
								<h1>{{$category->name}}<span class="special-color">.</span></h1>
							</div>						
							<div class="col-xs-12">
								<div class="title-separator-primary"></div>
							</div>
						</div>
						<div class="row list-offer-row">
							<div class="col-xs-12">
							@foreach($projects as $key=>$project)
								@include('frontend.partials.listProjects')
							@endforeach
                            {!! $projects->render() !!}
						        <div class="margin-top-45"></div>
							</div>
						</div>
						
				</div>
				<div class="col-xs-12 col-md-3">
                    @include('frontend.partials.projectArticleSidebar')                
				</div>
			</div>
		</div>
	</section>
@endsection