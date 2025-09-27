<?php
require_once dirname(__FILE__) . '/../classes/category_class.php';

// add category
function add_category_ctr($cat_name)
{
    $category = new Category();
    return $category->add_category($cat_name);
}

// get all categories
function get_categories_ctr()
{
    $category = new Category();
    return $category->get_categories();
}

// update category
function update_category_ctr($cat_id, $new_name)
{
    $category = new Category();
    return $category->update_category($cat_id, $new_name);
}

// delete category
function delete_category_ctr($cat_id)
{
    $category = new Category();
    return $category->delete_category($cat_id);
}
