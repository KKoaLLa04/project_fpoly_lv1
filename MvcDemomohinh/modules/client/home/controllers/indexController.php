<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    $user = $_SESSION['login_information']['email'];
    $teacher_code = str_replace("@gmail.com","",$user);
    $date = '2023-10-13'; //Fix cứng tạm thời
    $data['examination_teacher'] = get_data_examination($teacher_code);
    // $date = date('Y-m-d');//Thời gian hiện tại
    $data['examination_teacher_bydate'] = get_data_examination_bydate($teacher_code, $date);
    // echo "<pre>";
    // print_r($_SESSION['login_information']);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($data['examination_teacher_bydate']);
    // echo "</pre>";
    load_view('index',$data);
}

function downAction(){


    if(isset($_GET['file'])){
        $id = $_SESSION['login_information']['id'];
        $examinationId = $_GET['examid'];
        $examMediaId = $_GET['exammedia'];
        $createdAt = date('Y-m-d H:i:m');

        $dataInsert = [
            'download_id' => $id,
            'examination_id' => $examinationId,
            'examination_media_id' =>  $examMediaId,
            'created_at' => $createdAt
        ];
        insert('examination_histories',$dataInsert);
    }
    download();

    
}    