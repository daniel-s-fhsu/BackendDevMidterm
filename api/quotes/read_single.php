<?php
    // Get ID
    $quote->id = isset($_GET['id']) ? $_GET['id'] : die();

    // quote query
    $quote->read_single();

    // Create array
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author_name,
        'category' => $quote->category_name
    );

    if ($quote->quote == null) {
        echo json_encode(array("message" => "No Quotes Found"));
    } else {
        // JSON encode
        print_r(json_encode($quote_arr));
    }
