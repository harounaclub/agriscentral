<script type="text/javascript">
        
    var tabArray = {
        'informations': 0,
        'comments': 1,
        'equipments': 2,
    };

    listSpecificParams = {};
    
    var section = "map";
    var addressId = "<?php echo ((!empty($addressId) )  ? $addressId : '' ); ?>";
    
    $(document).ready(function() {
        
        buildTabContent('informations', '', '');
        $(".tabs li").click(function(e) {
            tab = $(this).attr('id');
            tab = tab + "s";
            buildTabContent(tab, '', '');
	}); 
        
    });
    
    function getCommentForm(addressId) {
        
        record_id = addressId;
        dynamicType = 'form';
        var field = "comment";
        postArray = {
            section: section,
            dynamicType: dynamicType,
        }

        listSpecificParams = {
            section: section,
        }
        buildDynamicForm(field, record_id, postArray);

    }
    
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

            case "comments":
                field = "comment";
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
<style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow: auto;
    }
</style>

<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $DETAILS[0]->address ?></h4>
    </div>
    <div class="modal-body" style="padding:20px 0px 0px 5px">
        <div class="tabbable" > <!-- Only required for left/right tabs -->
            <ul class="nav nav-tabs tabs">
                <li id="information" class="active"><a href="#informations" data-toggle="tab"><?php echo $this->lang->line("information") ?></a></li>
                <li id="comment"><a href="#comments" data-toggle="tab"><?php echo $this->lang->line("comments") ?></a></li>
                <li id="equipment"><a href="#equipments" data-toggle="tab"><?php echo $this->lang->line("equipments") ?></a></li>
            </ul>
            <div class="tab-content" style="padding:10px 10px 0px 10px">
                <div class="tab-pane active" id="informations">
                    <div id="list__information"></div>
                </div>
                <div class="tab-pane" id="comments">
                    <div id="list__comment"></div>
                    <div id="form__comment"></div>
                </div>
                <div class="tab-pane " id="equipments">
                    <div id="list__equipment"></div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line("close") ?></button>
    </div>

</div>
