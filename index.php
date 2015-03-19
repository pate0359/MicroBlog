<?PHP
ob_start(); 
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

$error="";

include('login.php');

if(isset($_SESSION['login_user']))
		{

	$nav='<div id="pageNav" class="row margin-top-2 col-lg-10 col-lg-offset-1">
							<div class="nav navbar navbar-right">
							<form class="navbar-form ">
							<label class="control-label margin-left-10 margin-right-20" for="parameterValue"><h4>Welcome '.$_SESSION['login_user'].' !</h4></label>
							<input type="submit" name="btnSignOut" value="Sign Out" class="btn btn-default">
							</form>
							</div>
							</div>';
}else
{
	$nav='<div id="defaultNav" class="row margin-top-2 col-lg-10 col-lg-offset-1">
					<div class="nav navbar navbar-right">
					<form class="navbar-form">
					<input type="submit" id="btnSignUp" name="btnSignUp" value="Sign Up" class="btn btn-default">
					<span class="margin-left-10 margin-right-10"> OR </span>
					<input type="button" id="btnSignIn" name="btnSignIn" value="Sign In" class="btn btn-default">
					</form>
					</div>
					</div>';
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Micro Blog</title>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<script src="js/error.js"></script>
</head>
<body>
<!--	Error dialog-->
	<?PHP
		$err = $GLOBALS['error'];		
		if ($err != '')
		{
			echo "<script> errorMessage('$err');</script>" ;
		}
	?>
	
	<!-- Wrap all page content here -->
	<div id="wrapper">
		<div class="container margin-bottom-2">
			<?PHP 
				echo $nav;
			?>	
<!--			<div class="top">-->
			
			<div id="signinNav" class="row margin-top-20 col-lg-10 col-lg-offset-1">
				<div class="nav navbar navbar-right">
					<form class="navbar-form" name="form_login" method="post" action="index.php" role="form">
						<fieldset>
							<label class="control-label" for="parameterValue">Username :</label>
							<input name="username" class="form-control" type="text" id="username" placeholder="Email Address">
							<label class="control-label margin-left-10" for="parameterValue">Password :</label>
							<input type="password" class="form-control" name="password" id="password" placeholder="Password">
							<input type="submit" name="Submit" value="Sign In" class="btn btn-default">
						</fieldset>
					  </form>
				</div>
			</div>
<!--			</div>-->
			<div class="row margin-top-2">
				<div class="col-lg-10 col-lg-offset-1">
			<?PHP 
		if(isset($_SESSION['login_user']))
		{
			$footer='<div id="footer">
			<div class="container">
			<div class="row col-lg-10 col-lg-offset-1">
			<form class="navbar-form" method="POST" action="index.php">
			<div class="form-group-lg col-lg-8">
			<input type="text" name="message" id="message" class="form-control input-xlg chat-input" placeholder="Share your thought !">
			</div>
			<input type="submit" name="Post" value="Post" class="btn btn-default input-lg">
			</form>
			</div>
			</div>
			</div>';
			echo $footer;
		}
	?>
				</div>
			</div>
			<div class="row margin-top-2">
				<div class="col-lg-10 col-lg-offset-1">
					
					<h1>News Feed </h1>
<!--					<hr>-->
					</br>
				</div>
			</div>

		<div class="messageview">
			<div class="col-lg-10 col-lg-offset-1 messagesubview">
			<?PHP
				fetchMessage(); //echo $messages;
			?>
				</div>
		</div>
		</div>	
	
	<div id="err_dialog"></div>
	</div>

	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
	<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600,200' rel='stylesheet' type='text/css'>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/index.js"></script>
	
</body>

</html>