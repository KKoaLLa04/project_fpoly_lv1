<?php

$request_path = MODULESPATH . DIRECTORY_SEPARATOR . get_role() . DIRECTORY_SEPARATOR .  get_module() . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . get_controller() . 'Controller.php';

// modules/client/home/controllers/indexController.php
// modules/admin/subject/controllers/indexController.php
// modules/admin/spring_blocks/controllers/indexController.php

if (file_exists($request_path)) {
    require $request_path;
} else {
    echo "Không tìm thấy: $request_path ";
}

// get method if get default null
$method = $_SERVER['REQUEST_METHOD'] === 'GET' ? '' : $_SERVER['REQUEST_METHOD'];
//  mac dinh: $method = '';
// => $method = 'post';

$action_name = get_action() . ucfirst(strtolower($method)) . 'Action';
// PT GET: => $action_name = indexAction
// PT POST: => $action_name = indexPostAction

call_function(['construct', $action_name]);
download();
