<div class="modal-header btn-primary">
    <h4 class="modal-title txt-color-white" id="myModalLabel">Service Group</h4>
</div>
<p>
<div class="text-right">
	<button type="button" class="btn btn-primary btn-sm add_svc_pos_grp_btn"><i class="fa fa-plus"></i> Add Record</button>
</div>
<br>
<div class="well">
	<div class="row table-condensed table-responsive">
		<table class="table table-bordered table-hover" id="tbl_svc_pos_grp_list" style="width: 100%">
		<thead>
            <tr>
                <th class="text-center col-md-1">Code</th>
                <th class="text-center col-md-4">Description</th>
                <th class="text-center col-md-1">Active ?</th>
                <th class="text-center col-md-1">Action</th>
            </tr>
		</thead>
		<tbody>
		<?php
			if (!empty($svc_pos_grp_list)) {
				foreach ($svc_pos_grp_list as $spg) {
					echo '
                    <tr>
                        <td class="text-center code">'.$spg->DGS_GROUP_CODE.'</td>
						<td class="text-left desc">'.$spg->DGS_GROUP_DESC.'</td>
						<td class="text-center">'.$spg->DGS_STATUS_DESC.'</td>
						<td class="text-center">
							<div class="btn-group">
								<button type="button" class="btn btn-success text-left btn-xs upd_spg" value=""><i class="fa fa-edit"></i> Edit</button>
							</div>
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