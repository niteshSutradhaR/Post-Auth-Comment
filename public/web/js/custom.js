$(document).ready(function(){


    $('#myModal').modal('show');

	console.log(paginateNotReq);

	$('#delete-post').click(function(){
		var cnf = confirm("Are you sure, you want delete ?")
		if (cnf) {
			$('#delete-post-form').submit();
		}
	});

	$("#post-tags").keypress(function(event){
		var tags = $(this).val();
		if(String.fromCharCode(event.which) == ' ') 
		{
			var tagsArr = tags.split(" ");
			var tagsArr1 = [];
			tagsArr.forEach((x) => {
			  	if( x != "")
		  	  	tagsArr1.push(x);
			});
			if(tagsArr1.length > 25)
			{
				alert("You have reach the max. limit!")
				$(this).val((tagsArr1.slice(0, 5)).join(" "));
			}
		}

	});
});