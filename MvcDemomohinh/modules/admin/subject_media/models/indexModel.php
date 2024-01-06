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


function get_count_exam()
{
    $sql = "SELECT * FROM examinations";
    return getRows($sql);
}

// dem so luong de thi
function get_count_media($subject_id, $spring_block_id)
{
    $sql = "SELECT * FROM subject_medias WHERE subject_id=$subject_id AND spring_block_id=$spring_block_id";
    return getRows($sql);
}

function get_count_media_byid($id)
{
    $sql = "SELECT * FROM subject_medias WHERE subject_id=$id";
    return getRows($sql);
}

function get_examination($subject_id, $spring_block_id)
{
    $sql = "SELECT * FROM examinations WHERE subject_id=$subject_id AND spring_block_id = $spring_block_id";
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

function subject_media($id)
{
    $sql = "SELECT * FROM `subject_medias` WHERE  `subject_medias`.`subject_id`=$id";
    $data = firstRaw($sql);
    return $data;
}

function get_examination_radom($subject_id, $spring_block_id)
{
    $sql = "SELECT * FROM `examinations` WHERE subject_id=$subject_id AND spring_block_id=$spring_block_id";
    echo $sql;
    $data = getRaw($sql);
    return $data;
}

function get_count_media_random($subject_id, $spring_block_id)
{
    $sql = "SELECT * FROM subject_medias WHERE subject_id=$subject_id AND spring_block_id=$spring_block_id";
    return getRows($sql);
}

function get_count_ex_media_random($examination_id)
{
    $sql = "SELECT * FROM examination_medias WHERE subject_media_id=$examination_id";
    return getRows($sql);
}



function get_one_examination_media($id)
{
    $sql = "SELECT *  FROM examination_medias WHERE subject_media_id = {$id}";
    return getRaw($sql);
}

// Lấy thông tin những môn học có trong lịch thi
function get_lists_subject_toExam()
{
    $sql = "SELECT subjects.*, count(examinations.subject_id) FROM subjects INNER JOIN examinations ON examinations.subject_id=subjects.id GROUP BY examinations.subject_id ORDER BY subjects.id DESC";
    $data = getRaw($sql);
    return $data;
}

function check_exam_media($examination_id)
{
    $sql = "SELECT * FROM examination_medias WHERE examination_id=$examination_id";
    return getRows($sql);
}
