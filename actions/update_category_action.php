<?php
require_once dirname(__FILE__) . '/../controllers/category_controller.php';

if (isset($_POST['cat_id']) && isset($_POST['cat_name'])) {
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];

    if (update_category_ctr($cat_id, $cat_name)) {
        echo "Category updated successfully";
    } else {
        echo "Failed to update category";
    }
} else {
    echo "Invalid data provided";
}
