<p>
<div class="modal-header btn-success">
    <h4 class="modal-title txt-color-white" id="myModalLabel">Suspect Detail</h4>
</div>
<br>
<form class="form-horizontal" method="post">
    <div class="form-group">
        <label class="col-md-2 control-label"><b>Case ID</b></label>
        <div class="col-md-4">
            <input name="" class="form-control" type="text" value="<?php echo $case_id?>" id="case_id" readonly>
        </div>
    </div>
</form>

<div class="text-right">
	<button type="button" class="btn btn-primary btn-sm add_sp_al_btn" value="<?php echo $case_id?>"><i class="fa fa-plus"></i> Add Record</button>
</div>
<br>
<div class="well">
	<div class="row table-condensed table-responsive">
		<table class="table table-bordered table-hover" id="tbl_sp_al_list" style="width: 100%">
		<thead>
            <tr>
                <th class="text-center col-md-1">Staff ID</th>
                <th class="text-center col-md-3">Name</th>
                <th class="text-center col-md-2">Department</th>
                <th class="text-center col-md-2">Service</th>
                <th class="text-center col-md-1">Guilty?</th>
                <th class="text-center col-md-1">Action</th>
            </tr>
		</thead>
		<tbody>
		<?php
            foreach ($sp_list as $spl) {
                echo '
                <tr>
                    <td class="text-center sid">'.$spl->DCS_STAFF_ID.'</td>
                    <td class="text-left sname">'.$spl->SM_STAFF_NAME.'</td>
                    <td class="text-center">'.$spl->DCS_DEPT.' - '.$spl->DM_DEPT_DESC.'</td>
                    <td class="text-center">'.$spl->DCS_JOBCODE.' - '.$spl->SS_SERVICE_DESC.'</td>
                    <td class="text-center">'.$spl->DCS_GUILTY_DESC.'</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger text-left btn-xs del_sp" value="'.$case_id.'"><i class="fa fa-trash"></i> Delete</button>
                    </td>
                </tr>
                ';
            }
		?>
		</tbody>
		</table>	
	</div>
</div>
</p>