<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $data['teacher'] = get_teacher_lists();
    load_view('index', $data);
}
