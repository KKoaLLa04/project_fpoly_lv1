<?php 
function login($email,$pass){
    $result = db_fetch_array("SELECT * FROM users WHERE email ='{$email}' AND password ='{$pass}'");
    return $result;
}

?>