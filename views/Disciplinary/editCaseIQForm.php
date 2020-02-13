<form id="editRpEntFmIQ" class="form-horizontal" method="post">
    <div class="modal-header btn-success">
        <h4 class="modal-title txt-color-white" id="myModalLabel">Case Report Entry Form (Inquiry)</h4>
    </div>
    
    <div id="editRpEntFmIQAlert">
        <b>Note : </b> ( <b><font color="red">*</font></b> ) <b><font color="red">compulsory fields</font></b><br>&nbsp; <span id="note"></span>
    </div>
    <div class="alert alert-info fade in">
        <b>Case Details</b>
    </div>
    <br>
    <div class="form-group">
        <label class="col-md-2 control-label">Case ID</label>
        <div class="col-md-4">
            <input name="form[case_id]" class="form-control" type="text" value="<?php echo $rp_iq_detl->DCM_CASE_ID?>" readonly>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Case Type</label>
        <div class="col-md-4">
            <input name="form[case_type]" class="form-control" type="text" value="<?php echo $rp_iq_detl->DCM_CAT_CODE?>" readonly>
        </div>


        <label class="col-md-2 control-label">Case Year<b><font color="red">* </font></b></label>
        <div class="col-md-4">
            <input name="form[case_year]" placeholder="YYYY" class="form-control yearPicker" type="text" value="<?php echo $rp_iq_detl->DCM_CASE_YEAR?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">File Reference <b><font color="red">* </font></b></label>
        <div class="col-md-4">
            <input name="form[file_reference]" class="form-control" type="text" value="<?php echo $rp_iq_detl->DCL_REF_CODE?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Complaint Date</label>
        <div class="col-md-4">
            <input name="form[complaint_date]" placeholder="DD/MM/YYYY" class="form-control dtPicker" type="text" value="<?php echo $rp_iq_detl->DCL_COMPLAINT_DATE2?>">
        </div>

        <label class="col-md-2 control-label">Date Received Audit Report</label>
        <div class="col-md-4">
            <input name="form[audit_report_date]" placeholder="DD/MM/YYYY" class="form-control dtPicker" type="text" value="<?php echo $rp_iq_detl->DCL_AUDIT_DATE2?>">
        </div>
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-primary edit_rp_iq_frm"><i class="fa fa-save"></i> Save</button>
    </div>
</form>

<script>
	$(document).ready(function(){
        $('.yearPicker').datetimepicker({
            format: 'L',
            format: 'YYYY'
        });

        $('.dtPicker').datetimepicker({
            format: 'L',
            format: 'DD/MM/YYYY'
        });
	});
</script>