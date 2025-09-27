<?php
require_once dirname(__FILE__) . '/../controllers/category_controller.php';

if (isset($_POST['cat_id'])) {
    $cat_id = $_POST['cat_id'];

    if (delete_category_ctr($cat_id)) {
        echo "Category deleted successfully";
    } else {
        echo "Failed to delete category";
    }
} else {
    echo "No category ID provided";
}
