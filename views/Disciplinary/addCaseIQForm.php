<form id="addRpEntFmIQ" class="form-horizontal" method="post">
    <div class="modal-header btn-primary">
        <h4 class="modal-title txt-color-white" id="myModalLabel">Case Report Entry Form (Inquiry)</h4>
    </div>
    
    <div id="addRpEntFmIQAlert">
        <b>Note : </b> ( <b><font color="red">*</font></b> ) <b><font color="red">compulsory fields</font></b><br>&nbsp; <span id="note"></span>
    </div>
    <div class="alert alert-info fade in">
        <b>Case Details</b>
    </div>
    <br>
    <div class="form-group">
        <label class="col-md-2 control-label">Case Type </label>
        <div class="col-md-4">
            <input name="form[case_type]" class="form-control" type="text" value="<?php echo $cs_type?>" readonly>
        </div>


        <label class="col-md-2 control-label">Case Year <b><font color="red">*</font></b></label>
        <div class="col-md-4">
            <input name="form[case_year]" placeholder="YYYY" class="form-control yearPicker" type="text">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">File Reference <b><font color="red">*</font></b></label>
        <div class="col-md-4">
            <input name="form[file_reference]" class="form-control" type="text" value="<?php echo $file_reference?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Complaint Date</label>
        <div class="col-md-4">
            <input name="form[complaint_date]" placeholder="DD/MM/YYYY" class="form-control dtPicker" type="text">
        </div>

        <label class="col-md-2 control-label">Date Received Audit Report</label>
        <div class="col-md-4">
            <input name="form[audit_report_date]" placeholder="DD/MM/YYYY" class="form-control dtPicker" type="text">
        </div>
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-primary add_rp_iq_frm"><i class="fa fa-save"></i> Save</button>
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