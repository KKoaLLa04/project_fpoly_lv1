<?php
// function get_data_examination($teacher_code) {
//     $sql = "SELECT examinations.*, examination_teachers.teacher_code_1, examination_teachers.teacher_code_2, subjects.name
//     FROM examinations
//     INNER JOIN subjects ON subjects.id = examinations.subject_id
//     INNER JOIN examination_teachers ON examinations.id = examination_teachers.examination_id  
//     WHERE examination_teachers.teacher_code_1='{$teacher_code}'
//     OR examination_teachers.teacher_code_2='{$teacher_code}' ORDER BY examinations.start_date ASC";
//     // echo $sql;
//     // echo "<br>";
//     return getRaw($sql);
// }
// function get_data_examination_bydate($teacher_code, $date) {
//     $sql = "SELECT examinations.*, examination_teachers.teacher_code_1, examination_teachers.teacher_code_2, subjects.name, 
//     SUBSTRING( examinations.start_date, 10) AS last_date, subject_medias.name AS name_exam
//     FROM examinations
//     INNER JOIN subjects ON subjects.id = examinations.subject_id
//     INNER JOIN subject_medias ON subject_medias.subject_id = subjects.id
//     INNER JOIN examination_teachers ON examinations.id = examination_teachers.examination_id  
//     WHERE examination_teachers.teacher_code_1='{$teacher_code}'
//     OR examination_teachers.teacher_code_2='{$teacher_code}' AND SUBSTRING( examinations.start_date, 1 ,10) = '{$date}'";
//     // echo $sql;
//     // echo "<br>";
//     // die();
//     return getRaw($sql);
// }

function get_lists_examination_histories()
{
    $sql = "SELECT * , users.name as user_name, examination_histories.created_at as time_download_examination
    FROM examination_histories 
    INNER JOIN users ON users.id=examination_histories.download_id 
    
    
    INNER JOIN examinations ON examinations.id=examination_histories.examination_id
    INNER JOIN spring_blocks ON spring_blocks.id=examinations.spring_block_id 
    INNER JOIN subjects ON subjects.id=examinations.subject_id 
    ORDER BY examinations.start_date DESC";
    return getRaw($sql);
}
