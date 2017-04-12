<script>
    $( ".editpage" ).on("click",function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var arr = id.split('__');
        projectId = arr[1];
        getProjectForm(projectId);
    });

</script>

<div class="widget-body <?php echo ((!empty($PROJECTS) && (isset($PROJECTS['results']) && count($PROJECTS['results']) > 0 )) ? 'no-padding' : 'padding') ?>">

    <table class="table table-striped table-bordered table-hover" width="100%">
        <?php
            if (!empty($PROJECTS) && (isset($PROJECTS['results']) && count($PROJECTS['results']) > 0 )) {
        ?>
        <thead>			                
            <tr>
                <th data-class="expand">Project Name</th>
                <th>Slug</th>
                <th></th>
            </tr>

        </thead>
        <tbody>
            <?php
                foreach ($PROJECTS['results'] as $project) {
                    ?>  
                    <tr>
                        <td><?php echo $project->project_name ?></td>
                        <td><?php echo $project->project_slug ?></td>
                        <td>
                            <a href="#" id="project__<?php echo $project->project_id; ?>" class="editpage"><i class="fa fa-edit fa-2x"></i></a> &nbsp;
                            <a id="delete__<?php echo $project->project_id ?>" href="#" class="openModal"> <i class="fa fa fa-trash-o fa-2x"></i></a>
                        </td>
                    </tr>
                <?php
                }
            ?>
        </tbody>
        <input type="hidden" name="list_project_id" id="list_project_id" value="">
    </table>
    <div class="">
        <div >
            <div>
            <?php
                    $uri = '';
                    buildPagination($PROJECTS['param'], $uri);
            ?>
            </div>
        </div>
    </div>
        <?php
            } else {
        ?>
            
        <div class="alert alert-warning fade in">
            <button data-dismiss="alert" class="close">
                    ×
            </button>
            <i class="fa-fw fa fa-warning"></i>
            <strong>Warning</strong> No data added.
        </div>
        <?php
            }
        ?>
</div>

<script>
    $(document).ready(function() {
        
        $(".openModal").on('click', function(e) {
            e.preventDefault();
            // Get ID from attr
            string_id = $(this).attr('id');
            arr = string_id.split('__');
            
            var field_name = $(this).parent().siblings(":first").text();
            $('#field_name').html("<strong>"+ field_name +"</strong>");
            
            //alert(arr);
            // Set it to hidden field
            $('#list_project_id').val(arr['1']);
            
            $('#basicModal').modal('show');
            
            //unbind click from modal
            $("#delete_yes").unbind('click');
            $("#delete_no").unbind('click');

            
            $("#delete_yes").on('click', function(e) {
                id = $('#list_project_id').val();
                var postArray = {
                    projectId: id
                };
                
                url = '/project/remove';
                
                $.post(url, postArray, function(data) {
                    
                    if ($.trim(data) == 'yes') {
                        $("#message").show()
                            .removeClass()
                            .css( "display","block" )
                            .addClass("alert alert-success fade in").
                            html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Success</strong> Deleted succesfully');

                        getProjectList();
                        getProjectForm();
                        
                    } else if (data == 'no') {
                        $("#message").show()
                            .removeClass()
                            .css( "display","block" )
                            .addClass("alert alert-danger fade in").
                            html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong>Please try again');
                    } else {
                        $("#message").show()
                            .removeClass()
                            .css( "display","block" )
                            .addClass("alert alert-warning fade in").
                            html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Success</strong> Not Deleted');
                    
                    }
                });
                $('#basicModal').removeClass().addClass('modal');
                $('#basicModal').modal('hide');
                
            });

            $("#delete_no").on('click', function() {
                // Close Model
                $('#basicModal').modal('hide');
            });
        });
    });
    
</script>
 
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Delete <strong id="field_name"></strong></h4>
            </div>
            <div class="modal-body">
                <h3>Are you sure ?</h3>
                <p>
                    Please confirm you want to delete this project. THIS ACTION IS NOT REVERSIBLE
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="delete_no"><i class='fa fa-times'></i>&nbsp; Cancel</button>
                <button type="button" class="btn btn-danger"  id="delete_yes"><i class='fa fa-trash-o'></i>&nbsp; Delete</button>
        </div>
    </div>
  </div>
</div>
