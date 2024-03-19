<?php

// Function to determine if entry exists in the database

function isValid($id, $model) {
    //Set the id on the model
    $model->id = $id;
    //Call the read_single method
    $model->read_single();
    //Return if exists
    return ($model->author != "" || $model->quote != "" || $model->category != "");
}