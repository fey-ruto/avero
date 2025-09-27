<?php
require_once dirname(__FILE__) . '/../controllers/category_controller.php';

if (isset($_POST['cat_name'])) {
    $cat_name = $_POST['cat_name'];

    if (add_category_ctr($cat_name)) {
        echo "Category added successfully";
    } else {
        echo "Failed to add category (maybe it already exists)";
    }
} else {
    echo "No category name provided";
}
