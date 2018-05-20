<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;
use classes\business\SubscribeManager;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';

$UM=new UserManager();
$users=$UM->getAllUsers();

if(isset($users)){
    ?>
	<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
    <br/><br/>Below is the list of Developers registered in community portal <br/><br/>
                <form action="bulkemail.php" method="post">
              <input type="submit" name="go" value="bulkemail.php">
    <table class="pure-table pure-table-bordered" width="800" align="center">
            <tr>
			<thead>
                <th>Checkbox</th>
               <th><b>Id</b></th>
               <th><b>First Name</b></th>
               <th><b>Last Name</b></th>
               <th><b>Email</b></th>
			   <th><b>Operation</b></th>
<!--          <form action="bulkemail.php" method="get"> -->
<!--          <input type="submit" name="go" value="bulkemail.php">
			   </form> -->
         </thead>
            </tr> 
    <?php 
    foreach ($users as $user) {
        if($user!=null){
            ?>
            <tr>
            
               <td><input type="checkbox" name="check_list[]" value="<?=$user->email?>"
               <?php
               $SM= new SubscribeManager();
               $subscribeuser = $SM->getUserByEmail($user->email);
               if ($subscribeuser == NULL){
                   echo "disabled='disabled'";
               }
               
               ?>></td>
               <td><?=$user->id?></td>
               <td><?=$user->firstName?></td>
               <td><?=$user->lastName?></td>
               <td><?=$user->email?></td>
			   <td>
					<a href='editusersprofile.php?id=<?php echo $user->id ?>'>Edit</a>
          <a href='deleteuser.php?id=<?php echo $user->id ?>'>Delete</a>
			   </td>
            </tr>
            <?php 
        }
    }
    ?>
    </table><br/><br/></form> 
    <?php 
}
?>




<?php
include '../../includes/footer.php';
?>