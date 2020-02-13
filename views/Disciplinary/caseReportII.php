<!--START report_i-->
<p>
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
                                <label><b>AFR001</b></label>
                            </div>
                        </div>

                        <div class="col-sm-7">
                            <div class="form-group text-left">
                                <label>List of staff according to case status</label>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group text-left">
                                <button type="button" repCode="AFR001" class="btn btn-danger btn-sm genRepBtn"><i class="fa fa-file-pdf-o"></i> PDF</button>
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
                                <?php echo form_dropdown('case_sts_sl', $sts_list, NULL, 'class="form-control" id="case_sts_sl"'); ?>
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
                                <input name="" class="form-control yearPicker" type="text" placeholder="Year" id="from_year_sl">	
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group text-right">
                                <label><b>To</b></label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group text-left">
                                <input name="" class="form-control yearPicker" type="text" placeholder="Year" id="to_year_sl">	
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
                                <label><b>AFR002</b></label>
                            </div>
                        </div>

                        <div class="col-sm-7">
                            <div class="form-group text-left">
                                <label>Offense Statistic</label>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group text-left">
                                <button type="button" repCode="AFR002" class="btn btn-danger btn-sm genRepBtn"><i class="fa fa-file-pdf-o"></i> PDF</button>
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
                                <input name="" class="form-control yearPicker" type="text" placeholder="Year" id="from_year_os">	
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group text-right">
                                <label><b>To</b></label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group text-left">
                                <input name="" class="form-control yearPicker" type="text" placeholder="Year" id="to_year_os">	
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