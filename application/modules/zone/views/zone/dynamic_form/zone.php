
                    <!-- widget content -->
                    <div class="widget-body">

                        <form class="form-horizontal" name="zoneForm" id="zoneForm" method="post" action="" role="form" data-toggle="validator"  novalidate="novalidate">

                            <fieldset>
                                <legend><?php echo ((isset($ZONE) && !empty($ZONE)) ? 'Update': 'Add' ); ?> Zone Form</legend>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Zone</label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="Enter zone name" type="text" name="zone" id="zone" value="<?php echo ((isset($ZONE) && !empty($ZONE )) ? $ZONE->zone_name : NULL ); ?>" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="select-1" class="col-md-2 control-label">Zone Type</label>
                                    <div class="col-md-10">
                                        <select id="zone_type_id" name="zone_type_id" class="form-control" required="">
                                            <option value="">Select Zone type </option>
                                                <?php
                                                if(!empty($ZONE_TYPES)) {
                                                    foreach($ZONE_TYPES as $zone_type) {
                                                ?>
                                                <option value="<?php echo $zone_type->zone_type_id;?>" <?php echo (isset($ZONE) && $ZONE->zone_type_id == $zone_type->zone_type_id ? 'selected="selected"' : '') ?>><?php echo $zone_type->zone_type ?></option>

                                                <?php
                                                    }
                                                }
                                                ?>
                                        </select> 
                                    </div>
                                </div>
                                
                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="zoneId" id="zoneId" value="<?php echo ((isset($ZONE) && !empty($ZONE )) ? $ZONE->zone_id : NULL ); ?>">
                                        <button type="submit" class="btn btn-primary" id="submitButton" name="submitButton">
                                            
                                            <?php echo ((isset($ZONE) && !empty($ZONE)) ? '<i class="fa fa fa-edit"></i> Update': '<i class="fa fa-plus-circle"></i> Add' ); ?>
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

            $(function() {
                $('#resetButton').click(function(){
                    getZoneForm();
                });
                // Validation
                $("#zoneForm").validate({
                    // Rules for form validation
                    rules: {
                        zone: {
                            required: true,
                        },
                        type: {
                            required: true,
                        }
                        
                    },
                    // Messages for form validation
                    messages: {
                        zone: {
                            required: 'Please enter Zone name',
                            
                        },
                        type: {
                            required: 'Please enter Zone type',
                            
                        }
                    },
                    
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
                        var zoneId = $('#zoneId').val();
                        formAction = '/zone/save_add';
                        var action = 'add';
                        if(zoneId !='') {
                            action = 'update';
                            formAction = '/zone/save_update';
                        } 
                        postArray = {
                           zone : $('#zone').val(),
                           zone_type_id : $('#zone_type_id').val(),
                           zoneId : zoneId 
                        };

                        $.post(formAction, postArray, function(data) {
                            //if correct login detail

                            if (data == 'yes') {
                                //document.location = "/zone";
                                getZoneList();
                                getZoneForm();
                                var message = '';

                                if(action =='add') {
                                    message += ' Zone has been added';
                                } else if(action =='update') {
                                    message += ' Zone has been updated';
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
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Zone not added');

                                } else if (action == "update") {   
                                    $("#message").show()
                                    .removeClass()
                                    .css( "display","block" )
                                    .addClass("alert alert-danger fade in").
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Zone not updated');

                                } else {
                                    $("#message").show()
                                        .removeClass()
                                        .css( "display","block" )
                                        .addClass("alert alert-danger fade in").
                                        html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Zone not add/update succesfully');
                                }
                            }
                        });
                    }
               });
                    
        </script>