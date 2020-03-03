var tempComment;
$(".editBtn").click(function(){
		// alert($("#content"+(this).id).text());
	 //    if ($("#content"+(this).id).isContentEditable == true) {
	 //    $("#content"+(this).id).attr('contentEditable' , 'false');
	 //    $("#"+(this).id).css('display', 'block');
	 //  	} 
	 //  else {
	 //    $("#content"+(this).id).attr('contentEditable' , 'true');
	 //    $("#"+(this).id).css('display', 'none');
  // }
  $id = ((this).id).substring(6);
  $tempComment = $("#content"+$id).text();
  //alert($tempComment);
  $("#content"+$id).attr('contentEditable' , 'true');
  $("#edit__"+$id).css('display', 'none');
  $("#dele__"+$id).css('display', 'none');
  $("#save__"+$id).css('display', 'inline-block');
  $("#canc__"+$id).css('display', 'inline-block');
});
$(".cancelBtn").click(function(){
	$id = ((this).id).substring(6);
	$("#content"+$id).text($tempComment);
	$tempComment = "";
	//alert($tempComment);
  $("#content"+$id).attr('contentEditable' , 'false');
  $("#edit__"+$id).css('display', 'inline-block');
  $("#dele__"+$id).css('display', 'inline-block');
  $("#save__"+$id).css('display', 'none');
  $("#canc__"+$id).css('display', 'none');
}); 
$(".saveBtn").click(function(){
	$id = ((this).id).substring(6);
  $("#content"+$id).attr('contentEditable' , 'false');
  $("#dele__"+$id).css('display', 'inline-block');
  $("#edit__"+$id).css('display', 'inline-block');
  $("#save__"+$id).css('display', 'none');
  //alert($("#content"+$id).text());
  $("#id__"+$id).val($("#content"+$id).text());
  //alert($("#id__"+$id).val());
  $("#canc__"+$id).css('display', 'none');
});  

$('.commentBar').hover(openDetailComment, closeDetailComment);
function openDetailComment () {
  $(this).find('.change').slideDown();
}
function closeDetailComment () {
  $(this).find('.change').slideUp();
}

$('.commentBar>table').hover(openInappropriateComment, closeInappropriateComment);
function openInappropriateComment () {
  $(this).find('.inappropriate').slideDown();
}
function closeInappropriateComment () {
  $(this).find('.inappropriate').slideUp();
}

