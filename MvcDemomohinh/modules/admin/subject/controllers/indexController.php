<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $data['subject'] = get_lists_subject();
    load_view('index', $data);
}

function createAction()
{
    load_view('create');
}
function createPostAction(){
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    global $config;
    // Nhận dữ liệu từ yêu cầu POST
    $listData = json_decode(file_get_contents("php://input"), true);

    $response = null;
    if (!empty($listData)) {
        $count = 0;
        foreach ($listData as $data) {
            $dataInsert = [
                'creator_id' => 1,
                'name' => $data['ten_mon'],
                'mon_code' => $data['ma_mon'],
                'created_at' => date('Y-m-d H:i:s')
            ];
            if(check_subject_exits($data['ma_mon']) > 0){
                continue;
            }
            insert('subjects', $dataInsert);
            // $count++;
            // if($count > 100){
            //     break;
            // }
        }

        // Phản hồi về frontend
        $response = ['status' => 'success', 'message' => 'Thêm dữ liệu thành công'];
    } else {    
        // Nếu thiếu dữ liệu, trả về một phản hồi lỗi
        $response = array('status' => 'error', 'message' => 'Thêm dữ liệu thất bại');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    }
}

// function createPostAction()
// {
//     global $config;

//     if (isPost()) {
//         $mon_code = $_POST['mon_code'];
//         $name = $_POST['name'];
//         $create_tor = 1; // fix cứng 1 tạm thời

//         $dataInsert = [
//             'name' => $name,
//             'mon_code' => $mon_code,
//             'creator_id' => $create_tor,
//             'created_at' => date('Y-m-d H:i:s'),
//         ];

//         insert('subjects', $dataInsert);
//     }
//     header("Location:{$config['baseUrl']}?role=admin&mod=subject");
// }

function deleteAction()
{
    global $config;
    $id = $_GET['id'];
    $condition = "id=$id";
    delete('subjects', $condition);
    header("Location:{$config['baseUrl']}?role=admin&mod=subject");
}

function updateAction()
{
    global $config;
    if (isGet() && !empty($_GET['id'])) {
        $id = $_GET['id'];

        $subject_detail = get_subject_detail($id);
        if (!empty($subject_detail)) {
            $data['subject'] = $subject_detail;

            load_view('update', $data);
        } else {
            redirect('?role=admin&mod=subject');
        }
    } else {
        redirect('?role=admin&mod=subject');
    }
}
function updatePostAction(){
    global $config;

    if (isPost()) {
        $id = $_GET['id'];
        $condition = "id=$id";
        $mon_code = $_POST['mon_code'];
        $name = $_POST['name'];
        $create_tor = 1; // fix cứng 1 tạm thời

        $dataUpdate= [
            
            'name' => $name,
            'mon_code' => $mon_code,
            'creator_id' => $create_tor,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

       update('subjects', $dataUpdate, $condition);
    }
    header("Location:{$config['baseUrl']}?role=admin&mod=subject");

}
