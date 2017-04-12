<script>
    $( ".editpage" ).on("click",function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var arr = id.split('__');
        equipmentTypeId = arr[1];
        getEquipmentTypeForm(equipmentTypeId);
    });

</script>

<div class="widget-body  <?php echo ((!empty($EQUIPMENT_TYPES) && (isset($EQUIPMENT_TYPES['results']) && count($EQUIPMENT_TYPES['results']) > 0 )) ? 'no-padding' : 'padding') ?>">

    <table class="table table-striped table-bordered table-hover" width="100%">
        <?php
            if (!empty($EQUIPMENT_TYPES) && (isset($EQUIPMENT_TYPES['results']) && count($EQUIPMENT_TYPES['results']) > 0 )) {
        ?>
        <thead>			                
            <tr>
                <th data-class="expand">Equipment Type</th>
                <th>Slug</th>
                <th></th>
            </tr>

        </thead>
        <tbody>
            <?php
                foreach ($EQUIPMENT_TYPES['results'] as $equipment_type) {
                    ?>  
                    <tr>
                        <td><?php echo $equipment_type->equipment_type ?></td>
                        <td><?php echo $equipment_type->equipment_slug ?></td>
                        <td><a href="#" id="zone__<?php echo $equipment_type->equipment_type_id; ?>" class="editpage"><i class="fa fa-edit fa-2x"></i></a> &nbsp;
                            <a id="delete__<?php echo $equipment_type->equipment_type_id ?>" href="#" class="openModal"> <i class="fa fa fa-trash-o fa-2x"></i></a>
                        </td>
                    </tr>
                <?php
                }
            ?>
        </tbody>
        <input type="hidden" name="list_equipment_type_id" id="list_equipment_type_id" value="">
    </table>
    <div class="">
        <div >
            <div>
            <?php
                    $uri = '';
                    buildPagination($EQUIPMENT_TYPES['param'], $uri);
            ?>
            </div>
        </div>
    </div>
       
        <?php
            } else {
        ?>
        
            <div class="alert alert-warning fade in" style="margin-top:20px;">
                <button data-dismiss="alert" class="close">
                        ×
                </button>
                <i class="fa-fw fa fa-warning"></i>
                <strong>Warning</strong> No added data.
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
            //alert(arr);
            // Set it to hidden field
            $('#list_equipment_type_id').val(arr['1']);
            var field_name = $(this).parent().siblings(":first").text();
            $('#field_name').html("<strong>"+ field_name +"</strong>");
            
            $('#basicModal').modal('show');
            
            
            //unbind click from modal
            $("#delete_yes").unbind('click');
            $("#delete_no").unbind('click');

            
            $("#delete_yes").on('click', function(e) {
                id = $('#list_equipment_type_id').val();

                var postArray = {
                    equipmentTypeId: id
                };
                url = '/equipment/equipmenttype/remove';
                
                
                $.post(url, postArray, function(data) {
                    
                    if ($.trim(data) == 'yes') {
                        $("#message").show()
                            .removeClass()
                            .css( "display","block" )
                            .addClass("alert alert-success fade in").
                            html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Success</strong> Deleted succesfully');

                        getEquipmentTypeList();
                        getEquipmentTypeForm();
                        
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
                $('#basicModal').modal(false);
            });
        });
    });
    
</script>

    
<!-- ui-dialog -->

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
                Please confirm you want to delete this equipment type. THIS ACTION IS NOT REVERSIBLE
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="delete_no"><i class='fa fa-times'></i>&nbsp; Cancel</button>
                <button type="button" class="btn btn-danger" id="delete_yes"><i class='fa fa-trash-o'></i>&nbsp; Delete</button>
        </div>
    </div>
  </div>
</div>

