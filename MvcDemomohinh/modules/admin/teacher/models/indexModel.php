<?php

function get_teacher_lists()
{
    $sql = "SELECT examination_teachers.*, examinations.* FROM examination_teachers INNER JOIN examinations ON examination_teachers.examination_id=examinations.id ORDER BY examination_teachers.id DESC";
    $data = getRaw($sql);
    return $data;
}
