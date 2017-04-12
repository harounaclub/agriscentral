<script type="text/javascript">
$(function() {
    $('#resetButton').click(function(){
        getProjectForm();
    });
        
    // Validation
    $("#projectForm").validate({
        // Rules for form validation
        rules: {
            project: {
                required: true,
            }

        },
        // Messages for form validation
        messages: {
            project: {
                required: 'Please enter Project name',

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
            var projectId = $('#projectId').val();
            formAction = '/project/save_add';
            var action = 'add';
            if(projectId !='') {
                action = 'update';
                formAction = '/project/save_update';
            } 
            postArray = {
               project : $('#project').val(),
               projectId : projectId 
            };

            $.post(formAction, postArray, function(data) {
                //if correct login detail

                if (data == 'yes') {
                    //document.location = "/project";
                    getProjectList();
                    getProjectForm();
                    var message = '';

                    if(action =='add') {
                        message += ' Project has been added';
                    } else if(action =='update') {
                        message += ' Project has been updated';
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
                        html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Project not added');

                    } else if (action == "update") {   
                        $("#message").show()
                        .removeClass()
                        .css( "display","block" )
                        .addClass("alert alert-danger fade in").
                        html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Project not updated');

                    } else {
                        $("#message").show()
                            .removeClass()
                            .css( "display","block" )
                            .addClass("alert alert-danger fade in").
                            html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Project not add/update succesfully');
                    }
                }
            });
        }
   });

</script>

<div class="widget-body padding">
    <form class="form-horizontal" name="projectForm" id="projectForm" method="post" action="" role="form" data-toggle="validator"  novalidate="novalidate">

        <fieldset>
            <legend><?php echo ((isset($PROJECT) && !empty($PROJECT)) ? 'Update': 'Add' ); ?> Project Form</legend>
            <div class="form-group">
                <label class="col-md-2 control-label">Project</label>
                <div class="col-md-10">
                    <input class="form-control" placeholder="Enter project name" type="text" name="project" id="project" value="<?php echo ((isset($PROJECT) && !empty($PROJECT )) ? $PROJECT->project_name : NULL ); ?>" required>
                </div>
            </div>

        </fieldset>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="projectId" id="projectId" value="<?php echo ((isset($PROJECT) && !empty($PROJECT)) ? $PROJECT->project_id : NULL ); ?>">
                    <button type="submit" class="btn btn-primary" id="submitButton" name="submitButton">
                        <?php echo ((isset($PROJECT) && !empty($PROJECT)) ? '<i class="fa fa fa-edit"></i> Update': '<i class="fa fa-plus-circle"></i> Add' ); ?>
                    </button>
                    <button type="reset" class="btn btn-primary" id="resetButton">Cancel</button>
                </div>
            </div>
        </div>

    </form>				
										
				
</div>
