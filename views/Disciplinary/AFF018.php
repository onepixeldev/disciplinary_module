<?php echo $this->lib->title('Disciplinary / Case Report Entry (Asset Loss)', $screen_id) ?>

<section id="widget-grid" class="">
    <div class="jarviswidget  jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" role="widget">
        <header role="heading">
            <div class="jarviswidget-ctrls" role="menu">
                <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" data-placement="bottom"><i class="fa fa-expand "></i></a>
            </div>
            <h2>AFF018 - Case Report Entry (Asset Loss)</h2>				
            <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
        </header>
        <div role="content">
            <div class="jarviswidget-editbox">
            </div>
            <div class="widget-body">
                <div class="jarviswidget well" id="wid-id-3" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">
                    <header role="heading">
                        <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                        <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
					</header>

                    <!-- widget div-->
                    <div role="content">
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                        </div>
                        <!-- end widget edit box -->
                        <div class="widget-body">

                            <ul id="myTab1" class="nav nav-tabs bordered">
								<li class="active">
                                    <a style="color:#000 !important" href="#s1" data-toggle="tab" aria-expanded="true">Case Report</a>
                                </li>
								<li class="">
                                    <a style="color:#000 !important" href="#s2" data-toggle="tab" aria-expanded="false">Case Report Form</a>
                                </li>
                                <li class="">
                                    <a style="color:#000 !important" href="#s3" data-toggle="tab" aria-expanded="false">Suspect</a>
                                </li>
                                <li class="">
                                    <a style="color:#000 !important" href="#s4" data-toggle="tab" aria-expanded="false">Committee</a>
                                </li>
                            </ul>
							<!-- myTabContent1 -->
                            <div id="myTabContent1" class="tab-content padding-10">

								<div class="tab-pane fade active in" id="s1">
									<div id="rp_ent_al">
									</div>
                                </div>

								<div class="tab-pane fade" id="s2">
									<div id="cs_rp_form_al">
                                        <p>
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Please click Add Record or Edit button from Case Report tab</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </p>
									</div>
                                </div>

                                <div class="tab-pane fade" id="s3">
									<div id="cs_rp_form_sp">
                                        <p>
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Please Add Record or click Edit button from Case Report tab</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </p>
									</div>
                                </div>

                                <div class="tab-pane fade" id="s4">
									<div id="cs_rp_form_cm">
                                        <p>
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Please Add Record or click Edit button from Case Report tab</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </p>
									</div>
                                </div>

                            </div>
                            <!-- end myTabContent1 -->
                        </div>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ADD / EDIT / DELETE page will be displayed here -->
<div class="modal fade" id="myModalis" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="mContent">
		
        </div>
    </div><!-- /.modal-dialog -->
</div>
<!-- end ADD / EDIT / DELETE -->

<!-- ADD / EDIT / DELETE page will be displayed here -->
<div class="modal fade" id="myModalis2" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content" id="mContent2">
		
        </div>
    </div><!-- /.modal-dialog -->
</div>
<!-- end ADD / EDIT / DELETE -->

