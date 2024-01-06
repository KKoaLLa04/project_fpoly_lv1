<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $permissionData = permissionData();

    if (!checkPermission($permissionData, 'upload_file', 'Xem')) {
        setFlashData('msg', 'Bạn không có quyền truy cập vào trang này');
        setFlashData('msg_type', 'danger');
        redirect('?role=admin');
    }

    $data['checkPermission'] = [
        'add' => checkPermission($permissionData, 'upload_file', 'Thêm'),
        'edit' => checkPermission($permissionData, 'upload_file', 'Sửa'),
        'delete' => checkPermission($permissionData, 'upload_file', 'Xóa'),
    ];

    $data['examination_lists'] = get_lists_examination();
    $data['spring_block'] = get_spring_block();
    load_view('index', $data);
}

function indexPostAction()
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        // nếu không chọn => tự động lấy kỳ thi mới nhất
        $springId = get_one_spring_block()['id'];

        $listData = json_decode(file_get_contents("php://input"), true);

        $response = null;
        // Kiểm tra xem dữ liệu đã nhận được chưa
        if (!empty($listData)) {
            // Xử lý dữ liệu (ví dụ: lưu vào cơ sở dữ liệu)
            $count = 0;
            foreach ($listData as $item) {

                $now = new DateTime();
                $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
                $now->setTimezone($timezone);
                $formattedDateTime = $now->format('Y-m-d H:i:s');

                // Tạo đối tượng DateTime từ chuỗi và định dạng ban đầu
                $datetime = DateTime::createFromFormat('d/m/Y', $item['ngay_thi']);
                $ngay_thi = $datetime->format('Y-m-d');

                switch ($item['ca_thi']) {
                    case 1:
                        $gioFormat = '07:00:00';
                        break;

                    case 2:
                        $gioFormat = '9:25:00';
                        break;
                    case 3:
                        $gioFormat = '12:00:00';
                        break;
                    case 4:
                        $gioFormat = '14:10:00';
                        break;
                    case 5:
                        $gioFormat = '16:20:00';
                        break;
                    case 6:
                        $gioFormat = '18:30:00';
                        break;
                }

                $ngayGioFormat = $ngay_thi . ' ' . $gioFormat;


                $dateTime = new DateTime($ngayGioFormat);

                $ngayGioDaFormat = $dateTime->format('Y-m-d H:i:s');

                $subjectId = get_subject_detail($item['ma_mon'])['id'];

                $dataInsert = [
                    'creator_id' => $_SESSION['login_information']['id'],
                    'subject_id' => $subjectId,
                    'spring_block_id' => $springId,
                    'start_date' => $ngayGioDaFormat,
                    'order_ex' => $item['ca_thi'],
                    'room_code' => $item['phong_thi'],
                    'class_code' => $item['lop'],
                    'created_at' => $formattedDateTime
                ];

                // insert vao bang examinations => lay ra id vua insert
                $lastId = lastInsertId('examinations', $dataInsert);

                // insert vao trong bang examinations_teacher (gt1)
                $dataInsertEx1 = [
                    'creator_id' => $_SESSION['login_information']['id'],
                    'spring_block_id' => $springId,
                    'examination_id' => $lastId,
                    'teacher_code_1' => $item['gt_1'],
                    'teacher_code_2' => $item['gt_2'],
                    'position' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                insert('examination_teachers', $dataInsertEx1);

                // insert giảng viên account
                if (check_email_exitst($item['gt_1'] . '@gmail.com') < 1) {
                    $email = $item['gt_1'] . '@gmail.com';
                    $dataInsert = [
                        'email' => $email,
                        'password' => password_hash('123456', PASSWORD_DEFAULT),
                        'group_id' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                    ];

                    insert('users', $dataInsert);
                }

                if (check_email_exitst($item['gt_2'] . '@gmail.com') < 1) {
                    $email = $item['gt_2'] . '@gmail.com';
                    $dataInsert = [
                        'email' => $email,
                        'password' => password_hash('123456', PASSWORD_DEFAULT),
                        'group_id' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                    ];

                    insert('users', $dataInsert);
                }

                $count++;
                if ($count > 100) {

                    break;
                }
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

function createAction()
{
    $data['examination_lists'] = get_lists_examination();
    $data['spring_block'] = get_spring_block();
    return load_view('create', $data);
}

function deleteAction()
{
    global $config;
    $id = $_GET['id'];
    $condition = "id=$id";

    $data['examination_media'] = get_one_examination_media($id);
    $data['examination_teacher'] = get_one_examination_teachers($id);
    if(!empty($data['examination_teacher']) or !empty($data['examination_media']) ){
        setFlashData('msg', 'Bạn không thể xóa vì đang có một dữ liệu liên kết với dữ liệu này');
        setFlashData('msg_type', 'danger');
        redirect('?role=admin&mod=subject');
    }else{
        setFlashData('msg', 'Xóa dữ liệu thành công.');
        setFlashData('msg_type', 'success');
        delete('examinations', $condition);
        redirect('?role=admin&mod=subject');
    }
    
    header("Location:{$config['baseUrl']}?role=admin&mod=upload_file");
}

function updateAction()
{
    $id = $_GET['id'];
    $data['examination_update'] = get_one_examination($id);
    load_view('update', $data);
}

function updatePostAction()
{
    global $config;
    $id = $_POST['id'];
    $start_date = $_POST['start_date'];
    $order_ex = $_POST['order_ex'];
    $room_code = $_POST['room_code'];
    $class_code = $_POST['class_code'];
    $now = new DateTime();
    $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
    $now->setTimezone($timezone);
    $updated_at = $now->format('Y-m-d H:i:s');
    echo $id;
    update('examinations', [
        'start_date' => $start_date,
        'order_ex' => $order_ex,
        'room_code' => $room_code,
        'class_code' => $class_code,
        'updated_at' => $updated_at
    ], 'id = ' . $id);
    header("Location:{$config['baseUrl']}?role=admin&mod=upload_file&action=update&id={$id}&mess=success");
}
