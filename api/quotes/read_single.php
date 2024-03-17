<?php
    // Get ID
    $quote->id = isset($_GET['id']) ? $_GET['id'] : die();

    // quote query
    $quote->read_single();

    // Create array
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author_id' => $quote->author_id,
        'category_id' => $quote->category_id,
        'author_name' => $quote->author_name,
        'category_name' => $quote->category_name
    );

    if ($quote->quote == null) {
        echo "quote_id Not Found";
    } else {
        // JSON encode
        print_r(json_encode($quote_arr));
    }
