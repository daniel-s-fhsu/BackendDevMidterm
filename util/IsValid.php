<?php

// Function to determine if entry exists in the database
function isValid($id, $model) {
    // Set the id on the model
    $model->id = $id;
    // Call the read_single method
    $model->read_single();
    
    // Check if at least one field exists and is not empty
    $fieldsToCheck = ['author', 'quote', 'category'];
    foreach ($fieldsToCheck as $field) {
        if (property_exists($model, $field) && !empty($model->$field)) {
            return true;
        }
    }
    
    // None of the fields are present
    return false;
}