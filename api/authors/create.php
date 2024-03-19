<?php


    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->author)) {
        echo json_encode(array("message" => "Missing Required Parameters"));
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
