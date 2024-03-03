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

    // Blog post query
    $result = $category->read();
    // Get row count
    $num = $result->rowCount();

    // Check if any posts
    if ($num >0 ) {
        // Post array
        $categories_arr = array();
        $categories_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $category_item = array(
                'id' => $id,
                'category' => $category
            );

            // Push to "data"
            array_push($categories_arr['data'], $category_item);

        }

        // JSON encode
        echo json_encode($categories_arr);

    } else {
        // No posts
        echo json_encode(array('message' => 'No categories Found'));
    }