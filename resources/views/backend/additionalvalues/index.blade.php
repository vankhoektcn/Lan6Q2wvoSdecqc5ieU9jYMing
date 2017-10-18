@extends('backend.layouts.master')

@section('title', 'Giá trị bổ sung')

@section('plugins.css')

@endsection

@section('content.head')
<section class="content-header">
	<h1>
		Giá Trị Bổ Sung
		<!-- <small>Optional description</small> -->
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Màn hình chính</a></li>
		<li class="active">Giá trị bổ sung</li>
	</ol>
</section>
@endsection

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header">
				<button type="button" class="btn btn-sm btn-success btn-flat pull-left" data-toggle="modal" data-target="#modalEntry">Thêm mới</button>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table id="tblEntryList" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Tên Loại</th>
							<th>Thứ tự</th>
							<th>Xuất bản</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalEntry"  tabindex="-1" role="dialog" aria-labelledby="modalEntry" data-backdrop="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="entry-form" class="form-horizontal" action="{{ route('additionalvalues.store') }}">
				<input type="hidden" id="_method" name="_method" value="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalEntryHeader">---</h4>
				</div>
				<div class="modal-body">
					<div id="modalEntryContent">
					<!-- body entry -->
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success btn-flat" id="btnSave">Hoàn tất</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('plugins.js')

@endsection

@section('javascript.customize')
<script src="/backend/js/additionalvalues/ketnoimoi.additionalvalues.index.js" type="text/javascript"></script>
@endsection