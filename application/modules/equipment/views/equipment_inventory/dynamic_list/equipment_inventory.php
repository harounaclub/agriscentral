
<script>
    $( ".editpage" ).on("click",function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var arr = id.split('__');
        equipmentInventoryId = arr[1];
        getEquipmentInventoryForm(equipmentInventoryId, null);
    });
    
    $( ".copypage" ).on("click",function(e) {
        
        e.preventDefault();
        var id = $(this).attr('id');
        var arr = id.split('__');
        equipmentInventoryId = arr[1];
        
        getEquipmentInventoryForm(equipmentInventoryId, 'copyaction');
    });

    
</script>

<div class="widget-body <?php echo ((!empty($EQUIPMENT_INVENTORIES) && (isset($EQUIPMENT_INVENTORIES['results']) && count($EQUIPMENT_INVENTORIES['results']) > 0 )) ? 'no-padding' : 'padding') ?>">

    <table class="table table-striped table-bordered table-hover" width="100%">
        <?php
            if (!empty($EQUIPMENT_INVENTORIES) && (isset($EQUIPMENT_INVENTORIES['results']) && count($EQUIPMENT_INVENTORIES['results']) > 0 )) {
        ?>
        <thead>			                
            <tr>
                <th data-class="expand">Seller name</th>    
                <th>Serial No.</th>
                <th></th>
            </tr>

        </thead>
        <tbody>
            <?php
                foreach ($EQUIPMENT_INVENTORIES['results'] as $equipment_inventory) {
                    ?>  
                    <tr>
                        <td><?php echo $equipment_inventory->seller_name ?></td>
                        <td><?php echo $equipment_inventory->serial_number ?></td>
                        
                        <td>
                            <a href="#" id="equipment__<?php echo $equipment_inventory->equipment_inventory_id; ?>" class="editpage"><i class="fa fa-edit fa-2x"></i></a> &nbsp;
                            <a href="#" id="equipment__<?php echo $equipment_inventory->equipment_inventory_id; ?>" class="copypage"><i class="fa fa-copy fa-2x"></i></a> &nbsp;
                            <a id="delete__<?php echo $equipment_inventory->equipment_inventory_id ?>" href="#" class="openModal"> <i class="fa fa fa-trash-o fa-2x"></i></a>
                            
                        </td>
                    </tr>
                <?php
                }
            ?>
        </tbody>
        <input type="hidden" name="list_equipment_inventory_id" id="list_equipment_inventory_id" value="">
    </table>
    <div class="">
        <div >
            <div>
            <?php
                    $uri = '';
                    buildPagination($EQUIPMENT_INVENTORIES['param'], $uri);
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
            
            $('#list_equipment_inventory_id').val(arr['1']);
            var field_name = $(this).parent().siblings(":last").text();
            $('#field_name').html("Inventory - <strong>"+ field_name +"</strong>");
            
            $('#basicModal').modal('show');
            
            //unbind click from modal
            $("#delete_yes").unbind('click');
            $("#delete_no").unbind('click');

            
            $("#delete_yes").on('click', function(e) {
                id = $('#list_equipment_inventory_id').val();

                var postArray = {
                    equipmentInventoryId: id
                };equipmentId
                url = '/equipment/remove_equipment_inventory';
                
                $.post(url, postArray, function(data) {
                    
                    if ($.trim(data) == 'yes') {
                        $("#message").show()
                            .removeClass()
                            .css( "display","block" )
                            .addClass("alert alert-success fade in").
                            html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Success</strong> Deleted succesfully');

                        getEquipmentInventoryList();
                        getEquipmentInventoryForm();
                        
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
                Please confirm you want to delete this equipment inventory. THIS ACTION IS NOT REVERSIBLE
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="delete_no"><i class='fa fa-times'></i>&nbsp; Cancel</button>
                <button type="button" class="btn btn-danger" id="delete_yes"><i class='fa fa-trash-o'></i>&nbsp; Delete</button>
        </div>
    </div>
  </div>
</div>

