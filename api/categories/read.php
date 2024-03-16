<?php
    // Category query
    $result = $category->read();
    // Get row count
    $num = $result->rowCount();

    // Check if any categories
    if ($num >0 ) {
        // Category array
        $categories_arr = array();
        $categories_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $category_item = array(
                'id' => $id,
                'category' => $category
            );

            // Push to "data"
            array_push($categories_arr['data'], $category_item);

        }

        // JSON encode
        echo json_encode($categories_arr);

    } else {
        // No categories
        echo json_encode(array('message' => 'No categories Found'));
    }