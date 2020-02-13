<?php echo $this->lib->title('Disciplinary / Case Statistic Query', $screen_id) ?>

<section id="widget-grid" class="">
    <div class="jarviswidget  jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" role="widget">
        <header role="heading">
            <div class="jarviswidget-ctrls" role="menu">
                <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" data-placement="bottom"><i class="fa fa-expand "></i></a>
            </div>
            <h2>AFF009 - Case Statistic Query</h2>				
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
                                    <a style="color:#000 !important" href="#s1" data-toggle="tab" aria-expanded="true">Case Statistic</a>
                                </li>
								<li class="">
                                    <a style="color:#000 !important" href="#s2" data-toggle="tab" aria-expanded="false">Case List</a>
                                </li>
                                <li class="">
                                    <a style="color:#000 !important" href="#s3" data-toggle="tab" aria-expanded="false">Case Details</a>
                                </li>
                            </ul>
							<!-- myTabContent1 -->
                            <div id="myTabContent1" class="tab-content padding-10">

								<div class="tab-pane fade active in" id="s1">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label"><b>Year</b></label>
                                            <div class="col-md-2">
                                                <?php echo form_dropdown('year_f', $case_year_list, '', 'class="form-control width-50 case_f" id="year_f"')?>
                                            </div>
                                        </div>

										<div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label"><b>Department</b></label>
                                            <div class="col-md-6">
                                                <?php echo form_dropdown('case_dept_f', $case_dept_list, $curr_dept, 'class="form-control width-50 case_f" id="case_dept_f"')?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label"><b>Case Type</b></label>
                                            <div class="col-md-2">
                                                <?php echo form_dropdown('case_type_f', $case_type, '', 'class="form-control width-50 case_f" id="case_type_f"')?>
                                            </div>
                                        </div>

										<div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label"><b>Status</b></label>
                                            <div class="col-md-6">
                                                <?php echo form_dropdown('case_sts_f', $sts_list, '', 'class="form-control width-50 case_f" id="case_sts_f"')?>
                                            </div>
                                        </div>
                                    </form>

									<div id="case_st">
									</div>
                                </div>

								<div class="tab-pane fade" id="s2">
									<div id="case_list">
                                        <p>
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Please click Case List button from Case Statistic tab</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </p>
									</div>
                                </div>

                                <div class="tab-pane fade" id="s3">
									<div id="form_upd">
                                        <p>
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Please click Detail button from Case List tab</th>
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
    var cs_stat_row = '';
	var rp_cs_detl_row = '';
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
	TAB 1 - CASE STATISTIC LIST
	------------------------------------------*/
    var year_f = $('#year_f').val();
    var case_dept_f = $('#case_dept_f').val();
    var case_type_f = $('#case_type_f').val();
    var case_sts_f = $('#case_sts_f').val();

	// POPULATE CASE STATISTIC LIST
	show_loading();
	$.ajax({
		type: 'POST',
		url: '<?php echo $this->lib->class_url('caseStatList')?>',
		data: {'year_f':year_f, 'case_dept_f':case_dept_f, 'case_type_f':case_type_f, 'case_sts_f':case_sts_f},
		success: function(res) {
			$('#case_st').html(res);

			cs_stat_row = $('#tbl_case_stat_list').DataTable({
				"ordering":false,
			});
			hide_loading();
		}
	});

	// CASE FILTER
    $('.case_f').change(function(){
        var year_f = $('#year_f').val();
		var case_dept_f = $('#case_dept_f').val();
		var case_type_f = $('#case_type_f').val();
		var case_sts_f = $('#case_sts_f').val();
		
        show_loading();
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('caseStatList')?>',
			data: {'year_f':year_f, 'case_dept_f':case_dept_f, 'case_type_f':case_type_f, 'case_sts_f':case_sts_f},
			success: function(res) {
				$('#case_st').html(res);

				cs_stat_row = $('#tbl_case_stat_list').DataTable({
					"ordering":false,
				});
				
				$('#case_list').html('<p><table class="table table-bordered table-hover"><thead><tr><th class="text-center">Please click Case List button from Case Statistic tab</th></tr></thead></table></p>');
				$('#form_upd').html('<p><table class="table table-bordered table-hover"><thead><tr><th class="text-center">Please click Detail button from Case List tab</th></tr></thead></table></p>');

				hide_loading();
			}
		});
    });

	// CASE DETAIL LIST 
	$('#case_st').on('click','.select_case_detl', function(){

		var thisBtn = $(this);
		var td = thisBtn.closest("tr");
		var case_year = thisBtn.data('year');
		var case_dept = thisBtn.data('dept');
		var case_type = thisBtn.data('type');
		var case_sts = thisBtn.data('sts');

		// console.log(case_year+' '+case_dept+' '+case_type+' '+case_sts);
		// return;

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('caseDetlList')?>',
			data: {'case_year':case_year, 'case_dept':case_dept, 'case_type':case_type, 'case_sts':case_sts},
			beforeSend: function() {
				$('#case_list').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
				$('.nav-tabs li:eq(1) a').tab('show');
			},
			success: function(res) {
				$('#case_list').html(res);

				rp_cs_detl_row = $('#tbl_cs_detl_list').DataTable({
								"ordering":false,
							});

				$('#form_upd').html('<p><table class="table table-bordered table-hover"><thead><tr><th class="text-center">Please click Detail button from Case List tab</th></tr></thead></table></p>');
			}
		});
	});

	// CASE DETAIL
	$('#case_list').on('click','.upd_case', function(){

		var thisBtn = $(this);
		var td = thisBtn.closest("tr");
		var code = td.find(".code").text();
		var case_type = thisBtn.val();

		// console.log(case_type); return;

		if(case_type == 'DISCIPLINARY') {
			$('.nav-tabs li:eq(2) a').tab('show');

			$.ajax({
				type: 'POST',
				url: '<?php echo $this->lib->class_url('discDetlForm')?>',
				data: {'case_id':code},
				beforeSend: function() {
					$('#form_upd').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>').show();
				},
				success: function(res) {
					$('#form_upd').html(res);

					$.ajax({
						type: 'POST',
						url: '<?php echo $this->lib->class_url('editCaseDiscForm2')?>',
						data: {'case_id':code},
						beforeSend: function() {
							$('#disc_detl_query').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						},
						success: function(res) {
							$('#disc_detl_query').html(res);

							$('#form_upd input').prop( "disabled", true );
							$('#form_upd textarea').prop( "disabled", true );
							$('#form_upd select').prop( "disabled", true );
							$('#form_upd .edit_rp_ent_frm').addClass("hidden");
							$('#form_upd #editRpEntFmDiscAlert').addClass("hidden");
							$('font').addClass("hidden");
						}
					});
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
					$('.nav-tabs li:eq(2) a').tab('show');
				},
				success: function(res) {
					$('#form_upd').html(res);
					$('#form_upd input').prop( "disabled", true );
					$('#form_upd select').prop( "disabled", true );
					$('#form_upd .edit_rp_afd_frm').addClass("hidden");
					$('font').addClass("hidden");
				}
			});
		}
		else if(case_type == 'ASSET_LOSS') {
			$('.nav-tabs li:eq(2) a').tab('show');

			$.ajax({
				type: 'POST',
				url: '<?php echo $this->lib->class_url('assetLossDetlForm')?>',
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
							
							// HIDE / DISABLE ELEMENT TAB 1
							$('#form_upd input').prop( "disabled", true );
							$('#form_upd select').prop( "disabled", true );
							$('#form_upd .search_asset').addClass("hidden");
							$('#form_upd .search_staff').addClass("hidden");
							$('#form_upd .upd_rp_al_frm').addClass("hidden");
							$('#form_upd #updRpEntFmALAlert').addClass("hidden");
							$('font').addClass("hidden");

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
									
									// HIDE / DISABLE ELEMENT TAB 2
									$('#form_upd input').prop( "disabled", true );
									$('#form_upd select').prop( "disabled", true );
									$('#form_upd .add_sp_al_btn').addClass("hidden");
									$('#form_upd .del_sp').addClass("hidden");

									// rp_al_row = $('#tbl_sp_al_list').DataTable({
									// 	"ordering":false,
									// });
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
									
									// HIDE / DISABLE ELEMENT TAB 3
									$('#form_upd input').prop( "disabled", true );
									$('#form_upd select').prop( "disabled", true );
									$('#form_upd textarea').prop( "disabled", true );
									$('#form_upd .add_cm_btn').addClass("hidden");
									$('#form_upd .del_cmm').addClass("hidden");
									$('#form_upd .save_cm_detl_frm').addClass("hidden");
									$('font').addClass("hidden");

									// rp_al_row = $('#tbl_cl_list').DataTable({
									// 	"ordering":false,
									// });
								}
							});
						}
					});
				}
        	});
		}
		else if(case_type == 'INQUIRY_SHOWCAUSE') {
			$('.nav-tabs li:eq(2) a').tab('show');

			$.ajax({
				type: 'POST',
				url: '<?php echo $this->lib->class_url('inquiryDetlForm')?>',
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

							// HIDE / DISABLE ELEMENT TAB 1
							$('#form_upd input').prop( "disabled", true );
							$('#form_upd .edit_rp_iq_frm').addClass("hidden");
							$('#form_upd #editRpEntFmIQAlert').addClass("hidden");
							$('font').addClass("hidden");
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

							// HIDE / DISABLE ELEMENT TAB 2
							$('#form_upd input').prop( "disabled", true );
							$('#form_upd textarea').prop( "disabled", true );
							$('#form_upd .add_cm_iq_btn').addClass("hidden");
							$('#form_upd .del_cmm2').addClass("hidden");
							$('#form_upd .save_cm_iq_frm').addClass("hidden");
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

							// HIDE / DISABLE ELEMENT TAB 3
							$('#form_upd .add_sp_al_btn2').addClass("hidden");
							$('#form_upd .del_sp_iq').addClass("hidden");

							// rp_iq_row = $('#tbl_sp_iq_list').DataTable({
							// 				"ordering":false,
							// 			});
						}
					});
				}
        	});
		}
	});

	/*----------------------------------------
	TAB 2 - DETAILS FORM
	------------------------------------------*/

	// PRINT REPORT
	$('#form_upd').on('click','.print_rep_disc', function () {
		var thisBtn = $(this);
        var case_id = thisBtn.data('caseid');
		var sid = thisBtn.data('sid');
		var repCode = 'AFR010';

        $.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('setRepParam')?>',
			data: {'case_id':case_id, 'sid':sid, 'repCode':repCode},
			dataType: 'JSON',
			success: function(res) {
				window.open("report?r="+res.report,"mywin","width=800,height=600");
			}
		});
	});

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
	
</script>