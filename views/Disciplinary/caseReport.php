<!--START report_i-->
<p>
    <div class="alert alert-info fade in">
        <b>Disciplinary</b>
    </div>
    <div class="row">
        <div class="col-sm-1">
            <div class="text-left">   
                &nbsp;
            </div>
        </div>

        <div class="container col-md-10">
            <div class="panel panel-default text-right">
                <div class="panel-body" id="summary">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group text-right">
                                <label><b>AFR006</b></label>
                            </div>
                        </div>

                        <div class="col-sm-7">
                            <div class="form-group text-left">
                                <label>Disciplinary Report</label>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group text-left">
                                <button type="button" repCode="AFR006" class="btn btn-danger btn-sm genRepBtn"><i class="fa fa-file-pdf-o"></i> PDF</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group text-right">
                                <label><b>Case Status</b></label>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group text-left">
                                <?php echo form_dropdown('case_sts_disc', $sts_list, '', 'class="form-control" id="case_sts_disc"'); ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-left">   
                                &nbsp;
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group text-right">
                                <label><b>From</b></label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group text-left">
                                <input name="" class="form-control yearPicker" type="text" placeholder="Year" id="from_year_disc">	
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group text-right">
                                <label><b>To</b></label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group text-left">
                                <input name="" class="form-control yearPicker" type="text" placeholder="Year" id="to_year_disc">	
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-left">   
                                &nbsp;
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="alert alert-info fade in">
        <b>Absence From Duty</b>
    </div>
    <div class="row">
        <div class="col-sm-1">
            <div class="text-left">   
                &nbsp;
            </div>
        </div>

        <div class="container col-md-10">
            <div class="panel panel-default text-right">
                <div class="panel-body" id="summary">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group text-right">
                                <label><b>AFR007</b></label>
                            </div>
                        </div>

                        <div class="col-sm-7">
                            <div class="form-group text-left">
                                <label>Absence From Duty Report</label>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group text-left">
                                <button type="button" repCode="AFR007" class="btn btn-danger btn-sm genRepBtn"><i class="fa fa-file-pdf-o"></i> PDF</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group text-right">
                                <label><b>Case Status</b></label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group text-left">
                                <?php echo form_dropdown('case_sts_afd', $sts_list2, NULL, 'class="form-control" id="case_sts_afd"'); ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-left">   
                                &nbsp;
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group text-right">
                                <label><b>From</b></label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group text-left">
                                <input name="" class="form-control yearPicker" type="text" placeholder="Year" id="from_year_afd">	
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group text-right">
                                <label><b>To</b></label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group text-left">
                                <input name="" class="form-control yearPicker" type="text" placeholder="Year" id="to_year_afd">	
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-left">   
                                &nbsp;
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="alert alert-info fade in">
        <b>Asset Loss</b>
    </div>
    <div class="row">
        <div class="col-sm-1">
            <div class="text-left">   
                &nbsp;
            </div>
        </div>

        <div class="container col-md-10">
            <div class="panel panel-default text-right">
                <div class="panel-body" id="summary">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group text-right">
                                <label><b>AFR008</b></label>
                            </div>
                        </div>

                        <div class="col-sm-7">
                            <div class="form-group text-left">
                                <label>Asset Loss Report</label>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group text-left">
                                <button type="button" repCode="AFR008" class="btn btn-danger btn-sm genRepBtn"><i class="fa fa-file-pdf-o"></i> PDF</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group text-right">
                                <label><b>Case Status</b></label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group text-left">
                                <?php echo form_dropdown('case_sts_al', $sts_list2, NULL, 'class="form-control" id="case_sts_al"'); ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-left">   
                                &nbsp;
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group text-right">
                                <label><b>From</b></label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group text-left">
                                <input name="" class="form-control yearPicker" type="text" placeholder="Year" id="from_year_al">	
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group text-right">
                                <label><b>To</b></label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group text-left">
                                <input name="" class="form-control yearPicker" type="text" placeholder="Year" id="to_year_al">	
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-left">   
                                &nbsp;
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="alert alert-info fade in">
        <b>Inquiry / Show Cause</b>
    </div>
    <div class="row">
        <div class="col-sm-1">
            <div class="text-left">   
                &nbsp;
            </div>
        </div>

        <div class="container col-md-10">
            <div class="panel panel-default text-right">
                <div class="panel-body" id="summary">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group text-right">
                                <label><b>AFR009</b></label>
                            </div>
                        </div>

                        <div class="col-sm-7">
                            <div class="form-group text-left">
                                <label>Inquiry / Show Cause Report</label>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group text-left">
                                <button type="button" repCode="AFR009" class="btn btn-danger btn-sm genRepBtn"><i class="fa fa-file-pdf-o"></i> PDF</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group text-right">
                                <label><b>Case Status</b></label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group text-left">
                                <?php echo form_dropdown('case_sts_iq', $sts_list2, NULL, 'class="form-control" id="case_sts_iq"'); ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-left">   
                                &nbsp;
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group text-right">
                                <label><b>From</b></label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group text-left">
                                <input name="" class="form-control yearPicker" type="text" placeholder="Year" id="from_year_iq">	
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group text-right">
                                <label><b>To</b></label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group text-left">
                                <input name="" class="form-control yearPicker" type="text" placeholder="Year" id="to_year_iq">	
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-left">   
                                &nbsp;
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</p>
<!-- END -->

<script>
	$(document).ready(function(){
        
        $('.yearPicker').datetimepicker({
            format: 'L',
            format: 'YYYY'
        });
	});
</script>