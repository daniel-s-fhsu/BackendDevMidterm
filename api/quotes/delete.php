<?php
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