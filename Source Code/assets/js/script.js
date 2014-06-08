// JavaScript Document

function searchfunction(){
	var searchquery = document.getElementById("appendedInputButton").value;
	var searchurl = document.getElementById("hiddenurl").value;
	if(searchquery != "")
	window.location = searchurl + "/" + searchquery;
}

function advancedsearch() {
	
	var e = document.getElementById("categoryName");
	var searchcategory = e.options[e.selectedIndex].value;
	
	var searchkeyword = document.getElementById("adsearchterm").value;
		
	var searchurl = document.getElementById("hiddensearchurl").value;
	
	if(searchkeyword != "")
		window.location = searchurl + "/" + searchcategory + "/" + searchkeyword;
}


function getPaymentGatewayValues(methodID) {
	//alert(methodID);	
	baseurl = document.getElementById('baseurl').value;
	$.ajax({
		type: "POST",
		data: "methodid="+methodID,
		url: baseurl+'checkout/getPaymentGatewayOptionValue/'
	}).success(function(data){
		//alert(data);
		console.log(data);
		//
		$('#clicked_2').html(data); 
		//$('#clicked_4').html(data);
		//eval($('#myscripteval').html());
	});
}

function callTabDetails(base_url,product_id,attribute_id,place) {
	$.ajax({
		url: base_url+'product/callTabDetails/'+product_id+'/'+attribute_id,
                 type:'POST'
         }).success(function(data) {
                if(data != "")
                {
					 $("#tab"+place).html('');
					 $("#tab"+place).html(data.tab_menu_value[0].value);
                }
         });
         return false;
}
function changeTarget() {
	document.getElementById('paypal').target="_blank";
}

function emptyCheck(thisObject){
	if(thisObject.val() == null || thisObject.val() == ""){
		thisObject.addClass('emptyinput');
		return true;
	}
	else{
		thisObject.removeClass('emptyinput');
	}
	return false;
}

function intCheck(thisObject){
	var value = thisObject.val();
	var intRegex = /^\d+\.?\d*$/;
    if(!intRegex.test(value)) {
		thisObject.addClass('checkoutErr');
		return true;
    }
	else{
		thisObject.removeClass('checkoutErr');
	}
	return false;
}


$(document).ready(function(){
	  $('#myTab a:first').tab('show');
	});

	$(document).ready(function(){
		$('.datepicker').datepicker({
		  changeMonth: true,
	      changeYear: true,
		  yearRange: "1940:2010",
		  dateFormat: "dd-mm-yy" 
	    });
	});
$(document).ready(function() {
		$("#resetpassword").validate({
			rules:{
				newpassword:{
					required:true,
					minlength: 7				
				},
				newconpassword:{
					required:true,
					equalTo: "#newpassword"
				}
				//gender:"required"
			},
			errorClass: "help-inline"
		});
});

$(document).ready(function() {
	$('button').on('click',function(e) {
		if ($(this).hasClass('grid')) {
			$('#list-container ul').removeClass('list').addClass('grid');
		}
		else if($(this).hasClass('list')) {
			$('#list-container ul').removeClass('grid').addClass('list');
		}
	});
});


