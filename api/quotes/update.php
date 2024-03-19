<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->id) ||
        !isset($data->quote) ||
        !isset($data->category_id) ||
        !isset($data->author_id)) {
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

    if (!isValid($data->id, new Quote($db))) {
        echo json_encode(array("message"=> "No Quotes Found"));
        die();
    }

    $quote->quote = $data->quote;
    $quote->id = $data->id;
    $quote->category_id = $data->category_id;
    $quote->author_id = $data->author_id;
    // Update category
    if($quote->update()) {
        echo json_encode(array('id' => $quote->id,
                               'quote' => $quote->quote,
                               'author_id' => $quote->author_id,
                               'category_id' => $quote->category_id));
    } else {
        echo json_encode(array('message' => 'No Quotes Found'));
    }
