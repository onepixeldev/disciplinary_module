<p>
<div class="well">
	<div class="row table-condensed table-responsive" style="font-size: 11px;">
		<table class="table table-bordered table-hover" id="tbl_cs_detl_list" style="width: 100%">
		<thead>
            <tr>
                <th class="text-center col-md-2">Case ID</th>
                <th class="text-center col-md-1">Case Type</th>
                <th class="text-center col-md-1">Reference File</th>
                <th class="text-center col-md-1">Staff ID / Item / Asset ID</th>
                <th class="text-center col-md-2">Name</th>
                <th class="text-center col-md-1">Status</th>
                <th class="text-center col-md-1">Status Date</th>
                <th class="text-center col-md-1">Action</th>
            </tr>
		</thead>
		<tbody>
		<?php
			if (!empty($rp_list_arr)) {
				foreach ($rp_list_arr as $rla=>$val) {
					echo '
                    <tr>
                        <td class="text-left code">'.$val['case_id'].'</td>
                        <td class="text-left">'.$val['case_type'].'</td>
                        <td class="text-left">'.$val['ref_no'].'</td>
                        <td class="text-left">'.$val['id'].'</td>
                        <td class="text-left">'.$val['cName'].'</td>
                        <td class="text-center">'.$val['dcm_sts'].'</td>
                        <td class="text-center">'.$val['dcm_sts_date'].'</td>
						<td class="text-center">
                            <button type="button" class="btn btn-primary text-left btn-xs upd_case" value="'.$val['case_type_val'].'"><i class="fa fa-info-circle"></i> Detail</button>
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