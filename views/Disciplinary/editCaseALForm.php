<form id="updRpEntFmAL" class="form-horizontal" method="post">
    <div class="modal-header btn-success">
        <h4 class="modal-title txt-color-white" id="myModalLabel">Case Report Entry Form (Asset Loss)</h4>
    </div>
    
    <div id="updRpEntFmALAlert">
        <b>Note : </b> ( <b><font color="red">*</font></b> ) <b><font color="red">compulsory fields</font></b><br>&nbsp; <span id="note"></span>
    </div>
    <div class="alert alert-info fade in">
        <b>Officer Details</b>
    </div>
    <br>

    <div class="form-group">
        <label class="col-md-2 control-label">Case ID</label>
        <div class="col-md-4">
            <input name="form[case_id]" class="form-control" type="text" value="<?php echo $rp_al_detl->DCM_CASE_ID?>" readonly>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Case Type </label>
        <div class="col-md-4">
            <input name="form[case_type]" class="form-control" type="text" value="<?php echo $rp_al_detl->DCM_CAT_CODE?>" readonly>
        </div>


        <label class="col-md-2 control-label">Case Year <b><font color="red">* </font></b></label>
        <div class="col-md-4">
            <input name="form[case_year]" placeholder="YYYY" class="form-control yearPicker" type="text" value="<?php echo $rp_al_detl->DCM_CASE_YEAR?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">File Reference <b><font color="red">* </font></b></label>
        <div class="col-md-4">
            <input name="form[file_reference]" class="form-control" type="text" value="<?php echo $rp_al_detl->DCL_REF_CODE?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Item Type <b><font color="red">* </font></b></label>
        <div class="col-md-4">
            <?php echo form_dropdown('itDummy', array(''=>'---Please Select---','MONEY'=>'MONEY','ASSET'=>'ASSET','INVENTORY'=>'INVENTORY'), $rp_al_detl->DCI_ITEMTYPE, 'class="form-control width-50" id="itemType" disabled')?>
        </div>

        <div class="col-md-4 hidden">
            <input name="form[item_type]" class="form-control" type="text" value="<?php echo $rp_al_detl->DCI_ITEMTYPE?>" readonly>
        </div>
    </div>

    <div class="form-group" id="loaderItType"></div>

    <div id="aForm" class="hidden">
        <div class="form-group">
            <label class="col-md-2 control-label">Item Details</label>
            <div class="col-md-4">
                <?php echo form_dropdown('form[item_details]', $money_type, $rp_al_detl->DCI_ITEM, 'class="form-control width-50" id="itemDetl"')?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Item Description</label>
            <div class="col-md-10">
                <input name="form[item_description]" class="form-control" type="text" placeholder="Item Description" id="itemDesc" value="<?php echo $rp_al_detl->DCI_ITEM_DESC?>">
            </div>
        </div>
    </div>

    <div id="bForm" class="hidden">
        <div class="form-group">
            <label class="col-md-2 control-label">Asset ID </label>
            <div class="col-md-4">
                <input name="form[asset_id]" class="form-control" type="text" value="<?php echo $rp_al_detl->DCI_ASSET_CODE?>" id="asset_id" readonly>
            </div>

            <div class="col-md-1">
                <button type="button" class="btn btn-primary search_asset"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Asset Type</label>
            <div class="col-md-10">
                <input name="form[asset_type]" class="form-control" type="text" placeholder="Asset Type" value="<?php echo $rp_al_detl->DCI_ASSET_DESC?>" id="assetType">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Serial No</label>
            <div class="col-md-4">
                <input name="form[serial_no]" class="form-control" type="text" placeholder="Serial Number" value="<?php echo $rp_al_detl->DCI_ASSET_SERIAL?>" id="serialNo">
            </div>

            <label class="col-md-2 control-label">Brand</label>
            <div class="col-md-4">
                <input name="form[brand]" class="form-control" type="text" placeholder="Brand" value="<?php echo $rp_al_detl->DCI_BRAND_NAME?>" id="brand">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Quantity</label>
            <div class="col-md-4">
                <input name="form[quantity]" class="form-control" type="text" placeholder="Quantity" value="<?php echo $rp_al_detl->DCI_BIL?>" id="qItem">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Amount (RM)</label>
        <div class="col-md-4">
            <input name="form[amount]" class="form-control" type="text" placeholder="RM" value="<?php echo $rp_al_detl->DCI_AMOUNT?>" id="amtItem">
        </div>
    </div>

    <br>

    <div class="alert alert-info fade in">
        <b>Case Details</b>
    </div>
    <br>

    <div class="form-group">
        <label class="col-md-2 control-label">Loss Location</label>
        <div class="col-md-10">
            <input name="form[loss_location]" class="form-control" type="text" placeholder="Loss Location" value="<?php echo $rp_al_detl->DCL_ACTUAL_LOC?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">How the Loss Happened</label>
        <div class="col-md-10">
            <input name="form[how_the_loss_happened]" class="form-control" type="text" placeholder="How the Loss Happened" value="<?php echo $rp_al_detl->DCL_LOST_METHOD?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Staff ID </label>
        <div class="col-md-2">
            <input name="form[staff_id]" class="form-control" type="text" value="<?php echo $rp_al_detl->DCL_STAFF_LAST?>" id="staff_id" readonly>
        </div>

        <div class="col-md-4">
            <input name="" class="form-control" type="text" value="<?php echo $stf_name?>" id="staff_name" readonly>
        </div>

        <div class="col-md-1">
            <button type="button" class="btn btn-primary search_staff"><i class="fa fa-search"></i> Search</button>
        </div>

        <label class="col-md-3 control-label text-left"> <b>The last officer handle the asset</b></label>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Police Report Date</label>
        <div class="col-md-4">
            <input name="form[police_report_date]" placeholder="DD/MM/YYYY" class="form-control dtPicker" type="text" value="<?php echo $rp_al_detl->DCL_POLICE_REPORT_DATE2?>">
        </div>
    </div>


    <div id="updRpEntFmALFooter"></div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-primary upd_rp_al_frm"><i class="fa fa-save"></i> Save</button>
    </div>
</form>

<script>
	$(document).ready(function(){
        // $('.select2-filter').select2({
        //     allowClear: true,
        //     placeholder: 'Select an option',
        //     width: '100%',
        // });
        
        $('.yearPicker').datetimepicker({
            format: 'L',
            format: 'YYYY'
        });

        $('.dtPicker').datetimepicker({
            format: 'L',
            format: 'DD/MM/YYYY'
        });
	});
</script>