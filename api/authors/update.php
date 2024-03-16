<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if ($data->author == null || $data->author == "" ||
        $data->id == null || $data->id == "") {
        echo "PUT submission MUST contain id and author";
        die();
    }

    $author->author = $data->author;
    $author->id = $data->id;
    // Update author
    if($author->update()) {
        echo json_encode(array('message' => 'updated author (' .
        $author->id . "," . $author->author .')'));
    } else {
        echo json_encode(array('message' => 'author_id Not Found'));
    }
