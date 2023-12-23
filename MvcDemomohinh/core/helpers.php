<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function loadLayout($path, $data = [])
{
    if (!empty($path)) {
        require_once './public/assets/clients/templates/' . $path . '.php';
    }
}

function view($data = [])
{
    $module = 'dashboard';
    $action = 'home';
    if (!empty($_GET['module'])) {
        $module = $_GET['module'];
    }

    if (!empty($_GET['action'])) {
        $action = $_GET['action'];
    }

    require_once './' . $module . '/views/' . $action . '.php';
}

function viewClient($data = [], $action = '')
{
    $module = 'home';
    $action = 'home';
    if (!empty($_GET['module'])) {
        $module = $_GET['module'];
    }

    if (!empty($_GET['action'])) {
        $action = $_GET['action'];
    }

    require_once './clients/' . $module . '/views/' . $action . '.php';
}

// kiem tra phuong thuc
function isPost()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    }
    return false;
}

function isGet()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        return true;
    }

    return false;
}

function getBody($method = '')
{
    $bodyArr = [];

    if (empty($method)) {
        if (isGet()) {
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }

        if (isPost()) {
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
    } else {
        if ($method == 'get') {
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        } elseif ($method == 'post') {
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
    }
    return $bodyArr;
}

// viet ham xu ly email
function isEmail($email)
{
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}

function isNumberInt($number, $range = [])
{
    /*
     * $range = ['min_range'=>1, 'max_range'=>20];
     *
     * */
    if (!empty($range)) {
        $options = ['options' => $range];
        $checkNumber = filter_var($number, FILTER_VALIDATE_INT, $options);
    } else {
        $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    }

    return $checkNumber;
}

//Kiểm tra số thực
function isNumberFloat($number, $range = [])
{
    /*
     * $range = ['min_range'=>1, 'max_range'=>20];
     *
     * */
    if (!empty($range)) {
        $options = ['options' => $range];
        $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT, $options);
    } else {
        $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
    }

    return $checkNumber;
}

function isPhone($phone)
{
    $pattern = '/^0[0-9]{9}$/';
    if (preg_match($pattern, $phone)) {
        return true;
    }

    return false;
}

function getMsg($msg, $msgType = 'danger')
{
    if (!empty($msg)) {
        echo '<div class="alert alert-' . $msgType . '">';
        echo $msg;
        echo '</div>';
    }
}

function redirect($path = 'index.php')
{
    header("Location: $path");
    exit;
}

function oldData($fieldName, $oldData, $default = null)
{
    return !empty($oldData[$fieldName]) ? $oldData[$fieldName] : $default;
}

function errorData($fieldName, $errorArr)
{
    return !empty($errorArr[$fieldName]) ? $errorArr[$fieldName] : false;
}

function activeMenuSidebar($module)
{
    if (!empty(getBody()['module'])) {
        if (getBody()['module'] == $module) {
            return true;
        }
    }

    return false;
}

function activeAction($action)
{
    if (!empty(getBody()['action'])) {
        if (getBody()['action'] == $action) {
            return true;
        }
    }

    return false;
}

function sendMail($to, $subject, $content)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'ndkdzvl@gmail.com';                     //SMTP username
        $mail->Password   = 'dchuzrbjuruftzrj';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('ndkdzvl@gmail.com', 'Fpt Polytechnic exam tool');
        $mail->addAddress($to);     //Add a recipient
        //Content
        $mail->isHTML(true);                             //Set email format to HTML
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        return $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}