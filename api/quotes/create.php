<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->quote)) {
        echo "POST submission MUST contain quote";
        die();
    }

    if (!isset($data->author_id)) {
        echo "POST submission MUST contain author_id";
        die();
    }

    if (!isset($data->category_id)) {
        echo "POST submission MUST contain category_id";
        die();
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
