<?php

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
