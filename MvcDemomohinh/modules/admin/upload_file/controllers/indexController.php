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
    load_view('index', $data);
}

function indexPostAction()
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Nhận dữ liệu từ yêu cầu POST
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

                $dataInsert = [
                    'creator_id' => 1,
                    'subject_id' => 13,
                    'spring_block_id' => 7,
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
                    'creator_id' => 1, //fix cung tam thoi
                    'spring_block_id' => 7, // fix cung tm thoi
                    'examination_id' => $lastId,
                    'teacher_code_1' => $item['gt_1'],
                    'teacher_code_2' => $item['gt_2'],
                    'position' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                insert('examination_teachers', $dataInsertEx1);

                $count++;
                if ($count > 10) {

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
    return load_view('create');
}

function deleteAction()
{
    global $config;
    $id = $_GET['id'];

    deleteItemInArr('examinations', [
        'id' => $id
    ]);
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
