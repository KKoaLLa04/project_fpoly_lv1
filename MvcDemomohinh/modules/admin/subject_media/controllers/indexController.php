<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $data['subject_medias'] = get_subject_media_lists();
    load_view('index', $data);
}

function createAction()
{
    $data['subject'] = get_subject_lists();
    $data['spring_block'] = get_spring_block();
    load_view('create', $data);
}

function createPostAction()
{
    $errors = [];

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
        $fileName = $_FILES['file_exam']['name'];
        $from = $_FILES['file_exam']['tmp_name'];
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