<script>
	var rp_al_row = '';
	var stf_row = '';
	var asset_row = '';
	
	$(document).ready(function(){
		$("#myModalis").draggable({
			handle: ".modal-content"
		});

		$("#myModalis2").draggable({
			handle: ".modal-content"
		});

		// PREVENT SUBMIT RELOAD
		$('#myModalis').on('submit', function(e){
			e.preventDefault();
		});
	});

	$(".nav-tabs a").click(function(){
		$(this).tab('show');
    });

	/*----------------------------------------
	TAB 1 - CASE REPORT ENTRY (ASSET LOSS)
	------------------------------------------*/

	// POPULATE ASSET LOSS CASE REPORT ENTRY
	$('#rp_ent_al').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
	$.ajax({
		type: 'POST',
		url: '<?php echo $this->lib->class_url('csRpEntAL')?>',
		data: '',
		success: function(res) {
			$('#rp_ent_al').html(res);

			rp_al_row = $('#tbl_rp_al_list').DataTable({
				"ordering":false,
			});
		}
	});		

	///////////////////////////////////////////////////////
	// ADD, EDIT, DELETE CASE REPORT ENTRY (AL)
	//////////////////////////////////////////////////////

	// ADD CASE REPORT ENTRY (AL)
	$('#rp_ent_al').on('click','.add_case_rp_al_btn', function(){
	
		$.ajax({
			type: 'POST',
            url: '<?php echo $this->lib->class_url('addCaseALForm')?>',
            beforeSend: function() {
				$('#cs_rp_form_al').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
				$('.nav-tabs li:eq(1) a').tab('show');
			},
			success: function(res) {
				$('#cs_rp_form_al').html(res);
				$('#cs_rp_form_sp').html('<p><table class="table table-bordered table-hover"><thead><tr> <th class="text-center">Please Add Record or click Edit button from Case Report tab</th></tr></thead></table></p>');
			}
		});
    });

    // HIDE / SHOW FORM FOR ITEM TYPE
	$('#cs_rp_form_al').on('change','#itemType', function(){
        var it_type = $(this).val();
        $('#loaderItType').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
        
        if(it_type == 'MONEY' && it_type != '') {
            $('#aForm').removeClass('hidden');
            $('#bForm').addClass('hidden');
        } else if (it_type != 'MONEY' && it_type != '') {
            $('#bForm').removeClass('hidden');
            $('#aForm').addClass('hidden');
        } else if (it_type == '') {
            $('#aForm').addClass('hidden');
            $('#bForm').addClass('hidden');
        }

        $('#loaderItType').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>').hide();
    });

	// POPULATE ITEM DESCRIPTION
	$('#cs_rp_form_al').on('change','#itemDetl', function(){
        var it_detl = $('#itemDetl option:selected').text();
        $('#loaderItType').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
        
        if(it_detl != '') {
            $('#itemDesc').val(it_detl);
        }

        $('#loaderItType').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>').hide();
    });

	///// SEARCH ASSET //////
	// SEARCH ASSET
	$('#cs_rp_form_al').on('click','.search_asset', function(){
		var item_type = $('#itemType').val();

		$('#myModalis .modal-content').empty();
		$('#myModalis').modal('show');
		$('#myModalis').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');
	
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('searchAssetMd')?>',
			data: {'item_type':item_type},
			success: function(res) {
				$('#myModalis .modal-content').html(res);
			}
		});
	});

	// SEARCH ASSET MODAL
	$('#myModalis').on('click', '.search_asset_md', function () {
		var asset_type = $('#myModalis .search_asset_md').val();
		var asset_id = $('#myModalis #asset_id').val();
		search_trigger = 1;
		
		if(asset_id == '') {
			msg.show('Please enter Asset ID / Serial No / Brand', 'warning', '#myModalis .modal-content #alertAssetIDMD');
			return;
		}

		$('#myModalis .modal-content').empty();
		$('#myModalis').modal('show');
		$('#myModalis').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');
		
	
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('searchAssetMd')?>',
			data: {'asset_type':asset_type, 'asset_id':asset_id, 'search_trigger':search_trigger},
			success: function(res) {
				$('#myModalis .modal-content').html(res);
				$('#myModalis #staff_list').removeClass('hidden');

				asset_row = $('#myModalis #tbl_asset_list').DataTable({
                    "ordering":false,
                });
			}
		});
	});

	// ENTER BUTTON NOT ALLOWED WARNING
	$('#myModalis').on('keyup', '#asset_id', function (e) {
		if (e.keyCode === 13) {
            e.preventDefault();
			msg.show('Enter button are not allowed', 'warning', '#myModalis .modal-content #alertAssetIDMD');
			return;
        }
	});

	// SELECT ASSET ID
	$('#myModalis').on('click', '.select_asset_id', function () {
		$('#myModalis').modal('hide');
		
		var thisBtn = $(this);
		var asset_code = thisBtn.data("al-code");
		var asset_desc = thisBtn.data("al-desc");
		var asset_serial = thisBtn.data("al-sno");
		var asset_brand = thisBtn.data("al-brand");
		var asset_quantity = thisBtn.data("al-quantity");
		var asset_amt = thisBtn.data("al-icost");
		var sid = thisBtn.data("al-sid");
		var sname = thisBtn.data("al-sname");
		
		$('#asset_id').val(asset_code);
		$('#assetType').val(asset_desc);
		$('#serialNo').val(asset_serial);
		$('#brand').val(asset_brand);
		$('#qItem').val(asset_quantity);
		$('#amtItem').val(asset_amt);
		$('#staff_id').val(sid);
		$('#staff_name').val(sname);
	});
	///// SEARCH ASSET //////

	///// SEARCH STAFF//////
	// SEARCH STAFF
	$('#cs_rp_form_al').on('click','.search_staff', function(){
		$('#myModalis .modal-content').empty();
		$('#myModalis').modal('show');
		$('#myModalis').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');
	
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('searchStaffMd')?>',
			data: '',
			success: function(res) {
				$('#myModalis .modal-content').html(res);
			}
		});
	});

	// SEARCH STAFF MODAL
	$('#myModalis').on('click', '.search_staff_md', function () {
		var staff_id = $('#myModalis #staff_id').val();
		search_trigger = 1;
		// console.log(staff_id);
		
		if(staff_id == '') {
			msg.show('Please enter Staff ID / Name', 'warning', '#myModalis .modal-content #alertStfIDMD');
			return;
		}

		$('#myModalis .modal-content').empty();
		$('#myModalis').modal('show');
		$('#myModalis').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');
		
	
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('searchStaffMd')?>',
			data: {'staff_id':staff_id, 'search_trigger':search_trigger},
			success: function(res) {
				$('#myModalis .modal-content').html(res);
				$('#myModalis #staff_list').removeClass('hidden');

				stf_row = $('#myModalis #tbl_stf_res_list').DataTable({
                    "ordering":false,
                });
			}
		});
	});

	// ENTER BUTTON NOT ALLOWED WARNING
	$('#myModalis').on('keyup', '#staff_id', function (e) {
		if (e.keyCode === 13) {
            e.preventDefault();
			msg.show('Enter button are not allowed', 'warning', '#myModalis .modal-content #alertStfIDMD');
			return;
        }
	});

	// SELECT STAFF ID
	$('#myModalis').on('click', '.select_staff_id', function () {
		$('#myModalis').modal('hide');

		var thisBtn = $(this);
		var td = thisBtn.parent().siblings();
		var staff_id = td.eq(0).html().trim();
		var staff_name = td.eq(1).html().trim();
		
		if(staff_id != '' && staff_name != '') {
			$('#staff_id').val(staff_id);
			$('#staff_name').val(staff_name);
		}
	});
	///// SEARCH STAFF//////

	// SAVE ADD CASE REPORT ENTRY (AL)
	$('#cs_rp_form_al').on('click', '.add_rp_al_frm', function (e) {
		e.preventDefault();
		var data = $('#addRpEntFmAL').serialize();
		msg.wait('#addRpEntFmALAlert');
		msg.wait('#addRpEntFmALFooter');
		// alert(data);
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveAddRpAlFrm')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#addRpEntFmALAlert');
				msg.show(res.msg, res.alert, '#addRpEntFmALFooter');

				if (res.sts == 1) {
				
					setTimeout(function () {
						$('.btn').removeAttr('disabled');
						
						// REFRESH CASE REPORT
						$('#rp_ent_al').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('csRpEntAL')?>',
							data: '',
							success: function(res) {
								$('#rp_ent_al').html(res);

								rp_al_row = $('#tbl_rp_al_list').DataTable({
									"ordering":false,
								});
							}
						});	
						
						// CHANGE UPDATE FORM
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('editCaseALForm')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#cs_rp_form_al').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
								$('.nav-tabs li:eq(1) a').tab('show');
							},
							success: function(res) {
								$('#cs_rp_form_al').html(res);

								var it_type = $('#itemType').val();
								$('#loaderItType').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
								
								if(it_type == 'MONEY' && it_type != '') {
									$('#aForm').removeClass('hidden');
									$('#bForm').addClass('hidden');
								} else if (it_type != 'MONEY' && it_type != '') {
									$('#bForm').removeClass('hidden');
									$('#aForm').addClass('hidden');
								} else if (it_type == '') {
									$('#aForm').addClass('hidden');
									$('#bForm').addClass('hidden');
								}

								$('#loaderItType').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>').hide();
							}
						});

						// SUSPECT
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('ALSuspectList')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#cs_rp_form_sp').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#cs_rp_form_sp').html(res);

								rp_al_row = $('#tbl_sp_al_list').DataTable({
									"ordering":false,
								});
							}
						});

					}, 1500);
				} else {
					$('.btn').removeAttr('disabled');
				}
			},
			error: function() {
				$('.btn').removeAttr('disabled');
				msg.danger('Please contact administrator.', '#addRpEntFmALAlert');
				msg.danger('Please contact administrator.', '#addRpEntFmALFooter');
			}
		});	
	});

	// UPDATE CASE AL
	$('#rp_ent_al').on('click','.upd_rp_ent', function(){

		var thisBtn = $(this);
		var td = thisBtn.closest("tr");
		var code = td.find(".code").text();

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('editCaseALForm')?>',
			data: {'case_id':code},
			beforeSend: function() {
				$('#cs_rp_form_al').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
				$('.nav-tabs li:eq(1) a').tab('show');
			},
			success: function(res) {
				$('#cs_rp_form_al').html(res);

				var it_type = $('#itemType').val();
				$('#loaderItType').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
				
				if(it_type == 'MONEY' && it_type != '') {
					$('#aForm').removeClass('hidden');
					$('#bForm').addClass('hidden');
				} else if (it_type != 'MONEY' && it_type != '') {
					$('#bForm').removeClass('hidden');
					$('#aForm').addClass('hidden');
				} else if (it_type == '') {
					$('#aForm').addClass('hidden');
					$('#bForm').addClass('hidden');
				}
				$('#loaderItType').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>').hide();

				// SUSPECT
				$.ajax({
					type: 'POST',
					url: '<?php echo $this->lib->class_url('ALSuspectList')?>',
					data: {'case_id':code},
					beforeSend: function() {
						$('#cs_rp_form_sp').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
					},
					success: function(res) {
						$('#cs_rp_form_sp').html(res);

						rp_al_row = $('#tbl_sp_al_list').DataTable({
							"ordering":false,
						});
					}
				});
			}
		});
	});

	// SAVE UPDATE CASE REPORT ENTRY (AL)
	$('#cs_rp_form_al').on('click', '.upd_rp_al_frm', function (e) {
		e.preventDefault();
		var data = $('#updRpEntFmAL').serialize();
		msg.wait('#updRpEntFmALAlert');
		msg.wait('#updRpEntFmALFooter');
		// alert(data);
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveEditRpAlFrm')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#updRpEntFmALAlert');
				msg.show(res.msg, res.alert, '#updRpEntFmALFooter');

				if (res.sts == 1) {
				
					setTimeout(function () {
						$('.btn').removeAttr('disabled');
						
						// REFRESH CASE REPORT
						$('#rp_ent_al').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('csRpEntAL')?>',
							data: '',
							success: function(res) {
								$('#rp_ent_al').html(res);

								rp_al_row = $('#tbl_rp_al_list').DataTable({
									"ordering":false,
								});
							}
						});	
						
						// CHANGE UPDATE FORM
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('editCaseALForm')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#cs_rp_form_al').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
								$('.nav-tabs li:eq(1) a').tab('show');
							},
							success: function(res) {
								$('#cs_rp_form_al').html(res);

								var it_type = $('#itemType').val();
								$('#loaderItType').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
								
								if(it_type == 'MONEY' && it_type != '') {
									$('#aForm').removeClass('hidden');
									$('#bForm').addClass('hidden');
								} else if (it_type != 'MONEY' && it_type != '') {
									$('#bForm').removeClass('hidden');
									$('#aForm').addClass('hidden');
								} else if (it_type == '') {
									$('#aForm').addClass('hidden');
									$('#bForm').addClass('hidden');
								}

								$('#loaderItType').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>').hide();
							}
						});

					}, 1500);
				} else {
					$('.btn').removeAttr('disabled');
				}
			},
			error: function() {
				$('.btn').removeAttr('disabled');
				msg.danger('Please contact administrator.', '#updRpEntFmALAlert');
				msg.danger('Please contact administrator.', '#updRpEntFmALFooter');
			}
		});	
	});

	// DELETE CASE REPORT ENTRY (AL)
	$('#rp_ent_al').on('click','.del_rp_afd', function() {
		var thisBtn = $(this);
		var td = thisBtn.closest("tr");
		var case_id = td.find(".code").text();
		var sid = td.find(".sid").text();
		var name = td.find(".name").text();
		
		$.confirm({
		    title: 'Delete Record',
		    content: 'Are you sure to delete this record? <br> <b>'+case_id+' - '+name+' ('+sid+')'+'</b>',
			type: 'red',
		    buttons: {
		        yes: function () {
					show_loading();
					$.ajax({
						type: 'POST',
						url: '<?php echo $this->lib->class_url('delCaseAfdForm')?>',
						data: {'case_id' : case_id},
						dataType: 'JSON',
						success: function(res) {
							if (res.sts==1) {
								hide_loading();
								$.alert({
									title: 'Success!',
									content: res.msg,
									type: 'green',
								});
								thisBtn.parents('tr').fadeOut().delay(1000).remove();
							} else {
								hide_loading();
								$.alert({
									title: 'Alert!',
									content: res.msg,
									type: 'red',
								});
							}
						}
					});			
		        },
		        cancel: function () {
		            $.alert('Canceled Delete Record!');
		        }
		    }
		});
		
	});

	/*----------------------------------------
	TAB 3 - SUSPECT DETAIL
	------------------------------------------*/

	// ADD SUSPECT DETL MODAL
	$('#cs_rp_form_sp').on('click','.add_sp_al_btn', function(){

		var case_id = $(this).val();

		$('#myModalis .modal-content').empty();
		$('#myModalis').modal('show');
		$('#myModalis').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('addSuspectDetlAL')?>',
			data: {'case_id':case_id},
			success: function(res) {
				$('#myModalis .modal-content').html(res);
			}
		});
	});

	// SEARCH STAFF
	$('#myModalis').on('click', '.search_staff_sp', function () {
        var case_id = $('#myModalis #case_id').val();
		var staff_id = $('#myModalis #staff_id').val();
		search_trigger = 1;
		
		if(staff_id == '') {
			msg.show('Please enter Staff ID / Name', 'warning', '#myModalis .modal-content #alertStfIDMD');
			return;
		}

		$('#myModalis .modal-content').empty();
		$('#myModalis').modal('show');
		$('#myModalis').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');
		
	
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('addSuspectDetlAL')?>',
			data: {'staff_id':staff_id, 'search_trigger':search_trigger, 'case_id':case_id},
			success: function(res) {
				$('#myModalis .modal-content').html(res);
				$('#myModalis #staff_list').removeClass('hidden');

				stf_row = $('#myModalis #tbl_stf_res_list').DataTable({
                    "ordering":false,
                });
			}
		});
	});

	// SELECT STAFF ID
	$('#myModalis').on('click', '.select_staff_id_sp', function () {
		show_loading();
		var thisBtn = $(this);
		var td = thisBtn.parent().siblings();
		var staff_id = td.eq(0).html().trim();
		var staff_name = td.eq(1).html().trim();

		var ss_code = thisBtn.data("ss-code");
		var ss_desc = thisBtn.data("ss-desc");
		var dept_code = thisBtn.data("dept-code");
		var dept_desc = thisBtn.data("dept-desc");
		
		if(staff_id != '') {
			$('#stfID').val(staff_id);
			$('#stfName').val(staff_name);

			$('#staff_svc').val(ss_code);
			$('#staff_svc_desc').val(ss_desc);

			$('#staff_dept').val(dept_code);
			$('#staff_dept_desc').val(dept_desc);
		}

		$('#myModalis #staff_form').removeClass('hidden');
        $('#myModalis').animate({scrollTop: $('#staff_form').position().top}, 'slow');
		hide_loading();
	});

	// SAVE SUSPECT DETAIL
	$('#myModalis').on('click', '.save_sp_detl', function (e) { 
		e.preventDefault();
        var data = $('#spDetlForm').serialize();
        msg.wait('#spDetlFormAlert');
        msg.wait('#spDetlFormAlertFooter');
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveSpDetl')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
                msg.show(res.msg, res.alert, '#spDetlFormAlert');
                msg.show(res.msg, res.alert, '#spDetlFormAlertFooter');
				
				if (res.sts == 1) {
					
					setTimeout(function () {
						$('#myModalis').modal('hide');

						// REFRESH SUSPECT LIST
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('ALSuspectList')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#cs_rp_form_sp').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#cs_rp_form_sp').html(res);

								rp_al_row = $('#tbl_sp_al_list').DataTable({
									"ordering":false,
								});
							}
						});
						
					}, 1000);
					$('.btn').removeAttr('disabled');
				} else {
					$('.btn').removeAttr('disabled');
				}
			},
			error: function() {
				$('.btn').removeAttr('disabled');
                msg.danger('Please contact administrator.', '#spDetlFormAlert');
                msg.danger('Please contact administrator.', '#spDetlFormAlertFooter');
			}
		});	
    });

	// DELETE SUSPECT DETAIL
	$('#cs_rp_form_sp').on('click','.del_sp', function() {
		var thisBtn = $(this);
		var td = thisBtn.parent().siblings();
		var staff_id = td.eq(0).html().trim();
		var staff_name = td.eq(1).html().trim();
		var case_id = thisBtn.val();
		
		$.confirm({
		    title: 'Delete Record',
		    content: 'Are you sure to delete this record? <br> <b>'+staff_id+' - '+staff_name+'</b>',
			type: 'red',
		    buttons: {
		        yes: function () {
					show_loading();
					$.ajax({
						type: 'POST',
						url: '<?php echo $this->lib->class_url('delSpDetl')?>',
						data: {'case_id':case_id, 'staff_id':staff_id},
						dataType: 'JSON',
						success: function(res) {
							if (res.sts==1) {
								hide_loading();
								$.alert({
									title: 'Success!',
									content: res.msg,
									type: 'green',
								});
								thisBtn.parents('tr').fadeOut().delay(1000).remove();
							} else {
								hide_loading();
								$.alert({
									title: 'Alert!',
									content: res.msg,
									type: 'red',
								});
							}
						}
					});			
		        },
		        cancel: function () {
		            $.alert('Canceled Delete Record!');
		        }
		    }
		});
		
	});


	
</script>