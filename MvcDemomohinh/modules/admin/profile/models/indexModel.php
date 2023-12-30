<?php

function check_pass($id){
    $sql = "SELECT users.password FROM `users` WHERE `users`.`id`=$id";
    return firstRaw($sql);
}

function get_infomation($id){
    $sql = "SELECT * FROM `users` WHERE `users`.`id`=$id";
    return firstRaw($sql);

}