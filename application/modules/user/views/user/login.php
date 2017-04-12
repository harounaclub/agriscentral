<?php
//echo '<pre>';
//print_r($this->lang);
//echo $this->lang->line("E-mail");die;
?>

<!DOCTYPE html>
<html lang="en-us" id="extr-page">
    <head>
        <meta charset="utf-8">
        <title> Ecoagris</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- #CSS Links -->
        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="/assets/themes/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="/assets/themes/css/font-awesome.min.css">

        <!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
        <link rel="stylesheet" type="text/css" media="screen" href="/assets/themes/css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="/assets/themes/css/smartadmin-skins.min.css">

        <!-- #FAVICONS -->
<!--
        <link rel="shortcut icon" href="/assets/dist/img/Jighi_logo.png" />
        <link rel="icon" href="/assets/dist/img/Jighi_logo.png" type="image/x-icon">
-->

        <!-- #GOOGLE FONT -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

        <!-- #APP SCREEN / ICONS -->
        <!-- Specifying a Webpage Icon for Web Clip 
                 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
        <link rel="apple-touch-icon" href="/assets/themes/img/splash/sptouch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/assets/themes/img/splash/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/assets/themes/img/splash/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/assets/themes/img/splash/touch-icon-ipad-retina.png">

        <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

    </head>

    <body class="animated fadeInDown">

        <header id="header">

            <div id="logo-group" style="margin-top: -7px;">
               
            </div>
        </header>

        <div id="main" role="main">

            <!-- MAIN CONTENT -->
            <div id="content" class="container">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
                        <h1 class="txt-color-red login-header-big">Ecoagris</h1>
                        <div class="hero">

                            <div class="pull-left login-desc-box-l">
                                <h4 class="paragraph-header">INTEGRATED REGIONAL AGRICULTURAL INFORMATION SYSTEM IN WEST AFRICA !</h4>
                            </div>

                            <img src="/assets/themes/img/demo/iphoneview.png" class="pull-right display-image" alt="" style="width:210px">

                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                        <div class="well no-padding">
                            <form action="" id="login-form" class="smart-form client-form" method="post" name="login-form">
                                <header>
                                    Sign In
                                </header>
                                
                                <fieldset>
                                    <section>
                                        <div id="message" style="display:none;"></div>
                                    </section>
        
                                    <section>
                                            <label class="label">Email</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="email" name="email" id="email" >
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
                                    </section>

                                    <section>
                                        <label class="label">Password</label>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" name="password" id="password">
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                                        
                                    </section>
                                    
                                </fieldset>
                                <footer>
                                    <button type="submit" class="btn btn-primary">
                                        Sign in
                                    </button>
                                </footer>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!--================================================== -->	


        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script> if (!window.jQuery) {
                        document.write('<script src="/assets/themes/js/libs/jquery-2.0.2.min.js"><\/script>');
                    }</script>

        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script> if (!window.jQuery.ui) {
                        document.write('<script src="/assets/themes/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
                    }</script>
        <script src="/assets/themes/js/bootstrap/bootstrap.min.js"></script>

        <!-- JQUERY VALIDATE -->
        <script src="/assets/themes/js/plugin/jquery-validate/jquery.validate.min.js"></script>

        <script type="text/javascript">
            //runAllForms();

            $(function() {
                // Validation
                $("#login-form").validate({
                    // Rules for form validation
                    rules: {
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 3,
                            maxlength: 20
                        }
                    },
                    // Messages for form validation
                    messages: {
                        email: {
                            required: 'Please enter your email address',
                            email: 'Please enter a VALID email address'
                        },
                        password: {
                            required: 'Please enter your password'
                        }
                    },
                    // Do not change code below
                    errorPlacement: function(error, element) {
                        error.insertAfter(element.parent());
                    }
                });
            }).attr('novalidate', 'novalidate')
                    .submit(function(e) {
                        var form = $(this);
                        // client-side validation OK.
                        if (!e.isDefaultPrevented()) {
                            //alert("Form Submitted");
                            
                            $.post("/user/login/authenticate", { email: $('#email').val(), password: $('#password').val() }, function(data) {
                                //if correct login detail
                                if (data == 'yes') {
                                    document.location = "/user/dashboard";
                                } else if (data == 'no') {
                                    $("#message").show()
                                    .removeClass()
                                    .css( "display","block" )
                                    .html('<div class="alert alert-warning fade in"><button data-dismiss="alert" class="close">×</button><i class="fa-fw fa fa-warning"></i><strong>Warning</strong> Your Login detail is incorrect.</div>');
                                }
                            });

                            // prevent default form submission logic
                            e.preventDefault();
                        }
                    });
        </script>

    </body>
</html>