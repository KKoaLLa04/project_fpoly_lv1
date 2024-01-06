<?php

function get_data_examination($teacher_code) {
    $sql = "SELECT examinations.*, examination_teachers.teacher_code_1, examination_teachers.teacher_code_2, subjects.name
    FROM examinations
    INNER JOIN subjects ON subjects.id = examinations.subject_id
    INNER JOIN subject_medias ON subject_medias.subject_id = subjects.id
    INNER JOIN examination_medias ON examination_medias.examination_id = examinations.id
    INNER JOIN examination_teachers ON examinations.id = examination_teachers.examination_id    
    WHERE (examination_teachers.teacher_code_1='{$teacher_code}'
    OR examination_teachers.teacher_code_2='{$teacher_code}')
    ORDER BY examinations.start_date ASC";
    // echo $sql;
    // echo "<br>";
    // echo "<br>";
    return getRaw($sql);
}

function get_data_examination_bydate($teacher_code, $date) {
    $sql = "SELECT examinations.*, examination_teachers.teacher_code_1, examination_teachers.teacher_code_2, subjects.name, 
    subject_medias.name AS name_exam, examination_medias.id AS media_id
    FROM examinations
    INNER JOIN subjects ON subjects.id = examinations.subject_id
    INNER JOIN subject_medias ON subject_medias.subject_id = subjects.id
    INNER JOIN examination_medias ON examination_medias.examination_id = examinations.id
    INNER JOIN examination_teachers ON examinations.id = examination_teachers.examination_id  
    WHERE (examination_teachers.teacher_code_1='{$teacher_code}'
    OR examination_teachers.teacher_code_2='{$teacher_code}') 
    AND (SUBSTRING( examinations.start_date, 1 ,10) = '{$date}') 
    AND (examination_medias.subject_media_id = subject_medias.id) ORDER BY examinations.start_date ASC";
    // echo $sql;
    // echo "<br>";
    // die();
    return getRaw($sql);
}