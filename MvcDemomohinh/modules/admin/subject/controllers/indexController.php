<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $data['subject'] = get_lists_subject();
    load_view('index', $data);
}

function createAction()
{
    load_view('create');
}

function createPostAction()
{
    global $config;

    if (isPost()) {
        $name = $_POST['name'];
        $create_tor = 1; // fix cứng 1 tạm thời

        $dataInsert = [
            'name' => $name,
            'creator_id' => $create_tor,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        insert('subjects', $dataInsert);
    }
    header("Location:{$config['baseUrl']}?role=admin&mod=subject");
}

function deleteAction()
{
    global $config;
    $id = $_GET['id'];
    $condition = "id=$id";
    delete('subjects', $condition);
    header("Location:{$config['baseUrl']}?role=admin&mod=subject");
}

function updateAction()
{
    global $config;
    if (isGet() && !empty($_GET['id'])) {
        $id = $_GET['id'];

        $subject_detail = get_subject_detail($id);
        if (!empty($subject_detail)) {
            $data['subject'] = $subject_detail;

            load_view('update', $data);
        } else {
            redirect('?role=admin&mod=subject');
        }
    } else {
        redirect('?role=admin&mod=subject');
    }
}
