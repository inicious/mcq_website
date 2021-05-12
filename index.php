<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome to Online Exam</title>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="quiz.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
include("database.php");
extract($_POST);
if(isset($submit))
{
	$rs=mysqli_query($con,"select * from mst_user where login='$loginid' and pass='$pass'");
	if(mysqli_num_rows($rs)<1)
	{
		$found="N";
	}
	else
	{
		$row = mysqli_fetch_array($rs);
		$_SESSION['login']=$loginid;
		$_SESSION['user_id']=$row['user_id'];
		header("Location: quiz.php");

	}
}
?>
<table width="100%" border="0">
  	<tr>
    	<table align="center" border="0" WIDTH="50%" height="250">
			<h1 class="text-center bg-warning">LOGIN PAGE</h1>
			<form method="post" action="">
				<tr>
					<th class="text-primary">LOGIN ID</th>
					<th>
						<input class="form-control"type="TEXT" title="enter your regitered LOGIN ID"  placeholder="LOGIN ID"  maxlength="10" size="25"  id="loginid2" name="loginid"/>
					</th>
				</tr>
				<tr>
					<th class="text-primary">ENTER PASSWORD</th>
					<th><input class="form-control" type="password" name="pass" id="pass2"/></th>
				</tr>
	  			<tr>
					<th class="errors">
						<input class="btn btn-danger "type="submit" name="submit" id="submit" Value="Login"/>
						<a class="btn btn-success " href="signup.php">New user ? click here</a>
					</th>
					<?php if(!empty($found)){
					echo '<th class="text-primary">Invalid Username or Password</th>';
					} ?>
				</tr>
			</form>
    	</table>
  	</tr>
</table>
</body>
</html>
