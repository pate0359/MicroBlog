<?PHP 
			
	if (isset($_REQUEST['Submit'])) //here give the name of your button on which you would like    //to perform action.
	{
		 login();

	}else if (isset($_REQUEST['btnSignOut']))
	{
		logOut();

	}else if (isset($_REQUEST['Post'])){

		postText();
	}else if (isset($_REQUEST['btnSignUp'])){

		header('Location:signup.php');
	}	

/******************** Login ******************/
function login()
{
	include("config.php");
	
	$uName = isset($_POST['username']) ? $_POST['username'] : '';
    $uPass = isset($_POST['password']) ? $_POST['password'] : '';
	
	if ($uName != '' && $uPass != '')
	{
			// username and password sent from Form
			$myusername=addslashes($uName);
			$mypassword=addslashes($uPass);		

			// Hash the users password right away so the original value is hidden. 
			$mypassword = md5($mypassword);

			$sql="SELECT * FROM users WHERE user_name='$myusername' and user_hash='$mypassword'";
			echo $sql;
			$result = $pdo_link->query($sql);
				
			
			$count = $result->rowCount();
		

		echo $count;
			// If result matched $myusername and $mypassword, table row must be 1 row
			if($count==1)
			{
				$row = $result->fetch(PDO::FETCH_ASSOC);
				$userId=$row['user_id'];				
				$_SESSION['user_id']=$userId;
				$_SESSION['login_user']=$myusername;
				echo $userId;
				//header("location:index.php");
			}
			else
			{
				$error="Username or password is invalid.";
				echo $error;
			}
	}else
	{
		
		echo "Enter username and password";
	}
}

/******************** Log Out ******************/

function logOut()
{
	//unset session variable
	unset($_SESSION['login_user']);
	unset($_SESSION['user_id']);
	
	//destroy current session
	if(session_id() != '' || isset($_SESSION)) {
    	// session destroy
		session_destroy();
	}
	
	header("Location:index.php");
}

/******************** post message ******************/
function postText()
{
	include("config.php");
	$umsg = isset($_POST['Post']) ? $_POST['Post'] : '';
	
	if ($umsg != '')
	{
		include("config.php");

		// user mesasge
			$message=addslashes($umsg);

			try
				{
					$sql= "INSERT INTO messages (user_name,user_hash) VALUES ('".$myusername."','".$mypassword."')";
					echo $sql;
					$pdo_link->exec($sql);

					$last_id = $pdo_link->lastInsertId();
					$_SESSION['user_id']=$last_id;
				
					echo $last_id;
					header("Location:index.php");
					
				}catch(PDOException $e)
				{
					echo $sql . "<br>" . $e->getMessage();
				}

		echo $count;
			// If result matched $myusername and $mypassword, table row must be 1 row
			if($count==1)
			{
				echo "Username exist. Please choose another one.";
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
				
					echo $last_id;
					header("Location:index.php");
					
				}catch(PDOException $e)
				{
					echo $sql . "<br>" . $e->getMessage();
				}
			}
	}else
	{
		echo "Enter message to post";
	}
}

	
?>