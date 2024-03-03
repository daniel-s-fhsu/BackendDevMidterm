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

    // Get ID
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Blog post query
    $category->read_single();
    
    // Create array
    $category_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );

    if ($category->category == null) {
        echo "category_id Not Found";
    } else {
        // JSON encode
        print_r(json_encode($category_arr));
    }
