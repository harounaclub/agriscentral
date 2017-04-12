
                    <!-- widget content -->
                    <div class="widget-body padding ">

                        <form class="form-horizontal" name="zoneTypeForm" id="zoneTypeForm" method="post" action="" role="form" data-toggle="validator"  novalidate="novalidate">

                            <fieldset>
                                <legend><?php echo ((!empty($ZONE_TYPE)) ? 'Update' : 'Add') ?> Zone Type Form</legend>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Type</label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="Enter Zone type" type="text" name="zone_type" id="zone_type" value="<?php echo ((isset($ZONE_TYPE) && !empty($ZONE_TYPE )) ? $ZONE_TYPE->zone_type : NULL ); ?>" required>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="zoneTypeId" id="zoneTypeId" value="<?php echo ((isset($ZONE_TYPE) && !empty($ZONE_TYPE )) ? $ZONE_TYPE->zone_type_id : NULL ); ?>">
                                        <button type="submit" class="btn btn-primary" id="submitButton" name="submitButton">
                                            
                                            <?php echo ((!empty($ZONE_TYPE) ) ? '<i class="fa fa fa-edit"></i> Update': '<i class="fa fa-plus-circle"></i> Add' ); ?> 
                                        </button>
                                        <button type="reset" class="btn btn-primary" id="resetButton">Cancel</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                    
        <script type="text/javascript">
            //runAllForms();

            $(function() {
                $('#resetButton').click(function(){
                    getZoneTypeForm();
                });
                
                
                // Validation
                $("#zoneTypeForm").validate({
                    // Rules for form validation
                    rules: {
                        zone_type: {
                            required: true,
                        }
                        
                    },
                    // Messages for form validation
                    messages: {
                        zone_type: {
                            required: 'Please enter zone type',
                            
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
                        var zoneTypeId = $('#zoneTypeId').val();
                        formAction = '/zone/zonetype/save_add';
                        var action = 'add';
                        if(zoneTypeId !='') {
                            action = 'update';
                            formAction = '/zone/zonetype/save_update';
                        } 
                        postArray = {
                           zoneTypeId : zoneTypeId,
                           zone_type : $('#zone_type').val()
                           
                        };

                        $.post(formAction, postArray, function(data) {
                            //if correct login detail

                            if (data == 'yes') {
                                getZoneTypeList();
                                getZoneTypeForm();
                                var message = '';

                                if(action =='add') {
                                    message += ' Zone Type has been added';
                                } else if(action =='update') {
                                    message += ' Zone Type has been updated';
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

                            } else if (action == "add") {   
                                    $("#message").show()
                                    .removeClass()
                                    .css( "display","block" )
                                    .addClass("alert alert-danger fade in").
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Zone Type not added');

                            } else if (action == "update") {   
                                $("#message").show()
                                .removeClass()
                                .css( "display","block" )
                                .addClass("alert alert-danger fade in").
                                html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Zone Type not updated');

                            } else {
                                $("#message").show()
                                    .removeClass()
                                    .css( "display","block" )
                                    .addClass("alert alert-danger fade in").
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Zone Type not add/update succesfully');
                            }
                            
                        });
                    }
               });
                    
        </script>