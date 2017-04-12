<script type="text/javascript">
    var field = "equipment_inventory";
    var section = "equipment";
    var equipment_inventory_id = '';
    //var listSpecificParams = '';
    
    var equipmentId = "<?php echo $EQUIPMENT->equipment_id ;?>";
    
    var listSpecificParams = {
        section: section,
        equipmentId: equipmentId
    }
    
    $(document).ready(function() {
       
       getEquipmentInventoryList();
       getEquipmentInventoryForm(equipment_inventory_id, null);
    });
    
    function getEquipmentInventoryList() {
        //var equipmentId = "<?php echo $EQUIPMENT->equipment_id ;?>";
        record_id = "";
        var field = "equipment_inventory";
        
        if (window.location.hash) {
            str = window.location.hash;

            str = str.substr(2);
            arr = str.split('&');
            postArray = {};
            var extraParam = {
                
            };
            var page = q = '';
            
            for (i = 0; i < arr.length; i++) {
                queryString = arr[i];
                arr2 = queryString.split('=');
                var key = '';
                var value = '';
                if (arr2[0]) {
                    key = arr2[0];
                }
                if (arr2[1]) {
                    value = arr2[0];
                }

                if (arr2[0] == 'page') {
                    page = arr2[1];
                } else if (arr2[0] == 'q') {
                    q = arr2[1];
                } else if (arr2[0] == 'sort') {
                    extraParam[arr2[0]] = arr2[1];
                } else if (arr2[0] == 'order') {
                    extraParam[arr2[0]] = arr2[1];
                }
            }

            if (q != '') {
                filter = "filter__" + field;
                filterObjString = "#" + filter;

                $(filterObjString).val(q);
            }

            postArray = {
                page: page,
                q: q,
                section:section,
                equipmentId: equipmentId
            }

            $.extend(postArray,extraParam);
            buildDynamicList(field, record_id, postArray);
            reinitializeFilterBox(field);
        } else {
            postArray = {
                section: section,
                equipmentId: equipmentId
            }

            buildDynamicList(field, record_id, postArray);
            reinitializeFilterBox(field);
        }
    }
    
    function getEquipmentInventoryForm(equipment_inventory_id, copyaction) {
        record_id = equipment_inventory_id;
        var field = "equipment_inventory";
        
        postArray = {
            section: section,
            copyaction : copyaction,
            equipmentId: equipmentId
        }
        
        buildDynamicForm(field, record_id, postArray);
        
    }
</script>

<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">
        <article class="col-sm-12">
            <div id="message" style="display:none;"></div>
        </article>
        
        
        <!-- NEW WIDGET START -->
        <article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" data-widget-editbutton="true" style="" role="widget">

                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Inventory - <?php echo $EQUIPMENT->equipment;?> </h2>
                </header>

                <!-- widget div-->
                
                <div class="dt-toolbar">
                    <div class="col-xs-12 col-sm-10">
                        <div class="dataTables_filter">
                            <label>
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-search"></i>
                                </span> 
                                <input type="text" id="filter__equipment_inventory" name="filter__equipment_inventory" class="search fr form-control" placeholder="Filter..." />
                            </label>
                        </div>
                    </div>
                </div>
                <div>
                    <!-- widget content -->
                    <div id = "list__equipment_inventory"></div>  
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->
        </article>
        
        
        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">

            <div data-widget-custombutton="false" data-widget-editbutton="false" id="wid-id-6" class="jarviswidget jarviswidget-sortable" style="position: relative; opacity: 1; left: 0px; top: 0px;" role="widget">
                
                <header role="heading">
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Equipment Inventory form </h2>				
                    <span class="jarviswidget-loader" style="display: none;"><i class="fa fa-refresh fa-spin"></i></span>
                </header>
                <div role="content">
                    <div id = "form__equipment_inventory"></div>
                </div>
        </article>
    </div>
</section>
<!-- end widget grid -->


    