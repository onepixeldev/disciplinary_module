<?php echo $this->lib->title('Disciplinary / Case Update', $screen_id) ?>

<section id="widget-grid" class="">
    <div class="jarviswidget  jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" role="widget">
        <header role="heading">
            <div class="jarviswidget-ctrls" role="menu">
                <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" data-placement="bottom"><i class="fa fa-expand "></i></a>
            </div>
            <h2>AFF015 - Case Update</h2>				
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
                                    <a style="color:#000 !important" href="#s2" data-toggle="tab" aria-expanded="false">Update Form</a>
                                </li>
                            </ul>
							<!-- myTabContent1 -->
                            <div id="myTabContent1" class="tab-content padding-10">

								<div class="tab-pane fade active in" id="s1">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label"><b>Case Type</b></label>
                                            <div class="col-md-2">
                                                <?php echo form_dropdown('case_type_f', $case_type, '', 'class="form-control width-50 case_f" id="case_type_f"')?>
                                            </div>

                                            <label class="col-md-2 control-label"><b>Year</b></label>
                                            <div class="col-md-2">
                                                <?php echo form_dropdown('year_f', $case_year_list, $curr_year, 'class="form-control width-50 case_f" id="year_f"')?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label"><b>Status</b></label>
                                            <div class="col-md-2">
                                                <?php echo form_dropdown('sts_f', $sts_list, '', 'class="form-control width-50 case_f" id="sts_f"')?>
                                            </div>
                                        </div>
                                    </form>

									<div id="case_rp">
									</div>
                                </div>

								<div class="tab-pane fade" id="s2">
									<div id="form_upd">
                                        <p>
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Please click Edit button from Case Report tab</th>
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
	var cs_rp_row = '';
	var stf_row = '';
	var sts_row = '';
	var rp_al_row = '';
	
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
	TAB 1 - CASE LIST
	------------------------------------------*/
	var year_f = $('#year_f').val();

	// POPULATE CASE LIST
	show_loading();
	$.ajax({
		type: 'POST',
		url: '<?php echo $this->lib->class_url('csUpdList')?>',
		data: {'year_f':year_f},
		success: function(res) {
			$('#case_rp').html(res);

			cs_rp_row = $('#tbl_cs_list').DataTable({
				"ordering":false,
			});
			hide_loading();
		}
	});

	// CASE FILTER
    $('.case_f').change(function(){
        var case_type_f = $('#case_type_f').val();
        var year_f = $('#year_f').val();
        var sts_f = $('#sts_f').val();

        // console.log(case_type_f);
        // console.log(year_f);
        // console.log(sts_f);
        
        // POPULATE CASE LIST
        $('#case_rp').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            type: 'POST',
            url: '<?php echo $this->lib->class_url('csUpdList')?>',
            data: {'case_type_f':case_type_f, 'year_f':year_f, 'sts_f':sts_f},
            success: function(res) {
				$('#case_rp').html(res);
				$('#form_upd').html('<p><table class="table table-bordered table-hover"><thead><tr><th class="text-center">Please click Edit button from Case Report tab</th></tr></thead></table></p>');

                cs_rp_row = $('#tbl_cs_list').DataTable({
                    "ordering":false,
                });
            }
        });
    });

	// EDIT CASE 
	$('#case_rp').on('click','.upd_case', function(){

		var thisBtn = $(this);
		var td = thisBtn.closest("tr");
		var code = td.find(".code").text();
		var case_type = thisBtn.val();

		// console.log(case_type); return;

		if(case_type == 'DISCIPLINARY') {
			$.ajax({
				type: 'POST',
				url: '<?php echo $this->lib->class_url('editCaseDiscForm2')?>',
				data: {'case_id':code},
				beforeSend: function() {
					$('#form_upd').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
					$('.nav-tabs li:eq(1) a').tab('show');
				},
				success: function(res) {
					$('#form_upd').html(res);
				}
			});
		} 
		else if(case_type == 'ABSENCE') {
			$.ajax({
				type: 'POST',
				url: '<?php echo $this->lib->class_url('editCaseAFDForm2')?>',
				data: {'case_id':code},
				beforeSend: function() {
					$('#form_upd').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
					$('.nav-tabs li:eq(1) a').tab('show');
				},
				success: function(res) {
					$('#form_upd').html(res);
				}
			});
		}
		else if(case_type == 'ASSET_LOSS') {
			$('.nav-tabs li:eq(1) a').tab('show');

			$.ajax({
				type: 'POST',
				url: '<?php echo $this->lib->class_url('assetLossUpdForm')?>',
				beforeSend: function() {
					$('#form_upd').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>').show();
				},
				success: function(res) {
					$('#form_upd').html(res);
					
					$.ajax({
						type: 'POST',
						url: '<?php echo $this->lib->class_url('editCaseALForm')?>',
						data: {'case_id':code},
						beforeSend: function() {
							$('#detl1').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						},
						success: function(res) {
							$('#detl1').html(res);

							var it_type = $('#itemType').val();
							$('#loaderItType').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							
							if(it_type == 'MONEY' && it_type != '') {
								$('#aForm').removeClass('hidden');
								$('#bForm').addClass('hidden');
								$('#form_upd .search_staff').attr('disabled', 'disabled');
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
									$('#detl2').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
								},
								success: function(res) {
									$('#detl2').html(res);

									rp_al_row = $('#tbl_sp_al_list').DataTable({
										"ordering":false,
									});
								}
							});

							// COMMITTEE
							$.ajax({
								type: 'POST',
								url: '<?php echo $this->lib->class_url('comCaseAl')?>',
								data: {'case_id':code},
								beforeSend: function() {
									$('#detl3').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
								},
								success: function(res) {
									$('#detl3').html(res);

									rp_al_row = $('#tbl_cl_list').DataTable({
										"ordering":false,
									});
								}
							});
						}
					});
				}
        	});
		}
		else if(case_type == 'INQUIRY_SHOWCAUSE') {
			$('.nav-tabs li:eq(1) a').tab('show');

			$.ajax({
				type: 'POST',
				url: '<?php echo $this->lib->class_url('inquiryUpdForm')?>',
				beforeSend: function() {
					$('#form_upd').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>').show();
				},
				success: function(res) {
					$('#form_upd').html(res);

					// ENTRY FORM
					$.ajax({
						type: 'POST',
						url: '<?php echo $this->lib->class_url('editCaseIQForm')?>',
						data: {'case_id':code},
						beforeSend: function() {
							$('#detlIQ1').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						},
						success: function(res) {
							$('#detlIQ1').html(res);
						}
					});

					// COMMITTEE 
					$.ajax({
						type: 'POST',
						url: '<?php echo $this->lib->class_url('editCommIQForm')?>',
						data: {'case_id':code},
						beforeSend: function() {
							$('#detlIQ2').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						},
						success: function(res) {
							$('#detlIQ2').html(res);
						}
					});

					// SUSPECT 
					$.ajax({
						type: 'POST',
						url: '<?php echo $this->lib->class_url('IQSuspectList')?>',
						data: {'case_id':code},
						beforeSend: function() {
							$('#detlIQ3').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						},
						success: function(res) {
							$('#detlIQ3').html(res);

							rp_iq_row = $('#tbl_sp_iq_list').DataTable({
											"ordering":false,
										});
						}
					});
				}
        	});
		}
	});

	/*----------------------------------------
	TAB 2 - UPDATE FORM
	------------------------------------------*/

	// STATUS PROGRESS
	$('#form_upd').on('click','.sts_progress', function(){
		var case_id = $(this).val();

		$('#myModalis .modal-content').empty();
		$('#myModalis').modal('show');
		$('#myModalis').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');
	
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('stsProgressMd')?>',
			data: {'case_id':case_id},
			success: function(res) {
				$('#myModalis .modal-content').html(res);
				sts_row = $('#myModalis #tbl_sts_list').DataTable({
                    "ordering":false,
                });
			}
		});
	});

	// CHANGE STATUS OPTION
	$('#form_upd').on('change','#sts_opt', function(){
		var sts_code = $(this).val();

		$('#loaderSts').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('getStatusDesc')?>',
			data: {'sts_code':sts_code},
			dataType: 'JSON',
			success: function(res) {
				if (res.sts == 1) {
					$('#loaderSts').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>').hide();

					$('#status').val(sts_code);
					$('#status_desc').val(res.sts_desc);
				} 	
			}
		});	

	});

	// SAVE UPDATE CASE REPORT ENTRY (DISCIPLINARY)
	$('#form_upd').on('click', '.edit_rp_ent_frm', function (e) {
		e.preventDefault();
		var data = $('#editRpEntFmDisc').serialize();
		msg.wait('#editRpEntFmDiscAlert');
		msg.wait('#editRpEntFmDiscAlertFooter');
		// alert(data);
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveEditRpEntFrm2')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#editRpEntFmDiscAlert');
				msg.show(res.msg, res.alert, '#editRpEntFmDiscAlertFooter');

				if (res.sts == 1) {
				
					setTimeout(function () {
						$('.btn').removeAttr('disabled');

						var case_type_f = $('#case_type_f').val();
						var year_f = $('#year_f').val();
						var sts_f = $('#sts_f').val();
						
						// POPULATE CASE LIST
						$('#case_rp').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('csUpdList')?>',
							data: {'case_type_f':case_type_f, 'year_f':year_f, 'sts_f':sts_f},
							success: function(res) {
								$('#case_rp').html(res);

								cs_rp_row = $('#tbl_cs_list').DataTable({
									"ordering":false,
								});
							}
						});
						
						// REFRESH EDIT FORM
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('editCaseDiscForm2')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#form_upd').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#form_upd').html(res);
							}
						});
					}, 1500);
				} else {
					$('.btn').removeAttr('disabled');
				}
			},
			error: function() {
				$('.btn').removeAttr('disabled');
				msg.danger('Please contact administrator.', '#editRpEntFmDiscAlert');
				msg.danger('Please contact administrator.', '#editRpEntFmDiscAlertFooter');
			}
		});	
	});

	// SAVE UPDATE CASE REPORT ENTRY (AFD)
	$('#form_upd').on('click', '.edit_rp_afd_frm', function (e) {
		e.preventDefault();
		var data = $('#editRpEntFmAFD').serialize();
		msg.wait('#editRpEntFmAFDAlert');
		msg.wait('#editRpEntFmAFDFooter');
		// alert(data);
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveEditRpAfdFrm')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#editRpEntFmAFDAlert');
				msg.show(res.msg, res.alert, '#editRpEntFmAFDFooter');

				if (res.sts == 1) {
				
					setTimeout(function () {
						$('.btn').removeAttr('disabled');

						var case_type_f = $('#case_type_f').val();
						var year_f = $('#year_f').val();
						var sts_f = $('#sts_f').val();

						// POPULATE CASE LIST
						$('#case_rp').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('csUpdList')?>',
							data: {'case_type_f':case_type_f, 'year_f':year_f, 'sts_f':sts_f},
							success: function(res) {
								$('#case_rp').html(res);

								cs_rp_row = $('#tbl_cs_list').DataTable({
									"ordering":false,
								});
							}
						});
						
						// REFRESH FORM UPDATE
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('editCaseAFDForm2')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#form_upd').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#form_upd').html(res);
							}
						});

					}, 1500);
				} else {
					$('.btn').removeAttr('disabled');
				}
			},
			error: function() {
				$('.btn').removeAttr('disabled');
				msg.danger('Please contact administrator.', '#editRpEntFmAFDAlert');
				msg.danger('Please contact administrator.', '#editRpEntFmAFDFooter');
			}
		});	
	});

	// SAVE UPDATE CASE REPORT ENTRY (AL)
	$('#form_upd').on('click', '.upd_rp_al_frm', function (e) {
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
						
						var case_type_f = $('#case_type_f').val();
						var year_f = $('#year_f').val();
						var sts_f = $('#sts_f').val();

						// POPULATE CASE LIST
						$('#case_rp').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('csUpdList')?>',
							data: {'case_type_f':case_type_f, 'year_f':year_f, 'sts_f':sts_f},
							success: function(res) {
								$('#case_rp').html(res);

								cs_rp_row = $('#tbl_cs_list').DataTable({
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
								$('#detl1').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#detl1').html(res);

								var it_type = $('#itemType').val();
								$('#loaderItType').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
								
								if(it_type == 'MONEY' && it_type != '') {
									$('#aForm').removeClass('hidden');
									$('#bForm').addClass('hidden');
									$('#form_upd .search_staff').attr('disabled', 'disabled');
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

	///// SEARCH STAFF////// - ASSET LOSS
	// SEARCH STAFF
	$('#form_upd').on('click','.search_staff', function(){
		$('#myModalis .modal-content').empty();
		$('#myModalis').modal('show');
		$('#myModalis').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');
	
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('searchStaffMd2')?>',
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
			url: '<?php echo $this->lib->class_url('searchStaffMd2')?>',
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
	///// SEARCH STAFF////// - ASSET LOSS

	// POPULATE ITEM DESCRIPTION
	$('#form_upd').on('change','#itemDetl', function(){
        var it_detl = $('#itemDetl option:selected').text();
        $('#loaderItType').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
        
        if(it_detl != '') {
            $('#itemDesc').val(it_detl);
        }

        $('#loaderItType').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>').hide();
	});
	
	// SAVE UPDATE CASE REPORT ENTRY (INQUIRY)
	$('#form_upd').on('click', '.edit_rp_iq_frm', function (e) {
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

						var case_type_f = $('#case_type_f').val();
						var year_f = $('#year_f').val();
						var sts_f = $('#sts_f').val();
						
						// POPULATE CASE LIST
						$('#case_rp').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('csUpdList')?>',
							data: {'case_type_f':case_type_f, 'year_f':year_f, 'sts_f':sts_f},
							success: function(res) {
								$('#case_rp').html(res);

								cs_rp_row = $('#tbl_cs_list').DataTable({
									"ordering":false,
								});
							}
						});	

						// ENTRY FORM
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('editCaseIQForm')?>',
							data: {'case_id': res.case_id},
							beforeSend: function() {
								$('#detlIQ1').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#detlIQ1').html(res);
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

	///// SEARCH ASSET //////
	// SEARCH ASSET
	$('#form_upd').on('click','.search_asset', function(){
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

	/*----------------------------------------
	TAB 2.2 - SUSPECT DETAIL (ASSET LOSS)
	------------------------------------------*/

	// ADD SUSPECT DETL MODAL
	$('#form_upd').on('click','.add_sp_al_btn', function(){

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
								$('#detl2').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#detl2').html(res);

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
	$('#form_upd').on('click','.del_sp', function() {
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

	/*----------------------------------------
	TAB 2.3 - COMMITTEE DETAIL (ASSET LOSS)
	------------------------------------------*/

	// CHANGE DATE JKTK
	$('#form_upd').on('dp.change', '#dateJKTK', function () {
		var jktk_date = $(this).val();
		var dcm_sts = $('#dcmSts').val();
		$('#loaderSts').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');

		if(jktk_date != '') {
			$('#dcmSts').val('CLOSED');
		} else if(jktk_date == '' && dcm_sts == 'CLOSED') {
			$('#dcmSts').val('PRELIMINARY REPORT');
		}

		$('#loaderSts').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>').hide();
	});

	// SAVE COMMITTEE DETL
	$('#form_upd').on('click', '.save_cm_detl_frm', function (e) { 
		e.preventDefault();
        var data = $('#comDetl').serialize();
        msg.wait('#comDetlAlert');
        msg.wait('#comDetlAlertFooter');
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveCmDetl')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
                msg.show(res.msg, res.alert, '#comDetlAlert');
                msg.show(res.msg, res.alert, '#comDetlAlertFooter');
				
				if (res.sts == 1) {
					
					setTimeout(function () {
						var case_type_f = $('#case_type_f').val();
						var year_f = $('#year_f').val();
						var sts_f = $('#sts_f').val();

						// POPULATE CASE LIST
						$('#case_rp').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('csUpdList')?>',
							data: {'case_type_f':case_type_f, 'year_f':year_f, 'sts_f':sts_f},
							success: function(res) {
								$('#case_rp').html(res);

								cs_rp_row = $('#tbl_cs_list').DataTable({
									"ordering":false,
								});
							}
						});	

						// COMMITTEE
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('comCaseAl')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#detl3').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#detl3').html(res);

								rp_al_row = $('#tbl_cl_list').DataTable({
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
                msg.danger('Please contact administrator.', '#comDetlAlert');
                msg.danger('Please contact administrator.', '#comDetlAlertFooter');
			}
		});	
    });

	// ADD COMMITTEE MODAL
	$('#form_upd').on('click','.add_cm_btn', function(){

		var case_id = $(this).val();

		$('#myModalis .modal-content').empty();
		$('#myModalis').modal('show');
		$('#myModalis').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('addCommAL')?>',
			data: {'case_id':case_id},
			success: function(res) {
				$('#myModalis .modal-content').html(res);
			}
		});
	});

	// SEARCH STAFF
	$('#myModalis').on('click', '.search_staff_cm', function () {
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
			url: '<?php echo $this->lib->class_url('addCommAL')?>',
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
	$('#myModalis').on('click', '.save_cmm_mem', function (e) { 
		e.preventDefault();
        var data = $('#comMemForm').serialize();
        msg.wait('#comMemFormAlert');
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveCommMem')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
                msg.show(res.msg, res.alert, '#comMemFormAlert');
				
				if (res.sts == 1) {
					
					setTimeout(function () {
						$('#myModalis').modal('hide');

						// COMMITTEE
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('comCaseAl')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#detl3').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#detl3').html(res);

								rp_al_row = $('#tbl_cl_list').DataTable({
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
                msg.danger('Please contact administrator.', '#comMemFormAlert');
			}
		});	
    });

	// DELETE COMMITTEE MEMBER
	$('#form_upd').on('click','.del_cmm', function() {
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
						url: '<?php echo $this->lib->class_url('delCmmMem')?>',
						data: {'seq':seq, 'case_id':case_id},
						dataType: 'JSON',
						success: function(res) {
							if (res.sts==1) {
								hide_loading();
								// COMMITTEE
								// $.ajax({
								// 	type: 'POST',
								// 	url: '<?php echo $this->lib->class_url('comCaseAl')?>',
								// 	data: {'case_id':res.case_id},
								// 	beforeSend: function() {
								// 		$('#detl3').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
								// 	},
								// 	success: function(res) {
								// 		$('#detl3').html(res);

								// 		rp_al_row = $('#tbl_cl_list').DataTable({
								// 			"ordering":false,
								// 		});
								// 	}
								// });

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
	TAB 2.2 - COMMITTEE DETAIL (INQUIRY)
	------------------------------------------*/

	// CHANGE DATE MPE
	$('#form_upd').on('dp.change', '#dateMPE', function () {
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
	$('#form_upd').on('click', '.save_cm_iq_frm', function (e) { 
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

						var case_type_f = $('#case_type_f').val();
						var year_f = $('#year_f').val();
						var sts_f = $('#sts_f').val();
						
						// POPULATE CASE LIST
						$('#case_rp').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('csUpdList')?>',
							data: {'case_type_f':case_type_f, 'year_f':year_f, 'sts_f':sts_f},
							success: function(res) {
								$('#case_rp').html(res);

								cs_rp_row = $('#tbl_cs_list').DataTable({
									"ordering":false,
								});
							}
						});	
						
						// COMMITTEE 
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('editCommIQForm')?>',
							data: {'case_id':res.case_id},
							beforeSend: function() {
								$('#detlIQ2').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#detlIQ2').html(res);
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
	$('#form_upd').on('click','.add_cm_iq_btn', function(){

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
								$('#detlIQ2').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#detlIQ2').html(res);
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
	$('#form_upd').on('click','.del_cmm2', function() {
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
	TAB 2.3 - SUSPECT DETAIL (INQUIRY)
	------------------------------------------*/

	// ADD SUSPECT DETL MODAL
	$('#form_upd').on('click','.add_sp_al_btn2', function(){

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
								$('#detlIQ3').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
							},
							success: function(res) {
								$('#detlIQ3').html(res);

								rp_iq_row = $('#tbl_sp_iq_list').DataTable({
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
	$('#form_upd').on('click','.del_sp_iq', function() {
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