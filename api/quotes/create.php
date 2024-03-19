<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->quote) || !isset($data->author_id) || !isset($data->category_id)) {
        echo json_encode(array("message" => "Missing Required Parameters"));
        die();
    }

    if (!isValid($data->author_id, new Author($db))) {
        echo json_encode(array("message"=> "author_id Not Found"));
        die();
    }

    if (!isValid($data->category_id, new Category($db))) {
        echo json_encode(array("message"=> "category_id Not Found"));
        die();
    }

    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    // Create Quote
    if($quote->create()) {
        $quote_arr = array(
            'id' => $quote->id,
            'quote' => $quote->quote,
            'author_id' => $quote->author_id,
            'category_id' => $quote->category_id
        );
        echo json_encode($quote_arr);
    } else {
        echo json_encode(array('message' => 'quote_id Not Found'));
    }
