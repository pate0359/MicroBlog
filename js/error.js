function errorMessage()
{
	alert(err);
	//Error message pop up
		var errorDiv = document.querySelector("#err_dialog");
		if (!errorDiv) {
			errorDiv = document.createElement("div");
			errorDiv.setAttribute("id", "err_dialog");
			document.body.appendChild(errorDiv);
		}
		errorDiv.style.display = 'block';
		errorDiv.innerHTML = "hello"; //err;
		//set timeout for error msg
		setTimeout(function () {
			errorDiv.style.display = 'none';
		}, 3000); //3secs
}