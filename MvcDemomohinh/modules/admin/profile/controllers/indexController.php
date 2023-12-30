<?php

function construct() {
    load_model('index');
}

function indexAction() {
    $id = $_SESSION['login_information']['id'];
    $data['infomation'] = get_infomation($id);
    // echo "<pre>";
    // print_r($data['infomation']);
    // echo "</pre>";
    // echo $data['infomation']['name'];
    // die();
    load_view('index', $data);
}

function changePassAction() {
    load_view('changePass');
}

function changePassPostAction() {
    if(isset($_POST['update'])){
        $id= $_SESSION['login_information']['id'];
        $password = $_POST['password_old'];
        $passwordNew = $_POST['password_new'];
        $confirmPassword =  $_POST['confirm_password'];
        $checkPass = check_pass($id); 
        $pass = $checkPass['password'];
        setFlashData('pass',$password);

        $errors = []; 
        // echo $pass;

        if(empty($password)){
            $errors['password'] = "Vui lòng nhập mật khẩu hiện tại";
        }
        if(empty($passwordNew)){
            $errors['password_new'] = "Vui lòng nhập mật khẩu mới";
            
        }
        if(empty($confirmPassword)){
            $errors['confirm_password'] = "Xác nhận mật khẩu mới không được để trống";
            
        }
        
        if(empty($errors)){
            if(password_verify($password, $pass)){

                if($passwordNew == $confirmPassword){
                    $dataUpdate = [
                        'password' => password_hash($confirmPassword, PASSWORD_DEFAULT),
                        'updated_at' => date("Y-m-d H:i:s")
                    ];
                    $condition = "id=$id";
                    $updateStatus = update('users',$dataUpdate,$condition);
    
                    if(!empty($updateStatus)){
                        setFlashData('msg','Đổi mật khẩu thành công');
                        setFlashData('msg_type', 'success');
                        redirect('?role=admin&mod=profile');
                    }
                }else{
                    $errors['confirm_password'] = "Mật khẩu mới không trùng khớp";
                    setFlashData('errors', $errors);                  
                    redirect('?role=admin&mod=profile&action=changePass');
                }
    
            }else{
                $errors['password'] = "Mật khẩu không chính xác";
                setFlashData('errors', $errors);
                redirect('?role=admin&mod=profile&action=changePass');
            }
        }else{
            setFlashData('errors', $errors);
            redirect('?role=admin&mod=profile&action=changePass');
            
        }





        // echo "<pre>";
        // print_r($checkPass);
        // echo "</pre>";
        // die();
        
    }
}

function indexPostAction(){
    if(isset($_POST['update'])){
        $email = $_POST['email'];
        $name = $_POST['fullName'];
        $id = $_SESSION['login_information']['id'];
        $errors = [];
        if(empty($email)){
            $errors['email'] = "Hãy nhập email";
        }
        if(empty($name)){
            $errors['name'] = "Hãy nhập tên";
        }

        // echo "<pre>";
        // print_r($errors);
        // echo "</pre>";
        // die();

        if(empty($errors)){
            $dataUpdate= [
                'email' => $email,
                'name' => $name,
            ];
            $condition = "id='$id'";
            $updateStatus = update('users', $dataUpdate, $condition);
            $data['infomation'] = get_infomation($id);
            $_SESSION['login_information']['name'] = $data['infomation']['name'];
            $_SESSION['login_information']['email'] = $data['infomation']['email'];
            if (!empty($updateStatus)) {
                setFlashData('msg', 'Cập nhật thông tin thành công!');
                setFlashData('msg_type', 'success');
                redirect('?role=admin&mod=profile');
            } else {
                setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
                setFlashData('msg_type', 'danger');
                redirect('?role=admin&mod=profile');
            }
            
        }else {
            setFlashData('msg', 'Vui lòng nhập email và tên');
            setFlashData('errors', $errors);
            redirect('?role=admin&mod=profile');
        }


    }
}