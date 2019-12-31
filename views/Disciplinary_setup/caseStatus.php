<div class="modal-header btn-primary">
    <h4 class="modal-title txt-color-white" id="myModalLabel">Case Status</h4>
</div>
<p>
<div class="text-right">
	<button type="button" class="btn btn-primary btn-sm add_case_status_btn"><i class="fa fa-plus"></i> Add Record</button>
</div>
<br>
<div class="well">
	<div class="row table-condensed table-responsive">
		<table class="table table-bordered table-hover" id="tbl_cs_list" style="width: 100%">
		<thead>
            <tr>
                <th class="text-center col-md-1">Code</th>
                <th class="text-center col-md-4">Description</th>
                <th class="text-center col-md-1">Order</th>
                <th class="text-center col-md-1">Active ?</th>
                <th class="text-center col-md-1">Action</th>
            </tr>
		</thead>
		<tbody>
		<?php
			if (!empty($cs_list)) {
				foreach ($cs_list as $csl) {
					echo '
                    <tr>
                        <td class="text-center code">'.$csl->SM_STATUS_CODE.'</td>
                        <td class="text-left desc">'.$csl->SM_STATUS_DESC.'</td>
                        <td class="text-center">'.$csl->SM_STATUS_RANK.'</td>
						<td class="text-center">'.$csl->SM_UPDATABLE_DESC.'</td>
						<td class="text-center">
							<div class="btn-group">
								<button type="button" class="btn btn-success text-left btn-block btn-xs upd_cs" value=""><i class="fa fa-edit"></i> Edit</button>
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