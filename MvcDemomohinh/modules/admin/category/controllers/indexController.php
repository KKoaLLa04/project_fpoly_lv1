<?php

function construct() {
    load_model('index');
}

function indexAction() {
    $data['categories'] = get_list_categories();
    load_view('index', $data);
}
function createAction(){
    load_view('create');
}
function createPostAction(){
    $name=$_POST['name'];
    $description=$_POST['description'];
    create_category($name,$description);
    header("Location:{$config['baseUrl']}?role=admin&mod=category");
}
function deleteAction(){
    $id=$_GET['id_cate'];
    delete_category($id);
    header("Location:{$config['baseUrl']}?role=admin&mod=category");
}
function updateAction(){
    $id=$_GET['id_cate'];
    $data['cate_update']=get_one_category($id);
    
    if(!$cate){
        header("Location:{$config['baseUrl']}?role=admin&mod=category");
        die();
    }
    load_view('update',$data);
    die();
    $name=$_POST['name'];
    $description=$_POST['description'];
    update_category($id,$name,$description);
    header("Location:{$config['baseUrl']}?role=admin&mod=category");
}