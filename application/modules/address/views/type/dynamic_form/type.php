
                    <!-- widget content -->
                    <div class="widget-body">

                        <form class="form-horizontal" name="addressTypeForm" id="addressTypeForm" method="post" action="" role="form" data-toggle="validator"  novalidate="novalidate">

                            <fieldset>
                                <legend><?php echo ((isset($ADDRESS_TYPE) && !empty($ADDRESS_TYPE)) ? 'Update': 'Add' ); ?> Address Type Form</legend>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Type</label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="Enter Address type" type="text" name="address_type" id="address_type" value="<?php echo ((isset($ADDRESS_TYPE) && !empty($ADDRESS_TYPE )) ? $ADDRESS_TYPE->address_type : NULL ); ?>" required>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="addressTypeId" id="addressTypeId" value="<?php echo ((isset($ADDRESS_TYPE) && !empty($ADDRESS_TYPE )) ? $ADDRESS_TYPE->address_type_id : NULL ); ?>">
                                        <button type="submit" class="btn btn-primary" id="submitButton" name="submitButton">
                                            <?php echo ((isset($ADDRESS_TYPE) && !empty($ADDRESS_TYPE)) ? '<i class="fa fa fa-edit"></i> Update': '<i class="fa fa-plus-circle"></i> Add' ); ?> 
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
                    getAddressTypeForm();
                });
                // Validation
                $("#addressTypeForm").validate({
                    // Rules for form validation
                    rules: {
                        address_type: {
                            required: true,
                        }
                        
                    },
                    // Messages for form validation
                    messages: {
                        address_type: {
                            required: 'Please enter address type',
                            
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
                        var addressTypeId = $('#addressTypeId').val();
                        formAction = '/address/addresstype/save_add';
                        var action = 'add';
                        if(addressTypeId !='') {
                            action = 'update';
                            formAction = '/address/addresstype/save_update';
                        } 
                        postArray = {
                           addressTypeId : addressTypeId,
                           address_type : $('#address_type').val()
                           
                        };

                        $.post(formAction, postArray, function(data) {
                            //if correct login detail
                            if (data == 'yes') {
                                getAddressTypeList();
                                getAddressTypeForm();
                                var message = '';

                                if(action =='add') {
                                    message += ' Address Type has been added';
                                } else if(action =='update') {
                                    message += ' Address Type has been updated';
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
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Address Type not added');

                            } else if (action == "update") {   
                                $("#message").show()
                                .removeClass()
                                .css( "display","block" )
                                .addClass("alert alert-danger fade in").
                                html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Address Type not updated');

                            } else {
                                $("#message").show()
                                    .removeClass()
                                    .css( "display","block" )
                                    .addClass("alert alert-danger fade in").
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Address Type not add/update succesfully');
                            }
                            
                        });
                    }
               });
                    
        </script>