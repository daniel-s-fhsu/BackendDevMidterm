<?php

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Check if there was an id specified
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    if ($id === '') {
        //No id, get all authors
        require('read.php');
    } else {
        //There was an id, get read_single
        require('read_single.php');
    }
} else if ($method == 'POST') {
    require('create.php');
} else if ($method == 'PUT') {
    require('update.php');
} else if ($method == 'DELETE') {
    require('delete.php');
}