<div class="modal-header btn-warning">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
    <h4 class="modal-title txt-color-white" id="myModalLabel">Status Progress</h4>
</div>
<div class="modal-body">
    <p>
        <div class="well">
            <div class="row table-condensed table-responsive">
                <table class="table table-bordered table-hover" id="tbl_sts_list">
                <thead>
                <tr>
                    <th class="text-center col-md-1">No.</th>
                    <th class="text-center col-md-1">Status Date</th>
                    <th class="text-center col-md-3">Status</th>
                    <th class="text-center">Status Detail</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($sts_prog)) {
                        foreach ($sts_prog as $sp) {
                            echo '
                            <tr>
                                <td class="text-center">' . $sp->DCP_SEQ . '</td>
                                <td class="text-left">
                                    <input name="form[status_date]" placeholder="DD/MM/YYYY" value="'.$sp->DCP_STATUS_DATE2.'" class="form-control dtPicker" type="text">
                                </td>
                                <td class="text-center">' . $sp->DCP_STATUS . '</td>
                                <td class="text-left">' . $sp->DCP_NOTES . '</td>
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

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-hand-o-left"></i> Close</button>
</div>

<script>
	$(document).ready(function(){
        $('.dtPicker').datepicker({
            format: 'DD/MM/YYYY'
            // inline: true
        });
	});
</script>