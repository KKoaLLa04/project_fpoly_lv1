<?php

function get_subject_media_lists()
{
    $sql = "SELECT subject_medias.*, users.name as user_name, spring_blocks.name as spring_name, subjects.name as subject_name FROM subject_medias INNER JOIN users ON users.id=subject_medias.creator_id INNER JOIN spring_blocks ON spring_blocks.id=subject_medias.spring_block_id INNER JOIN subjects ON subjects.id=subject_medias.subject_id ORDER BY subject_medias.spring_block_id DESC";
    return getRaw($sql);
}
function get_subject_detail($id)
{
    $sql = "SELECT subject_medias.*, users.name as user_name, spring_blocks.name as spring_name, subjects.name as subject_name FROM subject_medias INNER JOIN users ON users.id=subject_medias.creator_id INNER JOIN spring_blocks ON spring_blocks.id=subject_medias.spring_block_id INNER JOIN subjects ON subjects.id=subject_medias.subject_id WHERE subject_medias.id=$id";
    $data = firstRaw($sql);
    return $data;
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
