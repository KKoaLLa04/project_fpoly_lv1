<?php

function get_examinations_information()
{
    $sql = "SELECT examination_teachers.teacher_code_1, examination_teachers.teacher_code_2, examination_teachers.position, examinations.*, subjects.name as subject_name, subject_medias.name as subject_media_name,examination_medias.id as examination_media_id, examinations.id as examination_id  FROM examination_teachers INNER JOIN examinations ON examinations.id=examination_teachers.examination_id INNER JOIN subjects ON subjects.id=examinations.subject_id INNER JOIN examination_medias ON examination_medias.examination_id=examinations.id INNER JOIN subject_medias ON subject_medias.id = examination_medias.subject_media_id";
    return getRaw($sql);
}
