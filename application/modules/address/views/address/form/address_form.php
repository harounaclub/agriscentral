<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">
        <article class="col-sm-12">
            <div id="message" style="display:none;"></div>
        </article>
        
        <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">

            <div data-widget-custombutton="false" data-widget-editbutton="false" id="wid-id-6" class="jarviswidget jarviswidget-sortable" style="position: relative; opacity: 1; left: 0px; top: 0px;" role="widget">
               
                <header role="heading">
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Address form </h2>				
                    <span class="jarviswidget-loader" style="display: none;"><i class="fa fa-refresh fa-spin"></i></span>
                </header>
                <!-- widget div-->
                <div role="content">
            <!-- widget content -->
            <div class="widget-body padding">
                <form class="form-horizontal" name="addressForm" id="addressForm" method="post" action="" role="form" data-toggle="validator"  novalidate="novalidate">

                    <fieldset>
                        <legend><?php echo ((isset($ADDRESS) && !empty($ADDRESS) ) ? 'Update' : 'Add ') ?> Address</legend>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">Address</label>
                            <div class="col-md-4">
                                <input class="form-control" placeholder="Enter Address" type="text" name="address" id="address" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->address : NULL ); ?>" required>
                            </div>
                            
                            <label for="select-1" class="col-md-2 control-label">Address Type</label>
                            <div class="col-md-4">
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
                            
                            <label class="col-md-2 control-label">Location</label>
                            <div class="col-md-4">
                                <input class="form-control" placeholder="Enter location " type="text" name="location" id="location" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->location : NULL ); ?>" required>
                            </div>
                            
                            
                            <label for="select-1" class="col-md-2 control-label">Zone</label>
                            <div class="col-md-4">
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
                            
                            <label class="col-md-2 control-label">City</label>
                            <div class="col-md-4">
                                <input class="form-control" placeholder="Enter city number" type="text" name="city" id="city" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->city : NULL ); ?>" required>
                            </div>
                            
                            <label for="select-1" class="col-md-2 control-label"></label>
                            <div class="col-md-4">
                                <a id ="get_coordinates" href="#" class="btn btn-primary ladda-button" data-style="expand-right"><span class="ladda-label">Get Coodrinates</span></a>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            
                            <label for="select-1" class="col-md-2 control-label">State</label>
                            <div class="col-md-4">
                                <select id="state_id" name="state_id" class="form-control" required="">
                                    <option value="">Select State </option>
                                    <?php
                                    if(!empty($STATES)) {
                                        foreach($STATES as $state) {
                                    ?>
                                    <option value="<?php echo $state->state_id;?>" <?php echo (isset($ADDRESS) && $ADDRESS->state_id == $state->state_id ? 'selected="selected"' : '') ?>><?php echo $state->state ?></option>

                                    <?php
                                        }
                                    }
                                    ?>
                                </select> 
                            </div>
                            <label for="select-1" class="col-md-2 control-label"></label>
                            <div class="col-md-4">
                                <div style="margin-bottom: 0px;padding:6px;" id="cordinate_message" class="alert alert-success fade in">Please verify/adjust co-ordinates manually as Google does not map Ivory Coast very well.</div>
                            </div>
                        </div>

                        <div class="form-group">
                            
                            <label for="select-1" class="col-md-2 control-label">Country</label>
                            <div class="col-md-4">
                                <select id="country_id" name="country_id" class="form-control" required="">
                                    <option value="">Select Country </option>
                                    <?php
                                    if(!empty($COUNTRIES)) {
                                        foreach($COUNTRIES as $country) {
                                    ?>
                                    <option value="<?php echo $country->country_id;?>" <?php echo (isset($ADDRESS) && $ADDRESS->country_id == $country->country_id ? 'selected="selected"' : '') ?>><?php echo $country->country ?></option>

                                    <?php
                                        }
                                    }
                                    ?>
                                </select> 

                            </div>
                            <label class="col-md-2 control-label">Latitude</label>
                            <div class="col-md-4">
                                <input class="form-control" placeholder="Enter Latitude" type="text" name="latitude" id="latitude" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->latitude : NULL ); ?>" required>
                            </div>
                            
                            
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">Zipcode</label>
                            <div class="col-md-4">
                                <input class="form-control" placeholder="Enter zipcode" type="text" name="zipcode" id="zipcode" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->zipcode : NULL ); ?>" required>
                            </div>
                            <label class="col-md-2 control-label">Longitude</label>
                            <div class="col-md-4">
                                <input class="form-control" placeholder="Enter longitude" type="text" name="longitude" id="longitude" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->longitude : NULL ); ?>" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <article class="col-sm-12">
                                <div class="alert alert-warning fade in">
                                    <i class="fa-fw fa fa-warning"></i>
                                    Please enter latitude and longitude. This field is mandatory to build marker on map.
                                </div>
                            </article>
                        </div>
                        
                    </fieldset>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="addressId" id="addressId" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->address_id : NULL ); ?>">
                                <button type="submit" class="btn btn-primary" id="submitButton" name="submitButton">
                                    <?php echo ((isset($ADDRESS) && !empty($ADDRESS) ) ? '<i class="fa fa fa-edit"></i> Update': '<i class="fa fa-plus-circle"></i> Add' ); ?>
                                </button>
                                <a class="btn btn-primary" href="/address">Cancel</a>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </article>  
        
        
    </div>
</section>
<!-- end widget grid -->    



        <script type="text/javascript">
            //runAllForms();
            
            
            $(document).ready(function() {
                $('.datepicker').datepicker();
                showhidebutton();
                
                $('#latitude').change(function(e) {
                    showhidebutton();
                });
                
                $('#longitude').change(function(e) {
                    showhidebutton();
                });
                
                $('#get_coordinates').click(function(e) {
                    e.preventDefault();
                    var l = Ladda.create(this);
                    
                    var address  = $('#address').val();
                    var location = $('#location').val();
                    
                    if(address != '' && location != '') {
                        formAction = '/address/address/getCoordinates';
                        postArray = {
                            address : address,
                            location : location,
                            citty : $('#citty').val()
                        };
                        l.start();
                        $.post(formAction, postArray, function(data) {
                            var count = Object.keys(data).length
                            if(count > 0) {
                                $( "#cordinate_message" ).removeClass().addClass('alert alert-success fade in');
                                $( "#cordinate_message" ).html("Please verify/adjust co-ordinates manually as Google does not map Ivory Coast very well.");
                                $('#latitude').val(data.lat);
                                $('#longitude').val(data.lng);
                                $('#submitButton').show();
                            } else {
                                $( "#cordinate_message" ).removeClass().addClass('alert alert-warning fade in');
                                $( "#cordinate_message" ).html("Could not find coordinates , Please enter coordinates manually");
                                $('#latitude').val('');
                                $('#longitude').val('');
                            }
                            
                        },"json").always(function() { l.stop(); });
                        return false;
                    } else {
                        $( "#cordinate_message" ).removeClass().addClass('alert alert-danger fade in');
                        $( "#cordinate_message" ).html("Please enter at least address and location field");
                        $('#latitude').val('');
                        $('#longitude').val('');
                    }
                });
                
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
                        $(element).closest('.form-group .col-md-4').addClass('has-error');
                    },
                    unhighlight: function(element) {
                        $(element).closest('.form-group .col-md-4').removeClass('has-error');
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
                                document.location = "/address";
                               
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
               
               
                function showhidebutton() {
                    var latitude = $('#latitude').val();
                    var longitude = $('#longitude').val();

                    $('#submitButton').hide();
                    if(latitude !='' && longitude !='') {
                        $('#submitButton').show();
                    }
                }
                    
        </script>