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

function updateAction() {
    $id = $_GET['id'];
    $data['spring_bocks_update'] = get_one_spring_bocks($id);
    load_view('update', $data);
}

function updatePostAction(){
    global $config;

    if (isPost()) {
        $id = $_GET['id'];
        $condition = "id=$id";
        $name = $_POST['name'];


        $dataUpdate= [
            
            'name' => $name,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

       update('spring_blocks', $dataUpdate, $condition);
    }
    header("Location:{$config['baseUrl']}?role=admin&mod=spring_blocks&action=update&id={$id}&mess=success");

}

function deleteAction()
{
    global $config;
    $id = $_GET['id'];
    $condition = "id=$id";

   
    $data['examination_teacher'] = get_one_examination_teachers($id);
    $data['examinations'] = get_one_examinations($id);
    $data['subject_medias'] = get_one_subject_medias($id);

    if(!empty($data['examination_teacher']) or !empty($data['examinations']) or !empty($data['subject_medias'])){
        setFlashData('msg', 'Bạn không thể xóa vì đang có một dữ liệu liên kết với dữ liệu này');
        setFlashData('msg_type', 'danger');
        redirect('?role=admin&mod=spring_blocks');
    }else{
        setFlashData('msg', 'Xóa dữ liệu thành công.');
        setFlashData('msg_type', 'success');
        
        delete('spring_blocks', $condition);
        redirect('?role=admin&mod=spring_blocks');
    }
    
    header("Location:{$config['baseUrl']}?role=admin&mod=spring_blocks");
}
