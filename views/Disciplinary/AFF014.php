<?php echo $this->lib->title('Disciplinary / Case Query by Staff', $screen_id) ?>

<section id="widget-grid" class="">
    <div class="jarviswidget  jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" role="widget">
        <header role="heading">
            <div class="jarviswidget-ctrls" role="menu">
                <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" data-placement="bottom"><i class="fa fa-expand "></i></a>
            </div>
            <h2>AFF014 - Case Query by Staff</h2>				
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
                                    <a style="color:#000 !important" href="#s1" data-toggle="tab" aria-expanded="true">Case List</a>
                                </li>
                                <li class="">
                                    <a style="color:#000 !important" href="#s2" data-toggle="tab" aria-expanded="false">Case Details</a>
                                </li>
                            </ul>
							<!-- myTabContent1 -->
                            <div id="myTabContent1" class="tab-content padding-10">

								<div class="tab-pane fade active in" id="s1">
                                    <form class="form-horizontal">

                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label"><b>Staff ID</b></label>
                                            <div class="col-md-2">
                                                <input name="" class="form-control" type="text" id="staff_id" readonly>
                                            </div>

                                            <div class="col-md-4">
                                                <input name="" class="form-control" type="text" id="staff_name" readonly>
                                            </div>

                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-primary search_staff_cs"><i class="fa fa-search"></i> Search</button>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label"><b>IC No</b></label>
                                            <div class="col-md-2">
                                                <input name="" class="form-control" type="text" id="staff_ic" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label"><b>Status</b></label>
                                            <div class="col-md-6">
                                                <input name="" class="form-control" type="text" id="staff_sts" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label"><b>Service</b></label>
                                            <div class="col-md-6">
                                                <input name="" class="form-control" type="text" id="staff_svc" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-2 control-label"><b>Department</b></label>
                                            <div class="col-md-6">
                                                <input name="" class="form-control" type="text" id="staff_dept" readonly>
                                            </div>
                                        </div>
                                    </form>

									<div id="case_list">
                                        <p>
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Please enter Staff ID</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </p>
									</div>
                                </div>

                                <div class="tab-pane fade" id="s2">
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

    ///// SEARCH STAFF//////
	// SEARCH STAFF
	$('.search_staff_cs').click(function(){
		$('#myModalis .modal-content').empty();
		$('#myModalis').modal('show');
		$('#myModalis').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');
	
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('searchStaffMd3')?>',
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
			url: '<?php echo $this->lib->class_url('searchStaffMd3')?>',
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

		var ss_ic = thisBtn.data("ss-ic");
		var ss_sts = thisBtn.data("ss-sts");
		var ss_svc = thisBtn.data("ss-svc");
		var ss_dept = thisBtn.data("ss-dept");
		
		if(staff_id != '' && staff_name != '') {
			$('#staff_id').val(staff_id);
			$('#staff_name').val(staff_name);

			$('#staff_ic').val(ss_ic);
			$('#staff_sts').val(ss_sts);

			$('#staff_svc').val(ss_svc);
			$('#staff_dept').val(ss_dept);
            
            // POPULATE CASE LIST
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->lib->class_url('caseStaffListQ')?>',
                data: {'staff_id':staff_id},
                beforeSend: function() {
                    show_loading();
                },
                success: function(res) {
                    $('#case_list').html(res);

                    cs_stat_row = $('#tbl_cs_detl_list').DataTable({
                        "ordering":false,
                    });
					$('#form_upd').html('<p><table class="table table-bordered table-hover"><thead><tr><th class="text-center">Please click Detail button from Case List tab</th></tr></thead></table></p>');
                    hide_loading();
                }
            });
		}
	});
	///// SEARCH STAFF//////

	// CASE DETAIL
	$('#case_list').on('click','.upd_case', function(){

		var thisBtn = $(this);
		var td = thisBtn.closest("tr");
		var code = td.find(".code").text();
		var case_type = thisBtn.val();

		// console.log(case_type); return;

		if(case_type == 'DISCIPLINARY') {
			$('.nav-tabs li:eq(1) a').tab('show');

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
					$('.nav-tabs li:eq(1) a').tab('show');
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
			$('.nav-tabs li:eq(1) a').tab('show');

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
			$('.nav-tabs li:eq(1) a').tab('show');

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