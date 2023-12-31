<?php

function get_lists_examination_detail($id)
{
    $sql = "SELECT examinations.*, users.name as user_name, subjects.name as subject_name, spring_blocks.name as spring_name FROM examinations INNER JOIN users ON users.id=examinations.creator_id INNER JOIN subjects ON subjects.id=examinations.subject_id INNER JOIN spring_blocks ON spring_blocks.id=examinations.spring_block_id WHERE examinations.id=$id";
    return getRaw($sql);
}
function get_lists_examination()
{
    $sql = "SELECT * FROM examinations ORDER BY start_date ASC";
    return getRaw($sql);
}

function get_one_examination($id)
{
    $sql = "SELECT * FROM examinations WHERE id = {$id}";
    return firstRaw($sql);
}
