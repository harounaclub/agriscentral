<script>

    $( ".editpage" ).on("click",function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var arr = id.split('__');
        equipmentId = arr[1];
        getEquipmentForm(equipmentId);
    });
    
    $( ".copypage" ).on("click",function(e){
        
        e.preventDefault();
        var id = $(this).attr('id');
        var arr = id.split('__');
        equipmentId = arr[1];
        getEquipmentForm(equipmentId, 'copyaction');
    });

    
</script>

<div class="widget-body <?php echo ((!empty($EQUIPMENTS) && (isset($EQUIPMENTS['results']) && count($EQUIPMENTS['results']) > 0 )) ? 'no-padding' : 'padding') ?>">

    <table class="table table-striped table-bordered table-hover" width="100%">
        <?php
            if (!empty($EQUIPMENTS) && (isset($EQUIPMENTS['results']) && count($EQUIPMENTS['results']) > 0 )) {
        ?>
        <thead>			                
            <tr>
                <th data-class="expand">Equipment</th>    
                <th data-class="expand">Brand </th>
                
                <th></th>
            </tr>

        </thead>
        <tbody>
            <?php
                foreach ($EQUIPMENTS['results'] as $equipment) {
                    ?>  
                    <tr>
                        <td><?php echo $equipment->equipment ?></td>
                        <td><?php echo $equipment->brand_name ?></td>
                        <td>
                            <a href="#" id="equipment__<?php echo $equipment->equipment_id; ?>" class="editpage"><i class="fa fa-edit fa-2x"></i></a> &nbsp;
                            <a href="/equipment/equipment_inventory/<?php echo $equipment->equipment_id ?>" > <i class="fa fa-plus-circle fa-2x"></i> </a> &nbsp;
                            <a id="delete__<?php echo $equipment->equipment_id ?>" href="#" class="openModal"> <i class="fa fa fa-trash-o fa-2x"></i></a>
                            
                        </td>
                    </tr>
                <?php
                }
            ?>
        </tbody>
        <input type="hidden" name="list_equipment_id" id="list_equipment_id" value="">
    </table>
    <div class="">
        <div >
            <div>
            <?php
                    $uri = '';
                    buildPagination($EQUIPMENTS['param'], $uri);
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
            //alert(arr);
            // Set it to hidden field
            $('#list_equipment_id').val(arr['1']);
            var field_name = $(this).parent().siblings(":first").text();
            $('#field_name').html("<strong>"+ field_name +"</strong>");
            
            $('#basicModal').modal('show');
            
            //unbind click from modal
            $("#delete_yes").unbind('click');
            $("#delete_no").unbind('click');

            
            $("#delete_yes").on('click', function(e) {
                id = $('#list_equipment_id').val();

                var postArray = {
                    equipmentId: id
                };
                url = '/equipment/remove';
                
                $.post(url, postArray, function(data) {
                    
                    if ($.trim(data) == 'yes') {
                        $("#message").show()
                            .removeClass()
                            .css( "display","block" )
                            .addClass("alert alert-success fade in").
                            html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Success</strong> Deleted succesfully');

                        getEquipmentList();
                        getEquipmentForm();
                        
                    } else if (data == 'no') {
                        $("#message").show()
                            .removeClass()
                            .css( "display","block" )
                            .addClass("alert alert-danger fade in").
                            html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong>Not deleted Please try again');
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
                Please confirm you want to delete this equipment. THIS ACTION IS NOT REVERSIBLE
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="delete_no"><i class='fa fa-times'></i>&nbsp; Cancel</button>
                <button type="button" class="btn btn-danger" id="delete_yes"><i class='fa fa-trash-o'></i>&nbsp; Delete</button>
        </div>
    </div>
  </div>
</div>

