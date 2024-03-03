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

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if ($data->author == null || $data->author == "" ||
        $data->id == null || $data->id == "") {
        echo "PUT submission MUST contain id and author";
        die();
    }

    $author->author = $data->author;
    $author->id = $data->id;
    // Update author
    if($author->update()) {
        echo json_encode(array('message' => 'updated author (' .
        $author->id . "," . $author->author .')'));
    } else {
        echo json_encode(array('message' => 'author_id Not Found'));
    }
