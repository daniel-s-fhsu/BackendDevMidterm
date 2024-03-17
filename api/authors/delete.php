<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->id)) {
        echo "DELETE submission MUST contain id";
        die();
    }

    if (isValid($data->id, $author) == False) {
        echo "DELETE submission MUST contain valid id";
        die();
    }
    $author->id = $data->id;
    // DELETE author
    if($author->delete()) {
        echo json_encode(array('message' => 'deleted author '. $author->id));
    } else {
        echo json_encode(array('message' => 'author_id Not Found'));
    }
