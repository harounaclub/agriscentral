var fieldNameArray = new Array();
var formObjString;
$(document).ready(function() {

    $("#id_list a").click(function(e) {
        //e.preventDefault();
        id = $(this).attr('id');

        initializeLinks(id, e, data);
    });

});

function variableDefined(name) {
    return typeof this[name] !== 'undefined';
}

function initializeLinks(id, e, data) {
    arr = id.split('__');
    field = arr[1];

    //div = div__educationProvider;
    div = "div__" + field;
    divObjString = "#" + div;

    //title__educationProvider
    titleId = "title__" + field;
    titleObjString = "#" + titleId;

    formDivId = "formDiv__" + field;
    formDivObjString = "#" + formDivId;

    formId = "form__" + field;
    formObjString = "#" + formId;

    filter = "filter__" + field;
    filterObjString = "#" + filter;

    if (arr[0] == 'add') {
        e.preventDefault();

        $(titleObjString).html('New ' + fieldNameArray[field]);
        $(divObjString).show('slow');

        redrawForm('add', formDivObjString, field);

    } else if (arr[0] == 'update') {
        e.preventDefault();

        record_id = arr[2];
        $(titleObjString).html('Update ' + fieldNameArray[field]);
        $(divObjString).show('slow');

        redrawForm('update', formDivObjString, field, record_id);

    } else if (arr[0] == 'delete') {

        record_id = arr[1];
        $(titleObjString).html('Delete ' + fieldNameArray[field]);
        $(divObjString).show('slow');

        redrawForm('delete', formDivObjString, field, record_id);

    } else if (arr[0] == 'close') {
        e.preventDefault();

        $(divObjString).hide('slow');
    } else if (arr[0] == 'page') {
        e.preventDefault();
        page = arr[2];

        postArray = {
            page: page
        };

        filter = $(filterObjString).val();
        if (filter != "Filter..." && filter != "") {
            listSpecificParams['q'] = filter;
        }

        if (variableDefined('listSpecificParams')) {
            $.each(listSpecificParams, function(key, value) {
                postArray[key] = value;
            });
        }
        //console.log(applyAllHash);
        if ($.inArray(field, applyAllHash) >= 0) {

            //Build hash parameters
            str = window.location.hash;
            str = str.substr(2);
            var ignoreArray = ["page", "q", "tab"];
            var paramArray = queryStringToArray(str, ignoreArray);

            //Merge object
            $.extend(postArray, paramArray);

            //Build hash
            var hashUrl = $.param(postArray);


        } else {

        }
        
        buildDynamicList(field, record_id, postArray);

        q = '';

        if (data.param.q == false || data.param.q == null) {
            q = '';
        } else {
            q = data.param.q;
        }

        if ($.inArray(field, applyAllHash) >= 0) {

            //hashUrl += '&page='+ page + '&q=' + q;
        } else {
            hashUrl = 'page=' + page + '&q=' + q;
        }

        //if (typeof data.param.tab !='undefined') {
        if (!$.isEmptyObject(data.param.tab)) {
            hashUrl += "&tab=" + data.param.tab;
        }

       // window.location.hash = '!' + hashUrl;
    } else {
        // Form close
    }
}



function buildDynamicList(field, record_id, extraParams, method) {
    
    var formAction = '';
    formAction += '/lists/build';
       
    //list = list__educationProvider;
    var list = "list__" + field;
    
    $('#list__'+field).show();
    $('#form__'+field).hide();
    
    
    var listObjString = "#" + list;

    postArray = {
        type: field,
        record_id: record_id,
        
    };

    if (extraParams == null) {
        // Do Not do anything
    } else {
        $.each(extraParams, function(key, value) {
            if (key == 'q' && value == 'Filter...') {

            } else {
                postArray[key] = value;
            }
        });
    }

    $.post(formAction, postArray, function(data) {
        
        $(listObjString).html(data.html);
        $(listObjString).append(data.pagination);
        
        if (method) {
            str = method + '(data)';
            eval(str);
        }

        $(listObjString + " a").click(function(e) {
            id = $(this).attr('id');
            
            if (variableDefined(id)) {
                initializeLinks(id, e, data);
            }


        });
    },
    "json");
}


function buildDynamicForm(pagefield, record_id, extraParams) {
    var formAction = '';
    formAction = '/lists/buildForm';
    
    var form = "form__" + pagefield;
    
    $('#list__'+pagefield).hide();
    $('#form__'+pagefield).show();
    
    var formObjString = "#" + form;
    $(formObjString).html('');
    postArray = {
        type: pagefield,
        record_id: record_id
    };


    if (extraParams == null) {
        // Do Not do anything
    } else {
        $.each(extraParams, function(key, value) {
            if (key == 'q' && value == 'Filter...') {

            } else {
                postArray[key] = value;
            }
        });
    }
    //alert(formObjString);
    $.post(formAction, postArray, function(data) {
        //alert(data.html);

        $(formObjString).html(data.html);
    }, "json");
}

function buildMessagesOnAction(act, field, response, record_id) {

    messageId = "message__" + field;
    messageObjString = "#" + messageId;

    var message = '';

    if (response == 'yes') {
        if (act == "add") {
            message = fieldNameArray[field] + " Added!";
        } else if (act == "update") {
            message = fieldNameArray[field] + " Updated!";
        } else {
            message = fieldNameArray[field] + " Deleted!";
        }

        $(messageObjString)
                .show()
                .removeClass()
                .addClass("message success")
                .html("<p>" + message + "</p>");

        $(this).oneTime(1000, function() {
            $(divObjString).hide('slow');
            buildDynamicList(field, record_id);
        });

    } else if (response == 'duplicate') {
        var message = "Duplicate " + fieldNameArray[field] + "!";

        $(messageObjString)
                .show()
                .removeClass()
                .addClass("message error")
                .html("<p>" + message + "</p>");
    } else {
        if (act == "add") {
            message = fieldNameArray[field] + " cound not be added!";
        } else if (act == "update") {
            message = fieldNameArray[field] + " cound not be updated!";
        } else {
            message = fieldNameArray[field] + " cound not be deleted!";
        }
        $(messageObjString).show().removeClass().addClass("message error").html("<p>" + message + "</p>");
    }
}