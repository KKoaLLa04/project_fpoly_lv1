<?php
function get_lists_examination(){
    $sql = "SELECT * FROM examinations ORDER BY start_date ASC";
    return getRaw($sql);
}

function get_one_examination($id){
    $sql = "SELECT * FROM examinations WHERE id = {$id}";
    return firstRaw($sql);
}

function get_one_examination_media($id){
    $sql = "SELECT *  FROM examination_medias WHERE examination_id = {$id}";
    return getRaw($sql);
}

function get_one_examination_teachers($id){
    $sql = "SELECT *  FROM examination_teachers WHERE examination_id = {$id}";
    return getRaw($sql);
}
?>