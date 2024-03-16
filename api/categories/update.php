<?php
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
