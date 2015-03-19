<?PHP 
ob_start(); 
			
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

//	fetchMessage();

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
			//echo $sql;
			$result = $pdo_link->query($sql);
				
			
			$count = $result->rowCount();
		

		//echo $count;
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
				$error="<p class=\"errorP\">Username or password is invalid.</p>";
				echo $error;
			}
	}else
	{
		$error="<p class=\"errorP\">Enter username and password</p>";
		echo $error;
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
//	//echo date_default_timezone_get();
//	date_default_timezone_set('America/New_York');
//	$today = date("F-j-Y, g:i:s"); 
//	echo $today;
	
//	$time = currentt();
//	echo $time;
	
	include("config.php");
	$umsg = isset($_POST['message']) ? $_POST['message'] : '';
	$userId=isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
//	echo umsg;
//	echo "userIs - ".$userId;
	
	if ($umsg != '' && $userId != '')
	{
		include("config.php");

		// user mesasge
			$message=addslashes($umsg);
			try
				{
					$sql= "INSERT INTO messages (message_text,user_id,time_stamp) VALUES ('".$message."','".$userId."',CURRENT_TIMESTAMP)";
					//echo $sql;
					$pdo_link->exec($sql);

					$last_id = $pdo_link->lastInsertId();
				
					//echo $last_id;
//					header("Location:index.php");
					
				}catch(PDOException $e)
				{
					echo $sql . "<br>" . $e->getMessage();
				}
	}else
	{
		$error="<p class=\"errorP\">Enter message to post.</p>";
		echo $error;
	}
}

/******************** Fetch messages ******************/

function fetchMessage()
{
	include("config.php");
	$messages="";
	
//	$sql="SELECT * FROM messages.message_text,messages.time_stamp, users.user_name FROM messages INNER JOIN ON messages.user_id=users.usr_id ";
	$sql ="SELECT * FROM messages INNER JOIN users ON messages.user_id=users.user_id";
//	echo $sql;
	$result = $pdo_link->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);
	
	$count = $result->rowCount();
	if($count == 0)
	{
		$messages="Be first to share your thought ! ";
	}
	
	 while( $row = $result->fetch() )
     {
		 //$userName=getUserName($row['user_id']);
		 $timestamp= $row['time_stamp'];
		 $username = $row['user_name'];
//		 echo $username;
		 
//		 $datetime = date('Y-m-j g:i:s', $timestamp);
		 $datetime = date("Y-m-j g:i a",strtotime($timestamp));
		 
//		 echo $datetime;
		 $messages = $messages . "<div class=\"row margin-top-2\">
				<div class=\"col-lg-12 col-lg-10 col-lg-offset-1\">
					<label class=\"control-label\" for=\"parameterValue\">".$username."</label>
					<p>".$row['message_text']."</p>
					<label class=\"control-label navbar-right margin-right-10\" for=\"parameterValue\">".$datetime."</label>
				</div>
			</div><hr>";
		 
         //echo "<p>Product Name -> " . $row['message_text'] . "</p>\n\t\t";
     }
	echo $messages;
}

//function getUserName($userId)
//{
//	include("config.php");
//	
//	$sql="SELECT user_name FROM users WHERE user_id=".$userId."";
////	echo $sql;
//	$result = $pdo_link->query($sql);
//	$row = $result->fetch(PDO::FETCH_ASSOC);
//	$username = $row['user_name'];
////	echo $username;
//	return $username;
//	}	
?>