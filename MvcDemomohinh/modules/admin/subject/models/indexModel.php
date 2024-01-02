<?php

function get_lists_subject()
{
    $sql = "SELECT subjects.*,users.name as user_name FROM subjects INNER JOIN users ON users.id=subjects.creator_id ORDER BY subjects.id DESC";
    $data = getRaw($sql);
    return $data;
}

function get_subject_detail($id)
{
    $sql = "SELECT subjects.*,users.name as user_name FROM subjects INNER JOIN users ON users.id=subjects.creator_id WHERE subjects.id=$id ORDER BY id DESC";
    $data = firstRaw($sql);
    return $data;
}

function check_subject_exits($subject_code)
{
    $sql = "SELECT * FROM subjects WHERE mon_code='$subject_code'";
    $data = getRows($sql);
    return $data;
}


function get_one_examinations($id){
    $sql = "SELECT *  FROM examinations WHERE spring_block_id = {$id}";
    return getRaw($sql);
}

function get_one_subject_medias($id){
    $sql = "SELECT *  FROM subject_medias WHERE spring_block_id = {$id}";
    return getRaw($sql);
}

