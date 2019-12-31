<form id="editActCategory" class="form-horizontal" method="post">
    <div class="modal-header btn-success">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
            <h4 class="modal-title txt-color-white" id="myModalLabel">Edit Action Category</h4>
    </div>
    <div class="modal-body">
        <div id="editActCategoryAlert">
            <!--<b>Note : </b> ( <b><font color="red">*</font></b> ) <b><font color="red">compulsory fields</font></b><br>&nbsp; <span id="note"></span>-->
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Code</label>
            <div class="col-md-4">
                <input name="form[code]" class="form-control" type="text" value="<?php echo $ac_detl->DCA_CATEGORY_CODE?>" readonly>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Description</label>
            <div class="col-md-8">
                <input name="form[description]" class="form-control" type="text" value="<?php echo $ac_detl->DCA_CATEGORY_DESC?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Active ?</label>
            <div class="col-md-4">
                <?php
                    echo form_dropdown('form[active]', array(''=>'---Please Select---', 'Y'=>'Yes', 'N'=>'No'), $ac_detl->DCA_STATUS, 'class="form-control" style="width: 100%"')
                ?>
            </div>
        </div>
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-hand-o-left"></i> Cancel</button>
        <button type="submit" class="btn btn-primary save_upd_ac"><i class="fa fa-save"></i> Save</button>
    </div>
</form>