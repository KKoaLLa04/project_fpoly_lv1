<?php

function get_lists_spring_blocks()
{
    $sql = "SELECT * FROM spring_blocks ORDER BY id DESC";
    return getRaw($sql);
}

function get_one_spring_bocks($id){
    $sql = "SELECT * FROM spring_blocks WHERE id = {$id}";
    return firstRaw($sql);
}

function get_one_examination_teachers($id){
    $sql = "SELECT *  FROM examination_teachers WHERE spring_block_id = {$id}";
    return getRaw($sql);
}

function get_one_examinations($id){
    $sql = "SELECT *  FROM examinations WHERE spring_block_id = {$id}";
    return getRaw($sql);
}

function get_one_subject_medias($id){
    $sql = "SELECT *  FROM subject_medias WHERE spring_block_id = {$id}";
    return getRaw($sql);
}