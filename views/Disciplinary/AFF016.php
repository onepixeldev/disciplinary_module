<?php echo $this->lib->title('Disciplinary / Case Report Entry (Disciplinary)', $screen_id) ?>

<section id="widget-grid" class="">
    <div class="jarviswidget  jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" role="widget">
        <header role="heading">
            <div class="jarviswidget-ctrls" role="menu">
                <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" data-placement="bottom"><i class="fa fa-expand "></i></a>
            </div>
            <h2>AFF016 - Case Report Entry (Disciplinary)</h2>				
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
                            </ul>
							<!-- myTabContent1 -->
                            <div id="myTabContent1" class="tab-content padding-10">

								<div class="tab-pane fade active in" id="s1">
									<div id="rp_ent_disc">
									</div>
                                </div>

								<div class="tab-pane fade" id="s2">
									<div id="cs_rp_form">
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
	var rp_disc_row = '';
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
	TAB 1 - CASE REPORT ENTRY (DISCIPLINARY)
	------------------------------------------*/

	// POPULATE DISCIPLINARY CASE REPORT ENTRY
	// $('#rp_ent_disc').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
	show_loading();
	$.ajax({
		type: 'POST',
		url: '<?php echo $this->lib->class_url('csRpEntDisc')?>',
		data: '',
		success: function(res) {
			$('#rp_ent_disc').html(res);

			rp_disc_row = $('#tbl_rp_disc_list').DataTable({
				"ordering":false,
			});
			hide_loading();
		}
	});		

	///////////////////////////////////////////////////////
	// ADD, EDIT, DELETE CASE REPORT ENTRY (DISCIPLINARY)
	//////////////////////////////////////////////////////

	// ADD CASE REPORT ENTRY (DISCIPLINARY)
	$('#rp_ent_disc').on('click','.add_case_rp_disc_btn', function(){
	
		$.ajax({
			type: 'POST',
            url: '<?php echo $this->lib->class_url('addCaseDiscForm')?>',
            beforeSend: function() {
				$('#cs_rp_form').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
				$('.nav-tabs li:eq(1) a').tab('show');
			},
			success: function(res) {
				$('#cs_rp_form').html(res);
			}
		});
    });

	///// SEARCH STAFF//////
	// SEARCH STAFF
	$('#cs_rp_form').on('click','.search_staff', function(){
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

		var ss_code = thisBtn.data("ss-code");
		var ss_desc = thisBtn.data("ss-desc");
		var dept_code = thisBtn.data("dept-code");
		var dept_desc = thisBtn.data("dept-desc");
		console.log(ss_code+' '+ss_desc);
		console.log(dept_code+' '+dept_desc);
		
		if(staff_id != '' && staff_name != '') {
			$('#staff_id').val(staff_id);
			$('#staff_name').val(staff_name);

			$('#service_id').val(ss_code);
			$('#service_name').val(ss_desc);

			$('#department_id').val(dept_code);
			$('#department_name').val(dept_desc);
		}
	});
	///// SEARCH STAFF//////

	// SAVE ADD CASE REPORT ENTRY (DISCIPLINARY)
	$('#cs_rp_form').on('click', '.add_rp_ent_frm', function (e) {
		e.preventDefault();
		var data = $('#addRpEntFmDisc').serialize();
		msg.wait('#addRpEntFmDiscAlert');
		msg.wait('#addRpEntFmDiscAlertFooter');
		// alert(data);
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveAddRpEntFrm')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#addRpEntFmDiscAlert');
				msg.show(res.msg, res.alert, '#addRpEntFmDiscAlertFooter');

				if (res.sts == 1) {
				
					setTimeout(function () {
						$('.nav-tabs li:eq(0) a').tab('show');
						$('.btn').removeAttr('disabled');
						
						// REFRESH CASE REPORT
						$('#rp_ent_disc').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('csRpEntDisc')?>',
							data: '',
							success: function(res) {
								$('#rp_ent_disc').html(res);

								rp_disc_row = $('#tbl_rp_disc_list').DataTable({
									"ordering":false,
								});
							}
						});
						
						$('#cs_rp_form').html('<p><table class="table table-bordered table-hover"><thead><tr><th class="text-center">Please click Add Record or Edit button from Case Report tab</th></tr></thead></table></p>');

					}, 1500);
				} else {
					$('.btn').removeAttr('disabled');
				}
			},
			error: function() {
				$('.btn').removeAttr('disabled');
				msg.danger('Please contact administrator.', '#addRpEntFmDiscAlert');
				msg.danger('Please contact administrator.', '#addRpEntFmDiscAlertFooter');
			}
		});	
	});

	// UPDATE CASE DISCIPLINARY
	$('#rp_ent_disc').on('click','.upd_rp_ent', function(){

		var thisBtn = $(this);
		var td = thisBtn.closest("tr");
		var code = td.find(".code").text();

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('editCaseDiscForm')?>',
			data: {'case_id':code},
			beforeSend: function() {
				$('#cs_rp_form').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
				$('.nav-tabs li:eq(1) a').tab('show');
			},
			success: function(res) {
				$('#cs_rp_form').html(res);
			}
		});
	});

	// SAVE UPDATE CASE REPORT ENTRY (DISCIPLINARY)
	$('#cs_rp_form').on('click', '.edit_rp_ent_frm', function (e) {
		e.preventDefault();
		var data = $('#editRpEntFmDisc').serialize();
		msg.wait('#editRpEntFmDiscAlert');
		msg.wait('#editRpEntFmDiscAlertFooter');
		// alert(data);
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveEditRpEntFrm')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#editRpEntFmDiscAlert');
				msg.show(res.msg, res.alert, '#editRpEntFmDiscAlertFooter');

				if (res.sts == 1) {
				
					setTimeout(function () {
						$('.nav-tabs li:eq(0) a').tab('show');
						$('.btn').removeAttr('disabled');
						
						// REFRESH CASE REPORT
						$('#rp_ent_disc').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('csRpEntDisc')?>',
							data: '',
							success: function(res) {
								$('#rp_ent_disc').html(res);

								rp_disc_row = $('#tbl_rp_disc_list').DataTable({
									"ordering":false,
								});
							}
						});
						
						$('#cs_rp_form').html('<p><table class="table table-bordered table-hover"><thead><tr><th class="text-center">Please click Add Record or Edit button from Case Report tab</th></tr></thead></table></p>');

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

	// DELETE CASE REPORT ENTRY (DISCIPLINARY)
	$('#rp_ent_disc').on('click','.del_rp_ent', function() {
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
						url: '<?php echo $this->lib->class_url('delCaseDiscForm')?>',
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

	
</script>