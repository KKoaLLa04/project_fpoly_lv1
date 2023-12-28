<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $permissionData = permissionData();

    if (!checkPermission($permissionData, 'spring_blocks', 'Xem')) {
        setFlashData('msg', 'Bạn không có quyền truy cập vào trang này');
        setFlashData('msg_type', 'danger');
        redirect('?role=admin');
    }

    $data['checkPermission'] = [
        'add' => checkPermission($permissionData, 'spring_blocks', 'Thêm'),
        'edit' => checkPermission($permissionData, 'spring_blocks', 'Sửa'),
        'delete' => checkPermission($permissionData, 'spring_blocks', 'Xóa'),
    ];

    $data['spring_blocks_lists'] = get_lists_spring_blocks();
    load_view('index', $data);
}

function createAction()
{
    load_view('create');
}

function createPostAction()
{
    // if ($_SERVER['REQUEST_METHOD'] == 'post') {
    // $errors = [];

    // if(empty($_POST['name'])){
    //     $errors['name'] = 'Tên kỳ thi không được để trống'; 
    // }else{
    //     if(strlen(trim($_POST['name'])) < 3){
    //         $errors['name'] = 'Tên kỳ thi không được nhỏ hơn 3 ký tự';
    //     }
    // }

    $name = trim($_POST['name']);
    $creator = 1; // fix cung tam thoi

    $dataInsert = [
        'name' => $name,
        'creator_id' => $creator,
        'created_at' => date('Y-m-d H:i:s'),
    ];

    insert('spring_blocks', $dataInsert);


    header('Location: ?role=admin&mod=spring_blocks');
}
