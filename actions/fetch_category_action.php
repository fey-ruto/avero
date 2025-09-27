<?php
require_once dirname(__FILE__) . '/../controllers/category_controller.php';

$categories = get_categories_ctr();

if ($categories) {
    echo json_encode($categories);
} else {
    echo json_encode([]);
}
