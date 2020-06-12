<p>
<div class="modal-header btn-success">
    <h4 class="modal-title txt-color-white" id="myModalLabel">Committee Members</h4>
</div>
<br>
<form class="form-horizontal" method="post">
    <div class="form-group">
        <label class="col-md-2 control-label"><b>Case ID</b></label>
        <div class="col-md-4">
            <input name="" class="form-control" type="text" value="<?php echo $case_id?>" readonly>
        </div>
    </div>
</form>

<div class="text-right">
	<button type="button" class="btn btn-primary btn-sm add_cm_btn" value="<?php echo $case_id?>"><i class="fa fa-plus"></i> Add Record</button>
</div>
<br>
<div class="well">
	<div class="row table-condensed table-responsive">
		<table class="table table-bordered table-hover" id="tbl_cl_list" style="width: 100%">
		<thead>
            <tr>
                <th class="text-center col-md-1">No</th>
                <th class="text-center col-md-1">Staff ID</th>
                <th class="text-center col-md-3">Name</th>
                <th class="text-center col-md-1">Department</th>
                <th class="text-center col-md-1">Action</th>
            </tr>
		</thead>
		<tbody>
		<?php
            foreach ($com_list as $cl) {
                echo '
                <tr>
                    <td class="text-center seq">'.$cl->DCC_SEQ.'</td>
                    <td class="text-center sid">'.$cl->DCC_COMMITTEE_ID.'</td>
                    <td class="text-left sname">'.$cl->SM_STAFF_NAME.'</td>
                    <td class="text-center">'.$cl->SM_DEPT_CODE.'</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger text-left btn-xs del_cmm" value="'.$case_id.'"><i class="fa fa-trash"></i> Delete</button>
                    </td>
                </tr>
                ';
            }
		?>
		</tbody>
		</table>	
	</div>
</div>

<br>
<br>

<div class="modal-header btn-success">
    <h4 class="modal-title txt-color-white" id="myModalLabel">Committee Detail</h4>
</div>
<br>
<form id="comDetl" class="form-horizontal" method="post">
    <div id="comDetlAlert"></div>

    <div class="form-group">
        <div class="col-md-2"></div>
        <label class="col-md-2 control-label text-left"><b>Case ID</b></label>
    </div>
    <div class="form-group">
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <input name="form[case_id]" class="form-control" type="text" value="<?php echo $case_id?>" readonly>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-2"></div>
        <label class="col-md-4 control-label text-left"><b>Committee Appointment Date</b> <b><font color="red">* </font></b></label>
    </div>
    <div class="form-group">
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <input name="form[commitee_appointment_date]" class="form-control dtPicker" type="text" value="<?php echo $com_detl->DCL_APPOINTS_COMMITTEE_DATE2?>" placeholder="DD/MM/YYYY">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-2"></div>
        <label class="col-md-4 control-label text-left"><b>Investigation Committee Recommendation</b></label>
    </div>
    <div class="form-group">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <input name="form[recommendation_investigation_committee]" class="form-control" type="text" value="<?php echo $com_detl->DCL_RECOMMED_COMMITTEE_INQUIRY?>">
        </div>
    </div>

    <div class="alert alert-info fade in">
        <b>Guard Officer Decision</b>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Date</label>
        <div class="col-md-4">
            <input name="form[decision_date]" class="form-control dtPicker" type="text" value="<?php echo $com_detl->DCL_STATUS_DATE2?>" placeholder="DD/MM/YYYY">
        </div>

        <label class="col-md-2 control-label">Decision</label>
        <div class="col-md-4">
            <?php echo form_dropdown('form[decision]', $dec_sts_dd, $com_detl->DCL_STATUS, 'class="form-control width-50"')?>
        </div>
    </div>

    <div class="alert alert-info fade in">
        <b>Decision of Jawatankuasa Tindakan Kewangan (JKTK)</b>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Date</label>
        <div class="col-md-4">
            <input name="form[decision_date_jktk]" class="form-control dtPicker" type="text" value="<?php echo $com_detl->DCL_JKTK_DATE2?>" placeholder="DD/MM/YYYY" id="dateJKTK">
        </div>

        <label class="col-md-2 control-label">Status</label>
        <div class="col-md-4">
            <input name="form[status]" class="form-control" type="text" value="<?php echo $com_detl->DCM_STATUS?>" id="dcmSts" readonly>
        </div>
    </div>

    <div id="loaderSts"></div>

    <div class="form-group">
        <label class="col-md-2 control-label">Decision</label>
        <div class="col-md-10">
            <textarea name="form[decision_jktk]" class="form-control" type="text" rows="4" cols="50"><?php echo $com_detl->DCL_NOTES?></textarea>
        </div>
    </div>

    <div id="comDetlAlertFooter"></div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary save_cm_detl_frm"><i class="fa fa-save"></i> Save</button>
    </div>
</form>
</p>

<script>
	$(document).ready(function(){
        $('.dtPicker').datetimepicker({
            format: 'L',
            format: 'DD/MM/YYYY'
        });
	});
</script>