<?php
function construct()
{
    load_model('index');
}
// function createAction()
// {
//     load_view('create');
// }

function fogotAction()
{
    load_view('fogot');
}

function fogotPostAction()
{
    global $config;
    $email = $_POST['email'];

    if (check_email_exits($email) > 0) {
        $token = sha1(uniqid() . time());
        $linkToken = $config['baseUrl'] . '?role=client&mod=login&action=changePassword&token=' . $token;
        $subject = 'Yêu cầu khôi phục mật khẩu!';
        $content = "Chào bạn! <br/>";
        $content .= "Chúng tôi nhận được yêu cầu khôi phục mật khẩu từ bạn <br/>";
        $content .= "Vui lòng click vào link dưới đây để khôi phục mật khẩu: <br/>";
        $content .= $linkToken . '<br/>';
        $content .= "Trân trọng!";

        $dataUpdate = [
            'forgotToken' => $token,
        ];
        $condition = "email='$email'";

        update('users', $dataUpdate, $condition);

        sendMail($email, $subject, $content);
    }
    header("Location: ?role=client&mod=login");
}

function changePasswordAction()
{
    if (!empty($_GET['token'])) {
        $token = $_GET['token'];
        $checkToken = check_token_exits($token);

        if ($checkToken > 0) {
            // Load view neu thoa man dieu kien
            return load_view('change');
        } else {
            setFlashData('msg', 'Liên kết không tồn tại hoặc đã hết hạn!');
            setFlashData('msg_type', 'danger');
            redirect('?role=client&mod=login');
        }
    } else {
        setFlashData('msg', 'Liên kết không tồn tại hoặc đã hết hạn');
        setFlashData('msg_type', 'danger');
        redirect('?role=client&mod=login');
    };
}

function changePasswordPostAction()
{
    if (!empty($_GET['token'])) {
        $token = $_GET['token'];
        $checkToken = check_token_exits($token);

        if ($checkToken > 0) {
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            $errors = [];

            if (empty($password)) {
                $errors['password'] = 'Vui lòng nhập mật khẩu mới';
            }

            if (empty($confirmPassword)) {
                $errors['confirm_password'] = 'Xác nhận mật khẩu không được để trống!';
            } else {
                if ($confirmPassword != $password) {
                    $errors['confirm_password'] = 'Xác nhận mật khẩu không trùng khớp';
                }
            }

            if (empty($errors)) {
                $dataUpdate = [
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'forgotToken' => null,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $condition = "forgotToken = '$token'";

                $updateStatus = update('users', $dataUpdate, $condition);
                if (!empty($updateStatus)) {
                    setFlashData('msg', 'Đổi lại mật khẩu mới thành công!');
                    setFlashData('msg_type', 'success');
                    redirect('?role=client&mod=login');
                } else {
                    setFlashData('msg', 'Lỗi hệ thống, vui lòng thử lại sau!');
                    setFlashData('msg_type', 'danger');
                    redirect('?role=client&mod=login&action=changePassword&token=' . $token);
                }
            } else {
                setFlashData('msg', 'Vui lòng kiểm tra lại dữ liệu!');
                setFlashData('msg_type', 'danger');
                setFlashData('errors', $errors);
                redirect('?role=client&mod=login&action=changePassword&token=' . $token);
            }
        } else {
            setFlashData('msg', 'Liên kết không tồn tại hoặc đã hết hạn!');
            setFlashData('msg_type', 'danger');
            redirect('?role=client&mod=login');
        }
    } else {
        setFlashData('msg', 'Liên kết không tồn tại hoặc đã hết hạn');
        setFlashData('msg_type', 'danger');
        redirect('?role=client&mod=login');
    };
}
function indexAction()
{
    load_view('index');
}


function indexPostAction()
{
    global $config;
    if (isset($_POST['btn-login'])) {

        // validate
        $errors = [];

        $email = $_POST['email'];
        $pass = $_POST['pass'];

        if (!empty($email) && !empty($pass)) {
            $login = check_login($email);

            if (!empty($login)) {

                if (password_verify($pass, $login['password'])) {
                    setSession('login_information', $login);
                    header("Location:{$config['baseUrl']}?role=client&mod=home");
                } else {
                    setFlashData("msg", 'Mật khẩu không chính xác!');
                    setFlashData('msg_type', 'danger');
                    redirect('?role=client&mod=login');
                }
            } else {
                setFlashData("msg", 'Email không tồn tại trong hệ thống!');
                setFlashData('msg_type', 'danger');
                redirect('?role=client&mod=login');
            }
        } else {
            setFlashData('msg', 'Vui lòng nhập email và mật khẩu');
            setFlashData('msg_type', 'danger');
            redirect('?role=client&mod=login');
        }
    }
}

// function createPostAction()
// {
//     // echo $_SERVER['REQUEST_METHOD'];    

//     global $config;
//     if (isset($_POST['btn-create'])) {
//         $email = $_POST['email'];
//         $pass = $_POST['pass'];
//         $name = $_POST['name'];
//         $creatAt = date('Y-m-d');

//         if (isEmptyString($email)) {
//             $_SESSION['error'] = "Rỗng";
//         };
//         validateString($name);
//         validateString($pass);
//         if (isset($_SESSION['error'])) {
//         } else {
//             header("Location:{$config['baseUrl']}?role=client");
//         }
//     }
// }

function validateString($inputString)
{
    // Kiểm tra xem chuỗi có chứa ký tự đặc biệt hay không
    if (preg_match('/[^a-zA-Z0-9]/', $inputString)) {
        return false;
    }
    return true;
}

function isEmptyString($inputString)
{
    // Kiểm tra xem chuỗi có chứa ký tự đặc biệt hay không
    if (empty($inputString)) {
        return true;
    }
    return false;
}
