<!DOCTYPE html>
<html lang="en-us">
    <head>
        <?php $this->load->view('/admin_template/include_assets'); ?>
    </head>
    <body class="">
        <!-- possible classes: minified, fixed-ribbon, fixed-header, fixed-width-->

        <!-- HEADER -->
        <header id="header">
            <?php $this->load->view('/admin_template/header'); ?>
            
        </header>
        <!-- END HEADER -->

        <!-- Left panel : Navigation area -->
        <!-- Note: This width of the aside area can be adjusted through LESS variables -->
        <aside id="left-panel">
            <?php $this->load->view('/admin_template/left'); ?>

        </aside>
        <!-- END NAVIGATION -->

        <!-- MAIN PANEL -->
        <div id="main" role="main">

            <!-- RIBBON -->
            <div id="ribbon">

                <!-- breadcrumb -->
                <ol class="breadcrumb">
                    <!--<li>Home</li><li>Dashboard</li>-->
                </ol>
               
            </div>
            <!-- END RIBBON -->

            <!-- MAIN CONTENT -->
            <div id="content">
                <?php $this->load->view($main_content); ?>
               
            </div>
            <!-- END MAIN CONTENT -->

        </div>
        <!-- END MAIN PANEL -->

        <!-- PAGE FOOTER -->
        <div class="page-footer">
            <?php $this->load->view('/admin_template/footer'); ?>
        </div>
        
        
        <?php $this->load->view($footer_assets); ?>
        
    </body>

</html>