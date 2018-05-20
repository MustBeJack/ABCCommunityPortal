<?php

namespace classes\business;
use classes\data\SubscribeManagerDB;
use classes\entity\User;

class SubscribeManager{
    
    public function subscribe ($id, $email){
    $hashkey= md5($id);
    SubscribeManagerDB::subscribe($email , $id , $hashkey);
    }
    
    public static function getAllUsers(){
    
    return SubscribeManagerDB::getAllUsers();
    }
    
    
    public static function unsubscribe($id , $hashkey){
     SubscribeManagerDB::unsubscribe($id, $hashkey);
    }
    public static function getUserByEmail($email){
        return SubscribeManagerDB::getUserByEmail($email);
        
    }
    
    
}