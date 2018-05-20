<?php
require_once '../../includes/autoload.php';
include '../../includes/header.php';
include '../../includes/password.php';
use classes\business\UserManager;
use classes\business\SubscribeManager;
use classes\entity\User;
use classes\data\SubscribeManagerDB;


$formerror="";

$firstName="";
$lastName="";
$email="";
$password="";
$subscribe = "1";

if(isset($_REQUEST["submitted"])){
    $firstName=$_REQUEST["firstName"];
    $lastName=$_REQUEST["lastName"];
    $email=$_REQUEST["email"];
    $password=$_REQUEST["password"];
    $subscribe = isset($_REQUEST["subscribe"]);


// $hash_password = md5($password);
    $password = password_hash($password,PASSWORD_DEFAULT);




    
    if($firstName!='' && $lastName!='' && $email!='' && $password!=''){
        $UM=new UserManager();
        $user=new User();
        $user->firstName=$firstName;
        $user->lastName=$lastName;
        $user->email=$email;
        $user->password=$password;
        $user->role="user";
        

        $existuser=$UM->getUserByEmail($email);
    
        if(!isset($existuser)){
            // Save the Data to Database
            $UM->saveUser($user);
            if (isset($_POST ["subscribe"])){
            $UM = new UserManager();
            $existuser = $UM ->getUserByEmail($email);
            $id = $existuser ->id;
            $SM = new SubscribeManager();
            //echo $email;
            //echo $id;
            $SM -> subscribe($id,$email);
            
            }
                
//             $sub = new Subscribe();
//             $id = $sub -> getUserByEmail($email)->id;
            
            
//            header("Location:registerthankyou.php");
       		echo '<meta http-equiv="Refresh" content="1; url=./registerthankyou.php">';
        }
        
        
        else{
            $formerror="User Already Exist";
        }
    }else{
        $formerror="Please fill in the fields";
    }
}
?>
<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
<form name="myForm" method="post" class="pure-form pure-form-stacked">
<h1>Registration Form</h1>
<div><?=$formerror?></div>
<table width="800">
  <tr>
    <td>First Name</td>
    <td><input type="text" name="firstName" value="<?=$firstName?>" size="50"></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input type="text" name="lastName" value="<?=$lastName?>" size="50"></td>
  </tr>
  <tr>    
    <td>Email</td>
    <td><input type="text" name="email" value="<?=$email?>" size="50"></td>
  </tr>
  <tr>    
    <td>Password</td>
    <td><input type="password" name="password" value="<?=$password?>" size="20"></td>
  </tr>  
  <tr>    
    <td>Confirm Password</td>
    <td><input type="password" name="cpassword" value="<?=$password?>" size="20"></td>
  </tr>  
  <tr>
  <td>Subscribe to newsletter
  <td> <input type="checkbox" name="subscribe" value="1" checked ></td>
  </tr>
  <tr>
   <br> <td>
       <input type="submit" name="submitted" value="Submit">
       <input type="reset" name="reset" value="Reset">
    </td>
  </tr>
</table>
</form>

<?php
include '../../includes/footer.php';
?>