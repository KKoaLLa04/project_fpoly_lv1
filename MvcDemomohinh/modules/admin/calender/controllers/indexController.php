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
