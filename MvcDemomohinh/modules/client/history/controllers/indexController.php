<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    $data['exam_history'] = get_lists_examination_histories();
    load_view('index', $data);
}

