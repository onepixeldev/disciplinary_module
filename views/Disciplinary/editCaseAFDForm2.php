<form id="editRpEntFmAFD" class="form-horizontal" method="post">
    <div class="modal-header btn-success">
        <h4 class="modal-title txt-color-white" id="myModalLabel">Case Report Entry Form (Absence From Duty)</h4>
    </div>
    
    <div id="editRpEntFmAFDAlert">
        <!--<b>Note : </b> ( <b><font color="red">*</font></b> ) <b><font color="red">compulsory fields</font></b><br>&nbsp; <span id="note"></span>-->
    </div>
    <div class="alert alert-info fade in">
        <b>Officer Details</b>
    </div>
    <br>
    <div class="form-group">
        <label class="col-md-2 control-label">Case ID</label>
        <div class="col-md-4">
            <input name="form[case_id]" class="form-control" type="text" value="<?php echo $rp_afd_detl->DCM_CASE_ID?>" readonly>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Case Type</label>
        <div class="col-md-4">
            <input name="form[case_type]" class="form-control" type="text" value="<?php echo $rp_afd_detl->DCM_CAT_CODE?>" readonly>
        </div>


        <label class="col-md-2 control-label">Case Year <b><font color="red">* </font></b></label>
        <div class="col-md-4">
            <input name="form[case_year]" placeholder="YYYY" class="form-control yearPicker" type="text" value="<?php echo $rp_afd_detl->DCM_CASE_YEAR?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">File Reference</label>
        <div class="col-md-4">
            <input name="form[file_reference]" class="form-control" type="text" value="<?php echo $rp_afd_detl->DCS_REF?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Staff ID</label>
        <div class="col-md-2">
            <input name="form[staff_id]" class="form-control" type="text" id="staff_id" value="<?php echo $rp_afd_detl->DCS_STAFF_ID?>" readonly>
        </div>

        <div class="col-md-4">
            <input name="" class="form-control" type="text" value="<?php echo $stf_name?>" id="staff_name" value="<?php echo $stf_name?>" readonly>
        </div>

        <!--<div class="col-md-1">
            <button type="button" class="btn btn-primary search_staff"><i class="fa fa-search"></i> Search</button>
        </div>-->
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Service</label>
        <div class="col-md-2">
            <input name="form[service_id]" class="form-control" type="text" value="<?php echo $rp_afd_detl->DCS_JOBCODE?>" id="service_id" readonly>
        </div>

        <div class="col-md-4">
            <input name="" class="form-control" type="text" value="<?php echo $svc_desc?>" id="service_name" readonly>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Department</label>
        <div class="col-md-2">
            <input name="form[department_id]" class="form-control" type="text" value="<?php echo $rp_afd_detl->DCS_DEPT?>" id="department_id" readonly>
        </div>

        <div class="col-md-4">
            <input name="" class="form-control" type="text" value="<?php echo $dept_desc?>" id="department_name" readonly>
        </div>
    </div>

    <br>

    <div class="alert alert-info fade in">
        <b>Case Details</b>
    </div>
    <br>

    <div class="form-group">
        <label class="col-md-2 control-label">Guilty ?</label>
        <div class="col-md-4">
            <?php echo form_dropdown('form[guilty]', array(''=>'---Please Select---','Y'=>'YES','N'=>'NO'), $rp_afd_detl->DCS_GUILTY, 'class="form-control width-50"')?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Complaint Date</label>
        <div class="col-md-4">
            <input name="form[complaint_date]" placeholder="DD/MM/YYYY" class="form-control dtPicker" type="text" value="<?php echo $rp_afd_detl->DCS_COMPLAINT_DATE2?>">
        </div>

        <label class="col-md-2 control-label">Registrar Meeting Date</label>
        <div class="col-md-4">
            <input name="form[registrar_meeting_date]" placeholder="DD/MM/YYYY" class="form-control dtPicker" type="text" value="<?php echo $rp_afd_detl->DCS_REGISTRAR_DATE2?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Show Cause Notice Date</label>
        <div class="col-md-4">
            <input name="form[show_cause_notice_date]" placeholder="DD/MM/YYYY" class="form-control dtPicker" type="text" value="<?php echo $rp_afd_detl->DCS_NOTICE_DATE2?>">
        </div>

        <label class="col-md-2 control-label">Administration Warning / Reminder Date</label>
        <div class="col-md-4">
            <input name="form[administration_warning_date]" placeholder="DD/MM/YYYY" class="form-control dtPicker" type="text" id="awd" value="<?php echo $rp_afd_detl->DCS_ALERT_DATE2?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Absent Day(s)</label>
        <div class="col-md-4">
            <input name="form[absent_day]" placeholder="Day" class="form-control" type="text" value="<?php echo $rp_afd_detl->DCS_ABSENCE_DAY?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Total Emolument Deduction (RM)</label>
        <div class="col-md-4">
            <input name="form[total_emolument_deduction]" placeholder="RM" class="form-control" type="text" value="<?php echo $rp_afd_detl->DCS_EMOLUMENT?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Status</label>
        <div class="col-md-2">
            <input name="form[status]" class="form-control" type="text" value="<?php echo $rp_afd_detl->DCM_STATUS?>" id="status" readonly>
        </div>

        <div class="col-md-2" id="loaderSts"></div>
    </div>

    <div id="editRpEntFmAFDFooter"></div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-primary edit_rp_afd_frm"><i class="fa fa-save"></i> Save</button>
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