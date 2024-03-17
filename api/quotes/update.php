<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->id) ||
        !isset($data->quote) ||
        !isset($data->category_id) ||
        !isset($data->author_id)) {
        echo "PUT submission MUST contain id quote category_id and author_id";
        die();
    }

    $quote->quote = $data->quote;
    $quote->id = $data->id;
    $quote->category_id = $data->category_id;
    $quote->author_id = $data->author_id;
    // Update category
    if($quote->update()) {
        echo json_encode(array('message' => 'updated quote (' .
        $quote->id . "," . $quote->quote .')'));
    } else {
        echo json_encode(array('message' => 'quote_id Not Found'));
    }
