<?php

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Check if there was an id specified
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    if ($id === '') {
        //No id, get all authors
        require('read.php');
    }
} else if ($method == 'POST') {

}