<script>
	$(document).ready(function(){
		$('.adminNav>ul>li').hover(openDetailMenu, closeDetailMenu);

		// $('.adminNav>ul>li').bind('mouseover',openDetailMenu);
		function openDetailMenu () {
			// alert("over")
			// $(this).find('ul').css('visibility', 'visible');
			// $(this).find('ul').css('display','block');
			$(this).find('ul').slideDown();
		}
		// $('.adminNav>ul>li').bind('mouseout',closeDetailMenu);
		function closeDetailMenu () {
			//alert("out")
			// $(this).find('ul').css('visibility','hidden');
			// $(this).find('ul').css('display','none');
			$(this).find('ul').slideUp();
		}
		@include('include.etc.commentTag')
		@include('include.etc.updateCommentScript')
		@include('include.etc.headerScript')
		@include('include.etc.geolocationCookie')
		$('.display_5>ul>li').hover(openDetailDiscussion, closeDetailDiscussion);
		$('.display_7>ul>li').hover(openDetailDiscussion, closeDetailDiscussion);
		function openDetailDiscussion () {
			//alert("over")
			$(this).find('ul').fadeIn();
		}
		function closeDetailDiscussion () {
			$(this).find('ul').fadeOut();
		}
		// $('.display_5>ul>li').bind('mouseover',openDetailDiscussion);
		// function openDetailDiscussion () {
		// 	//alert("over")
		// 	$(this).find('ul').css('visibility', 'visible');
		// 	$(this).find('ul').css('display','block');
		// }
		// $('.display_5>ul>li').bind('mouseout',closeDetailDiscussion);
		// function closeDetailDiscussion () {
		// 	//alert("out")
		// 	$(this).find('ul').css('visibility','hidden');
		// 	$(this).find('ul').css('display','none');
		// }

	});
@include('include.etc.videoControlScript')
</script>