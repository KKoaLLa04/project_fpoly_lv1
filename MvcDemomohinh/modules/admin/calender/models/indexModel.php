<?php

function get_examinations_information()
{
    $sql = "SELECT examination_teachers.teacher_code_1, examination_teachers.teacher_code_2, examination_teachers.position, examinations.*, subjects.name as subject_name FROM examination_teachers INNER JOIN examinations ON examinations.id=examination_teachers.examination_id INNER JOIN subjects ON subjects.id=examinations.subject_id";
    return getRaw($sql);
}
