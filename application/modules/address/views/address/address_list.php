<script type="text/javascript">
    var field = "address";
    var section = "address";
    var addressId = '';
    $(document).ready(function() {
       getAddressList();
       //getAddressForm(addressId);
    });
    
    
    function getAddressList() {
        record_id = "";
        var field = "address";
        
        listSpecificParams = {
            section: section
        }
        
        if (window.location.hash) {
            str = window.location.hash;


            str = str.substr(2);
            arr = str.split('&');
            postArray = {};
            var extraParam = {};
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
                section: section
            }

            $.extend(postArray,extraParam);
            buildDynamicList(field, record_id, postArray);
            reinitializeFilterBox(field);
        } else {
            postArray = {
                section: section
            }

            buildDynamicList(field, record_id, postArray);
            reinitializeFilterBox(field);
        }
    }
    
    function getAddressForm(addressId) {
        record_id = addressId;
        var field = "address";
        postArray = {
            section: section,
        }
        
        listSpecificParams = {
            section: section,
        }
        buildDynamicForm(field, record_id, postArray);
    }
</script>

<!-- widget grid -->
<section id="widget-grid" class="">
        <!-- NEW WIDGET START -->
        <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" data-widget-editbutton="true" style="" role="widget">

                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Addresses</h2>
                    <span class="jarviswidget-loader" style="display: none;"><i class="fa fa-refresh fa-spin"></i></span>
                </header>

                <!-- widget div-->
                
                <div class="dt-toolbar">
                    <div class="col-xs-12 col-sm-6">
                        <div class="dataTables_filter">
                            <label>
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-search"></i>
                                </span> 
                                <input type="text" id="filter__address" name="filter__address" class="search fr form-control" placeholder="Filter..." />
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-6" style="text-align:right">
                        <a class="btn btn-primary" href="/address/add"><i class="fa fa-plus-circle"></i> Add</a>
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
                    <div id = "list__address"></div>  
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->
        </article>
        <?php
        /*
        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">

            <div data-widget-custombutton="false" data-widget-editbutton="false" id="wid-id-6" class="jarviswidget jarviswidget-sortable" style="position: relative; opacity: 1; left: 0px; top: 0px;" role="widget">
               
                <header role="heading">
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Address form </h2>				
                    <span class="jarviswidget-loader" style="display: none;"><i class="fa fa-refresh fa-spin"></i></span>
                </header>
                <!-- widget div-->
                <div role="content">
                    <div id = "form__address"></div>  
                </div>
        </article>
        */?>
        
       
    </div>
</section>
<!-- end widget grid -->


    