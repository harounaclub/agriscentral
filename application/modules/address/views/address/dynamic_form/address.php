
<!-- widget content -->
<div class="widget-body padding">
    <form class="form-horizontal" name="addressForm" id="addressForm" method="post" action="" role="form" data-toggle="validator"  novalidate="novalidate">

        <fieldset>
            <legend><?php echo ((isset($ADDRESS) && !empty($ADDRESS) ) ? 'Update' : 'Add ') ?> Address</legend>

            <div class="form-group">
                <label for="select-1" class="col-md-3 control-label">Country</label>
                <div class="col-md-9">
                    <select id="country_id" name="country_id" class="form-control" required="">
                        <option value="">Select country</option>
                        <option value="1" <?php echo ((isset($ADDRESS) && !empty($ADDRESS) && $ADDRESS->country_id == '1') ? 'selected = "SELECTED"' : '')?> >Code Eaver</option>
                    </select> 

                </div>
            </div>

            <div class="form-group">
                <label for="select-1" class="col-md-3 control-label">State</label>
                <div class="col-md-9">
                    <select id="state_id" name="state_id" class="form-control" required="">
                        <option value="">Select state</option>
                        <option value="1" <?php echo ((isset($ADDRESS) && !empty($ADDRESS) && $ADDRESS->state_id ==1) ? 'selected = "selected"' : '')?>>Every Coast</option>
                    </select> 
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">City</label>
                <div class="col-md-9">
                    <input class="form-control" placeholder="Enter city number" type="text" name="city" id="city" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->city : NULL ); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Location</label>
                <div class="col-md-9">
                    <input class="form-control" placeholder="Enter location " type="text" name="location" id="location" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->location : NULL ); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Zipcode</label>
                <div class="col-md-9">
                    <input class="form-control" placeholder="Enter zipcode" type="text" name="zipcode" id="zipcode" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->zipcode : NULL ); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Address</label>
                <div class="col-md-9">
                    <input class="form-control" placeholder="Enter Address" type="text" name="address" id="address" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->address : NULL ); ?>" required>
                </div>
            </div>


            <div class="form-group">
                <label for="select-1" class="col-md-3 control-label">Address Type</label>
                <div class="col-md-9">
                    <select id="address_type_id" name="address_type_id" class="form-control" required="">
                        <option value="">Select Address type </option>
                        <?php
                        if(!empty($ADDRESS_TYPES)) {
                            foreach($ADDRESS_TYPES as $address_type) {
                        ?>
                        <option value="<?php echo $address_type->address_type_id;?>" <?php echo (isset($ADDRESS) && $ADDRESS->address_type_id == $address_type->address_type_id ? 'selected="selected"' : '') ?>><?php echo $address_type->address_type ?></option>

                        <?php
                            }
                        }
                        ?>
                    </select> 

                </div>
            </div>
            
            <div class="form-group">
                <label for="select-1" class="col-md-3 control-label">Zone</label>
                <div class="col-md-9">
                    <select id="zone_id" name="zone_id" class="form-control" required="">
                        <option value="">Select Zone </option>
                        <?php
                        if(!empty($ZONES)) {
                            foreach($ZONES as $zone) {
                        ?>
                        <option value="<?php echo $zone->zone_id ;?>" <?php echo (isset($ADDRESS) && $ADDRESS->zone_id == $zone->zone_id ? 'selected="selected"' : '') ?>><?php echo $zone->zone_name ?></option>

                        <?php
                            }
                        }
                        ?>
                    </select> 
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Latitude</label>
                <div class="col-md-9">
                    <input class="form-control" placeholder="Enter Latitude" type="text" name="latitude" id="latitude" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->latitude : NULL ); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Longitude</label>
                <div class="col-md-9">
                    <input class="form-control" placeholder="Enter longitude" type="text" name="longitude" id="longitude" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->longitude : NULL ); ?>" required>
                </div>
            </div>

        </fieldset>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="addressId" id="addressId" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->address_id : NULL ); ?>">
                    <button type="submit" class="btn btn-primary" id="submitButton" name="submitButton">
                        <?php echo ((isset($ADDRESS) && !empty($ADDRESS) ) ? '<i class="fa fa fa-edit"></i> Update': '<i class="fa fa-plus-circle"></i> Add' ); ?>
                    </button>
                </div>
            </div>
        </div>

    </form>

</div>
                   

        <script type="text/javascript">
            //runAllForms();
            
            $(document).ready(function() {
                 $('.datepicker').datepicker();
                // Validation
                $("#addressForm").validate({
                    // Rules for form validation
                    rules: {
                        zipcode: {
                            required: true,
                            number:true
                        }

                    },
                    // Messages for form validation
                    messages: {
                        zipcode: {
                            required: 'Please enter Zipcode',
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
                        var addressId = $('#addressId').val();
                        formAction = '/address/address/save_add';
                        var action = 'add';
                        
                        if(addressId !='') {
                            action = 'update';
                            formAction = '/address/address/save_update';
                        } 
                        postArray = {
                           country_id : $('#country_id').val(),
                           address : $('#address').val(),
                           state_id : $('#state_id').val(),
                           city : $('#city').val(),
                           location : $('#location').val(),
                           address_type_id: $('#address_type_id').val(),
                           latitude: $('#latitude').val(),
                           longitude: $('#longitude').val(),
                           zipcode : $('#zipcode').val(),
                           addressId : addressId ,
                           zone_id : $('#zone_id').val()
                        };

                        $.post(formAction, postArray, function(data) {
                            //if correct login detail

                            if (data == 'yes') {
                                //document.location = "/zone";
                                getAddressList();
                                getAddressForm();
                                var message = '';

                                if(action =='add') {
                                    message += ' Address  has been added';
                                } else if(action =='update') {
                                    message += ' Address  has been updated';
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
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Address  not added');

                                } else if (action == "update") {   
                                    $("#message").show()
                                    .removeClass()
                                    .css( "display","block" )
                                    .addClass("alert alert-danger fade in").
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Address  not updated');

                                } else {
                                    $("#message").show()
                                        .removeClass()
                                        .css( "display","block" )
                                        .addClass("alert alert-danger fade in").
                                        html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Address  not add/update succesfully');
                                }
                            }
                        });
                    }
               });
                    
        </script>