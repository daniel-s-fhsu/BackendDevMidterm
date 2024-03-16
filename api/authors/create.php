<?php


    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if ($data->author == null || $data->author == "") {
        echo "POST submission MUST contain author";
        die();
    }

    $author->author = $data->author;
    // Create author
    if($author->create()) {
        echo json_encode(array('message' => 'created author (' .
        $author->id . "," . $author->author .')'));
    } else {
        echo json_encode(array('message' => 'author_id Not Found'));
    }
