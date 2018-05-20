<?php

require_once '../../includes/autoload.php';
use classes\business\UserManager;
use classes\business\SubscribeManager;

$UM = new UserManager();
$SM = new SubscribeManager();

$id = $_GET['id'];
$hashkey = $_GET['hashkey'];

echo $id."</br>";
echo $hashkey;

if ($id != NULL && $hashkey != NULL){
    if (isset($_POST['no'])){
        echo "You are still subscribed to our mailing list.";
        header("URL=http://localhost/phpcrudsample/public/frontpage.php");

    } else if (isset($_POST['yes'])){
        $SM -> unsubscribe($id, $hashkey);
        echo "You have successfully unsubscribe from our mailing list.";
    } else {?>
      
<div class="">
  <form method="post">
    <p>Do you want to unsubscribe from our mailling list?</p> 
    <button name = "yes">Yes</button>
    <button name ="no">No</button>
  </form>
</div>
      
      
<?php  
    }
}
?>




