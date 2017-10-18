@extends('backend.layouts.master')

@section('head.title', 'Cập nhật thông tin tỉnh/thành phố')

@section('head.pluginstyle')
<link href="/admin/assets/global/plugins/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet" type="text/css">
<link href="/admin/assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css">
<link href="/admin/assets/global/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css">
@endsection

@section('body.content')
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE HEAD -->
<div class="page-head">
	<!-- BEGIN PAGE TITLE -->
	<div class="page-title">
		<h1>Cập nhật thông tin tỉnh/thành phố <small>{{ $province->name }}</small></h1>
	</div>
	<!-- END PAGE TITLE -->
</div>
<!-- END PAGE HEAD -->
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
	<li>
		<a href="{{ route('admin.dashboard.index') }}">Màn hình chính</a>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<a href="{{ route('provinces.index') }}">Tỉnh/thành phố</a>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<a href="{{ route('provinces.edit', ['id' => $province->id]) }}">{{ $province->name }}</a>
	</li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-body form">
				@include('admin.partials.errors')
				{!! Form::open([
					'id' => 'province-form',
					'route' => ['provinces.update', $province->id],
					'class' => 'form-horizontal',
					'role'	=>	'form',
					'method' => 'PUT'
				]) !!}
				<div class="form-body">
					
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn green-jungle"><i class="fa fa-floppy-o"></i>&nbsp;Lưu thao tác</button>
						</div>
					</div>
				</div>
				{!! Form::close() !!}
		 	</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT-->
@endsection

@section('body.jsplugins')
<script type="text/javascript" src="/admin/assets/global/plugins/bootstrap-fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="/admin/assets/global/plugins/bootstrap-summernote/summernote.min.js"></script>
<script type="text/javascript" src="/admin/assets/global/plugins/jstree/dist/jstree.min.js"></script>
@endsection

@section('body.js')
<script type="text/javascript">
	var _manualInitLayout = true;
</script>
<script src="/admin/assets/customs/scripts/ccontrol.js" type="text/javascript"></script>
<script src="/admin/assets/pages/provinces/crazyify.provinces.entry.js" type="text/javascript"></script>
@endsection