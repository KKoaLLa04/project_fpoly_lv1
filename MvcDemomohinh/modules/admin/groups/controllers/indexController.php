<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    // Check quyền
    $permissionData = permissionData();

    if (!checkPermission($permissionData, 'groups', 'Xem')) {
        setFlashData('msg', 'Bạn không có quyền truy cập vào trang này');
        setFlashData('msg_type', 'danger');
        redirect('?role=admin');
    }


    $data['groups'] = get_lists_groups();
    load_view('index', $data);
}

function createAction()
{
    // Check quyền
    $permissionData = permissionData();

    if (!checkPermission($permissionData, 'groups', 'Thêm')) {
        setFlashData('msg', 'Bạn không có quyền truy cập vào trang này');
        setFlashData('msg_type', 'danger');
        redirect('?role=admin');
    }

    load_view('create');
}

function createPostAction()
{
    // Check quyền
    $permissionData = permissionData();

    if (!checkPermission($permissionData, 'groups', 'Thêm')) {
        setFlashData('msg', 'Bạn không có quyền truy cập vào trang này');
        setFlashData('msg_type', 'danger');
        redirect('?role=admin');
    }

    // chua validate

    $name = $_POST['name'];

    $dataInsert = [
        'name' => $name,
        'created_at' => date('Y-m-d H:i:s'),
    ];

    insert('groups', $dataInsert);

    redirect('?role=admin&mod=groups');
}

function permissionAction()
{
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = 1;
    }

    $data['modules'] = get_lists_modules();
    $data['groups'] = get_groups_detail($id);
    load_view('permission', $data);
}

function permissionPostAction()
{
    // cap nhat vao trong database
    $id = $_POST['id'];
    $permissionsArr = $_POST['permission'];
    $permissionJson = json_encode($permissionsArr);

    $dataUpdate = [
        'permission' => $permissionJson,
        'updated_at' => date('Y-m-d H:i:s'),
    ];

    $condition = "id=$id";

    update('groups', $dataUpdate, $condition);

    redirect('?role=admin&mod=groups&action=permission&id=' . $id);
}
