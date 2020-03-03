$('.activity tr').hover(openActivityLink, closeActivityLink);
function openActivityLink () {
	$(this).find('ul').slideDown();
}
function closeActivityLink () {
	$(this).find('ul').slideUp();
}

/*--- Size Minimize ---*/
// $("aside").hover(openSideNav, closeSideNav);
// function openSideNav(){
// 	$(this).find('.sidenav').animate({width: '25%', opacity: '1'}, "slow");
// 	$('body').animate({width: '-=32.5%'}, "slow");
// }
// function closeSideNav(){
// 	$(this).find('.sidenav').animate({width: '10px', opacity: '0'}, "slow");
// 	$('body').animate({width: '+=32.5%'}, "slow");
// }

/*--- Geser Kiri ---*/
$("aside").hover(openSideNav, closeSideNav);
function openSideNav(){
	$(this).find('.sidenav').animate({right: '+=200px', opacity: '1'}, "slow");
	// $('body').animate({right: '+=450px'}, "slow");
}
function closeSideNav(){
	$(this).find('.sidenav').animate({right: '-=200px', opacity: '0'}, "slow");
	// $('body').animate({right: '-=450px'}, "slow");
}

// -- Search TextBox --
$("#searchBox").focusin(function(){
	$(this).val("");
	$(this).animate({width: '80%'});
});
$("#searchBox").focusout(function(){
	$(this).animate({width: '10%'});
});

setTimeout(function () {
	$("#svgId").slideDown();
	$("svg").slideDown();
}, 600);


$("svg").click( function(){
	$(this).slideUp();
	$("#svgId").slideUp();
});