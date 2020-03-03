<script>
	$(document).ready(function(){
		$('.userNav>ul>li').hover(openDetailMenu, closeDetailMenu);
		function openDetailMenu () {
			$(this).find('ul').slideDown();
		}
		function closeDetailMenu () {
			$(this).find('ul').slideUp();
		}
		@include('include.etc.geolocationCookie')
		@include('include.etc.commentTag')
		@include('include.etc.updateCommentScript')
		@include('include.etc.headerScript')
		$('.activity tr').hover(openActivityLink, closeActivityLink);
		function openActivityLink () {
			$(this).find('ul').slideDown();
		}
		function closeActivityLink () {
			$(this).find('ul').slideUp();
		}
	});
	function showSubscribeModal(){
		document.getElementById("subscribeModal").showModal();
	}
	function showUnsubscribeModal(){
		document.getElementById("unsubscribeModal").showModal();
	}
	@include('include.etc.videoControlScript')
</script>