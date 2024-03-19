<?php
    // Get ID
    $author->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Authors query
    $author->read_single();
    
    // Create array
    $author_arr = array(
        'id' => $author->id,
        'author' => $author->author
    );

    if ($author->author == null) {
        echo json_encode(array("message" => "author_id Not Found"));
    } else {
        // JSON encode
        print_r(json_encode($author_arr));
    }
