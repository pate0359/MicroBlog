<?PHP
ob_start(); 
if (session_status() == PHP_SESSION_NONE) {
    	session_start();
}

if (isset($_REQUEST['signedUp'])) //here give the name of your button on which you would like to perform action.
{
	signUp();
	
}else if (isset($_REQUEST['cancel']))
{
	cancel();
}

function  signUp(){
	
	 $uName = isset($_POST['userName']) ? $_POST['userName'] : '';
    $uPass = isset($_POST['userPassword']) ? $_POST['userPassword'] : '';
	
	
	if ($uName != '' && $uPass != '')
	{
		include("config.php");
		
			// username and password sent from Form
			$myusername=addslashes($uName);
			$mypassword=addslashes($uPass);		

			// Hash the users password right away so the original value is hidden. 
			$mypassword = md5($mypassword);

			$sql="SELECT * FROM users WHERE user_name='$myusername' and user_hash='$mypassword'";
			//echo $sql;
			$result = $pdo_link->query($sql);
			$count = $result->rowCount();

		//echo $count;
			// If result matched $myusername and $mypassword, table row must be 1 row
			if($count==1)
			{
				$err="<p class=\"errorP\">Username exist. Please choose another one.</p>";
				
				echo $err; //"<script type=\"text/javascript\">errorMessage(); </script>" ;
			}
			else
			{
				try
				{
					$sql= "INSERT INTO users (user_name,user_hash) VALUES ('".$myusername."','".$mypassword."')";
					echo $sql;
					$pdo_link->exec($sql);

					$last_id = $pdo_link->lastInsertId();
					$_SESSION['user_id']=$last_id;
					$_SESSION['login_user']=$myusername;
					
//					echo $_SESSION['user_id'];
//					echo $_SESSION['login_user'];
					header("location:index.php");
					
				}catch(PDOException $e)
				{
					echo $sql . "<br>" . $e->getMessage();
				}
			}
	}else
	{
		$error="<p class=\"errorP\">Enter username and password</p>";
		echo $error;
	}
}

function  cancel(){
//	echo "cancel";
//	header('location:index.php');
	header('Location:index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">

	<title>MAD9023 - Bootstrap - CodePen</title>

	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
	<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600,200' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

<body>
	<div id="wrap" class="margin-botom-3">

		<div class="bg"></div>

		<div class="container">
			<div class="row margin-top-5">
				<div class="col-xs-12 text-left">
					<h1>Sign up to post on this page</h1>
				</div>
			</div>
			<div class="row margin-top-5 margin-top-10">
				<div class="col-xs-12 text-left">
					<h3>Please enter name and password.</h3>
				</div>
			</div>
			<hr>
			</br>
			</br>

			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-offset-2 formbg">
					<form class="form-login margin-top-20" name="form_login" method="post" action="signup.php" role="form">
						<fieldset>
<!--					<div class="form-login margin-top-20">-->
						<label class="control-label" for="parameterValue">Name</label>
						<input type="text" id="userName" name="userName" class="form-control chat-input" placeholder="name" />
						</br>
						<label class="control-label" for="parameterValue">Password</label>
						<input type="password" id="userPassword" name="userPassword" class="form-control chat-input" placeholder="password" />
						</br>
<!--						<div class="wrapper">-->
							<div class="col-lg-8 col-md-10 col-sm-8 col-xs-10 col-lg-offset-4 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 margin-top-20 margin-bottom-20">
								<input type="submit" id="signedUp" name="signedUp" value="Sign Up" class="btn btn-primary">
								<input type="submit" id="cancel" name="cancel" value="Cancel" class="btn btn-primary margin-left-20">
							</div>					
					</fieldset>
					  </form>

				</div>
			</div>
		</div>
	</div>

	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/signup.js"></script>
	<script src="js/error.js"></script>
</body>

</html>