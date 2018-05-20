<?php
session_start();
require_once '../../includes/autoload.php';
include '../../includes/header.php';
use classes\business\UserManager;
$existuser = [];
?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SEARCH USER</title>
<link rel="stylesheet" href="../../css/bootstrap.css">
<link rel="stylesheet" href="../../css/table.css">	
<br><br>
	<div class="container">
		<div class="row">				
				<div class="col-md-6 col-md-offset-3">				
					<br>
						<h2 style="text-align:center">Search User</h2>
				</div>
			<div class="col-lg-4"><!--OFFSET--></div>		
		</div>
	</div>
</br>
	
	<form action="searchuser.php" method="post">	
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
					<input type="text" class="form-control" name="firstname" placeholder="First Name">
						<hr>
			
				
					<input type="text" class="form-control" name="lastname" placeholder="Last Name">
					<hr>
					
					
						<button class="btn btn-outline-primary" type="submit" name="button" method="post">Search</button>
					<hr>
					</div>
			</div>
		</form>
				

<?php
if(isset($_POST['button'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

  
    $UM=new UserManager();
    $existuser=$UM->searchUser($firstname, $lastname);
    
           
    if(is_null($existuser)){
        echo "No User Found<br><br>";
    };

	
}
?>
<div class="container">
		<div class="row">
<div class="col-md-6 col-md-offset-3">
<table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">E-mail</th>
        </tr>
      </thead>
<?php 
if (is_null($existuser)){
    
}
else{
//     var_dump($existuser);
    foreach ($existuser as $user) {
       if($user!=null){
//            var_dump($user);
           ?>
            <tr>
               <td><?=$user->firstName?></td>
               <td "><?=$user->lastName?></td>
               <td><?=$user->email?></td>
            </tr>
      <?php
        };
    };
};
 

?>
</table>

<?php
// }	
// 	}
?>

<?php
//include '../../includes/footer.php';
?>