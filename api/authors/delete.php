<?php
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->id)) {
        echo json_encode(array('message' => "Missing Required Parameters"));
        die();
    }

    if (isValid($data->id, $author) == False) {
        echo "DELETE submission MUST contain valid id";
        die();
    }
    $author->id = $data->id;
    // DELETE author
    if($author->delete()) {
        echo json_encode(array('id' => $author->id));
    } else {
        echo json_encode(array('message' => 'author_id Not Found'));
    }
