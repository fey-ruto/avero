<?php
require_once dirname(__FILE__) . '/../settings/core.php'; 
require_once dirname(__FILE__) . '/../controllers/category_controller.php';

// check if user is logged in
if (!is_logged_in()) {
    header("Location: ../login/login.php");
    exit();
}

// check if user is admin
if (!is_admin()) {
    header("Location: ../login/login.php");
    exit();
}

// handle form submissions
$message = "";

if (isset($_POST['add_category'])) {
    $cat_name = $_POST['cat_name'];
    if (add_category_ctr($cat_name)) {
        $message = "Category added successfully.";
    } else {
        $message = "Failed to add category.";
    }
}

if (isset($_POST['update_category'])) {
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['new_name'];
    if (update_category_ctr($cat_id, $cat_name)) {
        $message = "Category updated successfully.";
    } else {
        $message = "Failed to update category.";
    }
}

if (isset($_POST['delete_category'])) {
    $cat_id = $_POST['cat_id'];
    if (delete_category_ctr($cat_id)) {
        $message = "Category deleted successfully.";
    } else {
        $message = "Failed to delete category.";
    }
}

// fetch all categories
$categories = get_categories_ctr();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Categories</title>
</head>
<body>
    <h2>Category Management</h2>
    <?php if ($message != "") echo "<p><b>$message</b></p>"; ?>

    <!-- Add Category Form -->
    <form method="POST">
        <input type="text" name="cat_name" placeholder="Enter category name" required>
        <button type="submit" name="add_category">Add Category</button>
    </form>

    <hr>

    <!-- Display Categories -->
    <h3>All Categories</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        if ($categories) {
            foreach ($categories as $cat) {
                echo "<tr>
                        <td>{$cat['cat_id']}</td>
                        <td>{$cat['cat_name']}</td>
                        <td>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='cat_id' value='{$cat['cat_id']}'>
                                <input type='text' name='new_name' placeholder='New name' required>
                                <button type='submit' name='update_category'>Update</button>
                            </form>
                        </td>
                        <td>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='cat_id' value='{$cat['cat_id']}'>
                                <button type='submit' name='delete_category'>Delete</button>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No categories found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
