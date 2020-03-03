<script> 
/*
$(document).ready(function(){
	$toggle = true;
	$("#signUpModal").hide();
  $("#signUpBtn").click(function(){
  	if ($toggle){
  		$("#signUpModal").slideDown();
  		$toggle=!$toggle;
  		//alert($toggle);
  	}
  	else {
  		$("#signUpModal").hide();
  		$toggle=!$toggle;
  		//alert($toggle);
  	}
  });
});
*/
@include('include.etc.videoControlScript')
function showSignUpModal(){
 document.getElementById("signUpModal").showModal();
}
function showLoginModal(){
 document.getElementById("LoginModal").showModal();
}
$(document).ready(function(){
  @include('include.etc.geolocationCookie')
  @include('include.etc.headerScript')
});
</script>