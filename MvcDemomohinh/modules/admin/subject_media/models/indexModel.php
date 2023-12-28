<?php

function get_subject_media_lists()
{
    $sql = "SELECT subject_medias.*, users.name as user_name, spring_blocks.name as spring_name, subjects.name as subject_name FROM subject_medias INNER JOIN users ON users.id=subject_medias.creator_id INNER JOIN spring_blocks ON spring_blocks.id=subject_medias.spring_block_id INNER JOIN subjects ON subjects.id=subject_medias.subject_id ORDER BY subject_medias.spring_block_id DESC";
    return getRaw($sql);
}

    

function get_subject_lists()
{
    $sql = "SELECT * FROM subjects ORDER BY id DESC";
    return getRaw($sql);
}



function get_spring_block()
{
    $sql = "SELECT * FROM spring_blocks ORDER BY id DESC";
    return getRaw($sql);
}


function get_count_exam()
{
    $sql = "SELECT * FROM examinations";
    return getRows($sql);
}

// dem so luong de thi
function get_count_media()
{
    $sql = "SELECT * FROM subject_medias";
    return getRows($sql);
}

function get_count_media_byid($id)
{
    $sql = "SELECT COUNT(*) FROM subject_medias";
    return getRows($sql);
}

function get_examination()
{
    $sql = "SELECT * FROM examinations";
    return getRaw($sql);
}

function get_subject_media($subject_id, $spring_block_id)
{
    $sql = "SELECT * FROM subject_medias WHERE subject_id=$subject_id AND spring_block_id=$spring_block_id";
    return getRaw($sql);
}

function get_list_subject_medias($id)
{
    $sql = "SELECT subject_medias.*, users.name as user_name, spring_blocks.name as spring_name, subjects.name as subject_name FROM
    subject_medias INNER JOIN users ON users.id=subject_medias.creator_id INNER JOIN spring_blocks ON
    spring_blocks.id=subject_medias.spring_block_id INNER JOIN subjects ON subjects.id=subject_medias.subject_id WHERE subject_medias.subject_id=$id";

    // $sql = "SELECT * FROM subject_medias WHERE subject_medias.subject_id=$id";
    $data = getRaw($sql);
    return $data;
}

function subject_media($id){
    $sql = "SELECT * FROM `subject_medias` WHERE  `subject_medias`.`subject_id`=$id";
    $data = firstRaw($sql);
    return $data;
}

Function get_examination_radom($subject_id,$spring_block_id){
    $sql = "SELECT * FROM `examinations` WHERE subject_id=$subject_id AND spring_block_id=$spring_block_id";
    $data = getRaw($sql);
    return $data;

}

function get_count_media_random($subject_id,$spring_block_id)
{
    $sql = "SELECT * FROM subject_medias WHERE subject_id=$subject_id AND spring_block_id=$spring_block_id";
    return getRows($sql);
}