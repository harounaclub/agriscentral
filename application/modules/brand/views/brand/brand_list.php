<script type="text/javascript">
    var field = "brand";
    var section = "";
    var brandId = '';
    $(document).ready(function() {
        getBrandList();
        getBrandForm(brandId);
    });
    function getBrandList() {
        record_id = "";
        var field = "brand";

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
                field: field,
                section: section

            }

            $.extend(postArray, extraParam);
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

    function getBrandForm(brandId) {
        record_id = brandId;
        dynamicType = 'list';
        var field = "brand";
        postArray = {
            section: section,
            dynamicType: dynamicType,
        }

        listSpecificParams = {
            section: section,
        }
        buildDynamicForm(field, record_id, postArray);

    }
</script>


<section class="" id="widget-grid">


    <!-- START ROW -->

    <div class="row">

        <article class="col-sm-12">
            <div id="message" style="display:none;"></div>
        </article>

        <article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">
            <div data-widget-editbutton="false" id="wid-id-0" class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" style="" role="widget">

                <header role="heading">
                    <div role="menu">
                        <ul class="dropdown-menu arrow-box-up-right color-select pull-right">
                            <li><span data-original-title="Green Grass" data-placement="left" rel="tooltip" data-widget-setstyle="jarviswidget-color-green" class="bg-color-green"></span></li>
                            <li><a data-original-title="Reset widget color to default" data-placement="bottom" rel="tooltip" data-widget-setstyle="" class="jarviswidget-remove-colors" href="javascript:void(0);">Remove</a></li>    
                        </ul>
                    </div>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Brands</h2>
                    <span class="jarviswidget-loader" style="display: none;"><i class="fa fa-refresh fa-spin"></i></span>
                </header>

                <div class="dt-toolbar">
                    <div class="col-xs-12 col-sm-10">
                        <div class="dataTables_filter">
                            <label>
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-search"></i>
                                </span>
                                <input type="text" id="filter__brand" name="filter__brand" class="search fr form-control" placeholder="Filter..." />

                            </label>
                        </div>
                    </div>
                </div>
                <!-- widget div-->
                <div role="content">
                    <div id = "list__brand"></div>
                </div>
                <!-- end widget div -->

            </div>
        </article>

        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">

            <div data-widget-custombutton="false" data-widget-editbutton="false" id="wid-id-6" class="jarviswidget jarviswidget-sortable" style="position: relative; opacity: 1; left: 0px; top: 0px;" role="widget">

                <header role="heading">
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Brand form </h2>				
                    <span class="jarviswidget-loader" style="display: none;"><i class="fa fa-refresh fa-spin"></i></span>
                </header>

                <!-- widget div-->
                <div role="content">
                    <div id = "form__brand"></div>
                </div>
            </div>
        </article>


    </div>
</section>
