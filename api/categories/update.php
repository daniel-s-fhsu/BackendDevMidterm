<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->id) || !isset($data->category)) {
        echo json_encode(array("message" => "Missing Required Parameters"));
        die();
    }

    $category->category = $data->category;
    $category->id = $data->id;
    // Update category
    if($category->update()) {
        echo json_encode(array('id'         => $category->id,
                               'category'   => $category->category));
    } else {
        echo json_encode(array('message' => 'category_id Not Found'));
    }
