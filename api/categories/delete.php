<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if ($data->id == null || $data->id == "") {
        echo json_encode(array('message' => 'Missing Required Parameters'));
        die();
    }

    $category->id = $data->id;
    // DELETE Category
    if($category->delete()) {
        echo json_encode(array('id' => $category->id));
    } else {
        echo json_encode(array('message' => 'category_id Not Found'));
    }
