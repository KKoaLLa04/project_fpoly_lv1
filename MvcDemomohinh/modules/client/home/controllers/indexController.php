<?php 
session_start();

function construct() {
    load_model('index');
}

function indexAction() {
    load_view('index');
}


?>