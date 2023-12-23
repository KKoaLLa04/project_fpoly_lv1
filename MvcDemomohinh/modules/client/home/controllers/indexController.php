<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
    load_view('index');
}
