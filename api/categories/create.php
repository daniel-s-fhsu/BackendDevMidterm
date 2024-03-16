<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if ($data->category == null || $data->category == "") {
        echo "POST submission MUST contain category";
        die();
    }

    $category->category = $data->category;
    // Create category
    if($category->create()) {
        echo json_encode(array('message' => 'created category (' .
        $category->id . "," . $category->category .')'));
    } else {
        echo json_encode(array('message' => 'category_id Not Found'));
    }
