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
<br>
<div class="text-right">
	<button type="button" class="btn btn-primary btn-sm add_cm_iq_btn" value="<?php echo $case_id?>"><i class="fa fa-plus"></i> Add Record</button>
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
			if (!empty($com_list)) {
				foreach ($com_list as $cl) {
					echo '
                    <tr>
                        <td class="text-center seq">'.$cl->DCC_SEQ.'</td>
                        <td class="text-center sid">'.$cl->DCC_COMMITTEE_ID.'</td>
                        <td class="text-left sname">'.$cl->SM_STAFF_NAME.'</td>
                        <td class="text-center">'.$cl->SM_DEPT_CODE.'</td>
						<td class="text-center">
                            <button type="button" class="btn btn-danger text-left btn-xs del_cmm2" value="'.$case_id.'"><i class="fa fa-trash"></i> Delete</button>
						</td>
					</tr>
                    ';
				}
			} else {
                echo '
                    <tr>
                        <td class="text-center" colspan="5">No record found.</td>
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
<form id="comDetlIQ" class="form-horizontal" method="post">
    <div id="comDetlIQAlert"></div>

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
        <label class="col-md-4 control-label text-left"><b>Committee Appointment Date</b></label>
    </div>
    <div class="form-group">
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <input name="form[commitee_appointment_date]" class="form-control dtPicker" type="text" value="<?php echo $com_detl->DCL_APPOINTS_COMMITTEE_DATE2?>" placeholder="DD/MM/YYYY">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-2"></div>
        <label class="col-md-4 control-label text-left"><b>Investigation Scope</b></label>
    </div>
    <div class="form-group">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <textarea name="form[investigation_scope]" class="form-control" type="text" rows="4" cols="50"><?php echo $com_detl->DCL_INQUIRY?></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-2"></div>
        <label class="col-md-4 control-label text-left"><b>Investigation Committee Recommendation</b></label>
    </div>
    <div class="form-group">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <textarea name="form[investigation_committee_rec]" class="form-control" type="text" rows="4" cols="50"><?php echo $com_detl->DCL_RECOMMED_COMMITTEE_INQUIRY?></textarea>
        </div>
    </div>

    <div class="alert alert-info fade in">
        <b>MPE Decision</b>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Date</label>
        <div class="col-md-4">
            <input name="form[decision_date_mpe]" class="form-control dtPicker" type="text" value="<?php echo $com_detl->DCL_MPE_DATE2?>" placeholder="DD/MM/YYYY" id="dateMPE">
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
            <textarea name="form[decision_mpe]" class="form-control" type="text" rows="4" cols="50"><?php echo $com_detl->DCL_NOTES?></textarea>
        </div>
    </div>

    <div id="comDetlIQAlertFooter"></div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary save_cm_iq_frm"><i class="fa fa-save"></i> Save</button>
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