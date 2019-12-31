<p>
<div class="text-right">
	<button type="button" class="btn btn-primary btn-sm add_case_rp_disc_btn"><i class="fa fa-plus"></i> Add Record</button>
</div>
<br>
<div class="well">
	<div class="row table-condensed table-responsive">
		<table class="table table-bordered table-hover" id="tbl_rp_disc_list" style="width: 100%">
		<thead>
            <tr>
                <th class="text-center col-md-2">Case ID</th>
                <th class="text-center col-md-1">Staff ID</th>
                <th class="text-center col-md-4">Name</th>
                <th class="text-center col-md-1">Category</th>
                <th class="text-center col-md-1">Year</th>
                <th class="text-center col-md-1">Guilty?</th>
                <th class="text-center col-md-1">Action</th>
            </tr>
		</thead>
		<tbody>
		<?php
			if (!empty($rp_disc_list)) {
				foreach ($rp_disc_list as $rdl) {
					echo '
                    <tr>
                        <td class="text-center code">'.$rdl->DCM_CASE_ID.'</td>
                        <td class="text-center sid">'.$rdl->DCS_STAFF_ID.'</td>
						<td class="text-left name">'.$rdl->SM_STAFF_NAME.'</td>
                        <td class="text-center">'.$rdl->DCM_CAT_CODE.'</td>
                        <td class="text-center">'.$rdl->DCM_CASE_YEAR.'</td>
                        <td class="text-center">'.$rdl->DCS_GUILTY_DESC.'</td>
						<td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-xs btn-warning" data-toggle="dropdown"><i class="fa fa-bars"></i> Menu</button>
                                <div style="background-color:silver;text-align:center;width:5px;" class="dropdown-menu dropdown-menu-right dd_btn">
                                    <button type="button" class="btn btn-success text-left btn-block btn-xs upd_rp_ent" value=""><i class="fa fa-edit"></i> Edit</button>
                                    <button type="button" class="btn btn-danger text-left btn-block btn-xs del_rp_ent" value=""><i class="fa fa-trash"></i> Delete</button>
                                </div>
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