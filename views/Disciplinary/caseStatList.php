<p>
    <div class="well">
        <div class="row table-condensed table-responsive">
            <table class="table table-bordered table-hover" id="tbl_case_stat_list">
            <thead>
            <tr>
                <th class="text-center">Case Year</th>
                <th class="text-center">Department</th>
                <th class="text-center">Case Type</th>
                <th class="text-center">Case Status</th>
                <th class="text-center">Case Amount</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
                if (!empty($case_stat_list)) {
                    foreach ($case_stat_list as $csl) {
                        echo '
                        <tr>
                            <td class="text-center col-md-1 case_year">' . $csl->DCM_CASE_YEAR . '</td>
                            <td class="text-center col-md-1 case_dept">' . $csl->DCM_DEPT . '</td>
                            <td class="text-left col-md-1 case_type">' . $csl->DCM_CAT_CODE_DESC . '</td>
                            <td class="text-left col-md-2 case_sts">' . $csl->DCM_STATUS . '</td>
                            <td class="text-center col-md-1">' . $csl->TOTAL_CASE . '</td>
                            <td class="text-center col-md-1">
                                <button type="button" class="btn btn-primary btn-xs select_case_detl" data-year="'. $csl->DCM_CASE_YEAR .'" data-dept="'. $csl->DCM_DEPT .'" data-type="'. $csl->DCM_CAT_CODE .'" data-sts="'. $csl->DCM_STATUS .'"><i class="fa fa-list-ul"></i> Case List</button>
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