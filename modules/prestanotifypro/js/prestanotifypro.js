
var tmp = $;
$ = $j210;

// function for debug
var cleanInt = function (x) {
	x = Number(x);
	return x >= 0 ? Math.floor(x) : Math.ceil(x);
};

var p = function () {
	var i = 0,
	arg_lenght = arguments.length;
	if (arg_lenght > 0) {
		for (i; i<arg_lenght; i++) {
			if (arguments[i] instanceof Array) {
				console.log(arguments[i]);
			}
			else if (typeof(arguments[i]) === 'object') {
				console.table(arguments[i]);
			} else {
				// console.log(arguments.callee.caller.toString());
				console.log(arguments[i]);
			}
		}
	}
};

// Main Function
var Main = function () {
	/**
	** Click Event
	*/
	var runEvent = function () {
		// Click on Edit button
		$('.edit').live('click', function (e) {
			e.preventDefault();
			var id = $(this).attr('role-id');
			var role = $(this).attr('data-role');
			var type = $(this).attr('data-type');
			var table = $(this).closest("table").attr('id');
			loadFormModal(id, role, type, table);
		});		
		$('.preview').live('click', function (e) {
			e.preventDefault();
			var id_obj = $(this).attr('role-id');
			var lang = $(this).attr('data-lang');
            var role = $(this).attr('data-role');
			var type = $(this).attr('data-type');
            loadPreview(id_obj, role, type, lang);		
		});

		// Click on Delete button
		$('.delete').live('click', function (e) {
			e.preventDefault();
			var obj_id = $(this).attr('role-id');
            var role = $(this).attr('data-role');
            var type = $(this).attr('data-type');
			var table = $(this).closest("table").attr('id');
			loadDeleteModal(obj_id, role, type, table);
		});		

		// Click on State button
		$('.action-enabled, .action-disabled').live('click', function (e) {
			e.preventDefault();
			var table = $(this).parents("table").attr('id');
			var obj_id = $(this).attr('role-id');
			var role = $(this).attr('data-role');
            var type = $(this).attr('data-type');
			$.ajax({
				type: 'POST',
				url: admin_module_ajax_url,
				dataType: 'html',
				data: {
					controller : admin_module_controller,
					action : 'SwitchAction',
					ajax : true,
					id_obj : obj_id,
                    role : role,
                    type : type
				},
				success : function() {
					reloadTable(table);
				}
			});
		});

		// On image manager tab, when you change the language, it hides and shows up the right tbody
		$('#img_select_lang').on('change', function (e){
			e.preventDefault();
			var value = cleanInt($(this).val());
            $('#table-images').attr('data-type', value);
            reloadTable('#table-images');
		});

		// Click on ToolsBar button
		$('.panel-footer a, .list-toolbar-btn').live('click', function (e) {
			e.preventDefault();
			var role = $(this).attr('data-role');
			var type = $(this).attr('data-type');
			var table = $(this).attr('data-table');
			loadFormModal(null, role, type, table);
		});

	};
    
	// function to displays collapsible content panels
	var runPanelToggle = function () {
		$(".contactus").on('click', function() {
			$href = $.trim($(this).attr('href'));
			$(".list-group a.active").each(function() {
				$(this).removeClass("active");
			});

			$(".list-group a.contacts").addClass("active");
		});

		// Tab panel active
		$(".list-group-item").on('click', function() {
			var $el = $(this).parent().closest(".list-group").children(".active");
			if ($el.hasClass("active")) {
				target = $(this).find('i').attr('data-target');
				if (target !== undefined) {
					loadTable(target);
				}
				$el.removeClass("active");
				$(this).addClass("active");
			}
		});

		// First init configuration tab
		loadTable('table-notif');
	};
    
	// function to custom select
	var runCustomElement = function () {
		// Hide ugly toolbar
		$('table[class="table"]').each(function(){
			$(this).hide();
			$(this).next('div.clear').hide();
		});

		// Hide ugly multishop select
		if (typeof(_PS_VERSION_) !== 'undefined') {
			var version = _PS_VERSION_.substr(0,3);

			if(version === '1.5' || version === '1.4') {
				$('.multishop_toolbar').addClass("panel panel-default");
				$('.shopList').removeClass("chzn-done").removeAttr("id").css("display", "block").next().remove();
				cloneMulti = $(".multishop_toolbar").clone(true, true);
				$(".multishop_toolbar").first().remove();
				cloneMulti.find('.shopList').addClass('selectpicker show-menu-arrow').attr('data-live-search', 'true');
				cloneMulti.insertBefore("#modulecontent");
				// Copy checkbox for multishop
				cloneActiveShop = $.trim($('table[class="table"] tr:nth-child(2) th').first().html());
				$(cloneActiveShop).insertAfter("#tab_translation");
			}
		}

		// Custom Select
		$('.selectpicker').selectpicker();

		// Fix bug form builder + bootstrap select
		$('.selectpicker').each(function(){
			var select = $(this);
			select.on('click', function() {
				$(this).parents('.bootstrap-select').addClass('open');
				$(this).parents('.bootstrap-select').toggleClass('open');
			});
		});

		// Custom Textarea
		$('.textarea-animated').autosize({append: "\n"});
	};

	/**
	** Load Modal for delete a notification
	*/
	var loadDeleteModal = function (id, role, type, table) {
		var loader = '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>';
		var reload = '<div class="bootstrap-dialog-message"><span>Thank you for your patience during the removal process rules</span>'+loader+'</div>';
        var message = '';
        var action = '';
        
        switch(role) {
            case 'images' :
                message = delete_image_message+' <p><strong>'+id+'</strong></p>';
                action = 'DeleteImage';
            break;
            
            default:
                message = delete_notif_message;
                action = 'DeleteNotif';
            break;
        }
        
        BootstrapDialog.show({
			sizeModal: 'SIZE_LARGE',
			message: '<span>'+message+'</span>',
			buttons: [{
				icon: 'icon-trash',
				label: delete_message,
				cssClass: 'btn-primary',
				autospin: true,
				action: function(dialogRef) {
					dialogRef.enableButtons(false);
					dialogRef.setClosable(false);
					dialogRef.getModalFooter().hide();
					dialogRef.getModalBody().html(reload);
					$.ajax({
						type: 'POST',
						url: admin_module_ajax_url,
						dataType: 'html',
						data: {
							controller : admin_module_controller,
							action : action,
							ajax : true,
                            role : role,
                            type : type,
							id : id
						},
						success: function(data) {
							dialogRef.setClosable(true);
							dialogRef.getModalBody().children().children().next().children().css('width', '100%');
							dialogRef.getModalBody().children().children().next().children().attr('aria-valuenow', '100');
                            dialogRef.getModalBody().html(data);
							reloadTable(table);
						},
						error: function (jqXHR, textStatus, errorThrown) {
							dialogRef.setClosable(true);
							dialogRef.getModalBody().children().children().next().children().addClass('progress-bar-danger');
							dialogRef.getModalBody().children().children().next().children().css('width', '100%');
							dialogRef.getModalBody().children().children().next().children().attr('aria-valuenow', '100');
							if(debug_mode === 0) {
								setTimeout(function(){
									dialogRef.close();
								}, 2000);
							}
						}
					});
				}
			}, {
				label: close_message,
				action: function(dialogRef){
					dialogRef.close();
				}
			}]
		});
	};

	/**
	** Load Notification Preview
	*/
	var loadPreview = function (id_obj, role, type, lang) 
	{
        var action = 'NotifPreview'; //ny default
        if(role === 'images')
            action = 'ImagePreview';

		Shadowbox.init({
			skipSetup: true
		});

		$.ajax({
			type: 'POST',
			url: admin_module_ajax_url,
			dataType: 'html',
			data: {
				action : action,
				ajax : true,
				type: type,
				lang: lang,
				id_obj : id_obj
			},
			success: function(data){
				Shadowbox.open({
	                content:   data,
	                player:     "html",
	                height:     $(data).find('img').attr('data-height'),
	                width:      $(data).find('img').attr('data-width'),
            	});
			}
		});
	};

	/**
	** Load Modal for Add or Edit
	*/
	var loadFormModal = function (id, role, type, table) {
		id_obj = (typeof(id) !== 'undefined') ? id : '';
		role = (typeof(role) !== 'undefined') ? role : 'notif';
		type = (typeof(type) !== 'undefined') ? type : 'image';
		$.ajax({
			type: 'POST',
			url: admin_module_ajax_url,
			dataType: 'html',
			data: {
				controller : admin_module_controller,
				action : 'LoadForm',
				ajax : true,
				type: type,
				role: role,
				id_obj : id_obj
			},
			success: function(jsonData) {
				// Filled the fields with pattern tags
				var response_form = $('<div id="response_form"></div>');
				response_form.html(jsonData);
                
                var title = form_title_notification //by default;
                if (role === 'upload')
                    title = form_title_image;

				// Show Modal
				BootstrapDialog.show({
					title: title,
					sizeModal: 'SIZE_LARGE',
					onshow: function(dialogRef) {

						dialogRef.setClosable(false);

						var $header = dialogRef.getModalHeader();
						var $body = dialogRef.getModalBody();
						var $footer = dialogRef.getModalFooter();
						var $button = dialogRef.getButton('btn-save');

						if (role === 'notif') {
							// Select picker
							$body.find('select.selectpicker').selectpicker();
							$body.find('button.selectpicker').each(function() {
								var select = $(this);
								select.on('click', function() {
									select.find('.bootstrap-select').addClass('open');
								});
							});

							$body.find('.bootstrap-select .notif-image').live('click', function (e) {
								e.preventDefault();
								var value = cleanInt($(this).val());
								$body.find('.notif-image').hide();
								$body.find('input.notif-image-'+value).show();
								$body.find('div.notif-image-'+value).show();
							});

							//bind datetimepicker type change
							$body.find('#notif_date_start').datetimepicker({
								stepMinute : 15,
								timeFormat: 'hh:mm:00',
								dateFormat: 'yy-mm-dd',
								 onSelect: function (selected) {
						            var dt = new Date(selected);
						            dt.setDate(dt.getDate() + 1);
						            $("#notif_date_end").datepicker("option", "minDate", dt);
						        }
							});

							$body.find('#notif_date_end').datetimepicker({
								stepMinute : 15,
								timeFormat: 'hh:mm:00',
								dateFormat: 'yy-mm-dd',
								onSelect:function (selected) {
						            var dt = new Date(selected);
						            dt.setDate(dt.getDate() - 1);
						            $("#notif_date_start").datepicker("option", "maxDate", dt);
       							}							
							});

							//bind notification type change
							$body.find('#notif-type').on('change', function (e) {
								e.preventDefault();
								var value = $(this).val();

								if (value === 'image') {
									$body.find('#step-image').show();
									$body.find('#step-html').hide();
								} else {
									$body.find('#step-image').hide();
									$body.find('#step-html').show();
								}
							});

							//bind notification type change
							$body.find('.notif-image').hide();
							$body.find('div.notif-image-'+cleanInt($body.find('#select_lang').val())).show();
							$body.find('input.notif-image-'+cleanInt($body.find('#select_lang').val())).show();

							// This part allows the switch between forms for multilang
							var current_lang = $body.find('.lang_selector.selected').val();
							$body.find('.notif-image').hide();
							$body.find('div.notif-image-'+cleanInt(current_lang)).show();
							$body.find('input.notif-image-'+cleanInt(current_lang)).show();

							$body.find('.lang_selector').click(function (e) {
								e.preventDefault();
								$body.find('.lang_selector').removeClass('btn-primary');
								$(this).addClass('btn-primary');
								var value = cleanInt($(this).val());
								$body.find('.notif-image').hide();
								$body.find('.img-lang-hidecontrol').attr('hidden', 'hidden');
								$body.find('#img-lang-'+value).removeAttr('hidden');
								$body.find('input.notif-image-'+value).show();
								$body.find('div.notif-image-'+value).show();
							});
						}

						if (role === 'upload') {
							$body.find('.upload-image').hide();
							$body.find('input.upload-image-'+cleanInt($body.find('#select_lang').val())).show();

							$body.find('#select_lang').on('change', function (e) {
								e.preventDefault();
								var value = cleanInt($(this).val());
								$body.find('.upload-image').hide();
								$body.find('input.upload-image-'+value).show();
								$body.find('div.upload-image-'+value).show();
							});
						}
					},
					message: response_form,
					buttons: [
						// Close
						{
							label: close_message,
							cssClass: 'btn-default pull-left',
							action: function(dialogRef){
								dialogRef.close();
							}
						},
						// Save
						{
							id: 'btn-save',
							label: save_message,
							cssClass: 'btn-primary pull-right',
							autospin: true,
							action: function(dialogRef) {
								dialogRef.enableButtons(false);
								dialogRef.setClosable(false);
								form_value = $("#form_add").serializeArray();

								showResponse = function(jsonData) {
									var $body = dialogRef.getModalBody();
									ps_version = cleanInt(ps_version);
									if (ps_version === 1) {
										error_exist = $(jsonData).find('.module_error').length;
										test_error = (error_exist === 0);
									} else {
										error_exist = $(jsonData).attr('class');
										test_error = (error_exist !== 'module_error alert error');
									}

									$body.show();
									if (test_error) {
										dialogRef.setClosable(true);
										$body.html(jsonData);
										reloadTable(table);
									} else {
										dialogRef.enableButtons(true);
										dialogRef.getModalFooter().show();
										error_already_exist = $body.find('.module_error').length;
										error_already_exist = cleanInt(error_already_exist);
										if (error_already_exist === 0) {
											$(jsonData).insertBefore($body.find('#response_form'));
										}
									}
								};

								if (role === 'upload') {

									$("#form_add").ajaxSubmit({
										beforeSubmit:  function(formData, jqForm, options) {

											// formData is an array of objects representing the name and value of each field
											// that will be sent to the server;  it takes the following form:
											//
											// [
											//     { name:  username, value: valueOfUsernameInput },
											//     { name:  password, value: valueOfPasswordInput }
											// ]
											//
											// To validate, we can examine the contents of this array to see if the
											// username and password fields have values.  If either value evaluates
											// to false then we return false from this method.

											formData.push({name: 'controller', value: admin_module_controller});
											formData.push({name: 'action', value: 'SaveForm'});
											formData.push({name: 'ajax', value: true});
											formData.push({name: 'type', value: type});
											formData.push({name: 'role', value: role});
											formData.push({name: 'id_obj', value: id_obj});
											formData.push({name: 'params', value: form_value});

											dialogRef.getModalBody().hide();
											dialogRef.getModalFooter().hide();
											
										},  // pre-submit callback
										success:       showResponse,  // post-submit callback
										url: admin_module_ajax_url,
										type: 'POST',
										dataType: 'html',
									});

								} else {

									dialogRef.getModalBody().hide();
									dialogRef.getModalFooter().hide();

									$.ajax({
										type: 'POST',
										url: admin_module_ajax_url,
										dataType: 'html',
										data: {
											controller : admin_module_controller,
											action : 'SaveForm',
											ajax : true,
											type: type,
											role: role,
											id_obj: id_obj,
											params: form_value
										},
										success: showResponse,
									});
								}
							}
						}
					]
				});
			}
		});
	};

	return {
		//main function to initiate template pages
		init: function () {
			runPanelToggle(); // This loads configuration table data
			runCustomElement();
			runEvent();
		}
	};
}();

$(function() {
	// Load functions
	Main.init();
});

$ = tmp;
