<?php echo $this->lib->title('Disciplinary / Staff Disciplinary Reports', $screen_id) ?>

<section id="widget-grid" class="">
    <div class="jarviswidget  jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" role="widget">
        <header role="heading">
            <div class="jarviswidget-ctrls" role="menu">
                <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" data-placement="bottom"><i class="fa fa-expand "></i></a>
            </div>
            <h2>AFF008 - Staff Disciplinary Reports</h2>				
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
                                    <a style="color:#000 !important" href="#s1" data-toggle="tab" aria-expanded="true">Report</a>
                                </li>
                                <li class="">
                                    <a style="color:#000 !important" href="#s2" data-toggle="tab" aria-expanded="false">Report II</a>
                                </li>
                            </ul>
							<!-- myTabContent1 -->
                            <div id="myTabContent1" class="tab-content padding-10">

								<div class="tab-pane fade active in" id="s1">
									<div id="case_rep">
									</div>
                                </div>

                                <div class="tab-pane fade" id="s2">
									<div id="case_rep2">
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

    // REPORT TAB
	$.ajax({
		type: 'POST',
		url: '<?php echo $this->lib->class_url('caseReport')?>',
		data: '',
		beforeSend: function() {
			show_loading();
		},
		success: function(res) {
            $('#case_rep').html(res);
            hide_loading();
		},
    });

    // REPORT TAB II
	$.ajax({
		type: 'POST',
		url: '<?php echo $this->lib->class_url('caseReportII')?>',
		data: '',
		beforeSend: function() {
			$('#case_rep2').html('<center><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:black"></i></center>');
		},
		success: function(res) {
            $('#case_rep2').html(res);
		},
    });

	// PRINT REPORT
	$('#case_rep').on('click','.genRepBtn', function () {
		var thisBtn = $(this);
        var repCode = thisBtn.attr('repCode');
        
        if(repCode == 'AFR006') {
            var case_sts = $('#case_sts_disc').val();
            var year_frm = $('#from_year_disc').val();
            var year_to = $('#to_year_disc').val();
        }

        if(repCode == 'AFR007') {
            var case_sts = $('#case_sts_afd').val();
            var year_frm = $('#from_year_afd').val();
            var year_to = $('#to_year_afd').val();
        }

        if(repCode == 'AFR008') {
            var case_sts = $('#case_sts_al').val();
            var year_frm = $('#from_year_al').val();
            var year_to = $('#to_year_al').val();
        }

        if(repCode == 'AFR009') {
            var case_sts = $('#case_sts_iq').val();
            var year_frm = $('#from_year_iq').val();
            var year_to = $('#to_year_iq').val();
        }

        $.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('setRepParam')?>',
			data: {'case_sts':case_sts, 'year_frm':year_frm, 'year_to':year_to, 'repCode':repCode},
			dataType: 'JSON',
			success: function(res) {
				window.open("report?r="+res.report,"mywin","width=800,height=600");
			}
		});
	});

    // PRINT REPORT 2
	$('#case_rep2').on('click','.genRepBtn', function () {
		var thisBtn = $(this);
        var repCode = thisBtn.attr('repCode');

        if(repCode == 'AFR001') {
            var case_sts = $('#case_sts_sl').val();
            var year_frm = $('#from_year_sl').val();
            var year_to = $('#to_year_sl').val();
        }

        if(repCode == 'AFR002') {
            var case_sts = '';
            var year_frm = $('#from_year_os').val();
            var year_to = $('#to_year_os').val();
        }

        $.ajax({
			type: 'POST',
			url: '<?php echo $this->lib->class_url('setRepParam')?>',
			data: {'repCode':repCode, 'case_sts':case_sts, 'year_frm':year_frm, 'year_to':year_to},
			dataType: 'JSON',
			success: function(res) {
				window.open("report?r="+res.report,"mywin","width=800,height=600");
			}
		});
	});
	
</script>