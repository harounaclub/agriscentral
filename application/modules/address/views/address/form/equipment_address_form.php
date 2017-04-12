<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<!-- MULTISELECT / REQUIERED RESOURCES -->
<link href="/assets/themes/css/multiselect.css" media="screen" rel="stylesheet" type="text/css" />
<script src="/assets/themes/multiselect/jquery.tinysort.js" type="text/javascript"></script>
<script src="/assets/themes/multiselect/jquery.quicksearch.js" type="text/javascript"></script>
<script src="/assets/themes/multiselect/jquery.multi-select.js" type="text/javascript"></script>


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
                    <h2>Equipment Address form </h2>				
                    
                </header>
                <!-- widget div-->
                <div role="content">
            <!-- widget content -->
            <div class="widget-body padding">
                <form class="form-horizontal" name="equipmentAddressForm" id="equipmentAddressForm" method="post" action="" role="form" data-toggle="validator"  novalidate="novalidate">

                    <fieldset>
                        <legend><strong><?php echo $ADDRESS->address ?> </strong> -Assign Equipment</legend>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Equipment</label>
                            <div class="col-md-4">
                                <?php 
                                $equipment =  NULL;
                                if(!empty($ADDRESS_EQUIPMENT)) {
                                    $equipment  .= !empty($ADDRESS_EQUIPMENT) ? $ADDRESS_EQUIPMENT->equipment : '';
                                    $equipment  .= !empty($ADDRESS_EQUIPMENT) ? '('. $ADDRESS_EQUIPMENT->brand_name .')' : '';
                                    $equipment  .= !empty($ADDRESS_EQUIPMENT) ? ' - '. $ADDRESS_EQUIPMENT->serial_number : '';
                                }
                                ?>
                                <input value = "<?php echo $equipment ;?>" class="form-control" placeholder="Search Brand/Equipment type" type="text" name="filter__equip" id="filter__equip" required>
                                <input type="hidden" id = "equipment_inventory_id" name = "equipment_inventory_id" value = "<?php echo ((!empty($ADDRESS_EQUIPMENT) && ($ADDRESS_EQUIPMENT->equipment_inventory_id != '') )? $ADDRESS_EQUIPMENT->equipment_inventory_id : '') ?>"/>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="select-1" class="col-md-2 control-label">Project</label>
                            <div class="col-md-8" style="width:80%">
                                
                                <div style="float:left;width:80%">
                                    <div style="float:left;width:56%">
                                        <a href='#' id='select-all'>Add all</a>
                                    </div>

                                    <div style="float:left;width:40% ">
                                        <a href='#' id='deselect-all'>Remove all</a>
                                    </div>
                                </div>
                                <div style="clear: both"></div>
                                <select multiple class="multiple_project form-control" name="multiple_project[]" id="multiple_project" required="">
                                    <?php
                                    if(!empty($PROJECTS)) {
                                        foreach($PROJECTS as $project) {
                                    ?>
                                    <option value="<?php echo $project->project_id;?>" 
                                        <?php 
                                        if(!empty($Added_project) && in_array($project->project_id, array_keys($Added_project))) {
                                            echo 'selected="selected"';
                                        }
                                        ?>
                                        
                                    >
                                    <?php echo $project->project_name ?></option>

                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">IP address</label>
                            <div class="col-md-4">
                                <input value = "<?php echo ((!empty($ADDRESS_EQUIPMENT) && ($ADDRESS_EQUIPMENT->ip != '') )? $ADDRESS_EQUIPMENT->ip : '') ?>" class="form-control" placeholder="Enter IP address" type="text" name="ip" id="ip">
                            </div>
                        </div>
                        
                        <div class="form-group inline">
                            <label class="col-md-2 control-label">Date of Installation</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" value="<?php echo ((!empty($ADDRESS_EQUIPMENT) && ($ADDRESS_EQUIPMENT->date_of_installation != '') )? date('d/m/Y', strtotime($ADDRESS_EQUIPMENT->date_of_installation)) : '') ?>" data-dateformat="dd/mm/yy" class="form-control datepicker" placeholder="Select date of installation" id="date_of_installation" name="date_of_installation" required>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-2 control-label">Date of Uninstallation</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" value="<?php echo ((!empty($ADDRESS_EQUIPMENT) && ($ADDRESS_EQUIPMENT->date_of_uninstallation != '') )? date('d/m/Y', strtotime($ADDRESS_EQUIPMENT->date_of_uninstallation)) : '') ?>" data-dateformat="dd/mm/yy" class="form-control datepicker" placeholder="Select date of Uninstallation" id="date_of_uninstallation" name="date_of_uninstallation">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="select-1" class="col-md-2 control-label">Status</label>
                            <div class="col-md-4">
                                <select id="status" name="status" class="form-control" required="">
                                    <option value="">Select status</option>
                                    <option value="1" <?php echo ((isset($ADDRESS_EQUIPMENT) && !empty($ADDRESS_EQUIPMENT ) && $ADDRESS_EQUIPMENT->status == 1) ? 'selected="selected"' : '') ?> >Active</option>
                                    <option value="0" <?php echo ((isset($ADDRESS_EQUIPMENT) && !empty($ADDRESS_EQUIPMENT ) && $ADDRESS_EQUIPMENT->status == 0) ? 'selected="selected"' : '') ?> >Inactive</option>
                                </select> 
                            </div>
                        </div>
                        
                        
                        
                    </fieldset>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="addressId" id="addressId" value="<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->address_id : NULL ); ?>">
                                <input type="hidden" name="addressEquipmentId" id="addressEquipmentId" value="<?php echo ((isset($ADDRESS_EQUIPMENT) && !empty($ADDRESS_EQUIPMENT)) ? $ADDRESS_EQUIPMENT->address_equipment_id : NULL ); ?>">
                                
                                <a class="btn btn-primary" href="/address/view/<?php echo ((isset($ADDRESS) && !empty($ADDRESS )) ? $ADDRESS->address_id : NULL ); ?>#equipments" >Cancel</a>
                                
                                <button type="submit" class="btn btn-primary" id="submitButton" name="submitButton">
                                    <?php echo ((isset($ADDRESS_EQUIPMENT) && !empty($ADDRESS_EQUIPMENT) ) ? '<i class="fa fa fa-edit"></i> Update': '<i class="fa fa-plus-circle"></i> Add' ); ?>
                                </button>
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
                // Validation
                $("#equipmentAddressForm").validate({
                    // Rules for form validation
                    
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
                        
                        formAction = '/address/address/add_address_equipment';
                        var action = 'add';
                        addressEquipmentId  = $('#addressEquipmentId').val();
                        
                        if(addressEquipmentId !='') {
                            action = 'update';
                            formAction = '/address/address/update_address_equipment';
                        } 
                        
                        var projectIds = '';
                        var j = 0;

                        $('#multiple_project' + ' :selected').each(function(i, selected) {
                            if (j == 0) {
                                projectIds += $(selected).val();
                            } else {
                                projectIds += ',' + $(selected).val();
                            }
                            j++;
                        });
                        
                        postArray = {
                           addressId  : $('#addressId').val(),
                           equipment_inventory_id : $('#equipment_inventory_id').val(),
                           //project_id : $('#project_id').val(),
                           projectIds : projectIds, 
                           ip : $('#ip').val(),
                           date_of_installation : $('#date_of_installation').val(),
                           date_of_uninstallation : $('#date_of_uninstallation').val(),
                           status : $('#status').val(),
                           addressEquipmentId : addressEquipmentId
                        };

                        $.post(formAction, postArray, function(data) {
                            //if correct login detail
                            var id = "<?php echo $ADDRESS->address_id ?>";
                            
                            if (data == 'yes') {
                                document.location = "/address/view/"+ id +"#equipments";
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
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Equipment Address  not added');

                                } else if (action == "update") {   
                                    $("#message").show()
                                    .removeClass()
                                    .css( "display","block" )
                                    .addClass("alert alert-danger fade in").
                                    html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Equipment  Address  not updated');

                                } else {
                                    $("#message").show()
                                        .removeClass()
                                        .css( "display","block" )
                                        .addClass("alert alert-danger fade in").
                                        html('<button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-check"></i><strong>Error!</strong> Equipment  Address  not add/update succesfully');
                                }
                            }
                        });
                    }
               });
                    
        </script>
        

<script type="text/javascript">
    /* $('.custom').multiSelect(); */
    $('.multiple_project').multiSelect({
        selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search Project' >",
        selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search Project'>",
        afterInit: function(ms) {

            var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)

                    .on('keydown', function(e) {

                        if (e.which === 40) {

                            that.$selectableUl.focus();

                            return false;

                        }

                    });



            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)

                    .on('keydown', function(e) {

                        if (e.which == 40) {

                            that.$selectionUl.focus();

                            return false;

                        }

                    });

        },
        afterSelect: function() {

            this.qs1.cache();

            this.qs2.cache();

        },
        afterDeselect: function() {

            this.qs1.cache();

            this.qs2.cache();

        }

    });



    $('#select-all').click(function() {

        $('.multiple_project').multiSelect('select_all');

        return false;

    });

    $('#deselect-all').click(function() {

        $('.multiple_project').multiSelect('deselect_all');

        return false;

    });
</script>
