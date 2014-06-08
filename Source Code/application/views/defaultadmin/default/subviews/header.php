<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Abdul Shamadhu - Admin Console</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel='stylesheet' type='text/css' media='all' href='<?php echo base_url(); ?>assets//pagestyle.css' />
        <script src="<?php echo base_url() ?>assets/js/jquery.2.0.0.min.js"></script>
        <!-- Le styles -->
        <link href="<?php echo base_url() ?>assets/css/admin/bootstrap.css" rel="stylesheet"> 
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/css/admin_home.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css" />
        
        
        <script src="<?php echo base_url() ?>assets/js/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
        <script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
        <script src="<?php echo base_url() ?>assets/js/spin.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.spin.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.tablesorter.js"></script> 
		<script src="<?php echo base_url(); ?>assets/js/jquery.multiselect.min.js"></script>
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }

            @media (max-width: 980px) {
                /* Enable use of floated navbar text */
                .navbar-text.pull-right {
                    float: none;
                    padding-left: 5px;
                    padding-right: 5px;
                }
            }
            #adminpagelisttabl th.header { 
                background-image: url(/newlscms/assets/img/asc.gif);     
                cursor: pointer; 
                font-weight: bold; 
                background-repeat: no-repeat; 
                background-position: center left; 
                padding-left: 20px; 
                /*border-right: 1px solid #dad9c7; */
                margin-left: -1px; 
            } 
        </style>
        <link href="<?php echo base_url() ?>assets/css/bootstrap-responsive.css" rel="stylesheet">
   </head>

    <body>
        <?php $usersessioninfo = $this->session->userdata('loggedinadmindata'); ?>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="brand" href="<?php echo base_url() . 'index.php/admin' ?>" class="logo pull-left">Abdul Shamadhu - Admin Console</a>
                    <div class="nav-collapse collapse">

                        <div class="navbar-text pull-right" style="text-transform:capitalize;">
                            Welcome <?php echo $usersessioninfo['username']; ?>, <a href="<?php echo base_url('index.php/admin/manageusers/changeadminpasswd'); ?>" class="navbar-link">Change Password </a> | 
                            <a href="<?php echo base_url('index.php/admin/logout'); ?>" class="navbar-link">Logout</a>
                            <!--<a href="#" class="navbar-link" onclick="reloadjs();return false;">Reload JS</a> -->
                        </div>
                        
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row-fluid">
