<?php echo $this->lib->title('Disciplinary / Case Report Entry (Inquiry)', $screen_id) ?>

<section id="widget-grid" class="">
    <div class="jarviswidget  jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" role="widget">
        <header role="heading">
            <div class="jarviswidget-ctrls" role="menu">
                <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" data-placement="bottom"><i class="fa fa-expand "></i></a>
            </div>
            <h2>AFF017 - Case Report Entry (Inquiry)</h2>				
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
                                    <a style="color:#000 !important" href="#s3" data-toggle="tab" aria-expanded="false">Committee</a>
                                </li>
                                <li class="">
                                    <a style="color:#000 !important" href="#s4" data-toggle="tab" aria-expanded="false">Suspect</a>
                                </li>
                            </ul>
							<!-- myTabContent1 -->
                            <div id="myTabContent1" class="tab-content padding-10">

								<div class="tab-pane fade active in" id="s1">
									<form class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label"><b>Case Year</b></label>
                                            <div class="col-md-2">
                                                <?php echo form_dropdown('year_f', $case_year_list, $curr_year, 'class="form-control width-50 case_f" id="year_f"')?>
                                            </div>
                                        </div>
                                    </form>

									<div id="rp_ent_iq">
									</div>
                                </div>

								<div class="tab-pane fade" id="s2">
									<div id="cs_rp_form_iq">
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
									<div id="cs_rp_form_cm_iq">
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
									<div id="cs_rp_form_sp_iq">
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
	var rp_iq_row = '';
	var stf_row = '';
	
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
	TAB 1 - CASE REPORT ENTRY (INQUIRY)
	------------------------------------------*/
	var year_f = $('#year_f').val();

	// POPULATE INQUIRY CASE REPORT ENTRY
	// $('#rp_ent_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
	show_loading();
	$.ajax({
		type: 'POST',
		url: '<?php echo $this->lib->class_url('csRpEntIQ')?>',
		data: {'year_f':year_f},
		success: function(res) {
			$('#rp_ent_iq').html(res);

			rp_iq_row = $('#tbl_rp_iq_list').DataTable({
				"ordering":false,
			});
			hide_loading();
		}
	});		

	// CASE FILTER
    $('.case_f').change(function(){
        var year_f = $('#year_f').val();
        
        // POPULATE CASE LIST
        show_loading();
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('csRpEntIQ')?>',
			data: {'year_f':year_f},
			success: function(res) {
				$('#rp_ent_iq').html(res);

				rp_iq_row = $('#tbl_rp_iq_list').DataTable({
					"ordering":false,
				});
				hide_loading();
			}
		});	
    });

	///////////////////////////////////////////////////////
	// ADD, EDIT, DELETE CASE REPORT ENTRY (INQUIRY)
	//////////////////////////////////////////////////////

	// ADD CASE REPORT ENTRY (INQUIRY)
	$('#rp_ent_iq').on('click','.add_case_rp_iq_btn', function(){
		$.ajax({
			type: 'POST',
            url: '<?php echo $this->lib->class_url('addCaseIQForm')?>',
            beforeSend: function() {
				$('#cs_rp_form_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
				$('.nav-tabs li:eq(1) a').tab('show');
			},
			success: function(res) {
				$('#cs_rp_form_iq').html(res);

				$('#cs_rp_form_cm_iq').html('<p><table class="table table-bordered table-hover"><thead><tr> <th class="text-center">Please Add Record or click Edit button from Case Report tab</th></tr></thead></table></p>');
				$('#cs_rp_form_sp').html('<p><table class="table table-bordered table-hover"><thead><tr> <th class="text-center">Please Add Record or click Edit button from Case Report tab</th></tr></thead></table></p>');
				$('#cs_rp_form_sp_iq').html('<p><table class="table table-bordered table-hover"><thead><tr> <th class="text-center">Please Add Record or click Edit button from Case Report tab</th></tr></thead></table></p>');
			}
		});
    });

	// SAVE ADD CASE REPORT ENTRY (INQUIRY)
	$('#cs_rp_form_iq').on('click', '.add_rp_iq_frm', function (e) {
		e.preventDefault();
		var data = $('#addRpEntFmIQ').serialize();
		msg.wait('#addRpEntFmIQAlert');
		// alert(data);
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveAddRpIqFrm')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#addRpEntFmIQAlert');

				if (res.sts == 1) {
				
					setTimeout(function () {
						$('.btn').removeAttr('disabled');
						
						// REPOPULATE INQUIRY CASE REPORT ENTRY
						$('#rp_ent_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('csRpEntIQ')?>',
							data: '',
							success: function(res) {
								$('#rp_ent_iq').html(res);

								rp_iq_row = $('#tbl_rp_iq_list').DataTable({
									"ordering":false,
								});
							}
						});

						// ENTRY FORM
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('editCaseIQForm')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#cs_rp_form_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#cs_rp_form_iq').html(res);
							}
						});

						// COMMITTEE 
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('editCommIQForm')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#cs_rp_form_cm_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#cs_rp_form_cm_iq').html(res);
							}
						});

						// SUSPECT 
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('IQSuspectList')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#cs_rp_form_sp_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#cs_rp_form_sp_iq').html(res);

								// rp_iq_row = $('#tbl_sp_iq_list').DataTable({
								// 				"ordering":false,
								// 			});
							}
						});

						$('.nav-tabs li:eq(2) a').tab('show');
					}, 1500);
				} else {
					$('.btn').removeAttr('disabled');
				}
			},
			error: function() {
				$('.btn').removeAttr('disabled');
				msg.danger('Please contact administrator.', '#addRpEntFmIQAlert');
			}
		});	
	});

	// UPDATE CASE INQUIRY
	$('#rp_ent_iq').on('click','.upd_rp_iq', function(){

		var thisBtn = $(this);
		var td = thisBtn.closest("tr");
		var code = td.find(".code").text();

		$('.nav-tabs li:eq(1) a').tab('show');
		
		// ENTRY FORM
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('editCaseIQForm')?>',
			data: {'case_id':code},
			beforeSend: function() {
				$('#cs_rp_form_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
			},
			success: function(res) {
				$('#cs_rp_form_iq').html(res);
			}
		});

		// COMMITTEE 
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('editCommIQForm')?>',
			data: {'case_id':code},
			beforeSend: function() {
				$('#cs_rp_form_cm_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
			},
			success: function(res) {
				$('#cs_rp_form_cm_iq').html(res);
			}
		});

		// SUSPECT 
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('IQSuspectList')?>',
			data: {'case_id':code},
			beforeSend: function() {
				$('#cs_rp_form_sp_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
			},
			success: function(res) {
				$('#cs_rp_form_sp_iq').html(res);

				// rp_iq_row = $('#tbl_sp_iq_list').DataTable({
				// 				"ordering":false,
				// 			});
			}
		});
	});

	// SAVE UPDATE CASE REPORT ENTRY (INQUIRY)
	$('#cs_rp_form_iq').on('click', '.edit_rp_iq_frm', function (e) {
		e.preventDefault();
		var data = $('#editRpEntFmIQ').serialize();
		msg.wait('#editRpEntFmIQAlert');
		msg.wait('#editRpEntFmIQAlertFooter');
		// alert(data);
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveEditRpIQFrm')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#editRpEntFmIQAlert');
				msg.show(res.msg, res.alert, '#editRpEntFmIQAlertFooter');

				if (res.sts == 1) {
				
					setTimeout(function () {
						$('.btn').removeAttr('disabled');
						
						// REPOPULATE INQUIRY CASE REPORT ENTRY
						$('#rp_ent_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('csRpEntIQ')?>',
							data: '',
							success: function(res) {
								$('#rp_ent_iq').html(res);

								rp_iq_row = $('#tbl_rp_iq_list').DataTable({
									"ordering":false,
								});
							}
						});

						// ENTRY FORM
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('editCaseIQForm')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#cs_rp_form_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
								$('.nav-tabs li:eq(1) a').tab('show');
							},
							success: function(res) {
								$('#cs_rp_form_iq').html(res);
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

	// DELETE CASE REPORT ENTRY (INQUIRY)
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
	TAB 3 - COMMITTEE DETAIL
	------------------------------------------*/

	// CHANGE DATE MPE
	$('#cs_rp_form_cm_iq').on('dp.change', '#dateMPE', function () {
		var mpe_date = $(this).val();
		var dcm_sts = $('#dcmSts').val();
		$('#loaderSts').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');

		if(mpe_date != '') {
			$('#dcmSts').val('CLOSED');
		} else if(mpe_date == '' && dcm_sts == 'CLOSED') {
			$('#dcmSts').val('PRELIMINARY REPORT');
		}

		$('#loaderSts').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>').hide();
	});

	// SAVE COMMITTEE DETL
	$('#cs_rp_form_cm_iq').on('click', '.save_cm_iq_frm', function (e) { 
		e.preventDefault();
        var data = $('#comDetlIQ').serialize();
        msg.wait('#comDetlIQAlert');
        msg.wait('#comDetlIQAlertFooter');
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveCmIQDetl')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
                msg.show(res.msg, res.alert, '#comDetlIQAlert');
                msg.show(res.msg, res.alert, '#comDetlIQAlertFooter');
				
				if (res.sts == 1) {
					
					setTimeout(function () {
						// COMMITTEE 
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('editCommIQForm')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#cs_rp_form_cm_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
								$('.nav-tabs li:eq(2) a').tab('show');
							},
							success: function(res) {
								$('#cs_rp_form_cm_iq').html(res);
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
                msg.danger('Please contact administrator.', '#comDetlIQAlert');
                msg.danger('Please contact administrator.', '#comDetlIQAlertFooter');
			}
		});	
    });

	// ADD COMMITTEE MODAL
	$('#cs_rp_form_cm_iq').on('click','.add_cm_iq_btn', function(){

		var case_id = $(this).val();

		$('#myModalis .modal-content').empty();
		$('#myModalis').modal('show');
		$('#myModalis').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('addCommIQ')?>',
			data: {'case_id':case_id},
			success: function(res) {
				$('#myModalis .modal-content').html(res);
			}
		});
	});

	// SEARCH STAFF
	$('#myModalis').on('click', '.search_staff_cm2', function () {
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
			url: '<?php echo $this->lib->class_url('addCommIQ')?>',
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
	$('#myModalis').on('click', '.select_staff_id_cm', function () {
		show_loading();
		var thisBtn = $(this);
		var td = thisBtn.parent().siblings();
		var staff_id = td.eq(0).html().trim();
		var staff_name = td.eq(1).html().trim();

		var dept_code = thisBtn.data("dept-code");
		var dept_desc = thisBtn.data("dept-desc");
		
		if(staff_id != '') {
			$('#stfID').val(staff_id);
			$('#stfName').val(staff_name);

			$('#staff_dept').val(dept_code);
			$('#staff_dept_desc').val(dept_desc);
		}

		$('#myModalis #staff_form').removeClass('hidden');
        $('#myModalis').animate({scrollTop: $('#staff_form').position().top}, 'slow');
		hide_loading();
	});

	// SAVE COMMITTEE MEMBER
	$('#myModalis').on('click', '.save_cmm_iq', function (e) { 
		e.preventDefault();
        var data = $('#comIQForm').serialize();
        msg.wait('#comIQFormAlert');
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveCommIQ')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
                msg.show(res.msg, res.alert, '#comIQFormAlert');
				
				if (res.sts == 1) {
					
					setTimeout(function () {
						$('#myModalis').modal('hide');

						// COMMITTEE 
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('editCommIQForm')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#cs_rp_form_cm_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
								$('.nav-tabs li:eq(2) a').tab('show');
							},
							success: function(res) {
								$('#cs_rp_form_cm_iq').html(res);
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
                msg.danger('Please contact administrator.', '#comIQFormAlert');
			}
		});	
    });

	// DELETE COMMITTEE MEMBER
	$('#cs_rp_form_cm_iq').on('click','.del_cmm2', function() {
		var thisBtn = $(this);
		var td = thisBtn.parent().siblings();
		var seq = td.eq(0).html().trim();
		var staff_id = td.eq(1).html().trim();
		var staff_name = td.eq(2).html().trim();
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
						url: '<?php echo $this->lib->class_url('delCmmIQ')?>',
						data: {'seq':seq, 'case_id':case_id},
						dataType: 'JSON',
						success: function(res) {
							if (res.sts==1) {
								hide_loading();
								$.alert({
									title: 'Success!',
									content: res.msg,
									type: 'green',
								});

								// COMMITTEE 
								$.ajax({
									type: 'POST',
									url: '<?php echo $this->lib->class_url('editCommIQForm')?>',
									data: {'case_id':res.case_id},
									beforeSend: function() {
										$('#cs_rp_form_cm_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
										$('.nav-tabs li:eq(2) a').tab('show');
									},
									success: function(res) {
										$('#cs_rp_form_cm_iq').html(res);
									}
								});
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
	TAB 4 - SUSPECT DETAIL
	------------------------------------------*/

	// ADD SUSPECT DETL MODAL
	$('#cs_rp_form_sp_iq').on('click','.add_sp_al_btn2', function(){

		var case_id = $(this).val();

		$('#myModalis .modal-content').empty();
		$('#myModalis').modal('show');
		$('#myModalis').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('addSuspectDetlIQ')?>',
			data: {'case_id':case_id},
			success: function(res) {
				$('#myModalis .modal-content').html(res);
			}
		});
	});

	// SEARCH STAFF
	$('#myModalis').on('click', '.search_staff_sp2', function () {
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
			url: '<?php echo $this->lib->class_url('addSuspectDetlIQ')?>',
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
	$('#myModalis').on('click', '.select_staff_id_sp2', function () {
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
	$('#myModalis').on('click', '.save_sp_detl2', function (e) { 
		e.preventDefault();
        var data = $('#spDetlForm').serialize();
        msg.wait('#spDetlFormAlert');
        msg.wait('#spDetlFormAlertFooter');
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveSpDetlIQ')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
                msg.show(res.msg, res.alert, '#spDetlFormAlert');
                msg.show(res.msg, res.alert, '#spDetlFormAlertFooter');
				
				if (res.sts == 1) {
					
					setTimeout(function () {
						$('#myModalis').modal('hide');

						// SUSPECT 
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('IQSuspectList')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#cs_rp_form_sp_iq').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#cs_rp_form_sp_iq').html(res);

								// rp_iq_row = $('#tbl_sp_iq_list').DataTable({
								// 				"ordering":false,
								// 			});
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
	$('#cs_rp_form_sp_iq').on('click','.del_sp_iq', function() {
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
						url: '<?php echo $this->lib->class_url('delSpDetlIQ')?>',
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