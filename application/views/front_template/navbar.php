<?php
$zones = getZones();
$equipments = getEquipments();
$states = getStates();
$address_types = getAddressTypes();
?>
<style>
    .dropdown-menu {
        min-width: 200px;
    }
    .dropdown-menu.columns-2 {
        min-width: 400px;
    }
    .dropdown-menu.columns-3 {
        min-width: 600px;
        font-size: 13px;
        
        text-align: left;
    }
    
    .dropdown-menu.columns-4 {
        min-width: 800px;
        
    }
    .dropdown-menu li a {
        padding: 5px 10px;
        font-weight: 300;
        
    }
    .multi-column-dropdown {
        list-style: none;
    }
    
    .multi-column-dropdown li a {
        clear: both;
        color: #333;
        display: block;
        font-weight: 400;
        line-height: 1.42857;
        padding: 3px 20px;
        white-space: nowrap;
        
    }
    
    .multi-column-dropdown li a:hover {
        text-decoration:none;
        color:#fff;
        background-color:#3276b1;
    }
    
    
    @media (max-width: 767px) {
        .dropdown-menu.multi-column {
            min-width: 240px !important;
            overflow-x: hidden;
        }
    }

    @media (max-width: 480px) {
        .content {
            width: 90%;
            margin: 50px auto;
            padding: 5px;
        }
        .multi-column-dropdown li a {
            clear: both;
            color: #999;
            display: block;
            font-weight: 400;
            line-height: 1.42857;
            padding: 3px 20px;
            white-space: nowrap;

        }
        
    }
    
    
</style>

<nav role="navigation" style="width:100%" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="/map">
                <img style="margin-top: -12px;" src="<?php echo base_url(); ?>assets/dist/img/orange.jpg" title="Orange" alt="Orange">
                <img style="margin-top: -12px;" src="/assets/dist/img/logo-jighi.png" title="Jmap" alt="Jmap">
            </a>
        </div>
        
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav  navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Region<b class="caret"></b></a>
                    
                        
                    <?php
                         $count_array = count($states);
                         if($count_array < 10) {
                    ?>
                    <ul class="dropdown-menu">
                    <?php
                        foreach ($states as $key => $state) {
                    ?>
                        <li><a id= "map__state__<?php echo $state->state_id; ?>__<?php echo $state->state; ?>" href="#"><?php echo $state->state; ?></a></li>
                    <?php
                        }
                    ?>
                    </ul>
                    <?php
                        } else {
                    ?>
                    <ul class="dropdown-menu multi-column columns-3">
                        <div class="row">
                            <?php
                            $count_array = count($states);
                            $count = 0;
                            foreach ($states as $key => $state) {
                                $count++;
                                ?>
                                <?php
                                if ($count % 11 == 1) {
                                    ?>
                                    <div class="col-sm-4 col-md-4">
                                        <?php
                                    }
                                    ?>

                                    <ul class="multi-column-dropdown">
                                        <li><a id= "map__state__<?php echo $state->state_id; ?>__<?php echo $state->state; ?>" href="#"><?php echo $state->state; ?></a></li>
                                    </ul>
                                    <?php
                                    if ($count % 11 == 0 || $count_array == $count) {
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>

                                <?php
                            }
                            ?>

                        </div>
                    </ul>
                    <?php
                         }
                    ?>
                </li>



                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line("zones") ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu columns-3">
                        <div class="row">
                            <?php
                            $count_array = count($zones);
                            $count = 0;
                            foreach ($zones as $key => $zone) {
                                $count++;
                                ?>
                                <?php
                                if ($count % 11 == 1) {
                                    ?>
                                    <div class="col-sm-4 col-md-4">
                                        <?php
                                    }
                                    ?>

                                    <ul class="multi-column-dropdown">
                                        <li><a id= "map__zone__<?php echo $zone->zone_id; ?>__<?php echo $zone->zone_name; ?>" ><?php echo $zone->zone_name; ?></a></li>
                                    </ul>
                                    <?php
                                    if ($count % 11 == 0 || $count_array == $count) {
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>

                                <?php
                            }
                            ?>

                        </div>
                    </ul>

                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line("address_type") ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        if (!empty($address_types)) {
                            foreach ($address_types as $address_type) {
                                ?>
                                <li><a id= "map__address_type__<?php echo $address_type->address_type_id; ?>__<?php echo $address_type->address_type; ?>" ><?php echo $address_type->address_type; ?></a></li>
                                <?php
                            }
                        }
                        ?>

                    </ul>
                </li>


                <?php
                if (!empty($equipments)) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line("equipment") ?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">

                            <?php
                            foreach ($equipments as $equipment) {
                                ?>
                                <li><a id= "map__equipment__<?php echo $equipment->equipment_id; ?>__<?php echo $equipment->equipment; ?>" href="<?php echo base_url(); ?>map/equipments/<?php echo $equipment->equipment_slug; ?>"><?php echo $equipment->equipment; ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>  
                    </li>
                    <?php
                }
                ?>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line("radius") ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu"  id="radius">
                        <li><a id= "map__radius__5__5 Km" >5 Km</a></li>
                        <li><a id= "map__radius__10__10 Km" >10 Km</a></li>
                        <li><a id= "map__radius__20__20 Km" >20 Km</a></li>
                        <li><a id= "map__radius__30__30 Km" >30 Km</a></li>
                    </ul>
                </li>
                <li>
                    <div id="bs-example-navbar-collapse-3" class="collapse navbar-collapse">
                        <button class="btn btn-default navbar-btn" type="button" id="view_all_marker">View All</button>
                    </div>
                </li>
                
                <li>
                    <form class="navbar-form" role="search" method="post" action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line("search") ?>" name="srch-term" id="srch-term">
                            <div class="input-group-btn">
                                <button style="height:32px;" class="btn btn-default" id="submitButton" name="submitButton"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </li>
                <?php
                    $access_id = $this->session->userdata('access_id');
                    if ($access_id == 1) {
                        ?>
                    
                        <li><a href="/user/dashboard"><?php echo $this->lang->line("dashboard") ?></a></li>
                    <?php
                    }
                    ?>
                    
                    <li><a href="/logout"><?php echo $this->lang->line("logout") ?></a></li>
                    
            </ul>
            
            <!--
            <div class="col-sm-3 col-md-3 navbar-form">
                <div class="input-group">
                    <div class="input-group-btn">
                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line("search") ?>" name="srch-term" id="srch-term">
                        <button style="height:32px;" class="btn btn-default" id="submitButton" name="submitButton"> <span class="glyphicon glyphicon-search" ></span></button>
                    </div>
                </div>
            </div>
            -->

            
        </div><!--/.nav-collapse -->
    </div>
</nav>    


<script>
    $(document).on('click','.navbar-collapse.in',function(e) {
        if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
            $(this).collapse('hide');
        }
        if( $(e.target).attr('id') == 'submitButton' ) {
            $(this).collapse('hide');
        }
        
    });
    
</script>