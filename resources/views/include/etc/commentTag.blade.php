
var start=/@/ig;
var word=/@(\w+)/ig;

$(".jqte").change(function(){
	var content = $(this).text(); 
		  // alert(content);
		  var matchText = content.match(start); 
			// alert(matchText);
			if (matchText!=null){
				// console.log(matchText);
				var username= content.match(word);
				console.log(username);
				var search = 'search='+ username;
				console.log(search);
				if(matchText.length>0)
				{
					
					if(username!=null){
						if(username.length>0)
						{
							console.log(username);
							$.ajax({
								method:'POST',
								url: '/search/tag',
								data : { 
									'search':  username, 
								},
								dataType: 'json',
								success: function(users)
								{
									var temp="";
									console.log(users);
									console.log(users.length);
									temp += '<ul>';
									for (var i = users.length - 1; i >= 0; i--) {
										temp += '<li id="tag_'+i+'" title="'+users[i]+'">'+users[i]+'</li>';
									};
									temp += '</ul>';
									// console.log(temp);
									$("#tagShow").html(temp).slideDown()
									// console.log($(".addName"));
								},
								error: function(users)
								{
									$("#tagShow").slideUp('show');
								}
							});
						}
					}
				}
			}
			else {
					$("#tagShow").slideUp('show');
			}

		});


$('#tagShow').on('click', '#tag_0',function(){
	var username = $(this).attr('title');
	var old = $(".jqte_editor").html();
	var content=old.replace(word," ");
	$(".jqte").jqteVal(content+ " <a class='tagLink' href='/activity/user/username/"+username+"' >"+username+"</a> ");
	// console.log(username);
	// console.log(old);
	// console.log($(".jqte_editor").html());
});

$('#tagShow').on('click', '#tag_1', function(){
	var username = $(this).attr('title');
	var old = $(".jqte_editor").html();
	var content=old.replace(word," ");
	$(".jqte").jqteVal(content+ " <a class='tagLink' href='/activity/user/username/"+username+"' >"+username+"</a> ");
}); 

$('#tagShow').on('click', '#tag_2', function(){
		var username = $(this).attr('title');
	var old = $(".jqte_editor").html();
	var content=old.replace(word," ");
	$(".jqte").jqteVal(content+ " <a class='tagLink' href='/activity/user/username/"+username+"' >"+username+"</a> ");
}); 

$('#tagShow').on('click', '#tag_3', function(){
	var username = $(this).attr('title');
	var old = $(".jqte_editor").html();
	var content=old.replace(word," ");
	$(".jqte").jqteVal(content+ " <a class='tagLink' href='/activity/user/username/"+username+"' >"+username+"</a> ");
}); 

$('#tagShow').on('click', '#tag_4', function(){
		var username = $(this).attr('title');
	var old = $(".jqte_editor").html();
	var content=old.replace(word," ");
	$(".jqte").jqteVal(content+ " <a class='tagLink' href='/activity/user/username/"+username+"' >"+username+"</a> ");
	// var username = $(this).attr('title');
	// var old = $(".jqte").html();
	// var content=old.replace(word," "); 
	// $(".jqte").html(content);
	// var taggedUser="<a href='/activity/user/"+username+"' >"+username+"</a>";
	// $(".jqte").append(taggedUser);
	// $("#tagShow").hide();
}); 
