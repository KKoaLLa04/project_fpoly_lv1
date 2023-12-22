<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load_view('index');
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
                $dataInsert = [
                    'creator_id' => 1,
                    'subject_id' => 13,
                    'spring_block_id' => 7,
                    'start_date' => $item['ngay_thi'],
                    'order_ex' => $item['ca_thi'],
                    'room_code' => $item['phong_thi'],
                    'class_code' => 'WD18204',
                    'created_at' => date('Y-m-d H:i:s')
                ];
                insert('examinations', $dataInsert);
                $count++;
                if($count > 100){
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
    return view('create');
}
