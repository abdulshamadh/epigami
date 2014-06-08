<div class="span10 contentborder">
    <?php echo ($message != null) ? '<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert">×</button>' . $message . '</div>' : null; ?>
    <?php echo ($error != null) ? '<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">×</button>' . $error . '</div>' : null; ?>
    <div class="row-fluid">
        <div class="span12">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('index.php/admin') ?>">Admin Dashboard</a> <span class="divider">/</span></li>
                <li><a href="<?php echo base_url('index.php/admin/manageusers/listusers') ?>">Admin Account Users</a> <span class="divider">/</span></li>
                <li class="active">Edit Admin Account User</li>
            </ul>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12 lead">
            <strong>Edit Admin Account User</strong> 
        </div>
    </div>

    <div id="">
        <?php $iddata = reset($contentdata['dataforid']); ?>
        <?php echo form_open('/index.php/admin/manageusers/adminuser_edit/'.$iddata->admin_id); ?>
        <input type="hidden" name="admin_id" value="<?php echo $iddata->admin_id; ?>" />
        <div class="row-fluid">
            <div id="pagetitlediv" class="span4"><label class="label">Name</label><br/>
                <input class="text-input" type="text" name="name" id="name" value="<?php echo $iddata->firstname; ?>"/>
            </div>
            <div id="pagetitlediv" class="span4"><label class="label">Email</label><br/>
                <input class="text-input" type="text" name="email" id="email" value="<?php echo $iddata->email; ?>"/>
            </div>
        </div>
        
        <div class="row-fluid">
            <div id="pagetitlediv" class="span4"><label class="label">Username (For Login)</label><br/>
                <input class="text-input" type="text" name="user_name" id="user_name" value="<?php echo $iddata->username; ?>"/>
            </div>
            <div id="pagetitlediv" class="span4"><label class="label">Password</label><br/>
                <input class="text-input" type="password" name="password" id="password" value=""/>
            </div>
        </div>
        
        <div class="row-fluid">
            <div id="" class="span4">
                <label class="label">Select Role</label><br />
                <select name="role">
                    <option value="1" <?php if ($iddata->role_id == '1') echo 'selected'; ?>>Admin</option>
                    <option value="2" <?php if ($iddata->role_id == '2') echo 'selected'; ?>>Moderator</option>
                </select>
            </div>
            <div id="" class="span4">
                <label class="label">Select Status</label><br />
                <select name="status">
                    <option value="active" <?php if ($iddata->user_status == 'active') echo 'selected'; ?>>Active</option>
                    <option value="inactive" <?php if ($iddata->user_status == 'inactive') echo 'selected'; ?>>Inactive</option>
                    <option value="deleted" <?php if ($iddata->user_status == 'deleted') echo 'selected'; ?>>Deleted</option>
                </select>
            </div>
        </div>
        
        <p> <br />
            <input class="btn" type="submit" value="Save" id="pagesave" />
            <a href="<?php echo base_url('index.php/admin/manageusers/listusers') ?>"><input class="btn" type="button" value="Cancel"  /> </a>
        </p>
        </form>
    </div>
</div>