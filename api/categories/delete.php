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

    // Instantiate Category object
    $category = new Category($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if ($data->id == null || $data->id == "") {
        echo "DELETE submission MUST contain id";
        die();
    }

    $category->id = $data->id;
    // DELETE Category
    if($category->delete()) {
        echo json_encode(array('message' => 'deleted category '. $category->id));
    } else {
        echo json_encode(array('message' => 'category_id Not Found'));
    }
