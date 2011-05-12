<div id="page">
<?php

session_start();

//This file covers the login and logout procedures. Ideally, it should also contain a registration module, but we don't have it for this example.

require_once "db.php"; //Import the database functions that we are using for capsulating the access to the MySQL database


//This function contacts the database to verify the username and password
function check_user_login($user,$pass)
{
	$query = "SELECT id,level,email FROM users WHERE username='$user' AND  pass=MD5('$pass') LIMIT 1"; //LIMIT 1 is for optimization
	$result = db_query($query); //Note we have to use MD5 because that's how we store the passwords. Both PHP and MySQL have an MD5 function. This is the MySQL one.
	if ($result->num_rows == 0) return false; //No users with this combination of username and password is detected
	$row = db_get_row($result); //We return the array of the data we are interested in - user id, user email, user level
	return $row;
}

//Error message
function print_wrong_login()
{
	echo "<div class=\"error\">Username or password don't match</div>";
}

//Check if we are trying to logout. See header.php.
if (isset($_GET['logout']))
	session_destroy(); //Destroying the session effectively makes our website lose all login information

//This is the case where the user has pressed Submit and is trying to login
if (isset($_POST['login']))
{
	$row = check_user_login(db_escape($_POST['user']),db_escape($_POST['pass'])); //Remember to always escape user input!!! See db.php for details.
	
	if ($row && $row['id']>= 0) //The second check is not really necessary
	{
		//Put into the session all user data that we might need
		$_SESSION['uid'] = $row['id'];
		$_SESSION['username'] = $_POST['user'];
		$_SESSION['ulevel'] = $row['level'];
		$_SESSION['umail'] = $row['email'];
		//Calling "header" with "Location: index.php" will redirect to the main page.
		//Ideally, we should keep (in the session) the page from which we landed on the login and go back to it on successful login, but
		//we don't do it here, in order to keep the code simpler.
		header("Location: index.php");
		exit;
	}
	else print_wrong_login(); //Show an error message;
}

include "header.php";
//Can't include the header.php before this place, because it's an HTML output and then the "header" redirection would not work anymore - header must be called before any content is output to the page

?>



<!-- LOGIN FORM -->

<form method="post" action="login.php"> <!-- the action points to this same file. When the user submits, the isset($_POST['login']) check will return true -->
<!-- using the label fields is convenient but you can see the fields are not well arranged - a drawback compared to tables; can be fixed with some CSS tuning -->
	<label for="user">Username: </label>
	<input type="text" id="user" name="user"/>
	<br/>
	<label for="pass">Password: </label>
	<input type="password" id="pass" name="pass"/>
	<br/>
	<input type="submit" name="login" value="Login"/> <!-- we put a name to the submit button in order to check for submission - see up above -->
</form>

<?php

include "footer.php";

?>
</div>