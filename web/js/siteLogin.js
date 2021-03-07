$(document).ready(function(){
  $(".form-control").focusout(function(){
	if($(this).parent('div').hasClass('has-error')==true)
		$(this).parent('div').removeClass('has-error')
  });
  
  $(".show-pswrd").click(function(){
	var psw = document.getElementById("loginform-password");
	
	  if (psw.type === "password") {
		psw.type = "text";
		$("#toggle-pswrd").toggleClass("fa-eye");
		$("#toggle-pswrd").toggleClass("fa-eye-slash vsble");
	  } else {
		psw.type = "password";
		$("#toggle-pswrd").toggleClass("fa-eye");
		$("#toggle-pswrd").toggleClass("fa-eye-slash vsble");
	  }
  });
});