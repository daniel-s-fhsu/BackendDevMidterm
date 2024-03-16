<?php
    // Author query
    $result = $author->read();
    // Get row count
    $num = $result->rowCount();

    // Check if any authors match
    if ($num >0 ) {
        // Authors array
        $authors_arr = array();
        $authors_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $author_item = array(
                'id' => $id,
                'author' => $author
            );

            // Push to "data"
            array_push($authors_arr['data'], $author_item);

        }

        // JSON encode
        echo json_encode($authors_arr);

    } else {
        // No authors
        echo json_encode(array('message' => 'No Authors Found'));
    }