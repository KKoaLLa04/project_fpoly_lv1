<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load_view('index');
}

function indexPostAction()
{
    echo '<pre>';
    print_r($_SERVER['REQUEST_METHOD']);
    echo '</pre>';
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
}
