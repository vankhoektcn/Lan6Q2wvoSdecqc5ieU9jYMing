if (typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if (typeof ketnoimoi.testimonials == 'undefined')
	ketnoimoi.testimonials = {};

ketnoimoi.testimonials.index = {
	table: null,
	commonControls: [
	{
		'label': 'Thông tin chung',
		'type': 'divider'
	},
	{
		'label': 'Thứ tự ưu tiên',
		'id': 'priority',
		'name': 'Testimonial[priority]',
		'type': 'number',
		'required': false,
		'placeholder': '',
		'cssclass': '',
		'value': '0',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'priority'
	},
	{
		'label': 'Hình ảnh',
		'id': 'attachments',
		'name': 'Testimonial[attachments]',
		'type': 'inputimages',
		'required': false,
		'placeholder': '',
		'cssclass': '',
		'value': '',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'attachments',
		'selected': true
	},
	{
		'label': 'Xuất bản',
		'id': 'published',
		'name': 'Testimonial[published]',
		'type': 'checkbox',
		'required': false,
		'placeholder': '',
		'cssclass': '',
		'value': '1',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'published',
		'selected': true
	},
	{
		'label': 'Tạo bởi',
		'id': 'created_by',
		'name': 'Testimonial[created_by]',
		'type': 'static',
		'placeholder': 'Tạo bởi',
		'cssclass': '',
		'value': '',
		'disabled': true,
		'readonly': true,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'created_by'
	},
	{
		'label': 'Cập nhật bởi',
		'id': 'updated_by',
		'name': 'Testimonial[updated_by]',
		'type': 'static',
		'placeholder': 'Cập nhật bởi',
		'cssclass': '',
		'value': '',
		'disabled': true,
		'readonly': true,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'updated_by'
	}
	],
	languageControls: [
	{
		'label': 'Họ tên',
		'id': 'full_name',
		'name': 'Testimonial[TestimonialTranslation][locale][full_name]',
		'type': 'text',
		'required': true,
		'placeholder': 'Họ tên',
		'cssclass': '',
		'value': '',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'full_name'
	},
	{
		'label': 'Tiêu đề',
		'id': 'job_title',
		'name': 'Testimonial[TestimonialTranslation][locale][job_title]',
		'type': 'text',
		'required': false,
		'placeholder': '',
		'cssclass': '',
		'value': '',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'job_title'
	},
	{
		'label': 'Công ty',
		'id': 'company_name',
		'name': 'Testimonial[TestimonialTranslation][locale][company_name]',
		'type': 'text',
		'required': false,
		'placeholder': '',
		'cssclass': '',
		'value': '',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'company_name'
	},
	{
		'label': 'Nhận xét',
		'id': 'meta_keywords',
		'name': 'Testimonial[TestimonialTranslation][locale][content]',
		'type': 'textarea',
		'required': false,
		'placeholder': '',
		'cssclass': '',
		'value': '',
		'disabled': false,
		'readonly': false,
		'datas': [],
		'help_block': '',
		'input_icon': '',
		'dbfieldname': 'content'
	}
	],
	init: function () {
		var thisObj = ketnoimoi.testimonials.index;
		thisObj.initTable();
		thisObj.events();
	},
	initTable: function () {
		var thisObj = ketnoimoi.testimonials.index;

		thisObj.table = new CDatatable({
			tableId: '#tblEntryList',
			url: '/backend/testimonials/filter',
			params: null,
			data: [],
			rowId: 'id',
			columns: [
			{ 
				data: "attachments",
				render: function (data, type, row) {
					if (type=== 'display' && data && data.length) {
						data.sort($.sortByProperty('priority'));
						return  $.format('<a href="#" data-toggle="modal" data-target="#modalEntry" data-id="{0}"><img src="/imagecache/small/{1}" class="img-responsive"></a>', row.id, data[0].path);
					}
					return data;
				}
			},
			{ 
				data: "full_name",
				render: function (data, type, row) {
					if(type === 'display'){
						return  $.format('<a href="#" data-toggle="modal" data-target="#modalEntry" data-id="{0}">{1}</a>', row.id, data);
					}
					return data;
				}
			},
			{ data: 'job_title'},
			{ data: 'company_name'},
			{ 
				data: 'priority',
				className: 'text-right',
			},
			{ 
				data: 'published',
				className: 'text-center',
				render: function (data, type, row) {
					if(type === 'display'){
						if(data){
							return $.format('<a href="javascript:;" data-action="unpublish" data-id="{0}" data-toggle="tooltip" data-placement="top" title="Xuất bản"><i class="fa fa-check-square-o text-green" aria-hidden="true"></i></a>', row.id);
						}
						else{
							return $.format('<a href="javascript:;" data-action="publish" data-id="{0}" data-toggle="tooltip" data-placement="top" title="Không xuất bản"><i class="fa fa-square-o text-yellow" aria-hidden="true"></i></a>', row.id);
						}
					}
					return data;	
				}
			},
			{
				data: null,
				className: 'text-center',
				render: function (data, type, row) {
					if (type === 'display') {
						return $.format('<a href="javascript:;" data-action="delete" data-id="{0}" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash text-red fa-lg"></i></a>', row.id);
					}
					return data;
				}
			}]
		});		
	thisObj.table.init();
},
events: function () {
	var thisObj = ketnoimoi.testimonials.index;

	$(document).on('click', 'a[data-action]', function (argument) {
		var dataId = $(this).data('id');
		var action = $(this).data('action');
		switch(action){
			case 'delete':
			bootbox.confirm("Bạn thật sự muốn xóa đối tượng này?", function(result) {
				if (result) {
					thisObj.delete(dataId);
				}
			});
			break;
			default:
			break;
		};
	});

	$('#modalEntry').on('shown.bs.modal', function (event) {
			var control = $(event.relatedTarget);
			var dataId = control.data('id');
			var modal = $(this);
			// if update
			if (dataId) {
				// update attribute form
				$('#entry-form').attr('action', '/backend/testimonials/' + dataId);
				$('#entry-form #_method').val('PATCH');

				var data = thisObj.table.getdata(dataId);

				$.ketnoimoiAjax({
					url: $('#entry-form').attr('action'),
					type: 'GET',
					success: function (data, textStatus, jqXHR) {
						CControl.init({
							dom:$('#modalEntryContent'), 
							commonControls: thisObj.commonControls, 
							languageControls: thisObj.languageControls,
							commonData: data,
							languageDatas: data.translations
						});
					}
				});
				modal.find('#modalEntryHeader').text('Đối tượng: ' + data.full_name);
			}
			else{
				// update attribute form
				$('#entry-form').attr('action', '/backend/testimonials');
				$('#entry-form #_method').val('POST');
				$('#entry-form')[0].reset();

				modal.find('#modalEntryHeader').text('Đối tượng mới')

				CControl.init({
					dom:$('#modalEntryContent'), 
					commonControls: thisObj.commonControls, 
					languageControls: thisObj.languageControls
				});
			}
		});

	$('#entry-form').submit(function(e){
			e.preventDefault();
			ketnoimoi.core.postForm({
				formId: 'entry-form',
				containerNotify: 'container-notify',
				blockContainer: '#modalEntry .modal-content',
				callback: function (data, textStatus, jqXHR) {
					if(!$('#entry-form input[name="_method"]').length || $('#entry-form input[name="_method"]').val().toUpperCase() == 'POST'){
						$('#entry-form')[0].reset();
						
						// add entry to table list
						thisObj.table.addrow(data);
					}
					else{
						// update entry to table list
						thisObj.table.setdata(data.id, data);
					}
					$('#modalEntry').modal('hide');
				}
			});
		});
},
delete: function (id) {
	var thisObj = ketnoimoi.testimonials.index;

	$.ketnoimoiAjax({
		url: '/backend/testimonials/' + id,
		type: 'DELETE',
		success: function (data, textStatus, jqXHR) {
			toastr['success']("Xóa đối tượng thành công.", "Xóa đối tượng");
			thisObj.table.delrow(id);
		},
		error: function (argument) {
			toastr['error']("Xóa đối tượng không thành công.", "Xóa đối tượng");
		}
	});
}
};

$(function () {
	ketnoimoi.testimonials.index.init();
});