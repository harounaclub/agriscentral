
<!-- widget grid -->
<section id="widget-grid" class="">
    <!-- NEW WIDGET START -->
    <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" data-widget-editbutton="true" style="" role="widget">

            <header>
                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                <h2><?php echo $this->lang->line("equipments") ?></h2>
                <span class="jarviswidget-loader" style="display: none;"><i class="fa fa-refresh fa-spin"></i></span>
            </header>
            
            <!-- widget div-->

            <div class="dt-toolbar">
                
                <div class="col-xs-12 col-sm-12" style="text-align:right;padding-bottom: 10px">
                    <a class="btn btn-primary" href="/address/add_equipment/<?php echo $ADDRESS_ID; ?>" ><i class="fa fa-plus-circle"></i> Add</a>
                </div>

                <?php
                $message = $this->session->flashdata('message');
                
                if (!empty($message)) {
                    ?>
                    <br />
                    <div class="row" id="message" style = "display:block;margin-top: 20px;">
                        <!-- NEW WIDGET START -->
                        <article class="col-sm-12">
                            <div class="alert alert-success fade in">
                                <button data-dismiss="alert" class="close">
                                    ×
                                </button>
                                <i class="fa-fw fa fa-check"></i>
                                <strong>Success</strong> <?php echo $message; ?>
                            </div>
                        </article>
                        <!-- WIDGET END -->
                    </div>
                    <?php
                } else {
                    ?>
                    <article class="col-sm-12">
                        <div id="message" style="display:none;margin-top: 20px;"></div>
                    </article>
                    <?php
                }
                ?>
            </div>

            <div>
                
                <!-- widget content -->
                <div class="widget-body <?php echo ((!empty($ADDRESS_EQUIPMENT) && (isset($ADDRESS_EQUIPMENT['results']) && count($ADDRESS_EQUIPMENT['results']) > 0 )) ? 'no-padding' : 'padding') ?>">

                    <table class="table table-striped table-bordered table-hover" width="100%">
                        <?php
                        if (!empty($ADDRESS_EQUIPMENT) && (isset($ADDRESS_EQUIPMENT['results']) && count($ADDRESS_EQUIPMENT['results']) > 0 )) {
                            ?>
                            <thead>			                

                                <tr role="row">
                                    <th data-class="expand">Address </th>
                                    <th data-hide="phone">Equipment</th>
                                    <!--<th data-hide="phone,tablet">Serial Number</th>-->
                                    <th data-hide="phone,tablet">IP</th>
                                    <th data-hide="phone">Brand</th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                foreach ($ADDRESS_EQUIPMENT['results'] as $address_equipment) {
                                    ?>  
                                    <tr>
                                        <td><?php echo $address_equipment->address ?></td>
                                        <td><?php echo $address_equipment->equipment ?></td>
                                        <!--<td><?php echo $address_equipment->serial_number ?></td>-->
                                        <td><?php echo $address_equipment->ip ?></td>
                                        
                                        <td><?php echo $address_equipment->brand_name ?></td>

                                        <td>
                                            <a href="/address/update_equipment/<?php echo $address_equipment->address_id; ?>/<?php echo $address_equipment->address_equipment_id; ?>"><i class="fa fa-edit fa-2x"></i></a> &nbsp;
                                            <a id="delete__<?php echo $address_equipment->address_equipment_id; ?>" href="#" class="openModal"> <i class="fa fa fa-trash-o fa-2x"></i></a> &nbsp;
                                            
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <input type="hidden" name="list_address_equipment_id" id="list_address_equipment_id" value="">
                        </table>
                        <div class="">
                            <div >
                                <div>
                                    <?php
                                    $uri = '';
                                    buildPagination($ADDRESS_EQUIPMENT['param'], $uri);
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
                            <strong>Warning</strong> <?php echo $this->lang->line("no_equipment") ?>
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
                            $('#list_address_equipment_id').val(arr['1']);

                            var field_name = $(this).parent().siblings(":first").text();
                            $('#field_name').html("<strong>" + field_name + "</strong>");

                            $('#basicModal').modal('show');
                            //unbind click from modal
                            $("#delete_yes").unbind('click');
                            $("#delete_no").unbind('click');


                            $("#delete_yes").on('click', function(e) {
                                id = $('#list_address_equipment_id').val();

                                var postArray = {
                                    address_equipment_id: id
                                };
                                url = '/address/remove_address_equipment';

                                $.post(url, postArray, function(data) {

                                    if ($.trim(data) == 'yes') {
                                        //alert(data);

                                        $("#message").show()
                                                .removeClass()
                                                .css("display", "block")
                                                .addClass("alert alert-success fade in").
                                                html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Success</strong> Deleted succesfully');
                                        
                                        location.reload(); 
                                    } else if (data == 'no') {
                                        $("#message").show()
                                                .removeClass()
                                                .css("display", "block")
                                                .addClass("alert alert-warning fade in").
                                                html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Warning</strong> Not Deleted');
                                    } else {
                                        $("#message").show()
                                                .removeClass()
                                                .css("display", "block")
                                                .addClass("alert alert-warning fade in").
                                                html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error</strong> Not Deleted');
                                    }
                                    $('#basicModal').removeClass().addClass('modal');
                                    $('#basicModal').modal('hide');
                                });
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
                                    Please confirm you want to delete this address equipment. THIS ACTION IS NOT REVERSIBLE
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="delete_no"><i class='fa fa-times'></i>&nbsp; Cancel</button>
                                <button type="button" class="btn btn-danger" id="delete_yes"><i class='fa fa-trash-o'></i>&nbsp; Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end widget content -->
            </div>
            <!-- end widget div -->

        </div>
        <!-- end widget -->
    </article>

</div>
</section>
<!-- end widget grid -->


