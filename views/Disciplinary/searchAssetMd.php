<form id="searchStaff" class="form-horizontal" method="post">
    <div class="modal-header btn-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4 class="modal-title txt-color-white" id="myModalLabel">Search Asset</h4>
    </div>
    <div class="modal-body">

        <div class="form-group">
            <label class="col-md-4 control-label"><b>Asset ID / Serial No / Brand</b></label>
            <div class="col-md-3">
                <input name="form[asset_id]" placeholder="Asset ID / Serial No / Brand" class="form-control" type="text" value="" id="asset_id">
            </div>
            
            <div class="col-md-2">
                <button type="button" class="btn btn-primary search_asset_md" value="<?php echo $asset_type?>"><i class="fa fa-search"></i> </button>
            </div>
        </div>

        <div class="form-group">
            <div id="alertAssetIDMD"></div>
        </div>
        <br>

        <div class="hidden" id="staff_list">
            <p>
                <div class="well">
                    <div class="row table-condensed table-responsive">
                        <table class="table table-bordered table-hover" id="tbl_asset_list">
                        <thead>
                        <tr>
                            <th class="text-left">Asset ID</th>
                            <th class="text-center">Serial No</th>
                            <th class="text-left">Brand</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Install Cost (RM)</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if (!empty($asset_list)) {
                                foreach ($asset_list as $al) {
                                    echo '
                                    <tr>
                                        <td class="text-left col-md-4 asset_id">' . $al->AIH_ASET_CODE . '</td>
                                        <td class="text-center serial_no">' . $al->AIH_SERIAL_NO . '</td>
                                        <td class="text-left col-md-2 brand">' . $al->AIH_BRAND_NAME . '</td>
                                        <td class="text-center col-md-1 quantity">' . $al->AIH_BIL . '</td>
                                        <td class="text-center col-md-2 install_cost">' . number_format($al->AIH_INSTALL_COST,2) . '</td>
                                        <td class="text-center col-md-1">
                                            <button type="button" class="btn btn-primary btn-xs select_asset_id" data-al-code="'.$al->AIH_ASET_CODE.'" 
                                            data-al-desc="'.$al->AIH_ASET_DESC.'"
                                            data-al-sno="'.$al->AIH_SERIAL_NO.'" data-al-brand="'.$al->AIH_BRAND_NAME.'" data-al-quantity="'.$al->AIH_BIL.'"
                                            data-al-icost="'.$al->AIH_INSTALL_COST.'"><i class="fa fa-chevron-down"></i> Select</button>
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
        </div>
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-hand-o-left"></i> Close</button>
    </div>
</form>