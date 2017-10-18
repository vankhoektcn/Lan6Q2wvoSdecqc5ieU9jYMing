
if(typeof ketnoimoi == 'undefined')
	var ketnoimoi = {};

ketnoimoi.common = {
	LANGUAGE: 'vi-VN',
	init: function(){
		var thisObj = ketnoimoi.common;
		thisObj.pageLoad();
		thisObj.events();
	},
	pageLoad: function(argument){
		var thisObj = ketnoimoi.common;

		
	},
	events: function (argument) {
		var thisObj = ketnoimoi.common;

		// Active Item
		$(document).on('click', 'a.link-active', function(e){
			thisObj.activeRecord($(this), function(error, result){
			});
		});
	},

	activeRecord : function ($obj,callback) {
		var value = $obj.data('active');
		var url = $obj.data('activeurl');
		if($.isEmpty(value) || $.isEmpty(url)){
			return false;
		}
		bootbox.confirm("Bạn thật sự muốn "+(value ? 'BẬT' : 'TẮT')+" dòng này?", function(result) {
				if (result) {
					$.ketnoimoiAjax({
						url: url,
						type: 'POST',
						data: {
							active: value
						},
						success: function (data, textStatus, jqXHR) {
							$obj.data('active', value ? 0: 1);
							if(value)
								$obj.find('i').removeClass('fa-square-o').addClass('fa-check-square-o');
							else 
								$obj.find('i').removeClass('fa-check-square-o').addClass('fa-square-o');
							
							if(typeof callback == 'function'){
								callback(null, data);
							}
						},
						error: function (jqXHR, textStatus, errorThrown) {
							var errorMessage = 'Lỗi';
							switch (jqXHR.status){
								case 401: errorMessage = 'Vui lòng đăng nhập lại.'; break;
								case 403: errorMessage = 'Bạn không có quyền thực hiện thao tác này.'; break;
							}
							jqXHR.errorMessage = errorMessage;
							if (jqXHR.status != 422) {
								toastr['warning'](errorMessage, 'Lỗi');
							};
							if(typeof callback == 'function'){
								callback(jqXHR);
							}
						}
					});
				}
			});
	},

	formatTypeDateTime: function(obj, callback){
		//alert("click bound to document listening for #test-element");
		var inputValue =  $(obj).val();
		if($.isEmpty(inputValue))
			return false;
		inputValue = inputValue.replace(/\//g, '');
		if(inputValue.length >= 8) {
			var newVal = inputValue.substring(0,2) + '/' + inputValue.substring(2,4) + '/' + inputValue.substring(4,8);
			$(obj).val(newVal);
		}
		if(typeof callback == 'function')
			callback();
	},
	// reset form	
	resetForm: function(formId,callback){
		if(!$.isEmpty(formId)){
			if(formId.indexOf('#') == -1)
				formId = '#'+ formId;
			var $form = $(formId)[0];
			if($form.length){			
				$form.reset();
				$(':hidden.clear-able',$form).val('');
				$('select.select2', $form).val('').trigger('change');
			}
		}
		if(typeof callback == "function")
			callback();
	},

	filterForm: function(formId,cb){
		if(!$.isEmpty(formId)){
			if(formId.indexOf('#') == -1)
				formId = '#'+ formId;
			var $form = $(formId)[0];
			if($form.length){			
				var $modalParent = $(this).data('formparent') ? $($(this).data('formparent')) : $($(this).parents('.modal'));
				ketnoimoi.core.postForm({
					formId: formId,
					containerNotify: 'container-notify',
					blockContainer: $modalParent.length ? $modalParent.find('.modal-content') : 'body',			
					showSuccessMessage: false,
					showErrorMessage: true,
					callback: function (error, data, textStatus, jqXHR) {
						if(typeof cb == "function")
							cb(error, data, textStatus, jqXHR);
					}
				});	
			}
		}
	},

	showElementHasRole: function(){
		if(ketnoimoi.user.hasRoles('Administrator')){
			$('.admin-role').removeClass('hide');
		}
		else{
			$('.admin-role').remove();
		}
		if(ketnoimoi.user.hasRoles('Sale')){
			$('.sale-role').removeClass('hide');
		}
		else{
			$('.sale-role').remove();
		}
		if(ketnoimoi.user.hasRoles('Inventory')){
			$('.inventory-role').removeClass('hide');
		}
		else{
			$('.inventory-role').remove();
		}
		if(ketnoimoi.user.hasRoles('Accounting')){
			$('.accounting-role').removeClass('hide');
		}
		else{
			$('.accounting-role').remove();
		}
		if(ketnoimoi.user.hasRoles('Marketing')){
			$('.marketing-role').removeClass('hide');
		}
		else{
			$('.marketing-role').remove();
		}
	}

};

if(typeof ketnoimoi.user == 'undefined')
	ketnoimoi.user = {};

ketnoimoi.user.hasRoles = function(roles){
	if(!$.isEmpty(ketnoimoi.user) && !$.isEmpty(roles)){
		var isAdmin = ketnoimoi.user.roles.some(function(item){
			return item == 'Administrator';
		});	
		if(isAdmin){
			return true;
		}
		else if(typeof roles == "object"){
			var hasRole = false;
			roles.forEach(function(role){
				var hasThisRole = ketnoimoi.user.roles.some(function(item){
					return item == role;
				});
				if(hasThisRole)
					hasRole = true;
			});
			return hasRole;
		}
		else{
			return ketnoimoi.user.roles.some(function(item){
				return item == roles;
			});	
		}
	}
	else{
		return false;
	}
}

$(function () {
	// register the handler 
	document.addEventListener('keyup', definedShortKey, false);
	ketnoimoi.common.init();	
});

var definedShortKey = function(e){
	if (e.altKey) {
		switch(e.keyCode){
			case 78:
			// N: Create
			$('.key-btn-alt-n:visible').trigger('click');
			break;
			case 83:
			// S: Save
			$('.key-btn-alt-s:visible').trigger('click');
			$('#btnSave:visible').trigger('click');
			break;
			case 112:
			// F1: Open question popup
			$('.key-btn-alt-f1:visible').trigger('click');
			break;
			case 113:
			// F2: Filter
			$('.btn-filter:visible').trigger('click');
			break;
		};
	}
	else{
		switch(e.keyCode){
			case 27:
			// Esc: Show order list
			$('.key-btn-alt-esc:visible').trigger('click');
			break;
		};
	}
};