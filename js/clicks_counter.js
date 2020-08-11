$(document).ready(function(){
	var submitBtn = $("button[type='submit']");
	var url = $("#url");
	var count = $("#count");
	var message = $("#message");
	url.keydown(function(e){
		if(e.which == 13){
			submitBtn.trigger("click");
			return false;
		}
	});
	submitBtn.click(function(){
		
		if(url.val() == ""){
			message.html("<span>Please enter a URL</span>");
			message.removeClass("d-none");
			count.hide();
			setTimeout(function(){
				message.addClass("d-none");
			},2000);
		}else{
			var path = "";
			if(url.val().startsWith("https://small-url.tk/")){
				$.ajax({
				    type: "GET",
				    url: "api/total_clicks.php",
				    data: "url=" + url.val().substr(21),
				    success: function(result){
				    	if(result == "invalid"){
				    		message.html("<span>The URL doesn't exist.</span>");
							message.removeClass("d-none");
							count.hide();
							setTimeout(function(){
								message.addClass("d-none");
							},2000);
				    	}else{
					    	count.hide();
					    	count.text("Total clicks = " + result);
					    	count.fadeIn("slow");
					    }
				    },
				    error: function(xhr,result,error){
				        message.html("<span>Please enter a valid URL</span>");
						message.removeClass("d-none");
						count.hide();
						setTimeout(function(){
							message.addClass("d-none");
						},2000);
				    }
	      		});
			}else{
				message.html("<span>Please enter a valid URL</span>");
				message.removeClass("d-none");
				count.hide();
				setTimeout(function(){
					message.addClass("d-none");
				},2000);
			}
			
		}
		return false;
	});
	
});