<script type="text/javascript">
$(function() {
    $('#resetButton').click(function(){
        getBrandForm();
    });
    // Validation
    $("#brandForm").validate({
        // Rules for form validation
        rules: {
            brand: {
                required: true,
            }

        },
        // Messages for form validation
        messages: {
            brand: {
                required: 'Please enter Brand name',

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
            var brandId = $('#brandId').val();
            formAction = '/brand/save_add';
            var action = 'add';
            if(brandId !='') {
                action = 'update';
                formAction = '/brand/save_update';
            } 
            postArray = {
               brand : $('#brand').val(),
               brandId : brandId 
            };

            $.post(formAction, postArray, function(data) {
                //if correct login detail

                if (data == 'yes') {
                    //document.location = "/brand";
                    getBrandList();
                    getBrandForm();
                    var message = '';

                    if(action =='add') {
                        message += ' Brand has been added';
                    } else if(action =='update') {
                        message += ' Brand has been updated';
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

                } else {
                    if (action == "add") {   
                        $("#message").show()
                        .removeClass()
                        .css( "display","block" )
                        .addClass("alert alert-danger fade in").
                        html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Brand not added');

                    } else if (action == "update") {   
                        $("#message").show()
                        .removeClass()
                        .css( "display","block" )
                        .addClass("alert alert-danger fade in").
                        html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Brand not updated');

                    } else {
                        $("#message").show()
                            .removeClass()
                            .css( "display","block" )
                            .addClass("alert alert-danger fade in").
                            html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Brand not add/update succesfully');
                    }
                }
            });
        }
   });
   

</script>

<div class="widget-body padding">
    <form class="form-horizontal" name="brandForm" id="brandForm" method="post" action="" role="form" data-toggle="validator"  novalidate="novalidate">

        <fieldset>
            <legend><?php echo ((isset($BRAND) && !empty($BRAND)) ? 'Update': 'Add' ); ?> Brand Form</legend>
            <div class="form-group">
                <label class="col-md-2 control-label">Brand</label>
                <div class="col-md-10">
                    <input class="form-control" placeholder="Enter brand name" type="text" name="brand" id="brand" value="<?php echo ((isset($BRAND) && !empty($BRAND )) ? $BRAND->brand_name : NULL ); ?>" required>
                </div>
            </div>

        </fieldset>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="brandId" id="brandId" value="<?php echo ((isset($BRAND) && !empty($BRAND)) ? $BRAND->brand_id : NULL ); ?>">
                    <button type="submit" class="btn btn-primary" id="submitButton" name="submitButton">
                        <?php echo ((isset($BRAND) && !empty($BRAND)) ? '<i class="fa fa fa-edit"></i> Update': '<i class="fa fa-plus-circle"></i> Add' ); ?>
                    </button>
                    <button type="reset" class="btn btn-primary" id="resetButton">Cancel</button>
                </div>
            </div>
        </div>

    </form>				
										
				
</div>
