$(document).ready(function(){
	var submitBtn = $("button[type='submit']");
	var url = $("#url");
	var link = $("#link");
	var resetBtn = $("button[type='reset']");
	var message = $("#message");
	submitBtn.click(function(){
		if(url.val() == ""){
			message.html("<span>Please enter a URL</span>");
			message.removeClass("d-none");
			setTimeout(function(){
				message.addClass("d-none");
			},2000);
		}
		else if($("#captcha").val() == ""){
			message.html("<span>Please enter the captcha</span>");
			message.removeClass("d-none");
			setTimeout(function(){
				message.addClass("d-none");
			},2000);
		}
		else{

			var dataObj = {"url":url.val(),"captcha":$("#captcha").val()};
			$.ajax({
			    type: "POST",
			    url: "shortit.php",
			    data: JSON.stringify(dataObj),
				contentType: 'application/json',
			    success: function(result){
			    	document.getElementById("captcha_image").src = "api/captcha_image.php";

			    	if(result == "invalid captcha"){
			    		message.html("<span>Invalid captcha, try again</span>");
						message.removeClass("d-none");
						setTimeout(function(){
							message.addClass("d-none");
						},2000);
			    	}
			     	else if(result != "empty"){
			     		let myObj = JSON.parse(result);
			     		var srcQR = 'api/QR.php?QR=' + myObj.shortUrl;
			     		document.getElementById("QR").innerHTML = '<a href="' + srcQR + '" target="_blank"><img width="100px" height="100px" src="' 
			     												+ srcQR + '">' + '</a>'+'<a href="' + srcQR + '" target="_blank">Download QR code</a>';
			     		var html = '<div class="row">'
			     					+ '<div class="col-lg-5 pt-1" style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><span>' 
			     					+ myObj.url + '</span></div>'
			     					+ '<div class="col-lg-4 pt-1"><a href="' + myObj.shortUrl 
			     					+ '" target=_blank id="new_link" title="Shortened URL" style="word-wrap: break-word;"></a></div>'
			     					+ '<div class="col-lg-3"><button type="button" id="copy_link" class="button btn-secondary">Copy URL</button></div>'
			     				+ '</div>';
			      		link.html(html);
			      		var new_link = $("#new_link");
			      		new_link.text(myObj.shortUrl);
			      		link.removeClass("d-none");
			      		var copy_link = $("#copy_link");
						copy_link.click(function(){
		                    var range = document.createRange();
		                    range.selectNode(document.getElementById("new_link"));
		                    window.getSelection().removeAllRanges(); // clear current selection
		                    window.getSelection().addRange(range); // to select text
		                    document.execCommand("copy");
		                    window.getSelection().removeAllRanges();// to deselect
							copy_link.text("URL Copied!");
							copy_link.removeClass("btn-secondary");
							copy_link.addClass("btn-success");
							setTimeout(function(){
								copy_link.text("Copy URL");
								copy_link.addClass("btn-secondary");
								copy_link.removeClass("btn-success");
							},1000);
						});
			      	}else{
			      		link.addClass("d-none");
			      	}
			    },
			    error: function(xhr,result,error){
			        $("#message").text("Some error occured");
			    }
	      	});
		}
		return false;
	});
	
});