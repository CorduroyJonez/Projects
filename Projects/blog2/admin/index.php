<?php 

session_start();

require 'connection.php';

if( isset($_SESSION['id']))
{
	header("Location: postlist.php");
}

if (!empty($_POST['username']) && !empty($_POST['password']))
{
	
	$records = $link->prepare('SELECT id, username, password FROM users WHERE username = :username');
	$records->bindParam(':username', $_POST['username']);

	$records->execute();

	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message='';

	if(count($results) > 0 && password_verify($_POST['password'], $results['password']))
	{
		$_SESSION['id']=$results['username'];
		header("Location: postlist.php");
	}
	else 
	{
		$message="Sorry, those credentials do not match";
	}

}
	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/styles.css" type="text/css">
</head>
<body>

	<div class='container'>
		<div class='col-sm-12 heading'>

			<?php 
				if (!empty($message)) 
					{ 
						echo "<div class='alert alert-danger'>".$message."</div>";
					} 
			?>

			<h1>Please Login Below</h1>
			<form method='POST'>
				<div class='form-group'>
					<label for='username'>Username</label>
					<input class='form-control' type='text' name='username' placeholder='Username' value='<? echo addslashes($_POST['username']); ?>' />

				</div>
				<div class='form-group'>
					<label for='password'>Password</label>
					<input class='form-control' type='password' name='password' placeholder='password' value='<? echo addslashes($_POST['password']); ?>'>
				</div>

					<input type='submit' name='submit' value="Log In!" class='btn btn-success btn-lg'>

			</form>

		</div>
	</div>

</body>
</html>