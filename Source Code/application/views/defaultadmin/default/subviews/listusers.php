<div class="span10 contentborder">
    <?php $usersessioninfo = $this->session->userdata('loggedinadmindata'); ?>
    <?php echo ($message != null) ? '<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert">×</button>' . $message . '</div>' : null; ?>
    <div class="row-fluid">
        <div class="span12">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('index.php/admin') ?>">Admin Dashboard</a> <span class="divider">/</span></li>
                <?php if (strpos(uri_string(), 'manageusers/listusers') !== false) { ?>
                    <li><a href="<?php echo base_url('index.php/admin/manageusers/') ?>">Admin Account Users</a> <span class="divider">/</span></li>
                    <li class="active">Manage Admin Account Users</li>

                    <?php
                } else {
                    ?>
                    <li class="active">Admin Account Users</li>
                <?php } ?>
            </ul></div>
    </div>
    <div class="row-fluid">
        <div class="span12 lead">
            <strong>Manage Admin Users</strong>  <a href="<?php echo base_url(); ?>index.php/admin/manageusers/adminuser_add" >
                <button class="btn btn-small"> Add Account New User </button></a>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span4">
            <div class="btn-group">
                <button class="btn dropdown-toggle" data-toggle="dropdown">
                    Fliter by <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <!-- dropdown menu links -->
                    <li><a href="<?php echo base_url('index.php/admin/manageusers/listusers/all/') ?>">All Users</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url('index.php/admin/manageusers/listusers/active/') ?>">Active Users</a></li>
                    <li><a href="<?php echo base_url('index.php/admin/manageusers/listusers/inactive/') ?>">Inactive Users</a></li>
                    <li><a href="<?php echo base_url('index.php/admin/manageusers/listusers/delete/') ?>">Deleted Users</a></li>
                </ul>
            </div>
            <?php
            if ($this->uri->segment(4) != NULL) {
                if ($this->uri->segment(4) == 'active')
                    $filterbyValue = 'Active';
                else if ($this->uri->segment(4) == 'inactive')
                    $filterbyValue = 'In Active';
                 else if ($this->uri->segment(4) == 'deleted')
                    $filterbyValue = 'Deleted';
                else
                    $filterbyValue = 'All';
                ?>
                <span class="breadcrumb"><?= $filterbyValue ?></span>
            <?php } ?>
        </div></div>
    <?php if ($contentdata != null && !empty($contentdata)) {
        ?>
        <table class="table table-hover" id="adminpagelisttabl">
            <thead>
                <tr>
<!--                    <th><input type="checkbox" id="selectall" name="selectall" onclick="checkboxselectall(this)"/></th>-->
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead> 
            <tbody>
                <?php foreach ($contentdata as $data): ?>
                    <tr>
<!--                        <td><input type="checkbox" id="selectcheckbox" name="selectcheckbox[]" value="<?php echo $data->admin_id; ?>" /></td>-->
                        <td><?php echo $data->admin_id; ?></td>
                        <td><?php echo $data->firstname; ?>
                            <div id="submenu"><span><a href="<?php echo base_url("index.php/admin/manageusers/adminuser_edit/" . $data->admin_id) ?>" id="edit" onclick="return true"> Edit </a> 
                                    <?php if($usersessioninfo['role_id']=='1'){ ?>| <a href="<?php echo base_url("index.php/admin/manageusers/deleteuser/" . $data->admin_id) ?>" id="delete" onclick="return confirm('Are you sure you want to delete this user?')"> Delete </a><?php } ?></span> </div></td>
                        <td><?php echo $data->email; ?></td>
                        <td><?php if($data->role_id == '1'){ echo 'Admin'; } elseif($data->role_id == '2'){ echo 'Moderator'; } ?></td>
                        <td><?php echo $data->user_status; ?></td>
                        <td><?php $dtime = new DateTime($data->created_at); print $dtime->format("M d, Y");?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table><hr />
        <?php
        echo $paginationdata;
    } else
        echo '<br /><div class="well span11" style="text-align:center;">No user found</div>';
    ?>
</div>
<script>
    function submitaction() {
        var data;
        var emptyflag = 0;
        var checkobj = document.getElementsByName('selectcheckbox[]');
        if (document.getElementById('actionselector').value != 'exportall') {
            for (var i = 0; i < checkobj.length; i++) {
                if (checkobj[i].checked == true) {
                    emptyflag = 1;
                    if (typeof data == 'undefined')
                        data = checkobj[i].value;
                    else
                        data = data + '.' + checkobj[i].value;
                }
            }
            if (emptyflag == 1) {
                document.getElementById('actionselect').value = document.getElementById('actionselector').value;
                document.getElementById("pagesid").value = data;
                document.getElementById('actionform').submit();
            }
            else
                alert("Please select atleast one item");
        }
        else {
            document.getElementById('actionselect').value = document.getElementById('actionselector').value;
            document.getElementById("pagesid").value = "empty";
            document.getElementById('actionform').submit();
        }
    }
    function checkboxselectall(thisobject) {
        if (thisobject.checked == true) {
            var checkobj = document.getElementsByName('selectcheckbox[]');
            for (var i = 0; i < checkobj.length; i++) {
                checkobj[i].checked = true;
            }
        }
        if (thisobject.checked == false) {
            var checkobj = document.getElementsByName('selectcheckbox[]');
            for (var i = 0; i < checkobj.length; i++) {
                checkobj[i].checked = false;
            }
        }
    }
</script>