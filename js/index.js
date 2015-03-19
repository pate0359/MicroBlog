document.addEventListener("DOMContentLoaded", function(){

	document.querySelector("#signinNav").style.display="none";
	
	document.querySelector("#btnSignIn").addEventListener("click",function(){
		
		document.querySelector("#signinNav").style.display="block";
		document.querySelector("#defaultNav").style.display="none";
		
	});
	
});

function userSignIn()
{
//	$.get(
//    'login.php'
//  	, {}
//  	, function( returnedData )
//    {
//      // Assumes returnedData has a javascript function name
//      window[returnedData]();
//    }
//  	, 'text'
//	);
	
	
//	// Make a variable that will hold our HTTP connection object
//	var xmlhttp;
//	
//	// Initialize object  for IE7 and up, and other modern browsers
//	if (window.XMLHttpRequest){
//		xmlhttp=new XMLHttpRequest();
//	}
//	// Or, initialize object for IE 6 and 5
//	else{
//		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//	}
//	
//	// To send your message to the server you use the 'open' function
//	// which takes 3 parameter: a string indicating we want to use GET,
//	// the url to the PHP file on the server with the query data added,
//	// and the last is a boolean setting Asynchronous mode to true.
//	xmlhttp.open("GET","login.php");
//	// Then send the message.
//	xmlhttp.send();
//	
//	
//	// Now we write code to handle any response from the server, done in the 
//	// onreadystatechange function you define like this..
//	xmlhttp.onreadystatechange= function() {
//		if (xmlhttp.readyState==4 && xmlhttp.status==200){
//			// The readyState==4 and status=200 are HTTP codes.
//			// If your status=404 the page is missing.
//			console.log("sucess");
//			document.getElementById("suggestions").innerHTML = xmlhttp.responseText;
//		}
//		else{
//			console.log("error");
//			// Handle if something went wrong getting the server response.
//			document.getElementById("suggestions").innerHTML = "Error getting data from server! HTTP.status=" + xmlhttp.status;
//		}
//		
//		return false;
//	}
}