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

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    // Get ID
    $author->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Blog post query
    $author->read_single();
    
    // Create array
    $author_arr = array(
        'id' => $author->id,
        'author' => $author->author
    );

    if ($author->author == null) {
        echo 'No author found with id ' . $author->id;
    } else {
        // JSON encode
        print_r(json_encode($author_arr));
    }

    // } else {
    //     // No posts
    //     echo json_encode(array('message' => 'No Authors Found with id '.
    //         $author->id));
    // }