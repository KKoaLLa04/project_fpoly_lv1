<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    if (isset($_GET['id']) && ($_GET['id'] > 0)) {
        $id = $_GET['id'];
        $data['check_create'] = get_count_media_byid($id);
        $data['subject_medias'] = get_list_subject_medias($id);
        $data['subject_id'] = $id;
        load_view('index', $data);
    } else {
        $_GET['id'] = 0;
        $data['subject_medias'] = get_subject_media_lists();
        load_view('index', $data);
    }
}

function createAction()
{
    $data['subject'] = get_lists_subject_toExam();
    $data['spring_block'] = get_spring_block();
    load_view('create', $data);
}

function createPostAction()
{
    $errors = [];
    global $config;

    if (empty($_POST['subject_id'])) {
        $errors['subject_id'] = 'Đề thi thuộc môn học nào';
    }

    if (empty($_POST['spring_block_id'])) {
        $errors['spring_block_id'] = 'Đề thi thuộc kỳ thi nào';
    }

    if (empty($_FILES['file_exam']['name'])) {
        $errors['file_name'] = 'Vui lòng thêm file đề thi';
    }

    if (empty($errors)) {
        // validate thanh cong, khong co loi xay ra

        if (isset($_FILES['file_exam'])) {
            $files = $_FILES['file_exam'];
            //$extension = ['jpg', 'jpeg', 'png', 'gif'];

            if (!empty($files) && empty($errors)) {
                foreach ($files['name'] as $key => $item) {
                    $fileName = $_FILES['file_exam']['name'][$key];
                    // echo $fileName;
                    $from = $files['tmp_name'][$key];
                    $to = './uploads/file/' . $fileName;
                    move_uploaded_file($from, $to);


                    $dataInsert = [
                        'creator_id' => $_SESSION['login_information']['id'],
                        'subject_id' => $_POST['subject_id'],
                        'spring_block_id' => $_POST['spring_block_id'],
                        'name' => $fileName,
                        'path_save' => $to,
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                    $insertStatus = insert('subject_medias', $dataInsert);
                }

                $subjectId = $_POST['subject_id'];
                $springBlockId = $_POST['spring_block_id'];

                $examinations = get_examination($subjectId, $springBlockId);
                $subject_media = get_subject_media($subjectId, $springBlockId);
                $count_subject_media = get_count_media($subjectId, $springBlockId);


              
                foreach ($examinations as $key => $exam) {
                    if (check_exam_media($exam['id']) < 1) {
                        $dataInsert = [
                            'creator_id' =>  $_SESSION['login_information']['id'],
                            'examination_id' => $exam['id'],
                            'subject_media_id' => $subject_media[rand(0, $count_subject_media - 1)]['id'],
                            'created_at' => date('Y-m-d H:i:s'),
                        ];

                        insert('examination_medias', $dataInsert);
                    } else {
                        $dataUpdate = [
                            'subject_media_id' => $subject_media[rand(0, $count_subject_media - 1)]['id'],
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];

                        $condition = "examination_id=" . $exam['id'];
                        update('examination_medias', $dataUpdate, $condition);
                    }
                }
            }
        }
        // $fileName = $_FILES['file_exam']['name'];
        // $from = $_FILES['file_exam']['tmp_name'];
        // $to = './uploads/file/' . $fileName;
        if (!empty($insertStatus)) {
            setFlashData('msg', 'Thêm đề thi mới thành công!');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra lại dữ liệu');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
    }
    redirect('?role=admin&mod=subject_media&action=create');
}


function deleteAction()
{
    global $config;
    $id = $_GET['id'];
    $condition = "id=$id";
    $data = get_one_examination_media($id);
    if(!empty($data)){
        setFlashData('msg', 'Bạn không thể xóa vì đang có một dữ liệu liên kết với dữ liệu này');
        setFlashData('msg_type', 'danger');
        redirect('?role=admin&mod=subject');
    }else{
        setFlashData('msg', 'Xóa dữ liệu thành công.');
        setFlashData('msg_type', 'success');
        delete('subject_medias', $condition);
        redirect('?role=admin&mod=subject');
    }
}
function updateAction()
{
    global $config;
    $data['subject'] = get_subject_lists();
    $data['spring_block'] = get_spring_block();
    if (isGet() && !empty($_GET['id'])) {
        $id = $_GET['id'];

        $subject_media = get_subject_detail($id);

        if (!empty($subject_media)) {
            $data['subject_media'] = $subject_media;

            load_view('update', $data);
        } else {
            redirect('?role=admin&mod=subject_media');
        }
    } else {
        redirect('?role=admin&mod=subject_media');
    }
}
function updatePostAction()
{
    global $config;
    $data['subject'] = get_subject_lists();
    $data['spring_block'] = get_spring_block();

    if (isPost()) {
        $fileName = $_FILES['file_exam']['name'];
        $from = $_FILES['file_exam']['tmp_name'];
        $to = './uploads/file/' . $fileName;

        move_uploaded_file($from, $to);

        $id = $_GET['id'];
        $condition = "id=$id";
        $subject_id = $_POST['subject_id'];
        $spring_block_id = $_POST['spring_block_id'];
        $name = $_POST['fileName'];
        $path_save = $to;
        $now = new DateTime();
        $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
        $now->setTimezone($timezone);
        $updated_at = $now->format('Y-m-d H:i:s');

        $dataUpdate = [
            'name' => $fileName,
            'subject_id' =>  $subject_id,
            'spring_block_id' => $spring_block_id,
            'path_save' => $to,
            'updated_at' => $updated_at
        ];
        update('subject_medias', $dataUpdate, $condition);
    }
    header("Location:{$config['baseUrl']}?role=admin&mod=subject_media");
}


function appendAction()
{
    $id = $_GET['id'];
    $data['spring_block'] = get_spring_block();
    $data['subject_id'] = $id;

    load_view('append', $data);
}

function appendPostAction()
{
    $errors = [];
    $id = $_GET['id'];

    if (empty($_FILES['file_exam']['name'])) {
        $errors['file_name'] = 'Vui lòng thêm file đề thi';
    }

    if (empty($errors)) {
        // validate thanh cong, khong co loi xay ra
        // $subjectId = $_POST['subject_id'];
        // $springBlockId = $_POST['spring_block_id'];
        global $config;

        if (isset($_FILES['file_exam'])) {
            $file = $_FILES['file_exam'];
            //$extension = ['jpg', 'jpeg', 'png', 'gif'];

            $fileNameArr = $file['name'];
            if (!empty($fileNameArr) && empty($errors)) {
                foreach ($fileNameArr as $key => $item) {
                    $fileName = $_FILES['file_exam']['name'][$key];
                    $from = $fileName;
                    $to = $config['baseUrl'].'/uploads/file/'. $fileName;
                    move_uploaded_file($from, $to);

                    $dataInsert = [
                        'creator_id' => $_SESSION['login_information']['id'],
                        'subject_id' => $_POST['subject_id'],
                        'spring_block_id' => $_POST['spring_block_id'],
                        'name' => $fileName,
                        'path_save' => $to,
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                    $insertStatus = insert('subject_medias', $dataInsert);
                }

                $subjectId = $_POST['subject_id'];
                $springBlockId = $_POST['spring_block_id'];

                $examinations = get_examination($subjectId, $springBlockId);
                $subject_media = get_subject_media($subjectId, $springBlockId);
                $count_subject_media = get_count_media($subjectId, $springBlockId);



                foreach ($examinations as $key => $exam) {
                    if (check_exam_media($exam['id']) < 1) {
                        $dataInsert = [
                            'creator_id' =>  $_SESSION['login_information']['id'],
                            'examination_id' => $exam['id'],
                            'subject_media_id' => $subject_media[rand(0, $count_subject_media - 1)]['id'],
                            'created_at' => date('Y-m-d H:i:s'),
                        ];

                        insert('examination_medias', $dataInsert);
                    } else {
                        $dataUpdate = [
                            'subject_media_id' => $subject_media[rand(0, $count_subject_media - 1)]['id'],
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];

                        $condition = "examination_id=" . $exam['id'];
                        update('examination_medias', $dataUpdate, $condition);
                    }
                }
            }
        }

        if (!empty($insertStatus)) {
            setFlashData('msg', 'Thêm đề thi mới thành công!');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra lại dữ liệu');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
    }
    redirect("?role=admin&mod=subject_media");
}

// function randomAction()
// {
//     if (!empty($_GET['subject_id']) && !empty($_GET['spring_block_id'])) {
//         $subject_id = $_GET['subject_id'];
//         $spring_block_id = $_GET['spring_block_id'];

//         $examinations = get_examination_radom($subject_id, $spring_block_id);
//         $subject_media = get_subject_media($subject_id, $spring_block_id);
//         $count_subject_media = get_count_media_random($subject_id, $spring_block_id);

//         foreach ($examinations as $key => $exam) {
//             $dataUpdate = [
//                 // 'creator_id' =>  $_SESSION['login_information']['id'],
//                 // 'examination_id' => $exam['id'],
//                 'subject_media_id' => $subject_media[rand(0, $count_subject_media - 1)]['id'],
//                 'updated_at' => date('Y-m-d H:i:s'),
//             ];
//             $condition = "examination_id =" . $exam['id'];
//             $updateStatus = update('examination_medias', $dataUpdate, $condition);
//         }

//         redirect("?role=admin&mod=subject_media");
//     } else {
//         setFlashData('msg', 'Liên kết không tồn tại');
//         setFlashData('msg_type', 'danger');
//     }
//     redirect("?role=admin&mod=subject_media");
// }