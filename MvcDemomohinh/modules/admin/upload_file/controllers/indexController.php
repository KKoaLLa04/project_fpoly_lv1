<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
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
            // echo "<pre>";
            // print_r($listData);
            // echo "</pre>";
            $count = 0;
            foreach ($listData as $item) {

                $now = new DateTime();
                $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
                $now->setTimezone($timezone);
                $formattedDateTime = $now->format('Y-m-d H:i:s');

                // Tạo đối tượng DateTime từ chuỗi và định dạng ban đầu
                $datetime = DateTime::createFromFormat('d/m/Y', $item['ngay_thi']);

                // Chuyển đổi sang định dạng mới
                $ngay_thi = $datetime->format('Y-m-d H:i:s');
                $dataInsert = [
                    'creator_id' => 1,
                    'subject_id' => 8,
                    'spring_block_id' => 7,
                    'start_date' => $ngay_thi,
                    'order_ex' => $item['ca_thi'],
                    'room_code' => $item['phong_thi'],
                    'class_code' => $item['lop'],
                    'created_at' => $formattedDateTime
                ];

                insert('examinations', $dataInsert);
                $count++;
                if ($count >= 100) {
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
    $id = $_GET['id'];
    echo $id;

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
    update('examinations',[
        'start_date' => $start_date,
        'order_ex' => $order_ex,
        'room_code' => $room_code,
        'class_code' => $class_code,
        'updated_at' => $updated_at
    ], 'id = '.$id);
    header("Location:{$config['baseUrl']}?role=admin&mod=upload_file&action=update&id={$id}&mess=success");
}
?>