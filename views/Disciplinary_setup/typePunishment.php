<div class="modal-header btn-primary">
    <h4 class="modal-title txt-color-white" id="myModalLabel">Punishment Type</h4>
</div>
<p>
<div class="text-right">
	<button type="button" class="btn btn-primary btn-sm add_top_btn"><i class="fa fa-plus"></i> Add Record</button>
</div>
<br>
<div class="well">
	<div class="row table-condensed table-responsive">
		<table class="table table-bordered table-hover" id="tbl_top_list" style="width: 100%">
		<thead>
            <tr>
                <th class="text-center col-md-1">Code</th>
                <th class="text-center col-md-4">Description</th>
                <th class="text-center col-md-1">Action</th>
            </tr>
		</thead>
		<tbody>
		<?php
			if (!empty($top_list)) {
				foreach ($top_list as $tl) {
					echo '
                    <tr>
                        <td class="text-center code">'.$tl->DPM_PENALTY_CODE.'</td>
                        <td class="text-left desc">'.$tl->DPM_PENALTY_DESC.'</td>
						<td class="text-center">
							<div class="btn-group">
								<button type="button" class="btn btn-success text-left btn-xs upd_top" value=""><i class="fa fa-edit"></i> Edit</button>
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