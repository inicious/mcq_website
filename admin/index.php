<?php
session_start();
include("../database.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administrative Login - Online Exam</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../quiz.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/bootstrap.min.css"/>

</head>

<body>
<?php
extract($_POST);
if(isset($submit))
{
  $rs=mysqli_query($con,"select * from mst_admin where loginid='$loginid' and pass='$pass'") or die(mysqli_error($con));
  if(mysqli_num_rows($rs)<=0)
  {
   $found="N";
  }
  else
  {
    $row = mysqli_fetch_array($rs);
    print_r($row);
    $_SESSION['login_id']=$row['id'];
    header("Location: testview.php");

  }
}
?>

<h1 class="text-center bg-danger">Adminstrative Login</h1>
<form name="form1" method="post" action="">
<table class="table table-striped">
  <tr>
    
    
    <td width="238"><table width="219" border="0" align="center">
  <tr>
    <td width="163" class="style2">Login ID </td>
    <td width="149"><input class="form-control" name="loginid" type="text" id="loginid"></td>
  </tr>
  <tr>
    <td class="style2">Password</td>
    <td><input class="form-control" name="pass" type="password" id="pass"></td>
  </tr>
  <tr>
    <td class="style2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="style2">&nbsp;</td>
    <td><input class="btn btn-primary" name="submit" type="submit" id="submit" value="Login"></td>
    
  </tr>
  <?php if(!empty($found)){
          echo '<tr class="text-primary">Invalid Username or Password</tr>';
          } ?>
</table></td>
  </tr>
</table>

</form>

</body>
</html>
