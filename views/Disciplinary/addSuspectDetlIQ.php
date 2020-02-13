<form id="" class="form-horizontal" method="post">
    <div class="modal-header btn-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4 class="modal-title txt-color-white" id="myModalLabel">Search Staff</h4>
    </div>
    <div class="modal-body">

        <div class="form-group">
            <label class="col-md-4 control-label">Staff ID / Name</label>
            <div class="col-md-3">
                <input name="form[staff_id]" placeholder="Staff ID / Name" class="form-control" type="text" value="" id="staff_id">
            </div>
            

            <div class="col-md-2">
                <button type="button" class="btn btn-primary search_staff_sp2"><i class="fa fa-search"></i> </button>
            </div>
        </div>

        <div class="form-group">
            <div id="alertStfIDMD"></div>
        </div>
        <br>

        <div class="hidden" id="staff_list">
            <p>
                <div class="well">
                    <div class="row table-condensed table-responsive">
                        <table class="table table-bordered table-hover" id="tbl_stf_res_list">
                        <thead>
                        <tr>
                            <th class="text-center">Staff ID</th>
                            <th class="text-left">Staff Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if (!empty($stf_inf)) {
                                foreach ($stf_inf as $si) {
                                    echo '
                                    <tr>
                                        <td class="text-center staff_id col-md-2">' . $si->SM_STAFF_ID . '</td>
                                        <td class="text-left staff_id">' . $si->SM_STAFF_NAME . '</td>
                                        <td class="text-center col-md-1">
                                            <button type="button" class="btn btn-primary btn-xs select_staff_id_sp2" data-ss-code="'.$si->SS_SERVICE_CODE.'" data-ss-desc="'.$si->SS_SERVICE_DESC.'" data-dept-code="'.$si->SM_DEPT_CODE.'" data-dept-desc="'.$si->DM_DEPT_DESC.'"><i class="fa fa-chevron-down"></i> Select</button>
                                        </td>
                                    </tr>
                                    ';
                                }
                            } 
                        ?>
                        </tbody>
                        </table>	
                    </div>
                </div>
            </p>    
        </div>
        
        <br>
</form>

<div class="hidden" id="staff_form">
    <form id="spDetlForm" class="form-horizontal" method="post">
        <div class="alert alert-info fade in">
            <b>Details</b>
        </div>

        <div class="modal-body">
            <div id="spDetlFormAlert"></div>

            <div class="form-group">
                <label class="col-md-3 control-label">Case ID</label>
                <div class="col-md-4">
                    <input name="form[case_id]" class="form-control" type="text" value="<?php echo $case_id?>" id="case_id" readonly>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Staff ID</label>
                <div class="col-md-2">
                    <input name="form[staff_id_form]" class="form-control" type="text" id="stfID" readonly>
                </div>

                <div class="col-md-6">
                    <input name="" class="form-control" type="text" readonly id="stfName">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Department</label>
                <div class="col-md-2">
                    <input name="form[staff_dept]" class="form-control" type="text" id="staff_dept" readonly>
                </div>

                <div class="col-md-6">
                    <input name="" class="form-control" type="text" id="staff_dept_desc" readonly>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Service</label>
                <div class="col-md-2">
                    <input name="form[staff_svc]" class="form-control" type="text" id="staff_svc" readonly>
                </div>

                <div class="col-md-6">
                    <input name="" class="form-control" type="text" id="staff_svc_desc" readonly>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Group Service</label>
                <div class="col-md-4">
                    <?php
                        echo form_dropdown('form[group_service]', $grp_svc_list, '', 'class="form-control" style="width: 100%"')
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Guilty ?</label>
                <div class="col-md-4">
                    <?php
                        echo form_dropdown('form[guilty]', array(''=>'--- Please Select ---', 'Y'=>'Yes', 'N'=>'No'), '', 'class="form-control" style="width: 100%"')
                    ?>
                </div>
            </div>
            
            <div id="spDetlFormAlertFooter">
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary save_sp_detl2"><i class="fa fa-save"></i> Save</button>
        </div>
    </form>                            
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-hand-o-left"></i> Close</button>
</div>
