<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->quote) || !isset($data->author_id) || !isset($data->category_id)) {
        echo json_encode(array("message" => "Missing Required Parameters"));
        die();
    }

    if (!isValid($data->author_id, new Author($db))) {
        echo json_encode(array("message"=> "author_id Not Found"));
    }

    if (!isValid($data->category_id, new Category($db))) {
        echo json_encode(array("message"=> "category_id Not Found"));
    }

    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    // Create Quote
    if($quote->create()) {
        echo json_encode(array('message' => 'created quote (' .
        $quote->id . "," . $quote->quote .')'));
    } else {
        echo json_encode(array('message' => 'quote_id Not Found'));
    }
