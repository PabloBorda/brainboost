/*!
* @summary     DataTables
* @description Paginate, search and sort HTML tables
* @file        jquery.dataTables.js
* @author      Allan Jardine (www.sprymedia.co.uk)
* @contact     www.sprymedia.co.uk/contact
*
* @copyright Copyright 2008-2014 Allan Jardine, all rights reserved.
*/
var tmp = $;
$ = $j210;

var $oTable;

function fnFormatDetails(pTr) {
	var sOut = '',
		id_cat = pTr.id,
		type = getTypeDetails(pTr);
	id_cat = id_cat.replace('cat_', '');
	$.ajax({
		type: 'POST',
		async : false,
		url: admin_module_ajax_url,
		dataType: 'html',
		data: {
			controller : admin_module_controller,
			action : 'RuleDetails',
			ajax : true,
			id_cat : id_cat,
			type: type
		},
		success: function(htmlData) {
			sOut += htmlData;
		}
	});
	return sOut;
}

function getTableId(data) {
	data = data.replace('table-meta-', '');
	return data-1;
}

function getTypeDetails(id) {
	if (typeof(id) !== 'object') {
		is_sharp = id.charAt(0);
		if (is_sharp !== '#') {
			id = '#'+id;
		}
	}
	$obj = $(id);
	var reg_m = new RegExp("^metas-[0-9]$","g");
	var reg_u = new RegExp("^urls-[0-9]$","g");
	var parentEls = $obj.parents().map(function() {
		var id = $.trim(this.id);
		if(reg_m.test(id)) {
			return this.id;
		}
		else if(reg_u.test(id)) {
			return this.id;
		}
	}).get().join('');
	return ($('#configuration-'+parentEls).attr('data-type'));
}

function getType(id) {
	if (typeof(id) !== 'object') {
		is_sharp = id.charAt(0);
		if (is_sharp !== '#') {
			id = '#'+id;
		}
	}
	return ($(id).attr('data-type'));
}

function getRole(id) {
	if (typeof(id) !== 'object') {
		is_sharp = id.charAt(0);
		if (is_sharp !== '#') {
			id = '#'+id;
		}
	}
	return ($(id).attr('data-role'));
}

function reloadTable(id) {
	if (typeof(id) !== 'object') {
		is_sharp = id.charAt(0);
		if (is_sharp !== '#') {
			id = '#'+id;
		}
	}

	type = getType(id);
	role = getRole(id);
	$(id).dataTable().fnDestroy();
	$(id).dataTable({
		"bDestroy":true,
		"bRetrieve": true,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": admin_module_ajax_url,
		"bAutoWidth": false,
		"fnRowCallback": function(nRow, aData, iDisplayIndex) {
			var $tr = $oTable.$('tr:eq('+cleanInt(iDisplayIndex)+')' );
			active = $(aData[cols_status]).hasClass('action-enabled');
			if (active === true)
				$tr.attr('data-active', 1);
			else
				$tr.attr('data-active', 0);
		},
		"fnServerData": function (sSource, aoData, fnCallback) {
			aoData = setData(aoData);
			$.ajax({
				"dataType": 'json',
				"type": "POST",
				"url": sSource,
				"data": aoData,
				"success": fnCallback
			});
		},
		"oLanguage": setLang(),
		"aoColumnDefs": setColumnDefs(role),
		"aaSorting": [
			[0, 'asc']
		]
	});
    overrideIcon(id);
}

function loadTable(id) {
	if (typeof(id) !== 'object') {
		is_sharp = id.charAt(0);
		if (is_sharp !== '#') {
			id = '#'+id;
		}
	}

	type = getType(id);
	role = getRole(id);
	$oTable = $(id).dataTable({
		"bRetrieve": true,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": admin_module_ajax_url,
		"bAutoWidth": false,
		"fnRowCallback": function(nRow, aData, iDisplayIndex) {
			var $tr = $oTable.$('tr:eq('+cleanInt(iDisplayIndex)+')' );
			active = $(aData[cols_status]).hasClass('action-enabled');
			if (active === true)
				$tr.attr('data-active', 1);
			else
				$tr.attr('data-active', 0);
		},
		"fnServerData": function (sSource, aoData, fnCallback) {
			aoData = setData(aoData);
			$.ajax({
				"dataType": 'json',
				"type": "POST",
				"url": sSource,
				"data": aoData,
				"success": fnCallback
			});
		},
		"oLanguage": setLang(),
		"aoColumnDefs": setColumnDefs(role),
		"aaSorting": [
			[0, 'asc']
		]
	});
    
    overrideIcon(id);
}

function setLang() {
	return {
		"sLengthMenu": records_msg+" _MENU_",
		"sZeroRecords": zero_records_msg,
		"sInfo": "_START_/_END_ of _TOTAL_ records",
		"sInfoEmpty": "",
		"sInfoFiltered": "(filtered from _MAX_ total records)"
	};
}

