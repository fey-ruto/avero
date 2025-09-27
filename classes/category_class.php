<?php
// include db connection
require_once dirname(__FILE__) . '/../db/db_connection.php';

class Category extends db_connection
{
    // add category
    function add_category($cat_name)
    {
        $cat_name = mysqli_real_escape_string($this->db, $cat_name);
        $sql = "INSERT INTO categories (cat_name) VALUES ('$cat_name')";
        return $this->db_write_query($sql);
    }

    // get all categories
    function get_categories()
    {
        $sql = "SELECT * FROM categories";
        return $this->db_fetch_all($sql);
    }

    // update category name
    function update_category($cat_id, $new_name)
    {
        $new_name = mysqli_real_escape_string($this->db, $new_name);
        $sql = "UPDATE categories SET cat_name = '$new_name' WHERE cat_id = '$cat_id'";
        return $this->db_write_query($sql);
    }

    // delete category
    function delete_category($cat_id)
    {
        $sql = "DELETE FROM categories WHERE cat_id = '$cat_id'";
        return $this->db_write_query($sql);
    }
}
