<div class="modal-header btn-primary">
    <h4 class="modal-title txt-color-white" id="myModalLabel">Action Category</h4>
</div>
<p>
<div class="text-right">
	<button type="button" class="btn btn-primary btn-sm add_act_cat_btn"><i class="fa fa-plus"></i> Add Record</button>
</div>
<br>
<div class="well">
	<div class="row table-condensed table-responsive">
		<table class="table table-bordered table-hover" id="tbl_ac_list" style="width: 100%">
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
			if (!empty($ac_list)) {
				foreach ($ac_list as $acl) {
					echo '
                    <tr>
                        <td class="text-center code">'.$acl->DCA_CATEGORY_CODE.'</td>
						<td class="text-left desc">'.$acl->DCA_CATEGORY_DESC.'</td>
						<td class="text-center">'.$acl->DCA_STATUS_DESC.'</td>
						<td class="text-center">
							<div class="btn-group">
							<button type="button" class="btn btn-success text-left btn-xs upd_ac" value=""><i class="fa fa-edit"></i> Edit</button>
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