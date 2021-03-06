<div class="modal-header btn-primary">
    <h4 class="modal-title txt-color-white" id="myModalLabel">Decision</h4>
</div>
<p>
<div class="text-right">
	<button type="button" class="btn btn-primary btn-sm add_als_btn"><i class="fa fa-plus"></i> Add Record</button>
</div>
<br>
<div class="well">
	<div class="row table-condensed table-responsive">
		<table class="table table-bordered table-hover" id="tbl_als_list" style="width: 100%">
		<thead>
            <tr>
                <th class="text-center col-md-1">Code</th>
                <th class="text-center col-md-4">Description</th>
                <th class="text-center col-md-1">Active</th>
                <th class="text-center col-md-1">Action</th>
            </tr>
		</thead>
		<tbody>
		<?php
			if (!empty($als_list)) {
				foreach ($als_list as $als) {
					echo '
                    <tr>
                        <td class="text-center code">'.$als->DAR_RESULT_CODE.'</td>
                        <td class="text-left desc">'.$als->DAR_RESULT_DESC.'</td>
                        <td class="text-center">'.$als->DAR_STATUS_DESC.'</td>
						<td class="text-center">
							<div class="btn-group">
								<button type="button" class="btn btn-success text-left btn-xs upd_als" value=""><i class="fa fa-edit"></i> Edit</button>
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