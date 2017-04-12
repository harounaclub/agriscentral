<style>
    
    .form-control{
  -webkit-border-radius: 0;
     -moz-border-radius: 0;
          border-radius: 0;
}
    #wrapper { position: relative; }
    #over_map { position: absolute; 
                left: 40%; 
                z-index: 99;
                text-align: left; 
                font-size: 15px; 

    }
    
    #notification_div { position: relative; }
    #notification_over_map { 
        position: absolute; 
        z-index: 99;
        text-align: center; 
        font-size: 15px; 
        width:100%
    }
    
    .scrollFix {
        line-height: 1.35;
        overflow:hidden !important; 
        white-space: nowrap;

    }
    .list-group-item {
        padding:5px 10px
    }
    
</style>

<div class="bs-example" id='notification_div'>
    <div class="alert alert-warning" id="notification_over_map">
        <strong>S'il vous plaît Partagez emplacement</strong>
    </div>
</div>

<div class="map" id="map" style="width:100%;height:100%;float:left"></div>
<div class="bootstrap-tagsinput" id="wrapper" style="border: 0px solid"></div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div id="info_conatiner"></div>
    </div>
</div>



<!-- Dynamic View creation  -->
<script type="text/javascript" src="/assets/dist/js/dynamic_view_redraw.js"></script>
<script type="text/javascript" src="/assets/js/html5placeholder.jquery.js"></script>
<script type="text/javascript" src="/assets/js/jquery.typing-0.2.0.min.js"></script>
<script type="text/javascript" src="/assets/js/search.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/validator.min.js"></script>
<script>
    var center = new google.maps.LatLng(5.3484501, -3.979665);
    var geocoder = new google.maps.Geocoder();
    var infowindow = new google.maps.InfoWindow();
    var markersarray = [];
    var sharedLoctaionLat = '';
    var sharedLoctaionLong = '';
    var circle = null;
    var radiusinkm = 5;
    //var marker = '';

    $(document).ready(function () {
        var mapCanvas = document.getElementById('map');

        var mapOptions = {
            center: center,
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(mapCanvas, mapOptions);
        var shared = 0;
        function initialize() {
            $('body').on('click', '#remove_filter', function (e) {
                $('#wrapper').hide();
                radiusinkm = 5;
                var html = '<span class="tag label label-info" id="over_map"> ' +
                        '5 Km' +
                        '<span data-role="remove" id="remove_filter"></span>' +
                        '</span>';

                $('#wrapper').html(html);
                $('#wrapper').show();
                loadMarkers(map);
            });
            
            console.log(shared);
            if(shared == 0) {
                //alert(navigator.geolocation);
                if (navigator.geolocation) {
                    browserSupportFlag = true;
                    navigator.geolocation.getCurrentPosition(function (position) {
                        sharedLoctaionLat = position.coords.latitude;
                        sharedLoctaionLong = position.coords.longitude;

                        initialLocation = new google.maps.LatLng(sharedLoctaionLat, sharedLoctaionLong);
                        map.setCenter(initialLocation);

                        if (sharedLoctaionLat) {
                            shared = 1;
                            $('#notification_div').hide();
                        } else {
                            $('#notification_div').show();
                        }
                        var html = '<span class="tag label label-info" id="over_map"> ' +
                                '5 Km' +
                                '<span data-role="remove" id="remove_filter"></span>' +
                                '</span>';

                        $('#wrapper').html(html);
                        $('#wrapper').show();


                        loadMarkers(map);

                    }, function () {
                        handleNoGeolocation(browserSupportFlag);
                    });
                } else {
                    browserSupportFlag = false;
                    handleNoGeolocation(browserSupportFlag);
                }

                function handleNoGeolocation(errorFlag) {
                    if (errorFlag == true) {
                        alert("Geolocation service failed.");
                        initialLocation = newyork;
                    } else {
                        alert("Your browser doesn't support geolocation. We've placed you in Siberia.");
                        initialLocation = siberia;
                    }
                    map.setCenter(initialLocation);
                }
            }

            //loadMarkers(map);
        }

        $('.dropdown-menu').on('click', 'a', function (e) {
            e.preventDefault();
            var id = $(this).attr('id');
            var arr = id.split('__');

            var select_filter = arr[3];

            var html = '<span class="tag label label-info" id="over_map"> ' +
                    select_filter +
                    '<span data-role="remove" id="remove_filter"></span>' +
                    '</span>';

            $('#wrapper').html(html);
            $('#wrapper').show();

            if (arr[1] == 'radius') {
                // Set dynamically Radius
                radiusinkm = arr[2];
                loadMarkers(map);
            } else {
                loadMarkers(map, id);
            }
        });

        $('#view_all_marker').on('click', function (e) {
            e.preventDefault();
            radiusinkm = 0;
            $('#wrapper').hide();
            loadMarkers(map);
        });

        $('#submitButton').on('click', function (e) {
            e.preventDefault();
            id = 'search';
            $('#wrapper').hide();
            loadMarkers(map, id);
        });

        google.maps.event.addDomListener(window, 'resize', initialize);
        google.maps.event.addDomListener(window, 'load', initialize);

        google.maps.event.addDomListener(window, "resize", function () {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
        /*
        var legend = document.createElement('div');
        legend.id = 'legend';
        var content = [];
        content.push('<h3>Butterflies*</h3>');
        content.push('<p><div class="color red"></div>Battus</p>');
        content.push('<p><div class="color yellow"></div>Speyeria</p>');
        content.push('<p><div class="color green"></div>Papilio</p>');
        content.push('<p><div class="color blue"></div>Limenitis</p>');
        content.push('<p><div class="color purple"></div>Myscelia</p>');
        content.push('<p>*Data is fictional</p>');
        legend.innerHTML = content.join('');
        legend.index = 1;
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
        */
        
        // Create the legend and display on the map
        
        /*
        var legendDiv = document.createElement('DIV');
        var legend = new Legend(legendDiv, map);
        legendDiv.index = 1;
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legendDiv);
        */

    });
    
    function Legend(controlDiv, map) {
        // Set CSS styles for the DIV containing the control
        // Setting padding to 5 px will offset the control
        // from the edge of the map
        //controlDiv.style.paddingLeft = '150px';
        
        // Set CSS for the control border
        var controlUI = document.createElement('DIV');
        //controlUI.style.backgroundColor = 'white';
        //controlUI.style.borderStyle = 'solid';
        //controlUI.style.borderWidth = '1px';
        controlUI.title = 'Legend';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control text
        var controlText = document.createElement('DIV');
        //controlText.style.fontFamily = 'Arial,sans-serif';
        //controlText.style.fontSize = '12px';
        //controlText.style.paddingLeft = '4px';
        //controlText.style.paddingRight = '4px';
        var html = ''
        for (i = 0; i < ADDRESS_TYPES.length; i++) {
            var link = address_type_image[ADDRESS_TYPES[i].address_type_slug];
            //alert(link);
            if (link != "undefined") {
                html += '<div><img src=' + link + ' height="28px" width="28px">' + ADDRESS_TYPES[i].address_type + '</div>';
            }
        }
        //console.log(html);


        // Add the text
        controlText.innerHTML = '<div class="container info">'+ 
                '   <div class="info-head"> <?php echo $this->lang->line('legends') ?> ' +
                '       <img id ="down" class="bas" src="/assets/dist/img/fleche_bas.png" alt="Bas" title="Down"> ' +
                '       <img id ="up" class="haut" src="/assets/dist/img/fleche_haut.png" alt="Haut" title="Up">' +
                '   </div>' +
                '   <div class="info-content">' + html +
                '   </div>'+
                '</div>';
                

        controlUI.appendChild(controlText);
    }
    
    
    function loadMarkers(map, id) {
        var table_name = '';
        var attribute_id = '';
        var search_string = '';


        if (id != null) {
            if (id == 'search') {
                radiusinkm = 0;
                search_string = $("#srch-term").val();

            } else {
                var arr = id.split('__');
                table_name = arr[1];
                attribute_id = arr[2];
            }
        }

        postArray = {
            table_name: table_name,
            attribute_id: attribute_id,
            search_string: search_string
        }


        $.post('/map/get_marker_detail', postArray, function (data) {
            DeleteMarkers();
            if (id != null) {
                if(data.markers.length>0) {
                    map.setZoom(10);
                    var initialLocation = new google.maps.LatLng(data.markers[0].latitude, data.markers[0].longitude);
                    map.setCenter(initialLocation);

                    var foundMarkers = 0;
                    $.each(data.markers, function (i, item) {
                        loadMarker(item, map);
                        foundMarkers++;
                    });
                    //console.log(foundMarkers);
                }
            } else if (radiusinkm > 0) {
                map.setZoom(12);
                var radius = parseInt(radiusinkm, 10) * 1000;

                var marker = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(sharedLoctaionLat, sharedLoctaionLong)
                            //title: 'The armpit of Cheshire'
                });
                var searchCenter = '';
                searchCenter = data.markers[0].address.location;

                var markerNewArry = [];
                var countLoc = 1;

                var foundMarkers = 0;

                var bounds = new google.maps.LatLngBounds();
                $.each(data.markers, function (i, item) {
                    distance = Math.round(calcDistance(data.markers[i].latitude, data.markers[i].longitude, sharedLoctaionLat, sharedLoctaionLong));
                    if (distance < radius) {
                        bounds.extend(new google.maps.LatLng(data.markers[i].latitude, data.markers[i].longitude))
                        loadMarker(item, map);
                        foundMarkers++;
                    }
                });
                console.log(foundMarkers);
                if (foundMarkers > 0) {
                    map.fitBounds(bounds);
                } else {
                    //map.fitBounds(circle.getBounds());
                }
            } else {
                map.setZoom(13);
                var foundMarkers = 0;
                $.each(data.markers, function (i, item) {
                    loadMarker(item, map);
                    foundMarkers++;
                });
                console.log(foundMarkers);
            }
        }, 'json');
    }

    function calcDistance(fromLat, fromLng, toLat, toLng) {
        return google.maps.geometry.spherical.computeDistanceBetween(
                new google.maps.LatLng(fromLat, fromLng), new google.maps.LatLng(toLat, toLng));
    }


    function loadMarker(location, map) {

        $("#map").css({width: '100%', position: 'relative'});
        $("#side_bar").css({display: 'none'});
        
        var content = '<div class="infoWindow"><ul class="list-group">'
                + '<li class="list-group-item"><b><?php echo $this->lang->line('address') ?></b> : ' + location.address + '</li>' 
                + '<li class="list-group-item"><b><?php echo $this->lang->line('address_type') ?></b> : ' + location.address_type + '</li>' 
                + '<li class="list-group-item"><b><?php echo $this->lang->line('location') ?> </b>: ' + location.location + '</li>'
                + '<li class="list-group-item"><b><?php echo $this->lang->line('latitude') ?> </b>: ' + location.latitude+ '</li>'
                + '<li class="list-group-item"><b><?php echo $this->lang->line('longitude') ?></b> : ' + location.longitude+ '</li>'
                + '<li class="list-group-item"><b><?php echo $this->lang->line('city') ?> </b>: ' + location.city+ '</li>'
                + '</ul>'
                + '<div><button type="button" id ="' + location.address_id + '" class="btn btn-info btn-sm btn-lg view_more" data-toggle="modal" data-target="#myModal"><?php echo $this->lang->line('view_more') ?></button></div>'
                + '</div>';

        if (parseInt(location.latitude) == 0) {
            geocoder.geocode({'address': location.address}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        title: location.zone_name,
                    });

                    google.maps.event.addListener(marker, 'click', function () {

                        if (infowindow)
                            infowindow.close();
                        infowindow.setContent(content);
                        infowindow.open(map, marker);

                    });

                }
            });
        } else {

            var position = new google.maps.LatLng(parseFloat(location.latitude), parseFloat(location.longitude));
            var marker = new google.maps.Marker({
                map: map,
                position: position,
                title: location.zone_name,
                icon: address_type_image[location.address_type_slug]
            });

            google.maps.event.addListener(marker, 'click', function () {
                if (infowindow) {
                    infowindow.close();
                }

                infowindow.setContent(content);
                infowindow.open(map, marker);
                $("#map").css({width: '100%', position: 'relative'});
                $("#side_bar").css({display: 'none'});


                $(".view_more").on("click", function (e) {
                    
                    var id = ($(this).attr('id'));
                    
                    $('#address_id').val(id);

                    //$("#map").css({width: '80%', position: 'relative'});
                    //$("#side_bar").css({width: '20%', display: 'block'});

                    // Get Address Details from address Id 

                    formAction = '/map/view';
                    postArray = {
                        addressId: location.address_id
                    }

                    $.post(formAction, postArray, function (data) {
                        //$("#info_conatiner").css({display: 'block'});
                        //$("#commnet_info").css({display: 'block'});

                        $('#info_conatiner').html(data.address_detail_html);
                        //$('#commnet_info').html(data.comment_detail_html);

                    }, "json");

                    //showHideSidebar();
                });
            });
            markersarray.push(marker);

        }
    }

    function DeleteMarkers() {
        //Loop through all the markers and remove
        for (var i = 0; i < markersarray.length; i++) {
            markersarray[i].setMap(null);

        }
        markersarray = [];
    }
    ;


</script>
 