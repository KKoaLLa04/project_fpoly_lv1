<?php
function check_login($email)
{
    $result = firstRaw("SELECT * FROM users WHERE email ='{$email}'");
    return $result;
}

function check_email_exits($email)
{
    $sql = "SELECT * FROM users WHERE email='$email'";
    $data = getRows($sql);
    return $data;
}

function check_token_exits($token)
{
    $sql = "SELECT * FROM users WHERE forgotToken='$token'";
    return getRows($sql);
}
