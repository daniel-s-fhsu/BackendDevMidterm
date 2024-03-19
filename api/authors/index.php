<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit(); 
}

include_once '../../config/Database.php';
include_once '../../models/Author.php';
include_once '../../util/IsValid.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$author = new Author($db);

$method = $_SERVER['REQUEST_METHOD'];

echo $method;

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