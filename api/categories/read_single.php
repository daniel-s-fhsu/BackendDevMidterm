<?php
    // Get ID
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Category query
    $category->read_single();

    // Create array
    $category_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );

    if ($category->category == null) {
        echo "category_id Not Found";
    } else {
        // JSON encode
        print_r(json_encode($category_arr));
    }
