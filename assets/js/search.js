var applyAllHash = [ ];
function queryStringToArray(queryString, ignoreArray){
    var hash;
    var arra = {};
    
    if( typeof queryString != 'undefined' && queryString != '' ){
        queryString = queryString.split('&');
        for(var i = 0; i < queryString.length; i++){
            
            hash = queryString[i].split('=');
            //if( hash[0] == 'order' || hash[0] == 'sort'){
            if( $.inArray(hash[0], ignoreArray) >= 0 ){
                //Some logic here
                
            }else{
                arra[hash[0]] = hash[1];
            }
        }
    }
    return arra;
}

$(document).ready(function() {
    //Common method for sorting
    $(".listpaging").on('click', 'a.sorting', function(e) {
            e.preventDefault();
            
            var postArray = {
                sort : $(this).data("sort"),
                order : $(this).data("order")
            };
            
            //Build hash parameters
            str = window.location.hash;
            str = str.substr(2);
            var ignoreArray = [ "order", "sort", "tab" ];
            var paramArray = queryStringToArray(str,ignoreArray);
            
            //Merge object
            $.extend( postArray, paramArray );
            
            //Build hash
            var hashUrl = $.param(postArray);
            
            //record_id = "";
            if (variableDefined('listSpecificParams')) {
                $.each(listSpecificParams, function(key, value) { 
                        postArray[key] = value;
                });
            }
            
            if (variableDefined('tab')) {
                if (!$.isEmptyObject(tab)) {
                        hashUrl += "&tab=" + tab;
                }
            }

            window.location.hash = '!'+hashUrl;
            buildDynamicList(field, record_id, postArray);

       });
        
        
        //Parent checkbox class
        $(".listpaging").on('click', 'input.parentCheckbox', function(e) {
            
            var isheaderChecked = this.checked;
            $(".childCheckBox").each(function() {
                if (isheaderChecked) {
                    this.checked = true;
                } else {
                    this.checked = false;
                }

            });
            
        });


        $('#multiple_delete').on('click',function(e) {
            e.preventDefault();
            
            var postAction = $(this).attr('href');
            
            if( postAction == 'undefined' || ( postAction.length <= 0 ) ){
                console.log('=======Please add uri in href to multiple delete=======');
                return 0;
            }
            
            var ids = new Array();
            $('.childCheckBox:checked').each(function() {
                ids.push($(this).val()) 
            });
            
            if( ids.length <= 0 ){
                
                //Notify through model
                $('#multiDeleteNotifyModal').foundation('reveal', 'open');
                
                $('#multiDeleteNotifyModal .close-reveal-modal').one('click', function() {
                    // Close Model
                    $('#multiDeleteNotifyModal').foundation('reveal', 'close');
                }); 
                
                $('#multiDeleteNotifyModal #ok_close').one('click', function() {
                    // Close Model
                    $('#multiDeleteNotifyModal').foundation('reveal', 'close');
                }); 

                return 0;
            }
            
            //Multi delete model started
            $('#multiDeleteModal').foundation('reveal', 'open');
            
            $("#multiDeleteModal #multidelete_yes").unbind('click');
            
            $("#multiDeleteModal #multidelete_yes").on('click', function(e) {
                e.preventDefault();
                
                // AJAX
                var postArray = {
                    ids : ids
                };
                
                //url = '/employee/remove';

                 $.post( postAction, postArray, function(data) {
                        
                        
                        // Close Model
                        $('#multiDeleteModal').foundation('reveal', 'close');
                            
                            if( data.status == 'success' ) {
                                
                                $("#message")
                                        .removeClass('alert-box error radius')
                                        .addClass('alert-box success')
                                        .html(data.message)
                                        .show('slow');
                                
                                 setTimeout(function(){
                                        window.location.reload(true);
                                   }, 800);   

                            } else if( data.status == 'redirect' ) {

                                $("#message")
                                        .removeClass('alert-box success')
                                        .addClass('alert-box error radius')
                                        .html(data.message)
                                        .show('slow');

                                $("#message").fadeOut(1000, function(){
                                    window.location = data.url;
                                });

                            } else {
                                $("#message")
                                        .removeClass('alert-box success')
                                        .addClass('alert-box error radius')
                                        .html(data.message)
                                        .show('slow');
                            }

                    },'json');
                
            });

            $("#multiDeleteModal #multidelete_no").one('click', function(e) {
                e.preventDefault();
                // Close Model
                $('#multiDeleteModal').foundation('reveal', 'close');
            });

            $('#multiDeleteModal .close-reveal-modal').one('click', function(e) {
                e.preventDefault();
                // Close Model
                $('#multiDeleteModal').foundation('reveal', 'close');
            }); 
            
        });
});

function reinitializeFilterBox(field) {
    filter = "filter__" + field;
    filterObjString = "#" + filter;
    $(filterObjString).unbind();
    
    $(filterObjString).typing({
    	start: function (event, $elem) {
            //$elem.css('background', '#fa0');
        },
    	stop: function (event, $elem) {
        var postArray = {};	
        
        //record_id = "";
        if (variableDefined('listSpecificParams')) {
            //alert("IF");
            $.each(listSpecificParams, function(key, value) { 
                    postArray[key] = value;
            });
        }
        
        if( $.inArray(field, applyAllHash) >= 0 ){
            
            //Build hash parameters
            str = window.location.hash;
            str = str.substr(2);
            var ignoreArray = [ "q", "page" , "tab"];
            var paramArray = queryStringToArray(str,ignoreArray);

        }else{
            
        }
        
        q = $elem.val();
        //alert($elem.attr('id'));
        if (q == false || q ==null) {
                postArray['q'] = '';
        } else {
                postArray['q'] = q;
        }
        
        if( $.inArray(field, applyAllHash) >= 0 ){
            //Merge object
            $.extend( postArray, paramArray );

            //Build hash
            var hashUrl = $.param(postArray);
        }else{

            //console.log(postArray);
            hashUrl = 'page=&q=' + q;
        }
        
        if (variableDefined('tab')) {
            if (!$.isEmptyObject(tab)) {
                    hashUrl += "&tab=" + tab;
            }
        }
        
        window.location.hash = '!'+hashUrl;
        
        buildDynamicList(field, record_id, postArray);
			
    	},
    	delay: 500
    });
	
}