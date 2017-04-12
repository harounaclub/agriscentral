
       
                    <!-- widget content -->
<div class="widget-body ">

    <form class="form-horizontal" name="equipmentForm" id="equipmentForm" method="post" action="" role="form" data-toggle="validator"  novalidate="novalidate">

        <fieldset>
            <legend>
                <?php echo ((isset($EQUIPMENT) && !empty($EQUIPMENT) && empty($TYPE)) ? 'Update': 'Add' ); ?> Equipment Form</legend>
            
            <div class="form-group">
                <label class="col-md-3 control-label">Equipment</label>
                <div class="col-md-9">
                    <input class="form-control" placeholder="Enter Equipment Name" type="text" name="equipment" id="equipment" value="<?php echo ((isset($EQUIPMENT) && !empty($EQUIPMENT )) ? $EQUIPMENT->equipment : NULL ); ?>" required>
                </div>
            </div>


            <div class="form-group">
                <label for="select-1" class="col-md-3 control-label">Brand</label>
                <div class="col-md-9">
                    <select id="brand_id" name="brand_id" class="form-control" required="">
                        <option value="">Select Brand</option>
                        <?php
                        if(!empty($BRANDS)) {
                            foreach($BRANDS as $brand) {
                        ?>
                        <option value="<?php echo $brand->brand_id ?>" <?php echo (isset($EQUIPMENT) && $EQUIPMENT->brand_id ==$brand->brand_id ? 'selected="selected"' : '') ?> ><?php echo $brand->brand_name ?></option>

                        <?php
                            }
                        }
                        ?>
                    </select> 

                </div>
            </div>

            <div class="form-group">
                <label for="select-1" class="col-md-3 control-label">Equipment Type</label>
                <div class="col-md-9">
                    <select id="equipment_type_id" name="equipment_type_id" class="form-control" required="">
                        <option value="">Select Equipment </option>
                        <?php
                        if(!empty($EQUIPMENT_TYPES)) {
                            foreach($EQUIPMENT_TYPES as $equipment_type) {
                        ?>
                        <option value="<?php echo $equipment_type->equipment_type_id ; ?>"  <?php echo (isset($EQUIPMENT) && $EQUIPMENT->equipment_type_id == $equipment_type->equipment_type_id ? 'selected="selected"' : '') ?>><?php echo $equipment_type->equipment_type ?></option>

                        <?php
                            }
                        }
                        ?>
                    </select> 

                </div>
            </div>

            <div class="form-group">
                <label for="select-1" class="col-md-3 control-label">Status</label>
                <div class="col-md-9">
                    <select id="status" name="status" class="form-control" required="">
                        <option value="">Select status</option>
                        <option value="1" <?php echo ((isset($EQUIPMENT) && !empty($EQUIPMENT ) && $EQUIPMENT->status == 1) ? 'selected="selected"' : '') ?> >Active</option>
                        <option value="0" <?php echo ((isset($EQUIPMENT) && !empty($EQUIPMENT ) && $EQUIPMENT->status == 0) ? 'selected="selected"' : '') ?> >Inactive</option>
                    </select> 
                </div>
            </div>

        </fieldset>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="equipmentId" id="equipmentId" value="<?php echo ((isset($EQUIPMENT) && !empty($EQUIPMENT) && empty($TYPE)) ? $EQUIPMENT->equipment_id : NULL ); ?>">
                    <button type="submit" class="btn btn-primary" id="submitButton" name="submitButton">
                        
                        <?php echo ((isset($EQUIPMENT) && !empty($EQUIPMENT) && empty($TYPE)) ? '<i class="fa fa fa-edit"></i> Update': '<i class="fa fa-plus-circle"></i> Add' ); ?>
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
                getEquipmentForm();
            });
            $(document).ready(function() {
                 $('.datepicker').datepicker();
                // Validation
                $("#equipmentForm").validate({
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
                        var equipmentId = $('#equipmentId').val();
                        
                        formAction = '/equipment/equipment/save_add';
                        var action = 'add';
                        
                        if(equipmentId !='') {
                            action = 'update';
                            formAction = '/equipment/equipment/save_update';
                        } 
                        postArray = {
                           brand_id : $('#brand_id').val(),
                           equipment_type_id : $('#equipment_type_id').val(),
                           status: $('#status').val(),
                           equipment : $('#equipment').val(),
                           equipmentId : equipmentId 
                        };

                        $.post(formAction, postArray, function(data) {
                            //if correct login detail

                            if (data == 'yes') {
                                //document.location = "/zone";
                                getEquipmentList();
                                getEquipmentForm();
                                var message = '';

                                if(action =='add') {
                                    message += ' Equipment  has been added';
                                } else if(action =='update') {
                                    message += ' Equipment  has been updated';
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
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Equipment  not added');

                                } else if (action == "update") {   
                                    $("#message").show()
                                    .removeClass()
                                    .css( "display","block" )
                                    .addClass("alert alert-danger fade in").
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Equipment  not updated');

                                } else {
                                    $("#message").show()
                                        .removeClass()
                                        .css( "display","block" )
                                        .addClass("alert alert-danger fade in").
                                        html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Equipment  not add/update succesfully');
                                }
                            }
                        });
                    }
               });
                    
        </script>