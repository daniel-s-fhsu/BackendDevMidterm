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
    include_once '../../models/Category.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if ($data->category == null || $data->category == "" ||
        $data->id == null || $data->id == "") {
        echo "PUT submission MUST contain id and category";
        die();
    }

    $category->category = $data->category;
    $category->id = $data->id;
    // Update category
    if($category->update()) {
        echo json_encode(array('message' => 'updated category (' .
        $category->id . "," . $category->category .')'));
    } else {
        echo json_encode(array('message' => 'category_id Not Found'));
    }
