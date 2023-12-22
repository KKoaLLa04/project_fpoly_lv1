<?php 
session_start();
$error=[];
function construct() {
    load_model('index');
}
function createAction(){
    load_view('create');
}

function fogotAction(){
    load_view('fogot');
}
function indexAction(){
    load_view('index');


}

 
function indexPostAction() {
    global $config;
    if(isset($_POST['btn-login'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $login = login($email,$pass);
    
     if($login){
         $role = $login[0]['is_admin'];
         $_SESSION['role'] = $role;
         $_SESSION['loggedin'] = true;
         $_SESSION['email'] = $login[0]['email'];
         $_SESSION['user_id'] = $login[0]['id'];
         $_SESSION['username'] = $login[0]['name'];
         $_SESSION['password'] = $login[0]['password'];
         $_SESSION['success'] = "Welcome ". $_SESSION['username'];
         header("Location:{$config['baseUrl']}?role=client&mod=home");
         echo "<pre>";
         print_r($login[0]);
         echo "</pre>";
         }else{
             $_SESSION['error'] = "Login failed please login with correct username and password";
             header("Location:{$config['baseUrl']}?role=client");
             
         }
    }
}

function createPostAction() {
    // echo $_SERVER['REQUEST_METHOD'];    
    
    global $config;
    if(isset($_POST['btn-create'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $creatAt = date('Y-m-d');
   
    if(isEmptyString($email))
    {
        $_SESSION['error'] = "Rỗng";

    };
    validateString($name);
    validateString($pass);
    if(isset($_SESSION['error'])){

    }else{
        header("Location:{$config['baseUrl']}?role=client");
    }
    
    echo "<pre>";
    print_r();
    echo "</pre>";
   
    }
}

function validateString($inputString) {
    // Kiểm tra xem chuỗi có chứa ký tự đặc biệt hay không
    if (preg_match('/[^a-zA-Z0-9]/', $inputString)) {
        return false;
    }
    return true;

}

function isEmptyString($inputString) {
     // Kiểm tra xem chuỗi có chứa ký tự đặc biệt hay không
    if (empty($inputString)) {
        return true;
    }
    return false;
}


?>