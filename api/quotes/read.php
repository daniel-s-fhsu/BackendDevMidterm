<?php
    // Get query string information
    $quote->category_id = isset($_GET['category_id']) ? $_GET['category_id'] : "";
    $quote->author_id = isset($_GET["author_id"]) ? $_GET["author_id"] : "";

    // Check for random
    $is_random_string =  isset($_GET['random']) ? $_GET['random'] : 'false';
    $is_random = $is_random_string == "true" ? true : false;

    // Quote query
    $result = $quote->read($is_random);
    // Get row count
    $num = $result->rowCount();

    // Check if any quotes
    if ($num >0 ) {
        // Quotes array
        $quotes_arr = array();
        //$quotes_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $quote_item = array(
                'id' => $id,
                'quote' => $quote,
                'author' => $author_name,
                'category' => $category_name
            );

            // Push to "data"
            array_push($quotes_arr, $quote_item);

        }

        // JSON encode
        echo json_encode($quotes_arr);

    } else {
        // No quotes
        echo json_encode(array('message' => 'No Quotes Found'));
    }