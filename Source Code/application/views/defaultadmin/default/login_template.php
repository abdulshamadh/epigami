<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sign&minus;in - Abdul - Admin Console</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
            }

            .form-signin {
                max-width: 300px;
                padding: 19px 29px 29px;
                margin: 0 auto 20px;
                background-color: #fff;
                border: 1px solid #e5e5e5;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
                margin-bottom: 10px;
            }
            .form-signin input[type="text"],
            .form-signin input[type="password"] {
                font-size: 16px;
                height: auto;
                margin-bottom: 15px;
                padding: 7px 9px;
            }

        </style>
        <link href="<?php echo base_url() ?>assets/css/bootstrap-responsive.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="../assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
    </head>

    <body>
        <div class="container">
            <form class="form-signin" action="<?php echo base_url() ?>index.php/admin/login/" method="post">
                <label class="text-center" style="font-size:22px;">Admin Panel</label>
                <?php echo validation_errors(); ?>  
                <h2 class="form-signin-heading" style="color:#3D7A84;">Sign-in</h2>
                <h6 class="form-signin-heading">Please enter details to sign-in</h6>
                <input class="input-block-level" type="text" name="username" id="adminloginusername" value="<?php echo set_value('username'); ?>" placeholder="Username" />
                <input class="input-block-level" type="password" name="password" value="" placeholder="Password"/>
                <button class="btn btn-large btn-primary" type="submit">Sign in</button>
            </form>

        </div> <!-- /container -->
    </body>
    <!-- Le scripts -->
    <script type="text/javascript">
        document.getElementById('adminloginusername').focus()
    </script>
</html>
