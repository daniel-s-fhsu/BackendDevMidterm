<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if ($data->id == null || $data->id == "") {
        echo "DELETE submission MUST contain id";
        die();
    }

    $quote->id = $data->id;
    // DELETE Quote
    if($quote->delete()) {
        echo json_encode(array('message' => 'deleted quote '. $quote->id));
    } else {
        echo json_encode(array('message' => 'No Quotes Found'));
    }
