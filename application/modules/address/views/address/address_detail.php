 
 <script type="text/javascript">
        
    var tabArray = {
        'informations': 0,
        'equipments': 1,
    };

    listSpecificParams = {};
    
    var section = "address";
	
    var addressId = "<?php echo ((!empty($ADDRESS) && ($ADDRESS->address_id !='') )  ? $ADDRESS->address_id : '' ); ?>";
    
    $(document).ready(function() {
        $(".tabs li").click(function(e) {
            tab = $(this).attr('id');
            tab = tab + "s";
            window.location.hash = tab;

            buildTabContent(tab, '', '');

	}); 
                   
        if (window.location.hash) {
            str = window.location.hash;

            if (str == '#informations' || str == '#equipments' ) {
                tab = str.substr(1);

                $("#information").removeClass('active in');
                $("#equipment").removeClass('active in');
                
                var selector = str.slice(0, -1);
                $(selector).addClass('active in');
                
                $("#informations").removeClass('active in');
                $("#equipments").removeClass('active in');
                
                $(str).addClass('active in');
                
                buildTabContent(tab, '', '');
            } else {

                str = str.substr(2);
                arr = str.split('&');
                postArray = {};
                var page = q = tab = '';
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
                    } else if (arr2[0] == 'tab') {
                        tab = arr2[1];
                    }
                }
                //alert(tab);
                
                str = "#" + tab;
                $("#information").removeClass('active in ');
                $("#equipment").removeClass('active in ');
                var selector = str.slice(0, -1);
                $(selector).addClass('active in ');
                
                $("#informations").removeClass('active in');
                $("#equipments").removeClass('active in ');
                $(str).addClass('active in');

                //buildTabContent(tab, page, q);
                
                var tabs = $("ul.tabs").data("tabs");
                tabs.click(eval(tabArray[tab]));
                
                buildTabContent(tab, page, q);
            }
        }
    });

    function buildTabContent(tab, page, q) {
        
        switch (tab) {
            case "informations":
                field = "information";
                record_id = addressId;
                section  = section;
                postArray = {
                    tab: tab
                };
                if (page != '') {
                    postArray['page'] = page;
                }
                if (q != '') {
                    filter = "filter__" + field;
                    filterObjString = "#" + filter;

                    $(filterObjString).val(q);

                    postArray['q'] = q;
                }
                listSpecificParams = {
                    tab: tab,
                    section: section
                };
                $.extend(postArray,listSpecificParams);
                buildDynamicList(field, record_id, postArray);
                break;

            case "equipments":
                field = "equipment";
                record_id = addressId;
                section  = section;
                postArray = {
                    tab: tab
                };
                if (page != '') {
                    postArray['page'] = page;
                }
                if (q != '') {
                    filter = "filter__" + field;
                    filterObjString = "#" + filter;

                    $(filterObjString).val(q);

                    postArray['q'] = q;
                }
                listSpecificParams = {
                    tab: tab,
                    section: section
                };
                $.extend(postArray,listSpecificParams);
                buildDynamicList(field, record_id, postArray);
                break;
        }
        reinitializeFilterBox(field);
    }
        
</script>


<div class="row">
    <article class="col-sm-12 sortable-grid ui-sortable">
        <!-- new widget -->

        <!-- end widget -->

        <div data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-fullscreenbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" id="wid-id-0" class="jarviswidget jarviswidget-sortable" style="" role="widget">
           
            <header role="heading">
                <div class="widget-toolbar">
                    <a href="/address" class="btn btn-primary">Back</a>
                </div>
                <ul id="myTab" class="nav nav-tabs pull-left in tabs">
                    
                    <li id="information">
                        <a href="#informations" data-toggle="tab"><i class="fa fa-home"></i> <span class="hidden-mobile hidden-tablet">Information</span></a>
                    </li>

                    <li id="equipment">
                        <a href="#equipments" data-toggle="tab"><i class="fa fa-wrench"></i> <span class="hidden-mobile hidden-tablet">Equipment</span></a>
                    </li>

                </ul>

                <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>

            <!-- widget div-->
            <div class="no-padding" role="content">
                
                <div class="widget-body">
                    <!-- content -->
                    <div class="tab-content">
                        <div id="informations" class="tab-pane fade active in padding-10 no-padding-bottom">
                            <div id="list__information"></div>
                        </div>
                        <!-- end s1 tab pane -->

                        <div id="equipments" class="tab-pane fade padding-10 no-padding-bottom">
                            <div id="list__equipment"></div>
                        </div>
                        <!-- end s2 tab pane -->
                    </div>

                    <!-- end content -->
                </div>

            </div>
            <!-- end widget div -->
        </div></article>
</div>