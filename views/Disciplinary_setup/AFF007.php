<?php echo $this->lib->title('Disciplinary / Disciplinary Setup', $screen_id) ?>

<section id="widget-grid" class="">
    <div class="jarviswidget  jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" role="widget">
        <header role="heading">
            <div class="jarviswidget-ctrls" role="menu">
                <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" data-placement="bottom"><i class="fa fa-expand "></i></a>
            </div>
            <h2>AFF007 - Disciplinary Setup</h2>				
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
                                    <a style="color:#000 !important" href="#s1" data-toggle="tab" aria-expanded="true">Disciplinary Setup</a>
                                </li>
								<li class="">
                                    <a style="color:#000 !important" href="#s2" data-toggle="tab" aria-expanded="false">Asset Loss Setup</a>
                                </li>
                            </ul>
							<!-- myTabContent1 -->
                            <div id="myTabContent1" class="tab-content padding-10">

								<div class="tab-pane fade active in" id="s1">
									<div id="spg_setup">
									</div>
                                    <br>
                                    <div id="ac_setup">
									</div>
                                    <br>
                                    <div id="cs_setup">
									</div>
                                    <br>
                                    <div id="top_setup">
									</div>
                                </div>

								<div class="tab-pane fade" id="s2">
									<div id="asset_loss_set">
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
	var disc_row = '';
	
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

		<?php
			$currtab = $this->session->tabID;
		
			if (!empty($currtab)) {
				if ($currtab == 's2'){
					echo "$('.nav-tabs li:eq(1) a').tab('show');";
				}  
				else {
					echo "$('.nav-tabs li:eq(0) a').tab('show');";
				}
			}
		?>
	});

	$(".nav-tabs a").click(function(){
		$(this).tab('show');
    });

	/*-----------------------------
	TAB 1 - DISCIPLINARY SETUP
	-----------------------------*/

	// POPULATE KUMPULAN JAWATAN PERKHIDMATAN
	// $('#spg_setup').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');

	$.ajax({
		type: 'POST',
		url: '<?php echo $this->lib->class_url('svcPosGroup')?>',
		data: '',
		beforeSend: function() {
			show_loading();
		},
		success: function(res) {
			$('#spg_setup').html(res);
			hide_loading();

			disc_row = $('#tbl_svc_pos_grp_list').DataTable({
				"ordering":false,
                pageLength : 5,
                "lengthMenu": [ 5, 10, 15, 20 ]
			});
		}
	});	

    // POPULATE KATEGORI TINDAKAN
    // $('#ac_setup').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
	$.ajax({
		type: 'POST',
		url: '<?php echo $this->lib->class_url('actCategory')?>',
		data: '',
		beforeSend: function() {
			show_loading();
		},
		success: function(res) {
			$('#ac_setup').html(res);
			hide_loading();

			disc_row = $('#tbl_ac_list').DataTable({
				"ordering":false,
                pageLength : 5,
                "lengthMenu": [ 5, 10, 15, 20 ]
			});
		}
	});

    // POPULATE STATUS KES
    // $('#cs_setup').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
	$.ajax({
		type: 'POST',
		url: '<?php echo $this->lib->class_url('caseStatus')?>',
		data: '',
		beforeSend: function() {
			show_loading();
		},
		success: function(res) {
			$('#cs_setup').html(res);
			hide_loading();

			disc_row = $('#tbl_cs_list').DataTable({
				"ordering":false,
                pageLength : 5,
                "lengthMenu": [ 5, 10, 15, 20 ]
			});
		}
	});	

    // POPULATE JENIS HUKUMAN
    // $('#top_setup').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
	$.ajax({
		type: 'POST',
		url: '<?php echo $this->lib->class_url('typePunishment')?>',
		data: '',
		beforeSend: function() {
			show_loading();
		},
		success: function(res) {
			$('#top_setup').html(res);
			hide_loading();

			disc_row = $('#tbl_top_list').DataTable({
				"ordering":false,
                pageLength : 5,
                "lengthMenu": [ 5, 10, 15, 20 ]
			});
		}
	});		

	////////////////////////////////////////////////////
	// ADD, EDIT KUMPULAN JAWATAN PERKHIDMATAN
	///////////////////////////////////////////////////

	// ADD KUMPULAN JAWATAN PERKHIDMATAN
	$('#spg_setup').on('click','.add_svc_pos_grp_btn', function(){

		$('#myModalis2 .modal-content').empty();
		$('#myModalis2').modal('show');
		$('#myModalis2').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');
	
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('addSvcPosGroup')?>',
			success: function(res) {
				$('#myModalis2 .modal-content').html(res);
			}
		});
    });

	// SAVE ADD KUMPULAN JAWATAN PERKHIDMATAN
	$('#myModalis2').on('click', '.save_spg', function (e) {
		e.preventDefault();
		var data = $('#addSvcPosGroup').serialize();
		msg.wait('#addSvcPosGroupAlert');
		// alert(data);
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveAddSpg')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#addSvcPosGroupAlert');

				if (res.sts == 1) {

					setTimeout(function () {
						$('.btn').removeAttr('disabled');
						$('#myModalis2').modal('hide');

						$('#spg_setup').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('svcPosGroup')?>',
							data: '',
							success: function(res) {
								$('#spg_setup').html(res);

								disc_row = $('#tbl_svc_pos_grp_list').DataTable({
									"ordering":false,
									pageLength : 5,
									"lengthMenu": [ 5, 10, 15, 20 ]
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
				msg.danger('Please contact administrator.', '#addSvcPosGroupAlert');
			}
		});	
	});

	// UPDATE KUMPULAN JAWATAN PERKHIDMATAN
	$('#spg_setup').on('click','.upd_spg', function(){

		var thisBtn = $(this);
		var td = thisBtn.closest("tr");
		var code = td.find(".code").text();

		$('#myModalis2 .modal-content').empty();
		$('#myModalis2').modal('show');
		$('#myModalis2').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('editSvcPosGroup')?>',
			data: {'code':code},
			success: function(res) {
				$('#myModalis2 .modal-content').html(res);
			}
		});
	});

	// SAVE UPDATE KUMPULAN JAWATAN PERKHIDMATAN
	$('#myModalis2').on('click', '.upd_spg', function (e) {
		e.preventDefault();
		var data = $('#editSvcPosGroup').serialize();
		msg.wait('#editSvcPosGroupAlert');
		// alert(data);
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveUpdSpg')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#editSvcPosGroupAlert');

				if (res.sts == 1) {

					setTimeout(function () {
						$('.btn').removeAttr('disabled');
						$('#myModalis2').modal('hide');

						$('#spg_setup').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('svcPosGroup')?>',
							data: '',
							success: function(res) {
								$('#spg_setup').html(res);

								disc_row = $('#tbl_svc_pos_grp_list').DataTable({
									"ordering":false,
									pageLength : 5,
									"lengthMenu": [ 5, 10, 15, 20 ]
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
				msg.danger('Please contact administrator.', '#editSvcPosGroupAlert');
			}
		});	
	});

	////////////////////////////////////////////////////
	// ADD, EDIT KATEGORI TINDAKAN
	///////////////////////////////////////////////////

	// ADD KATEGORI TINDAKAN
	$('#ac_setup').on('click','.add_act_cat_btn', function(){

		$('#myModalis2 .modal-content').empty();
		$('#myModalis2').modal('show');
		$('#myModalis2').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('addActCat')?>',
			success: function(res) {
				$('#myModalis2 .modal-content').html(res);
			}
		});
	});

	// SAVE ADD KATEGORI TINDAKAN
	$('#myModalis2').on('click', '.save_ac', function (e) {
		e.preventDefault();
		var data = $('#addActCategory').serialize();
		msg.wait('#addActCategoryAlert');
		// alert(data);
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveAddAc')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#addActCategoryAlert');

				if (res.sts == 1) {

					setTimeout(function () {
						$('.btn').removeAttr('disabled');
						$('#myModalis2').modal('hide');

						$('#ac_setup').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('actCategory')?>',
							data: '',
							success: function(res) {
								$('#ac_setup').html(res);

								disc_row = $('#tbl_ac_list').DataTable({
									"ordering":false,
									pageLength : 5,
									"lengthMenu": [ 5, 10, 15, 20 ]
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
				msg.danger('Please contact administrator.', '#addActCategoryAlert');
			}
		});	
	});

	// UPDATE KATEGORI TINDAKAN
	$('#ac_setup').on('click','.upd_ac', function(){

		var thisBtn = $(this);
		var td = thisBtn.closest("tr");
		var code = td.find(".code").text();

		$('#myModalis2 .modal-content').empty();
		$('#myModalis2').modal('show');
		$('#myModalis2').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('editActCategory')?>',
			data: {'code':code},
			success: function(res) {
				$('#myModalis2 .modal-content').html(res);
			}
		});
	});

	// SAVE UPDATE KATEGORI TINDAKAN
	$('#myModalis2').on('click', '.save_upd_ac', function (e) {
		e.preventDefault();
		var data = $('#editActCategory').serialize();
		msg.wait('#editActCategoryAlert');
		// alert(data);
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveUpdAc')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#editActCategoryAlert');

				if (res.sts == 1) {

					setTimeout(function () {
						$('.btn').removeAttr('disabled');
						$('#myModalis2').modal('hide');

						$('#ac_setup').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('actCategory')?>',
							data: '',
							success: function(res) {
								$('#ac_setup').html(res);

								disc_row = $('#tbl_ac_list').DataTable({
									"ordering":false,
									pageLength : 5,
									"lengthMenu": [ 5, 10, 15, 20 ]
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
				msg.danger('Please contact administrator.', '#editActCategoryAlert');
			}
		});	
	});

	////////////////////////////////////////////////////
	// ADD, EDIT STATUS KES
	///////////////////////////////////////////////////

	// ADD STATUS KES
	$('#cs_setup').on('click','.add_case_status_btn', function(){

		$('#myModalis2 .modal-content').empty();
		$('#myModalis2').modal('show');
		$('#myModalis2').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('addCaseStatus')?>',
			success: function(res) {
				$('#myModalis2 .modal-content').html(res);
			}
		});
	});

	// SAVE ADD STATUS KES
	$('#myModalis2').on('click', '.save_cs', function (e) {
		e.preventDefault();
		var data = $('#addCaseStatus').serialize();
		msg.wait('#addCaseStatusAlert');
		// alert(data);

		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveAddCs')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#addCaseStatusAlert');

				if (res.sts == 1) {

					setTimeout(function () {
						$('.btn').removeAttr('disabled');
						$('#myModalis2').modal('hide');

						$('#cs_setup').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('caseStatus')?>',
							data: '',
							success: function(res) {
								$('#cs_setup').html(res);

								disc_row = $('#tbl_cs_list').DataTable({
									"ordering":false,
									pageLength : 5,
									"lengthMenu": [ 5, 10, 15, 20 ]
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
				msg.danger('Please contact administrator.', '#addCaseStatusAlert');
			}
		});	
	});

	// UPDATE STATUS KES
	$('#cs_setup').on('click','.upd_cs', function(){

		var thisBtn = $(this);
		var td = thisBtn.closest("tr");
		var code = td.find(".code").text();

		$('#myModalis2 .modal-content').empty();
		$('#myModalis2').modal('show');
		$('#myModalis2').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('editCaseStatus')?>',
			data: {'code':code},
			success: function(res) {
				$('#myModalis2 .modal-content').html(res);
			}
		});
	});

	// SAVE UPDATE KATEGORI TINDAKAN
	$('#myModalis2').on('click', '.save_upd_cs', function (e) {
		e.preventDefault();
		var data = $('#editCaseStatus').serialize();
		msg.wait('#editCaseStatusAlert');
		// alert(data);
		
		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveUpdCs')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#editCaseStatusAlert');

				if (res.sts == 1) {

					setTimeout(function () {
						$('.btn').removeAttr('disabled');
						$('#myModalis2').modal('hide');

						$('#cs_setup').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('caseStatus')?>',
							data: '',
							success: function(res) {
								$('#cs_setup').html(res);

								disc_row = $('#tbl_cs_list').DataTable({
									"ordering":false,
									pageLength : 5,
									"lengthMenu": [ 5, 10, 15, 20 ]
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
				msg.danger('Please contact administrator.', '#editCaseStatusAlert');
			}
		});	
	});

	////////////////////////////////////////////////////
	// ADD, EDIT PUNISHMENT TYPE
	///////////////////////////////////////////////////

	// ADD PUNISHMENT TYPE
	$('#top_setup').on('click','.add_top_btn', function(){

		$('#myModalis2 .modal-content').empty();
		$('#myModalis2').modal('show');
		$('#myModalis2').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('addPunishmentType')?>',
			success: function(res) {
				$('#myModalis2 .modal-content').html(res);
			}
		});
	});

	// SAVE ADD PUNISHMENT TYPE
	$('#myModalis2').on('click', '.save_top', function (e) {
		e.preventDefault();
		var data = $('#addPunishmentType').serialize();
		msg.wait('#addPunishmentTypeAlert');
		// alert(data);

		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveAddTop')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#addPunishmentTypeAlert');

				if (res.sts == 1) {

					setTimeout(function () {
						$('.btn').removeAttr('disabled');
						$('#myModalis2').modal('hide');

						$('#top_setup').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('typePunishment')?>',
							data: '',
							success: function(res) {
								$('#top_setup').html(res);

								disc_row = $('#tbl_top_list').DataTable({
									"ordering":false,
									pageLength : 5,
									"lengthMenu": [ 5, 10, 15, 20 ]
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
				msg.danger('Please contact administrator.', '#addPunishmentTypeAlert');
			}
		});	
	});

	// UPDATE PUNISHMENT TYPE
	$('#top_setup').on('click','.upd_top', function(){

		var thisBtn = $(this);
		var td = thisBtn.closest("tr");
		var code = td.find(".code").text();

		$('#myModalis2 .modal-content').empty();
		$('#myModalis2').modal('show');
		$('#myModalis2').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('editPunishmentType')?>',
			data: {'code':code},
			success: function(res) {
				$('#myModalis2 .modal-content').html(res);
			}
		});
	});

	// SAVE UPDATE PUNISHMENT TYPE
	$('#myModalis2').on('click', '.save_upd_top', function (e) {
		e.preventDefault();
		var data = $('#editPunishmentType').serialize();
		msg.wait('#editPunishmentTypeAlert');
		// alert(data);

		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveUpdTop')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#editPunishmentTypeAlert');

				if (res.sts == 1) {

					setTimeout(function () {
						$('.btn').removeAttr('disabled');
						$('#myModalis2').modal('hide');

						$('#top_setup').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('typePunishment')?>',
							data: '',
							success: function(res) {
								$('#top_setup').html(res);

								disc_row = $('#tbl_top_list').DataTable({
									"ordering":false,
									pageLength : 5,
									"lengthMenu": [ 5, 10, 15, 20 ]
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
				msg.danger('Please contact administrator.', '#editPunishmentTypeAlert');
			}
		});	
	});

    /*-----------------------------
	TAB 2 - ASSET LOSS SETUP
	-----------------------------*/

    // POPULATE ASSET LOSS SETUP
    $('#asset_loss_set').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
	$.ajax({
		type: 'POST',
		url: '<?php echo $this->lib->class_url('assetLossSetup')?>',
		data: '',
		success: function(res) {
			$('#asset_loss_set').html(res);

			disc_row = $('#tbl_als_list').DataTable({
				"ordering":false,
			});
		}
	});

	////////////////////////////////////////////////////
	// ADD, EDIT ASSET LOSS SETUP
	///////////////////////////////////////////////////

	// ADD ASSET LOSS SETUP
	$('#asset_loss_set').on('click','.add_als_btn', function(){

		$('#myModalis2 .modal-content').empty();
		$('#myModalis2').modal('show');
		$('#myModalis2').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('addResALS')?>',
			success: function(res) {
				$('#myModalis2 .modal-content').html(res);
			}
		});
	});

	// SAVE ASSET LOSS SETUP
	$('#myModalis2').on('click', '.save_als', function (e) {
		e.preventDefault();
		var data = $('#addResALS').serialize();
		msg.wait('#addResALSAlert');
		// alert(data);

		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveAddAls')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#addResALSAlert');

				if (res.sts == 1) {

					setTimeout(function () {
						$('.btn').removeAttr('disabled');
						$('#myModalis2').modal('hide');

						// POPULATE ASSET LOSS SETUP
						$('#asset_loss_set').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('assetLossSetup')?>',
							data: '',
							success: function(res) {
								$('#asset_loss_set').html(res);

								disc_row = $('#tbl_als_list').DataTable({
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
				msg.danger('Please contact administrator.', '#addResALSAlert');
			}
		});	
	});

	// UPDATE ASSET LOSS SETUP
	$('#asset_loss_set').on('click','.upd_als', function(){

		var thisBtn = $(this);
		var td = thisBtn.closest("tr");
		var code = td.find(".code").text();

		$('#myModalis2 .modal-content').empty();
		$('#myModalis2').modal('show');
		$('#myModalis2').find('.modal-content').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');

		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('editResALS')?>',
			data: {'code':code},
			success: function(res) {
				$('#myModalis2 .modal-content').html(res);
			}
		});
	});

	// SAVE UPDATE ASSET LOSS SETUP
	$('#myModalis2').on('click', '.save_upd_als', function (e) {
		e.preventDefault();
		var data = $('#editResALS').serialize();
		msg.wait('#editResALSAlert');
		// alert(data);

		$('.btn').attr('disabled', 'disabled');
		$.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('saveUpdAls')?>',
			data: data,
			dataType: 'JSON',
			success: function(res) {
				msg.show(res.msg, res.alert, '#editResALSAlert');

				if (res.sts == 1) {

					setTimeout(function () {
						$('.btn').removeAttr('disabled');
						$('#myModalis2').modal('hide');

						// POPULATE ASSET LOSS SETUP
						$('#asset_loss_set').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
						$.ajax({
							type: 'POST',
							url: '<?php echo $this->lib->class_url('assetLossSetup')?>',
							data: '',
							success: function(res) {
								$('#asset_loss_set').html(res);

								disc_row = $('#tbl_als_list').DataTable({
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
				msg.danger('Please contact administrator.', '#editResALSAlert');
			}
		});	
	});

	
</script>