$(document).ready(function() {
	$(".hidden_destiny").hide()
  $("input[name$='type']").click(function(){
  var value = $(this).val();
  if(value=='Individual') {
    $("#Individual_box").show();
     $("#Company_box").hide();
  }
  else if(value=='Company') {
   $("#Company_box").show();
    $("#Individual_box").hide();
   }
  });
  $("#Individual_box").show();
  $("#Company_box").hide();
  
  //New
  
  $('#continue').click(function(){
	 $('#steptwo').attr('data-toggle',"tab") ;
	 $('#checkouttabs a[href="#tab2"]').tab('show');
  });
  $('.radio input[type="radio"]:eq(0)').click(function(){
	   $('#steptwo').removeAttr('data-toggle') ;
  });
  $('.radio input[type="radio"]:eq(1)').click(function(){
	   $('#steptwo').removeAttr('data-toggle') ;
  });
  $('#saveandcontinue').click(function(){
	  var baseurl = document.getElementById('baseurl').value;
	   //data = $('#checkoutaddrform').serialize();
	   
	   flag = 0;
	   
	   $('#checkoutaddrform').click(function(){
			var varVali = new Array();
			varVali[0] = "useradd";
			varVali[1] = "usercity";
			varVali[2] = "userstate";
			varVali[3] = "usercountry";
			varVali[4] = "userpincode";
	   })
	   
	   for(var i=0; i<varVali.length;i++) {
		   	//alert($('#'+arr[i]+'').val());
		   	if(emptyCheck($('#'+varVali[i]+'')))
		   		flag = 1;			
	   }
	   /*
	   $('#checkoutaddrform input').each(function(pos,elem){		   
			if($(elem).val().trim() == ""){
				//$(elem).css('background-color',"red");
				$(elem).addClass('checkoutErr');
				flag=1;
			}
			
		})*/
		
	 $('.word_count').each(function(){
     //maximum limit of characters allowed.
     var maxlimit = 240;
     // get current number of characters
     var length = $(this).val().length;
     if(length >= maxlimit) {
   $(this).val($(this).val().substring(0, maxlimit));
   length = maxlimit;
  }
     // update count on page load
     $(this).parent().find('.counter').html( (maxlimit - length) + ' characters left');
     // bind on key up event
     $(this).keyup(function(){
  // get new length of characters
  var new_length = $(this).val().length;
  if(new_length >= maxlimit) {
    $(this).val($(this).val().substring(0, maxlimit));
    //update the new length
    new_length = maxlimit;
   }
  // update count
  $(this).parent().find('.counter').html( (maxlimit - new_length) + ' characters left');
     });
 });
 
 var useradd = $("textarea#useradd").val();
			if (useradd == "") {
			 // $(();"label#message_error").show();
			// alert("www");
			  $("textarea#useradd").focus();
			 
			  	flag=1;
			}
 
 	if(flag == 0){
			data = $('#checkoutaddrform').serialize();// alert(data);
			$.ajax({
                     url: baseurl+'index.php/checkout/updatenewaddress',
					 type:'POST',
					 data:data
                       }).success(function(data) {
                               //alert(data);
							/* $('#steptwo').attr('data-toggle',"tab") ;
							$('#checkouttabs a[href="#tab2"]').tab('show');*/
							 document.checkoutaddrform.submit();
               });
		}
		else{
			alert('please check the highlighted fields');	
			
		}
		return false;
  });
  $('#paymentcon').click(function(){
	 $('#stepthree').attr('data-toggle',"tab");
	 //window.location.reload();
	  $('#tabs').tabs({ remote: true }); 
	 $('#checkouttabs a[href="#tab3"]').tab('show');
  });
  //new end 
  
  //prod review
  $('#abcd').click(function(){
        $('#sdfg').tab('show');
        $('html,body').animate({scrollTop:530},'slow')
 });
  //prod review end
  $('div[name="starCatalog"]').raty({
	  readOnly:true,
	  score: function() {
		return $(this).attr('data-score');
	  }
	});
	
	 $('input[name="fate"]').change(function(){
		 $(".hidden_destiny").hide(),
		 $("#clicked_"+this.id.replace("radio_","")).show()
	});
	
});


/* -------------- Start - Single Sign on with Forum - In Progress------------*/
/*$(document).ready(function(){
  $('form#contact').submit(function(e){
  e.preventDefault();
  $('form').addClass('contact');
  if($('form').hasClass('contact')){
  
  var username = $('#username').val();
  var password = md5($('#password').val());
  var base_url = $('#base_url').val(); 

    $.ajax({
          type: "POST",
          url: 'http://localhost/sudhir/login/loginWithForum/'+username+'/'+password,
          //data: dataString,
          success: function() {
			  //console.log("ajax success");
			  $('form').removeClass('contact');
			  //$('form').submit();
          }
         }); return false;
  }     
  });
});

*/
function callLogin(){
	var username = $('#usernamef').val();
	var password = $('#passwordf').val();
	var login = "Login";
		$.post("http://localhost/sudhir/forum/ucp.php?mode=login", {username: ""+username+"", password: ""+password+"", login: ""+login+""}, function(data){
			//alert(data)
			callLoginOursite(username, password, login);
		});
	return false;
}

function callLoginOursite(username, password, login){
	 $.ajax({
		  url: 'http://localhost/sudhir/login/loginWithForum/'+username+'/'+password,
		  type:'POST'
	  }).success(function(data) {
		 // location.reload();
	  });
	return false;
}
/* -------------- End - Single Sign on with Forum - In Progress------------*/