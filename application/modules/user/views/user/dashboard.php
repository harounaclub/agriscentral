<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-3d.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="http://code.highcharts.com/modules/data.js"></script>
<script src="http://code.highcharts.com/modules/drilldown.js"></script>

<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div id="combination_container"></div>
    </div>
    
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" >
        <div id="container"></div>
    </div>
</div>
<script>
    
    $(function () {
        getContainerGraph();
        getColumnGraph();
    });
    
    function getColumnGraph() {
        
        var formAction = '/user/getDataforColumnChart';
        postArray = {};
        
        $.post(formAction, postArray, function(data) {
            if(data != '' && data !='undefined' ) {
                response = $.parseJSON(data);
                //var chart;
                var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                      ];

                var series_added_data =[];
                var series_installed_data = [];

                var drilldown_added_series = [];

                for(var i = 0; i<12; i++){
                    drildown ={};
                    drildown['data'] = [];
                    item = {};

                    if(typeof(response.monthly_equipments[monthNames[i]]) !='undefined') {
                        item ["name"] = monthNames[i];
                        item ["y"] = response.monthly_equipments[monthNames[i]].added;
                        item ["drilldown"] = 'added_'+monthNames[i];

                        drildown['name'] = monthNames[i];
                        drildown['id'] = 'added_'+monthNames[i];

                        if((typeof(response.monthly_equipments[monthNames[i]]['added_equipment']) !='undefined') &&(response.monthly_equipments[monthNames[i]]['added_equipment'] !=0)) {
                            $.each(response.monthly_equipments[monthNames[i]]['added_equipment'], function(equipment_name, value){
                                a = [];
                                a.push(equipment_name);

                                a.push(value.length) ;                        
                                drildown['data'].push(a);
                            });
                        }


                    } else {
                        item ["name"] = monthNames[i];
                        item ["y"] = 0;
                        item ["drilldown"] = 'added_'+monthNames[i];

                        drildown['name'] = monthNames[i];
                        drildown['id'] = 'added_'+monthNames[i];
                        drildown['data'] = [];

                    }

                    drilldown_added_series.push(drildown);
                    series_added_data.push(item);


                };

                ///////////////////////////////

                for(var i = 0; i<12; i++){

                    item = {};
                    drildown ={};
                    drildown['data'] = [];

                    if(typeof(response.monthly_equipments[monthNames[i]]) !='undefined') {
                        item ["name"] = monthNames[i];
                        item ["y"] = response.monthly_equipments[monthNames[i]].installed;
                        item ["drilldown"] = 'installed_'+ monthNames[i];

                        drildown['name'] = monthNames[i];
                        drildown['id'] = 'installed_'+monthNames[i];

                        if((typeof(response.monthly_equipments[monthNames[i]]['installed_equipment']) !='undefined') &&(response.monthly_equipments[monthNames[i]]['installed_equipment'] !=0)) {
                            $.each(response.monthly_equipments[monthNames[i]]['installed_equipment'], function(equipment_name, value){
                                a = [];
                                a.push(equipment_name);
                                a.push(value.length) ;                        
                                drildown['data'].push(a);
                            });
                        }

                    } else {
                        item ["name"] = monthNames[i];
                        item ["y"] = 0;
                        item ["drilldown"] = 'installed_'+ monthNames[i];
                        drildown['name'] = monthNames[i];
                        drildown['id'] = 'installed_'+monthNames[i];
                        drildown['data'] = [];
                    }

                    drilldown_added_series.push(drildown);
                    series_installed_data.push(item);

                };

                chart = new Highcharts.Chart({

                    credits :{
                        enabled:false
                    },
                    chart: {
                        renderTo: 'combination_container',
                        type: 'column',
                        events: {
                                drilldown: function(e) {
                                    chart.setTitle({text:  e.point.name + ' # ' + e.point.y});

                                },
                                drillup: function(e) {
                                    chart.setTitle({text: 'Equipment Chart'});

                                }
                            }
                    },

                    title: {
                        text: 'Equipment Chart'
                    },
                    xAxis: [{
                        title: {
                            useHTML: true
                        },
                        type: "category",
                        //categories: protocolNames,
                        labels: {
                            useHTML: true,
                            rotation:45
                        }
                    }, {
                        title: {
                            useHTML: true
                        },
                        type: "category",
                        opposite: true,
                        //categories: protocolNames,
                        labels: {
                            useHTML: true,
                            rotation:45
                        }
                    }],
                    yAxis: [{
                        min: 0,
                        title: {
                            text: ''
                        }
                    }, {
                        title: {
                            text: ''
                        },
                        opposite: false
                    }],

                    legend: {
                        layout: 'horizontal',
                        enabled: true,
                        align: 'center',
                        verticalAlign: 'bottom',
                        useHTML: true,
                        labelFormatter: function() {
                            return '<div class"padding-top-10" >' + this.name +  '</div>';
                        }

                    },
                    tooltip: {
                        //shared: true
                    },

                    plotOptions: {
                        column: {
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Added',
                        data: series_added_data,
                        tooltip: {
                            //valueSuffix: ' mGy.cm'
                        }
                    }, {
                        name: 'Installed',
                        data: series_installed_data,
                        tooltip: {
                            //valueSuffix: ' mGy'
                        },
                        //yAxis: 1
                    }],
                    drilldown: {
                        series: drilldown_added_series
                    }

                });
            }  
        });
    }
    
    function getContainerGraph() {
        
        var formAction = '/user/getDataforcontainerchart';
        postArray = {};
        
        $.post(formAction, postArray, function(data) {
            if(data != '' && data !='undefined' ) {
                response = $.parseJSON(data);

                var insalled  = [];
                var uninstalled = [];
                $.each(response.equipments, function(key, value){
                    insalled.push([key, value.assigned]);
                });

                $.each(response.equipments, function(key, value){
                    uninstalled.push([key, value.unassigned]);
                });


                Highcharts.setOptions({
                    lang: {
                        drillUpText: 'Back'
                    }
                });
                var default_title = 'Total Equipment # '+ response.total_equipment_inentory;
                $('#container').highcharts({
                    credits :{
                        enabled:false
                    },
                    chart: {
                        type: 'pie',
                        events: {
                            drilldown: function(e) {
                                this.setTitle({text:  e.point.name + ' # ' + e.point.y});
                            },
                            drillup: function(e) {
                                this.setTitle({text:default_title});
                            }
                        },

                    },

                    title: {
                        text: 'Total Equipment # '+ response.total_equipment_inentory
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        },
                    },
                    legend: {
                        enabled: true,
                        layout: 'horizontal',
                        align: 'center',
                        // width: 200,
                        verticalAlign: 'bottom',
                        useHTML: true,
                        labelFormatter: function() {
                                return '<div class"padding-top-10" >' + this.name + ' # ' + this.y + '</div>';
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b># {point.y}</b><br/>'
                    },
                    series: [{
                        name: "Equipment",
                        colorByPoint: true,
                        data: [{
                            name: "Installed",
                            y: response.installed_inventory,
                            drilldown: "Installed"
                        }, {
                            name: "Not Installed",
                            y: response.remaining_inventory,
                            drilldown: "Not Insatlled"
                        }]
                    }],
                    drilldown: {

                        series: [{
                            name: "Installed",
                            id: "Installed",
                            data: insalled

                        }, {
                            name: "Not Insatlled",
                            id: "Not Insatlled",
                            data: uninstalled
                        }]
                    }
                });
            }
        });
    }
</script>

