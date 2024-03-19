<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if ($data->id == null || $data->id == "") {
        echo json_encode(array("message" => "Missing Required Parameters"));
        die();
    }

    $quote->id = $data->id;
    // DELETE Quote
    if($quote->delete()) {
        echo json_encode(array('id' => $quote->id));
    } else {
        echo json_encode(array('message' => 'No Quotes Found'));
    }
