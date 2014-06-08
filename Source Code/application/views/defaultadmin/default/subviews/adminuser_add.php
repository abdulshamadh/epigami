<div class="span10 contentborder">
    <?php echo ($message != null) ? '<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert">×</button>' . $message . '</div>' : null; ?>
    <?php echo ($error != null) ? '<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">×</button>' . $error . '</div>' : null; ?>
    <div class="row-fluid">
        <div class="span12">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('index.php/admin') ?>">Admin Dashboard</a> <span class="divider">/</span></li>
                <li><a href="<?php echo base_url('index.php/admin/manageusers/listusers') ?>">Account Users</a> <span class="divider">/</span></li>
                <li class="active">Add Account New User</li>
            </ul>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12 lead">
            <strong>Add Account New User</strong> 
        </div>
    </div>

    <div id="">
        <?php echo form_open('/index.php/admin/manageusers/adminuser_add'); ?>
        <div class="row-fluid">
            <div id="pagetitlediv" class="span4"><label class="label label-info">Name</label><br/>
                <input class="text-input" type="text" name="name" id="name" />
            </div>
            <div id="pagetitlediv" class="span4"><label class="label label-info">Email</label><br/>
                <input class="text-input" type="text" name="email" id="email" />
            </div>
        </div>
        
        <div class="row-fluid">
            <div id="pagetitlediv" class="span4"><label class="label label-info">Username (For Login)</label><br/>
                <input class="text-input" type="text" name="user_name" id="user_name" />
            </div>
            <div id="pagetitlediv" class="span4"><label class="label label-info">Password</label><br/>
                <input class="text-input" type="password" name="password" id="password" />
            </div>
        </div>
        
        <!-- 
<div class="row-fluid">
			<div class="span4">
				<label class="label label-info">Date of Birth</label><br />
				<input type="text" name="displaystartdate" readonly id="startdatepicker" class="datepicker CHECK_TX_BG" style="cursor:pointer !important; background-color: white;" >
			</div>
		</div>
 -->

        <div class="row-fluid">
            <div id="" class="span4">
                <label class="label label-info">Select Role</label><br />
                <select name="role">
                    <option value="1" selected>Admin</option>
                    <option value="2">Moderator</option>
                </select>
            </div>
            <div id="" class="span4">
                <label class="label label-info">Select Status</label><br />
                <select name="status">
                    <option value="active" selected>Active</option>
                    <option value="inactive">Inactive</option>
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