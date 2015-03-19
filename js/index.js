document.addEventListener("DOMContentLoaded", function(){

	document.querySelector("#signinNav").style.display="none";
//	document.querySelector(".messagesubview").innerHTML="";
	
	document.querySelector("#btnSignIn").addEventListener("click",function(){
		
		document.querySelector("#signinNav").style.display="block";
		document.querySelector("#defaultNav").style.display="none";
		
	});
});