function setData(aoData) {
	aoData.push({
		"name": "controller", "value": admin_module_controller
	});
	aoData.push({
		"name": "action", "value": 'ReloadData'
	});
	aoData.push({
		"name": "ajax", "value": true
	});
	aoData.push({
		"name": "type", "value": type
	});
	aoData.push({
		"name": "role", "value": role
	});
	return aoData;
}

function overrideIcon(id) {
	if (typeof(id) !== 'object') {
		is_sharp = id.charAt(0);
		if (is_sharp !== '#') {
			id = '#'+id;
		}
	}

	// Override icon
	$(id).children().each(function () {
		if ($(this).find('th').is(".number")) {
			asc_icon = 'icon-sort-amount-asc';
			desc_icon = 'icon-sort-amount-desc';
		} else {
			asc_icon = 'icon-sort-alpha-asc';
			desc_icon = 'icon-sort-alpha-desc';
		}

		$(this).find('i').remove('.icon-sort');
		$(this).find('i').remove('.'+asc_icon);
		$(this).find('i').remove('.'+desc_icon);

		$(this).find('.sorting').append('<i class="icon-sort pull-right"></i>');
		$(this).find('.sorting_asc').append('<i class="'+asc_icon+' pull-right"></i>');
		$(this).find('.sorting_desc').append('<i class="'+desc_icon+' pull-right"></i>');
	});
}

function setColumnDefs(role) {

    //define option (style, action, ..) for esch column
    switch (role) {
        case 'images' :
        	// cols_status = 0;
            return [{
                    "sClass": "fixed-width-sm text-center",
                    "aTargets": [0, 1, 2]
                }, {
                    "bSortable": false,
                    "bSearchable": false,
                    "aTargets": [1, 2]
                }, {
                    "sClass": "pointer",
                    "bSortable": true,
                    "bSearchable": true,
                    "aTargets": [0]
                }
            ];
        break;
                
        default : // notifications list table
			if (cleanInt(multishop) === 1) {
				cols_status = 5;
				cols_after = 6;
            	cols_preview = 7; // preview
				last_cols = 8;
	
				return [{
					"sClass": "fixed-width-sm text-center",
					"aTargets": [0, 1, 2, 3, 4, cols_status, cols_after, cols_preview, last_cols]
				},{
					"sClass": "pointer",
                    "bSortable": true,
                    "bSearchable": false,
                    "aTargets": [1, 2, cols_status]
                	}, {
                    "sClass": "pointer",
                    "bSearchable": true,
                    "bSortable": true,
                    "aTargets": [0]
				}, {
					"bSortable": false,
	                "bSearchable": false,
					"aTargets": [1, 2, 3, 4, cols_after, last_cols, cols_preview]
				}
				];
			}

			cols_status = 4; // active or not
			cols_after = 5; // delay
            cols_preview = 6; // preview
			last_cols = 7	; // last column - actions
			return [{
					"sClass": "fixed-width-sm text-center",
					"aTargets": [0, 1, 2, 3, cols_status, cols_after,cols_preview, last_cols]
				}, {
                    "sClass": "pointer",
                    "bSortable": true,
                    "bSearchable": false,
                    "aTargets": [1, 2, cols_status]
				}, {
                    "sClass": "pointer",
                    "bSearchable": true,
                    "bSortable": true,
                    "aTargets": [0]
				}, {
					"bSortable": false,
                    "bSearchable": false,
					"aTargets": [1, 2, 3, cols_after, last_cols]
				}
			];
		break;
	}
}

$(window).load(function() {

	$(document).on('click', '.dataTableHidden tbody td.hidden-table-info', function (e) {
		e.preventDefault();
		var $pTr = $(this).parents('tr')[0];
		$(this).children().toggleClass("icon-minus");
		if ($oTable.fnIsOpen($pTr)) {
			$oTable.fnClose($pTr);
		} else {
			data = fnFormatDetails($pTr);
			$oTable.fnOpen($pTr, data, 'details');
		}
	});

	$(document).on('click', '.dataTable thead th', function (e) {
		e.preventDefault();
		if (!$(this).hasClass('sorting_disabled')) {
			$(this).parents('thead').each(function () {
				$(this).find('i').removeClass('icon-sort-alpha-asc icon-sort-amount-asc').addClass('icon-sort');
				$(this).find('i').removeClass('icon-sort-alpha-desc icon-sort-amount-desc').addClass('icon-sort');
			});
			$(this).find('i').toggleClass(function() {
				if ($(this).parent().is(".number")) {
					asc_icon = 'icon-sort-amount-asc';
					desc_icon = 'icon-sort-amount-desc';
				} else {
					asc_icon = 'icon-sort-alpha-asc';
					desc_icon = 'icon-sort-alpha-desc';
				}

				if ($(this).parent().is(".sorting_asc")) {
					$(this).removeClass(desc_icon);
					return asc_icon;
				} else {
					$(this).removeClass(asc_icon);
					return desc_icon;
				}
			});
		}
	});
});

$ = tmp;