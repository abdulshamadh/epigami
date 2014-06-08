<div class="span2">
    <div class="sidebar-nav">
        <ul class="nav nav-list">
            <li style="color:#333; font-size:13px;" class="nav-header">Dashboard</li>
            <li style="padding-left:15px" class="<?php echo ($activemenu == 'home') ? 'active' : null ?>"><a style="font-size:13px;" href="<?php echo base_url('index.php/admin/managedashboard/') ?>">Home</a></li>
            <?php $usersessioninfo = $this->session->userdata('loggedinadmindata'); ?>
            <?php if($usersessioninfo['role_id']=='1'){ ?>
            <li style="color:#333; font-size:12px;" class="nav-header">Account Management</li>
            <li style="padding-left:15px" class="<?php echo ($activemenu == 'listusers') ? 'active' : null ?>"><a style="font-size:13px;"  href="<?php echo base_url('index.php/admin/manageusers/listusers') ?>">Account Users</a></li>
            <li style="padding-left:15px" class="<?php echo ($activemenu == 'adminuser_add') ? 'active' : null ?>"><a style="font-size:13px;"  href="<?php echo base_url('index.php/admin/manageusers/adminuser_add') ?>">Add New User</a></li>
            <?php } ?>
        </ul>
    </div><!--/.well -->
</div><!--/span-->