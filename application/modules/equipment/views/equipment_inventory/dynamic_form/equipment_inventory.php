<div class="widget-body ">

    <form class="form-horizontal" name="equipmentInventoryForm" id="equipmentInventoryForm" method="post" action="" role="form" data-toggle="validator"  novalidate="novalidate">

        <fieldset>
            <legend>
                
            <?php echo ((isset($EQUIPMENT_INVENTORY) && !empty($EQUIPMENT_INVENTORY) && empty($TYPE)) ? 'Update': 'Add' ); ?> Equipment Inventory Form</legend>
            
            <div class="form-group">
                <label for="select-1" class="col-md-3 control-label">Seller</label>
                <div class="col-md-9">
                    <select id="seller_id" name="seller_id" class="form-control" required="">
                        <option value="">Select seller</option>
                        <?php
                        if(!empty($SELLERS)) {
                            foreach($SELLERS as $seller) {
                        ?>
                        <option value="<?php echo $seller->seller_id ?>"  <?php echo (isset($EQUIPMENT_INVENTORY) && $EQUIPMENT_INVENTORY->seller_id == $seller->seller_id ? 'selected="selected"' : '') ?> ><?php echo $seller->seller_name ?></option>

                        <?php
                            }
                        }
                        ?>
                    </select> 

                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Serial No.</label>
                <div class="col-md-9">
                    <input class="form-control" placeholder="Enter serial number" type="text" name="serial_number" id="serial_number" value="<?php echo ((isset($EQUIPMENT_INVENTORY) && !empty($EQUIPMENT_INVENTORY )) ? $EQUIPMENT_INVENTORY->serial_number : NULL ); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Date of Purchase.</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <input type="text" name="dop" id="dop" placeholder="Select date of purchase" class="form-control datepicker" data-dateformat="dd/mm/yy" value="<?php echo ((!empty($EQUIPMENT_INVENTORY) && $EQUIPMENT_INVENTORY->date_of_purchase!='') ? date('m/d/Y', strtotime($EQUIPMENT_INVENTORY->date_of_purchase)) : NULL ); ?>">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>

                </div>
            </div>
            
            <div class="form-group">
                <label for="select-1" class="col-md-3 control-label">Status</label>
                <div class="col-md-9">
                    <select id="status" name="status" class="form-control" required="">
                        <option value="">Select status</option>
                        <option value="1" <?php echo ((isset($EQUIPMENT_INVENTORY) && !empty($EQUIPMENT_INVENTORY ) && $EQUIPMENT_INVENTORY->status == 1) ? 'selected="selected"' : '') ?> >Active</option>
                        <option value="0" <?php echo ((isset($EQUIPMENT_INVENTORY) && !empty($EQUIPMENT_INVENTORY ) && $EQUIPMENT_INVENTORY->status == 0) ? 'selected="selected"' : '') ?> >Inactive</option>
                    </select> 
                </div>
            </div>

        </fieldset>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12">
                    
                    <input type="hidden" name="equipmentId" id="equipmentId" value="<?php echo $EQUIPMENT->equipment_id; ?>">
                    <input type="hidden" name="equipmentInventoryId" id="equipmentInventoryId" value="<?php echo ((isset($EQUIPMENT_INVENTORY) && !empty($EQUIPMENT_INVENTORY) && empty($TYPE)) ? $EQUIPMENT_INVENTORY->equipment_inventory_id : NULL ); ?>">
                    <button type="submit" class="btn btn-primary" id="submitButton" name="submitButton">
                        <?php echo ((isset($EQUIPMENT_INVENTORY) && !empty($EQUIPMENT_INVENTORY) && empty($TYPE)) ? '<i class="fa fa fa-edit"></i> Update': '<i class="fa fa-plus-circle"></i> Add' ); ?>
                    </button>
                    <button type="reset" class="btn btn-primary" id="resetButton">Cancel</button>
                </div>
            </div>
        </div>

    </form>

</div>
<!-- end widget content -->

        <script type="text/javascript">
            //runAllForms();
            $('#resetButton').click(function(){
                getEquipmentInventoryForm();
            });
            
            
            $(document).ready(function() {
                 $('.datepicker').datepicker();
                // Validation
                $("#equipmentInventoryForm").validate({
                    // Rules for form validation
                    
                    highlight: function(element) {
                        $(element).closest('.form-group').addClass('has-error');
                    },
                    unhighlight: function(element) {
                        $(element).closest('.form-group').removeClass('has-error');
                    },
                    errorElement: 'span',
                    errorClass: 'help-block',
                    errorPlacement: function(error, element) {
                        if(element.parent('.input-group').length) {
                            error.insertAfter(element.parent());
                        } else {
                            error.insertAfter(element);
                        }
                    }
                });
            }).attr('novalidate', 'novalidate')
                .submit(function(e) {
                    var form = $(this);
                    // client-side validation OK.
                    if (!e.isDefaultPrevented()) {
                        // prevent default form submission logic
                        e.preventDefault();
                        //alert("Form Submitted");
                        var equipmentInventoryId = $('#equipmentInventoryId').val();
                        
                        formAction = '/equipment/add_equipment_inventory';
                        var action = 'add';
                        
                        if(equipmentInventoryId !='') {
                            action = 'update';
                            formAction = '/equipment/update_equipment_inventory';
                        } 
                        postArray = {
                           seller_id : $('#seller_id').val(),
                           serial_number : $('#serial_number').val(),
                           dop: $('#dop').val(),
                           status: $('#status').val(),
                           equipmentId : equipmentId ,
                           equipmentInventoryId : $('#equipmentInventoryId').val(),
                        };

                        $.post(formAction, postArray, function(data) {
                            //if correct login detail

                            if (data == 'yes') {
                                //document.location = "/zone";
                                getEquipmentInventoryList();
                                getEquipmentInventoryForm();
                                var message = '';

                                if(action =='add') {
                                    message += ' Equipment Inventory  has been added';
                                } else if(action =='update') {
                                    message += ' Equipment Inventory  has been updated';
                                }

                                $("#message").show()
                                    .removeClass()
                                    .css( "display","block" )
                                    .addClass("alert alert-success fade in").
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Success</strong>' + message);


                            } else if(data == 'duplicate') { 
                                 $("#message").show()
                                .removeClass()
                                .css( "display","block" )
                                .addClass("alert alert-warning fade in").
                                html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Warning </strong> Already added' );

                            } else {
                                if (action == "add") {   
                                    $("#message").show()
                                    .removeClass()
                                    .css( "display","block" )
                                    .addClass("alert alert-danger fade in").
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Equipment Inventory  not added');

                                } else if (action == "update") {   
                                    $("#message").show()
                                    .removeClass()
                                    .css( "display","block" )
                                    .addClass("alert alert-danger fade in").
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Equipment Inventory  not updated');

                                } else {
                                    $("#message").show()
                                        .removeClass()
                                        .css( "display","block" )
                                        .addClass("alert alert-danger fade in").
                                        html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Equipment Inventory  not add/update succesfully');
                                }
                            }
                        });
                    }
               });
                    
        </script>