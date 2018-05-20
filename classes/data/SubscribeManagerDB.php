<?php
namespace classes\data;
// use mysqli;
use classes\entity\User;
use classes\util\DBUtil;
// use mysqli;

class SubscribeManagerDB{
//     static function saveuseremail($id,$email,$hashkey){
//         $user=NULL;
// //         $conn=DBUtil::getConnection();
//         $conn = new mysqli('localhost','root','root123','phpcrudsample');
//         $email=mysqli_real_escape_string($conn,$email);
//         //$password=mysqli_real_escape_string($conn,$password);
//         $sql="INSERT INTO `tb_subscribe`(`Email`, `Id` , `hashkey`) VALUES ('$email','$id' ,'$hashkey');";
//        echo $sql;
//         $result = $conn->query($sql);
     
//         $conn->close();
//         return "ok";
//     }

    public static function fillUser($row){
        $user=new User();
        $user->id=$row["Id"];
        $user->email=$row["Email"];
        $user->hashkey=$row["hashkey"];
        return $user;
    }
    
    public static function getAllUsers(){
        $users[]=array();
         $conn=DBUtil::getConnection();
//         $conn = new mysqli('localhost','root','root123','phpcrudsample');
        $sql="select * from tb_subscribe";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
                $users[]=$user;
            }
        }
        $conn->close();
        return $users;
    }
    public static function unsubscribe($id,$hashkey){
         $conn=DBUtil::getConnection();
//         $conn = new mysqli('localhost','root','root123','phpcrudsample');
        $sql="delete from tb_subscribe where id='$id' and hashkey= '$hashkey'";
        $conn->query($sql);
        $conn->close();
    }
    
    
    public static function subscribe($email,$id,$hashkey){
        $conn=DBUtil::getConnection();
//         $conn = new mysqli('localhost','root','root123','phpcrudsample');
        $sql="insert into tb_subscribe (Email , Id , hashkey) VALUES ('$email','$id' ,'$hashkey')";
        $conn->query($sql);
        $conn->close();
    }
    
    public static function getUserByEmail($email){
        $user=null;
        $conn=DBUtil::getConnection();
        $email = mysqli_real_escape_string($conn, $email);
        //         $conn = new mysqli('localhost','root','root123','phpcrudsample');
        $sql="select * from tb_subscribe where Email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
    
    
}