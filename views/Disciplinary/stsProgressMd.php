<style>
.bootstrap-datetimepicker-widget.dropdown-menu {width: auto;}
</style>

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
                    <th class="text-center col-md-1 hidden">CaseID.</th>
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
                                <td class="text-left hidden">' . $sp->DCP_CASE_ID . '</td>
                                <td class="text-center">' . $sp->DCP_SEQ . '</td>
                                <td class="text-left">
                                    <input name="form[status_date]" placeholder="DD/MM/YYYY" value="'.$sp->DCP_STATUS_DATE2.'" class="form-control dtPickerMd" type="text">
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
        $('.dtPickerMd').datetimepicker({
            format: 'DD/MM/YYYY',
        });

        // STATUS PROGRESS UPDATE STATUS DATE
        $('.dtPickerMd').on('dp.change', function(e){
            e.preventDefault();
            var thisBtn = $(this);
		    var td = thisBtn.parent().siblings();
            var case_id = td.eq(0).html().trim();
		    var dcp_seq = td.eq(1).html().trim();
            var sts_date = $(this).val();
            // console.log(case_id);
            // console.log(dcp_seq);
            // console.log(sts_date);
            // return;

            $('.btn').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->lib->class_url('saveUpdStsProg')?>',
                data: {'case_id':case_id, 'dcp_seq':dcp_seq, 'sts_date':sts_date},
                dataType: 'JSON',
                success: function(res) {
                    show_loading();

                    if (res.sts==1) {
                        hide_loading();
                        $.alert({
                            title: 'Success!',
                            content: res.msg,
                            type: 'green',
                        });
                        $('.btn').removeAttr('disabled');
                    } else {
                        hide_loading();
                        $.alert({
                            title: 'Alert!',
                            content: res.msg,
                            type: 'red',
                        });
                        $('.btn').removeAttr('disabled');
                    }

                },
                error: function() {
                    $('.btn').removeAttr('disabled');
                    hide_loading();
                }
            });	


        });
	});

    
</script>