<form id="searchStaff" class="form-horizontal" method="post">
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
                <button type="button" class="btn btn-primary search_staff_md"><i class="fa fa-search"></i> </button>
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
                                            <button type="button" class="btn btn-primary btn-xs select_staff_id" data-ss-ic="'.$si->SM_IC_NO.'" data-ss-sts="'.$si->SS_STATUS_DESC.'" data-ss-svc="'.$si->SS_SERVICE_DESC.'" data-ss-dept="'.$si->DM_DEPT_DESC.'"><i class="fa fa-chevron-down"></i> Select</button>
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
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-hand-o-left"></i> Close</button>
    </div>
</form>