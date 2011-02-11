$(document).ready(function() {
	/**
	 * @author João Lagarto
	 * Method to handle logins
	 */
	//initialize notification plugin
	//$("#alertDiv").startAlert({});	
	
	jQuery.fn.login = function(){
		//check if any of the fields is empty		
		if($("#user_login").val()=="" || $("#user_passwd").val()==""){
			$("#alertDiv").alertMsg({
				  text: "Missing fields"
			});
		} else {
			//send the ajax request
			$.post("session.php?login",{login:$("#user_login").val(),
							  pass:$('#user_passwd').val()},
							  function(data){
								  //return the data
								  if(data.length!=0){
									  $("#alertDiv").alertMsg({
										  text: "Wrong Login"
									  });
								  } else {
									  window.location = "admin.php";
								  }
							  });
		}
		
			
	};
	
	jQuery.fn.recoverPwd = function(){
		var mail = prompt("Your email:");
		if(mail){
			$.get("session.php?pwd",{email:mail},
								function(data){
									if(data.length!=0){
										msg=data;
									} else {
										msg="Password updated. Check your email";
									}
									$("#alertDiv").alertMsg({
										text: msg
									});
								});
		}
	};
	
});
