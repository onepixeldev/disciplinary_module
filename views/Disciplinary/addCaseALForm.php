<form id="addRpEntFmAL" class="form-horizontal" method="post">
    <div class="modal-header btn-primary">
        <h4 class="modal-title txt-color-white" id="myModalLabel">Case Report Entry Form (Asset Loss)</h4>
    </div>
    
    <div id="addRpEntFmALAlert">
        <b>Note : </b> ( <b><font color="red">*</font></b> ) <b><font color="red">compulsory fields</font></b><br>&nbsp; <span id="note"></span>
    </div>
    <div class="alert alert-info fade in">
        <b>Officer Details</b>
    </div>
    <br>
    <div class="form-group">
        <label class="col-md-2 control-label">Case Type </label>
        <div class="col-md-4">
            <input name="form[case_type]" class="form-control" type="text" value="<?php echo $cs_type?>" readonly>
        </div>


        <label class="col-md-2 control-label">Case Year <b><font color="red">* </font></b></label>
        <div class="col-md-4">
            <input name="form[case_year]" placeholder="YYYY" class="form-control yearPicker" type="text">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">File Reference <b><font color="red">* </font></b></label>
        <div class="col-md-4">
            <input name="form[file_reference]" class="form-control" type="text" value="<?php echo $file_reference?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Item Type <b><font color="red">* </font></b></label>
        <div class="col-md-4">
            <?php echo form_dropdown('form[item_type]', array(''=>'---Please Select---','MONEY'=>'MONEY','ASSET'=>'ASSET','INVENTORY'=>'INVENTORY'), '', 'class="form-control width-50" id="itemType"')?>
        </div>
    </div>

    <div class="form-group" id="loaderItType"></div>

    <div id="aForm" class="hidden">
        <div class="form-group">
            <label class="col-md-2 control-label">Item Details</label>
            <div class="col-md-4">
                <?php echo form_dropdown('form[item_details]', $money_type, '', 'class="form-control width-50" id="itemDetl"')?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Item Description</label>
            <div class="col-md-10">
                <input name="form[item_description]" class="form-control" type="text" placeholder="Item Description" id="itemDesc">
            </div>
        </div>
    </div>

    <div id="bForm" class="hidden">
        <div class="form-group">
            <label class="col-md-2 control-label">Asset ID</label>
            <div class="col-md-4">
                <input name="form[asset_id]" class="form-control" type="text" id="asset_id" readonly>
            </div>

            <div class="col-md-1">
                <button type="button" class="btn btn-primary search_asset"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Asset Type</label>
            <div class="col-md-10">
                <input name="form[asset_type]" class="form-control" type="text" placeholder="Asset Type" id="assetType">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Serial No</label>
            <div class="col-md-4">
                <input name="form[serial_no]" class="form-control" type="text" placeholder="Serial Number" id="serialNo">
            </div>

            <label class="col-md-2 control-label">Brand</label>
            <div class="col-md-4">
                <input name="form[brand]" class="form-control" type="text" placeholder="Brand" id="brand">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Quantity</label>
            <div class="col-md-4">
                <input name="form[quantity]" class="form-control" type="text" placeholder="Quantity" id="qItem">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Amount (RM)</label>
        <div class="col-md-4">
            <input name="form[amount]" class="form-control" type="text" placeholder="RM" id="amtItem">
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
            <input name="form[loss_location]" class="form-control" type="text" placeholder="Loss Location">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">How the Loss Happened</label>
        <div class="col-md-10">
            <input name="form[how_the_loss_happened]" class="form-control" type="text" placeholder="How the Loss Happened">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Staff ID <b><font color="red">* </font></b></label>
        <div class="col-md-2">
            <input name="form[staff_id]" class="form-control" type="text" value="" id="staff_id" readonly>
        </div>

        <div class="col-md-4">
            <input name="" class="form-control" type="text" value="" id="staff_name" readonly>
        </div>

        <div class="col-md-1">
            <button type="button" class="btn btn-primary search_staff"><i class="fa fa-search"></i> Search</button>
        </div>

        <label class="col-md-3 control-label text-left"> <b>The last officer handle the asset</b></label>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Police Report Date</label>
        <div class="col-md-4">
            <input name="form[police_report_date]" placeholder="DD/MM/YYYY" class="form-control dtPicker" type="text">
        </div>
    </div>


    <div id="addRpEntFmALFooter"></div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-primary add_rp_al_frm"><i class="fa fa-save"></i> Save</button>
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