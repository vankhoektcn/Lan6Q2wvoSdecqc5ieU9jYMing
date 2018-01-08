if (typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};
if (typeof ketnoimoi.projects == 'undefined')
	ketnoimoi.projects = {};

ketnoimoi.projects.index = {
	table: null,
	commonControls: [
		{
			'label': 'Thông tin chung',
			'type': 'divider'
		},
		{
			'label': 'Key',
			'id': 'key',
			'name': 'Project[key]',
			'type': 'static',
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': true,
			'readonly': true,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'key'
		},/*
		{
			'label': 'Loại bài viết',
			'id': 'ProjectTypes',
			'name': 'Project[projectTypes][]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/projecttypes/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'project_types',
			'multiple': true
		},*/
		{
			'label': 'Loại dự án(type)',
			'id': 'ProjectTypes',
			'name': 'Project[project_type_id]',
			'type': 'select',
			'required': true,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/projecttypes/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'project_type_id',
			'multiple': false
		},
		{
			'label': 'Danh mục(category)',
			'id': 'ProjectCategories',
			'name': 'Project[projectCategories][]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/projectcategories/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'project_categories',
			'multiple': true
		},
		{
			'label': 'Hình ảnh',
			'id': 'attachments',
			'name': 'Project[attachments]',
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
			'label': 'Tags',
			'id': 'tags',
			'name': 'Project[tags][]',
			'type': 'select',
			'required': false,
			'placeholder': '',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/tags/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'tags',
			'multiple': true
		},
		{
			'label': 'Tỉnh/Thành phố',
			'id': 'Provinces',
			'name': 'Project[province_id]',
			'type': 'select',
			'required': true,
			'placeholder': 'Tỉnh/Thành phố',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/provinces/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'province_id',
			'multiple': false
		},
		{
			'label': 'Quận/huyện',
			'id': 'Provinces',
			'name': 'Project[district_id]',
			'type': 'select',
			'required': false,
			'placeholder': 'Quận/huyện',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'url': '/backend/districts/filter',
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'district_id',
			'multiple': false
		},
		{
			'label': 'Địa chỉ',
			'id': 'client_name',
			'name': 'Project[address]',
			'type': 'text',
			'required': true,
			'placeholder': 'Địa chỉ',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'address'
		},
		{
			'label': 'Hotline',
			'id': 'hotline',
			'name': 'Project[hotline]',
			'type': 'text',
			'required': true,
			'placeholder': 'Hotline',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'hotline'
		},
		{
			'label': 'Email',
			'id': 'client_name',
			'name': 'Project[email]',
			'type': 'email',
			'required': true,
			'placeholder': 'Email',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'email'
		},
		{
			'label': 'Thứ tự ưu tiên',
			'id': 'priority',
			'name': 'Project[priority]',
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
			'label': 'Xuất bản',
			'id': 'published',
			'name': 'Project[published]',
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
			'name': 'Project[created_by]',
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
			'name': 'Project[updated_by]',
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
			'label': 'Tên dự án',
			'id': 'name',
			'name': 'Project[ProjectTranslation][locale][name]',
			'type': 'text',
			'required': true,
			'placeholder': 'Tên dự án',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'name'
		},
		{
			'label': 'Tóm tắt',
			'id': 'summary',
			'name': 'Project[ProjectTranslation][locale][summary]',
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
			'dbfieldname': 'summary'
		},
		{
			'label': 'Mô tả giá',
			'id': 'price_description',
			'name': 'Project[ProjectTranslation][locale][price_description]',
			'type': 'text',
			'required': true,
			'placeholder': 'Mô tả giá',
			'cssclass': '',
			'value': '',
			'disabled': false,
			'readonly': false,
			'datas': [],
			'help_block': '',
			'input_icon': '',
			'dbfieldname': 'price_description'
		},
		{
			'label': 'Nội dung',
			'id': 'content',
			'name': 'Project[ProjectTranslation][locale][content]',
			'type': 'editor',
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
		},
		{
			'label': 'Meta Description',
			'id': 'meta_description',
			'name': 'Project[ProjectTranslation][locale][meta_description]',
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
			'dbfieldname': 'meta_description'
		},
		{
			'label': 'Meta Keywords',
			'id': 'meta_keywords',
			'name': 'Project[ProjectTranslation][locale][meta_keywords]',
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
			'dbfieldname': 'meta_keywords'
		}
	],
	init: function () {
		var thisObj = ketnoimoi.projects.index;
		thisObj.initFilter();
		// thisObj.initTable();
		thisObj.events();
	},
	initFilter: function () {
		var thisObj = ketnoimoi.projects.index;
		$('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        });

		var initProjectTypes = function (callback) {
			$.ketnoimoiAjax({
				url: '/backend/projecttypes/filter',
				type: 'POST',
				success: function (data, textStatus, jqXHR) {
					$.each(data, function (index, item) {
						var html ='';
						html += $.format('<option value="{0}">{1}</option>', item.id, item.name);
						$('#filter_project_type').append(html);
					});
					if (typeof callback == 'function') {
						callback();
					};
				}
			});
		}

		var initCategories = function (callback) {
			$.ketnoimoiAjax({
				url: '/backend/projectcategories/filter',
				type: 'POST',
				success: function (data, textStatus, jqXHR) {
					$.each(data, function (index, item) {
						var html ='';
						html += $.format('<option value="{0}">{1}</option>', item.id, item.name);
						$('#filter_project_categories').append(html);
					});
					if (typeof callback == 'function') {
						callback();
					};
				}
			});
		}

		var initUsers = function (callback) {
			$.ketnoimoiAjax({
				url: '/backend/users/filter',
				type: 'POST',
				success: function (data, textStatus, jqXHR) {
					$.each(data, function (index, item) {
						var html ='';
						html += $.format('<option value="{0}">{1} {2}</option>', item.id, item.last_name, item.first_name);
						$('#filter_project_created_by').append(html);
					});
					if (typeof callback == 'function') {
						callback();
					};
				}
			});
		}

		initProjectTypes(initCategories(initUsers(thisObj.initTable)));		
	},
	initTable: function () {
		var thisObj = ketnoimoi.projects.index;

		thisObj.table = new CDatatable({
			tableId: '#tblEntryList',
			url: '/backend/projects/filter',
			params: {
				type: 'filter',
				search: $('#filter_project_code').val(),
				fromdate: $('#filter_project_created_at_from').val(),
				todate: $('#filter_project_created_at_to').val(),
				projecttype: $('#filter_project_type').val(),
				createdby: $('#filter_project_created_by').val(),
				category: $('#filter_project_categories').val()
			},
			data: [],
			rowId: 'id',
			columns: [
			{ 
				data: "attachments",
				render: function (data, type, row) {
					if (type=== 'display' && data && data.length) {
						data.sort($.sortByProperty('id'));
						return  $.format('<a href="#" data-toggle="modal" data-target="#modalEntry" data-id="{0}"><img src="/imagecache/small/{1}" class="img-responsive"></a>', row.id, data[0].path);
					}
					return data;
				}
			},
			{ 
				data: "name",
				render: function (data, type, row) {
					if(type === 'display'){
						return  $.format('<a href="#" data-toggle="modal" data-target="#modalEntry" data-id="{0}">{1}</a>', row.id, data);
					}
					return data;
				}
			},
			{ 
				data: 'priority',
				className: 'text-right',
			},
			{
				data: 'project_type',
				render: function (data, type, row) {
					if (type=== 'display' && data ) {
						/*data.sort($.sortByProperty('id'));
						var html = '';
						$.each(data, function (index, item) {
							html += $.format('<span class="label label-success">{0}</span> ', item.name);
						});*/
						var html = $.format('<span class="label label-success">{0}</span> ', data.name);
						return html;
					}
					return data;
				}
			},
			{
				data: 'project_categories',
				render: function (data, type, row) {
					if (type=== 'display' && data && data.length) {
						data.sort($.sortByProperty('id'));
						var html = '';
						$.each(data, function (index, item) {
							html += $.format('<span class="label label-success">{0}</span> ', item.name);
						});
						return html;
					}
					return data;
				}
			},
			{
				data: 'tags',
				render: function (data, type, row) {
					if (type=== 'display' && data && data.length) {
						data.sort($.sortByProperty('id'));
						var html = '';
						$.each(data, function (index, item) {
							html += $.format('<span class="label label-success">{0}</span> ', item.name);
						});
						return html;
					}
					return data;
				}
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
						var strHtml = $.format('<a href="/backend/articles?projectid={0}" class="mrgr05" target="_blank" data-id="{0}" title="Bài viết dự án"><i class="fa fa-newspaper-o text-blue"></i></a>', row.id);
						if(!parseInt(row.not_delete)){
							strHtml += $.format('<a href="javascript:;" data-action="delete" data-id="{0}" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash text-red fa-lg"></i></a>', row.id);
						}
						else{
							strHtml += $.format('<a href="javascript:;" data-id="{0}" data-toggle="tooltip" data-placement="top" title="Không được xóa"><i class="fa fa-ban text-red fa-lg"></i></a>', row.id);
						}
						return strHtml;
					}
					return data;
				}
			}]
		});		
	thisObj.table.init();
},
events: function () {
	var thisObj = ketnoimoi.projects.index;

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
				$('#entry-form').attr('action', '/backend/projects/' + dataId);
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
				modal.find('#modalEntryHeader').text('Đối tượng: ' + data.name);
			}
			else{
				// update attribute form
				$('#entry-form').attr('action', '/backend/projects');
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
					/*if(!$('#entry-form input[name="_method"]').length || $('#entry-form input[name="_method"]').val().toUpperCase() == 'POST'){
						$('#entry-form')[0].reset();
						
						// add entry to table list
						thisObj.table.addrow(data);
					}
					else{
						// update entry to table list
						thisObj.table.setdata(data.id, data);
					}
					$('#modalEntry').modal('hide');*/
				}
			});
		});

	$(document).on('click', '#btn_filter_project', function (argument) {
		$('#tblEntryList').DataTable().destroy();
		ketnoimoi.projects.index.initTable();
	});
},
delete: function (id) {
	var thisObj = ketnoimoi.projects.index;

	$.ketnoimoiAjax({
		url: '/backend/projects/' + id,
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
	ketnoimoi.projects.index.init();
});