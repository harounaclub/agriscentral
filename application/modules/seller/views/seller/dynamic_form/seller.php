
                    <!-- widget content -->
                    <div class="widget-body">

                        <form class="form-horizontal" name="sellerForm" id="sellerForm" method="post" action="" role="form" data-toggle="validator"  novalidate="novalidate">

                            <fieldset>
                                <legend><?php echo ((isset($SELLER) && !empty($SELLER)) ? 'Update': 'Add' ); ?> Seller Form</legend>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Name</label>
                                    
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="Enter seller name" type="text" name="seller_name" id="seller_name" value="<?php echo ((isset($SELLER) && !empty($SELLER )) ? $SELLER->seller_name : NULL ); ?>" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Address</label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="Enter seller Address" type="text" name="seller_address" id="seller_address" value="<?php echo ((isset($SELLER) && !empty($SELLER )) ? $SELLER->seller_address : NULL ); ?>" required>
                                    </div>
                                </div>
                                
                                
                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="sellerId" id="sellerId" value="<?php echo ((isset($SELLER) && !empty($SELLER )) ? $SELLER->seller_id : NULL ); ?>">
                                        <button type="submit" class="btn btn-primary" id="submitButton" name="submitButton">
                                            <?php echo ((isset($SELLER) && !empty($SELLER)) ? '<i class="fa fa fa-edit"></i> Update': '<i class="fa fa-plus-circle"></i> Add' ); ?>
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
                    getSellerForm();
                });
                
                // Validation
                $("#sellerForm").validate({
                    // Rules for form validation
                    rules: {
                        seller_name: {
                            required: true,
                        },
                        seller_address: {
                            required: true,
                        }
                        
                    },
                    // Messages for form validation
                    messages: {
                        seller_name: {
                            required: 'Please enter seller name',
                            
                        },
                        seller_address: {
                            required: 'Please enter seller address',
                            
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
                        var sellerId = $('#sellerId').val();
                        formAction = '/seller/save_add';
                        var action = 'add';
                        if(sellerId !='') {
                            action = 'update';
                            formAction = '/seller/save_update';
                        } 
                        postArray = {
                           sellerId : sellerId,
                           name : $('#seller_name').val(),
                           address : $('#seller_address').val()
                        };

                        $.post(formAction, postArray, function(data) {
                            //if correct login detail

                            if (data == 'yes') {
                                //document.location = "/seller";
                                getSellerList();
                                getSellerForm();
                                var message = '';

                                if(action =='add') {
                                    message += ' Seller has been added';
                                } else if(action =='update') {
                                    message += ' Seller has been updated';
                                }

                                $("#message").show()
                                    .removeClass()
                                    .css( "display","block" )
                                    .addClass("alert alert-success fade in").
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Success</strong>' + message);


                            } else if($.trim(data) == 'duplicate') {
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
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Seller not added');

                            } else if (action == "update") {   
                                $("#message").show()
                                .removeClass()
                                .css( "display","block" )
                                .addClass("alert alert-danger fade in").
                                html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Seller not updated');

                            } else {
                                $("#message").show()
                                    .removeClass()
                                    .css( "display","block" )
                                    .addClass("alert alert-danger fade in").
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Seller not add/update succesfully');
                            }
                            
                        });
                    }
               });
                    
        </script>