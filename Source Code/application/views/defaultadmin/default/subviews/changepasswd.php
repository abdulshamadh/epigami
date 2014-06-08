<div class="span10 contentborder">
	<?php echo ($message!=null) ? '<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert">×</button>'.$message.'</div>' : null; ?>
	<div class="row-fluid">
		<div class="span12">
			<ul class="breadcrumb">
				<li><a href="<?php echo base_url('admin') ?>">Admin Dashboard</a> <span class="divider">/</span></li>
<!--				<li><a href="<?php echo base_url('admin/manageusers') ?>">Users</a> <span class="divider">/</span></li>-->
				<li class="active">Change Admin Password </li>
			</ul>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12 lead">
			<strong>Change Admin Password</strong>
		</div>
    </div>
	<?php $attributes = array('class' => 'form-horizontal', 'id' => 'registration');?>
	<?php echo form_open('index.php/admin/manageusers/changeadminpasswd', $attributes); ?>
	<div>
	  <fieldset>
		<div class="control-group">
		  <label class="control-label"><span class="text-error">*</span> Current Password:</label>
		  <div class="controls">
			<input type="password" required autofocus class="input-xlarge" id="admincpasswd" name="admincpasswd">
			<?php echo form_error('admincpasswd', '<div class="text-error">', '</div>'); ?> </div>
		</div>
		<div class="control-group">
		  <label class="control-label"><span class="text-error">*</span> New Password:</label>
		  <div class="controls">
			<input type="password" class="input-xlarge" id="adminnpasswd" name="adminnpasswd" >
			<?php echo form_error('adminnpasswd', '<div class="text-error">', '</div>'); ?> </div>
		</div>
		<div class="control-group">
		  <label class="control-label"><span class="text-error">*</span> Retype New Password:</label>
		  <div class="controls">
			<input type="password"  class="input-xlarge" id="adminnnpasswd" name="adminnnpasswd">
			<?php echo form_error('adminnnpasswd', '<div class="text-error">', '</div>'); ?> </div>
		</div>
		<div style="margin:0% 0% 0% 14%;">
		  <input type="Submit" class="btn btn-info" value="Save Changes">
		</div>
	  </fieldset>
	</div>
</div><!--/span10-->