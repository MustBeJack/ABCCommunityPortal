<?php
session_start();
use classes\business\UserManager;
use classes\business\Validation;
include 'includes/header.php';
include 'includes/password.php';
$formerror="";
$email="";
$password="";
$error_auth="";
$error_name="";
$error_passwd="";
$error_email="";
$validate=new Validation();


if(isset($_POST["submitted"])){
 
    $email=$_POST["email"];
    $password=$_POST["password"];

	if($validate->check_password ($password, $error_passwd))
	{
		$UM=new UserManager();

		$existuser=$UM->getUserByEmail($email);
    $hash_password = $existuser->password;
    echo password_verify($password,$hash_password);

		if(isset($existuser) && password_verify($password,$hash_password)){
			
			$_SESSION['email']=$email;
      $_SESSION['role']= $existuser ->role;
			$_SESSION['id']=$existuser->id;
			echo '<meta http-equiv="Refresh" content="0; url=home.php">';
		}else{
			$formerror="Invalid User Name or Password";
		}
	}
//}
}

?>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"  href="css/bootstrap.css">
<!-- Boostrap End -->
<div class="container-fluid">
<div class="col-md-6 col-md-offset-3">
<script src='http://www.google.com/recaptcha/api.js'></script>
<h1>Login</h1>
<form name="myForm" method="post" class="pure-form pure-form-stacked">
<table border='0' width="100%">
  <tr>    
    <td>Email</td>
    <td><input type="email"  name="email" value="<?=$email?>" pattern=".{1,}"   required title="Cannot be empty field" size="30" class ="form-control" placeholder="Email"></td>
	<td><?php echo $error_name?>
  </tr>
  <tr>    
    <td>Password</td>
    <td><input type="password" name="password" value="<?=$password?>"  size="30" class="form-control" id="inputPassword" placeholder="Password" ></td>
	<td><?php echo $error_passwd?>
  </tr> 
<tr>

</tr>
<td></td>


  <tr>
    <td></td>
    <td><br><input type="submit" name="submitted" value="Submit" class="btn btn-primary">
    <!-- <input type="reset" name="reset" value="Reset" class="btn btn-primary"> -->
  <a class="btn btn-info" href="modules/user/register.php">Register Now</a></td>
    </td>
  </tr>
  <tr> <?php echo $formerror?></tr>
  <tr>
  <td></td>
    <td>
       <br>
	   <a class="btn btn-link" href="./forgetpassword.php">Forget Password</a>
    </td>
  </tr>   
</table>
</form>
</div>
  </div>
<?php
include 'includes/footer.php';
?>