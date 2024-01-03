<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $data['exam_calender'] = get_examinations_information();
    
    load_view('index', $data);
}

function addHistoryAction(){
    global $config;
    if (!empty($_GET['file'])) {
        $fileName = basename($_GET['file']);
        $filePath = 'uploads/' . $fileName;
        
        
        if (!empty($fileName) && file_exists($filePath)) {
            $user = getSession('login_information');
            $id = $user['id'];
            $examination_id = $_GET['examination_id'];
            $examination_media_id = $_GET['examination_media_id'];
            $dataInsert = [
                'download_id' => $id,
                'examination_id' => $examination_id,
                'examination_media_id' => $examination_media_id,
                'created_at' => date('Y-m-d H:i:s'),
            ];
    
            insert('examination_histories', $dataInsert);

            // Thiết lập các header cho việc truyền tải dữ liệu
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            // header('Content-Length: ' . filesize($fileName));
            readfile($filePath);
            $msg = "Download file thành công";
            $type = "success";
            exit;
            
            
            
        } else {
            $msg = "Download file không thành công";
            $type = "danger";
        }
        setFlashData('msg', $msg);
        setFlashData('msg_type', $type);
        redirect('?role=admin&mod=calender');
    }
}
