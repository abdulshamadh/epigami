<!-- sof body section  -->
<div id="maincontainer">
  <section id="product">
    <div class="container">
      
 	<div class="row">
        <!-- Phone Book-->
        <div class="span9">
        
<div class="add_contact">       
<h1 class="heading1" id="add"><span class="maintext">Add Contact</span><br clear="all"></h1> 
<h1 class="heading1" id="update"><span class="maintext">Update Contact</span><br clear="all"></h1>

<form class="form-horizontal" >                 
<fieldset>
<input type="hidden" class="input-xlarge" id="phoneId" name="phoneId">
    <div class="control-group">
      <label class="control-label">Name: </label>
      <div class="controls">
        <input type="text" required autofocus class="input-xlarge" id="name" name="name" minlength="2" placeholder="Name" pattern="[a-zA-Z]{2,25}"/>
         </div>
    </div>
    <div class="control-group">
      <label class="control-label">Phone Number:</label>
      <div class="controls">
        <input type="text" required autofocus class="input-xlarge" id="phone_number" name="phone_number">
         </div>
    </div>
    <div style="margin:0% 0% 0% 25%;">
      <input type="button" class="btn btn-orange" value="Save Contact" id="add_contact" >
      <input type="button" class="btn btn-orange" value="Save Contact" id="update_contact" >
      <input type="reset" class="btn btn-orange" id="cancel_contact" value="Cancel">
    </div>
  </fieldset>
  </form>
</div>
        
        
<h1 class="heading1" style="margin-bottom:10px;"><span class="maintext">Phone Book</span></h1> 
<div class="text-right" style=" margin-right:30px;"><a href="" class="icon-print" onclick="printDiv('printableArea')">Print</a></div>
<div id="getPhonebook"></div>       
          
</div>

     <!-- Sidebar Start right side bar-->
          <aside class="span3">
            <div class="sidewidt">
              <h2 class="heading2"><span>&nbsp;</span></h2>
<ul class="nav nav-list categories">
  <li> <a href="#">Manage Phone Book</a> </li>
  <li> <a href="<?php echo base_url() . 'index.php/home/index/export'?>">Export Phone Book</a> </li>
  <li> <a class="showcontact" style="cursor:pointer;">Add New Contact</a></li>
</ul>
		   </div>
          </aside>
        <!-- Sidebar End-->
      </div>
    </div>
  </section>
</div>

<script>
function getPhonebook() {
	$('#phoneId').val('');
	$('#name').val('');
    $('#phone_number').val('');
    $.post("<?php echo base_url() ?>index.php/home/getPhonebook",
        function(data) {
        var getPhonebook;
            if (data != "") {
                $("#getPhonebook").html('');
                getPhonebook = '<table class="table table-striped table-bordered table-condensed" style="font-size:12px;"><thead><tr><th class="centeralign"><strong>ID</strong></th><th class="centeralign" ><strong>Name</strong></th><th class="centeralign" ><strong>Phone Number</strong> </th><th class="centeralign" ><strong>Added at</strong></th><th class="centeralign" ><strong>Action</strong> </th></tr></thead>';
                
                for (var i = 0; i < data.phonebook.length; i++) {
                
                getPhonebook += '<tr>';
                getPhonebook += '<td class="centeralign">' + data.phonebook[i].id + '</td>';
                getPhonebook += '<td class="leftalign">' + data.phonebook[i].name + '</td>';
                getPhonebook += '<td class="centeralign">' + data.phonebook[i].phone_number + '</td>';
                getPhonebook += '<td class="centeralign">' + data.phonebook[i].created_at + '</td>';
                getPhonebook += '<td class="centeralign"><a style="text-decoration:underline;cursor:pointer;" onclick="return get_contact(' + data.phonebook[i].id + ');">Edit</a> / <a style="text-decoration:underline;cursor:pointer;" onclick="return delete_contact(' + data.phonebook[i].id + ');">Delete</a></td>';
                getPhonebook += '</tr>';
                
                }
                getPhonebook += '</table>';
                $("#getPhonebook").html(getPhonebook);
            }
            else {
                $("#getPhonebook").html('<div style="margin-left:40%; color:red;">No result found!</div>');
            }
    });
    return false;
}

function delete_contact(phoneId) {
    var conf = confirm("Do you really want to delete this Contact?");
    if (conf == true) {
        $.post("<?php echo base_url() ?>index.php/home/delete_contact", {"phoneId": phoneId},
        function(data) {
            if (data != "") {
                alert("Selected contact deleted successfully!");
                getPhonebook();
            }
        });
    }
    else {
        return false;
    }
}

function get_contact(phoneId) {
	$.post("<?php echo base_url() ?>index.php/home/get_contact", {"phoneId": phoneId},
        function(data) {
            if (data != "") {
            	$("#add").hide();
            	$("#update").show();
    			$("#add_contact").hide();
    			$("#update_contact").show();
    			
                $('#phoneId').val(data.phonebook[0].id);
                $('#name').val(data.phonebook[0].name);
    			$('#phone_number').val(data.phonebook[0].phone_number);
    			$(".add_contact").show();
            }
        });
        return false;
}

$('document').ready(function() {
    $(".add_contact").hide();
    $("#update").hide();
    $("#update_contact").hide();
    
    $('.showcontact').click(function(e) {
        $(".add_contact").toggle();
        $("#add").show();
        $("#update").hide();
        $('#phoneId').val('');
		$('#name').val('');
    	$('#phone_number').val('');
    	$("#add_contact").show();
    	$("#update_contact").hide();
    });
    
    $('#cancel_contact').click(function(e) {
        $(".add_contact").hide();
    });
    
    $('#add_contact').click(function(e) {
    	var name = $('#name').val();
    	var phone_number = $('#phone_number').val();
        $.post("<?php echo base_url() ?>index.php/home/addContact", {"name": name, "phone_number": phone_number},
        function(result) {
            if (result == 'success') {
                alert("Contact has been added into your phonebook successfully!");
                getPhonebook();
            } else {
                alert("Sorry, Contact has not been added into your phonebook!");
            }
        });
        return false;
    });
    
    $('#update_contact').click(function(e) {
    	var phoneId = $('#phoneId').val();
    	var name = $('#name').val();
    	var phone_number = $('#phone_number').val();
        $.post("<?php echo base_url() ?>index.php/home/updateContact", {"name": name, "phone_number": phone_number, "phoneId": phoneId},
        function(result) {
            if (result == 'success') {
                alert("Contact has been updated into your phonebook successfully!");
                getPhonebook();
            } else {
                alert("Sorry, Contact has not been updated into your phonebook!");
            }
        });
        return false;
    });
});
getPhonebook();
function printDiv(divName) {
    var printContents = document.getElementById('getPhonebook').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>