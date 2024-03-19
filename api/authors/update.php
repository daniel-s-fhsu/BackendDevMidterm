<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->id) || !isset($data->author)) {
        echo "Missing Required Parameters";
        die();
    }

    $author->author = $data->author;
    $author->id = $data->id;
    // Update author
    if($author->update()) {
        echo json_encode(array('id'     => $author->id,
                               'author' => $author->author));
    } else {
        echo json_encode(array('message' => 'author_id Not Found'));
    }
