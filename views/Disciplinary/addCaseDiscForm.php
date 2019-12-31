<form id="addRpEntFmDisc" class="form-horizontal" method="post">
    <div class="modal-header btn-primary">
        <h4 class="modal-title txt-color-white" id="myModalLabel">Case Report Entry Form (Disciplinary)</h4>
    </div>
    
    <div id="addRpEntFmDiscAlert">
        <b>Note : </b> ( <b><font color="red">*</font></b> ) <b><font color="red">compulsory fields</font></b><br>&nbsp; <span id="note"></span>
    </div>
    <div class="alert alert-info fade in">
        <b>Officer Details</b>
    </div>
    <br>
    <div class="form-group">
        <label class="col-md-2 control-label">Case Type </label>
        <div class="col-md-4">
            <input name="form[case_type]" class="form-control" type="text" value="<?php echo $cs_type?>" readonly>
        </div>


        <label class="col-md-2 control-label">Case Year <b><font color="red">* </font></b></label>
        <div class="col-md-4">
            <input name="form[case_year]" placeholder="YYYY" class="form-control yearPicker" type="text">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">File Reference</label>
        <div class="col-md-4">
            <input name="form[file_reference]" class="form-control" type="text" value="<?php echo $file_reference?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Staff ID <b><font color="red">* </font></b></label>
        <div class="col-md-2">
            <input name="form[staff_id]" class="form-control" type="text" value="" id="staff_id" readonly>
        </div>

        <div class="col-md-4">
            <input name="" class="form-control" type="text" value="" id="staff_name" readonly>
        </div>

        <div class="col-md-1">
            <button type="button" class="btn btn-primary search_staff"><i class="fa fa-search"></i> Search</button>
        </div>

        <!--<div class="col-md-1">
            <button type="button" class="btn btn-danger" id="toggleClear"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>-->
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Service</label>
        <div class="col-md-2">
            <input name="form[service_id]" class="form-control" type="text" value="" id="service_id" readonly>
        </div>

        <div class="col-md-4">
            <input name="" class="form-control" type="text" value="" id="service_name" readonly>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Department</label>
        <div class="col-md-2">
            <input name="form[department_id]" class="form-control" type="text" value="" id="department_id" readonly>
        </div>

        <div class="col-md-4">
            <input name="" class="form-control" type="text" value="" id="department_name" readonly>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Service Group</label>
        <div class="col-md-4">
            <?php
                echo form_dropdown('form[service_group]', $grp_svc_list, '', 'class="form-control" id="country" style="width: 100%"')
            ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Action Category</label>
        <div class="col-md-4">
            <?php echo form_dropdown('form[action_category]', $act_cat_list, '', 'class="form-control width-50"')?>
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
            <?php echo form_dropdown('form[guilty]', array(''=>'---Please Select---','Y'=>'YES','N'=>'NO'), '', 'class="form-control width-50"')?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Offense Type</label>
        <div class="col-md-10">
            <textarea name="form[offense_type]" placeholder="Offense Type" class="form-control" type="text" rows="5"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Status</label>
        <div class="col-md-2">
            <input name="form[status]" class="form-control" type="text" value="<?php echo $dcm_sts?>" id="status" readonly>
        </div>

        <div class="col-md-4">
            <input name="form[status_desc]" class="form-control" type="text" value="<?php echo $dcm_sts_desc?>" id="status_desc" readonly>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Status Date <b><font color="red">* </font></b></label>
        <div class="col-md-4">
            <input name="form[status_date]" placeholder="DD/MM/YYYY" class="form-control dtPicker" type="text">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Rule A605</label>
        <div class="col-md-10">
            <textarea name="form[rule_a605]" placeholder="Rule A605" class="form-control" type="text" rows="4"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Punishment Type</label>
        <div class="col-md-10">
            <?php echo form_dropdown('form[punishment_type]', $p_type_list, '', 'class="form-control width-50"')?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Punishment Enforcement Date <b><font color="red">* </font></b></label>
        <div class="col-md-4">
            <input name="form[punishment_enforcement_date]" placeholder="DD/MM/YYYY" class="form-control dtPicker" type="text">
        </div>

        <label class="col-md-2 control-label">Punishment End Date <b><font color="red">* </font></b></label>
        <div class="col-md-4">
            <input name="form[punishment_end_date]" placeholder="DD/MM/YYYY" class="form-control dtPicker" type="text">
        </div>
    </div>


    <div id="addRpEntFmDiscAlertFooter"></div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-primary add_rp_ent_frm"><i class="fa fa-save"></i> Save</button>
    </div>
</form>

<script>
	$(document).ready(function(){
        // $('.select2-filter').select2({
        //     allowClear: true,
        //     placeholder: 'Select an option',
        //     width: '100%',
        // });
        
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