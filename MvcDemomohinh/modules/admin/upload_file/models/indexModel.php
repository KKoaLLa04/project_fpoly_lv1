<?php
function get_lists_examination()
{
    $sql = "SELECT examinations.*, users.name as user_name, spring_blocks.name as spring_name, subjects.name as subject_name FROM examinations INNER JOIN users ON users.id=examinations.creator_id INNER JOIN spring_blocks ON spring_blocks.id=examinations.spring_block_id INNER JOIN subjects ON subjects.id=examinations.subject_id WHERE examinations.spring_block_id";
    return getRaw($sql);
}
function get_examination_detail()
{
    $sql = "SELECT * FROM examinations ORDER BY start_date ASC";
    return getRaw($sql);
}
function get_one_examination($id)
{
    $sql = "SELECT * FROM examinations WHERE id = {$id}";
    return firstRaw($sql);
}
function get_spring_block()
{
    $sql = "SELECT * FROM spring_blocks ORDER BY id DESC";
    return getRaw($sql);
}

function get_one_spring_block()
{
    $sql = "SELECT * FROM spring_blocks ORDER BY id DESC";
    return firstRaw($sql);
}

function get_subject_detail($mon_code)
{
    $sql = "SELECT * FROM subjects WHERE mon_code='$mon_code'";
    return firstRaw($sql);
}

function check_email_exitst($email)
{
    $sql = "SELECT * FROM users WHERE email='$email'";
    return getRows($sql);
}
