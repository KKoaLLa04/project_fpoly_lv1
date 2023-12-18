<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $data['spring_blocks_lists'] = get_lists_spring_blocks();
    load_view('index', $data);
}
