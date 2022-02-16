<?php
// Connect to database
$connection = mysqli_connect('localhost', 'root', '', 'phpcrud');

$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        // Retrive category
        if (!empty($_GET["id"])) {
            $category_id = intval($_GET["id"]);
            get_category($category_id);
        } else {
            get_category();
        }
        break;
    case 'POST':
        // Insert category
        insert_category();
        break;
    case 'PUT':
        // Update category
        $category_id = intval($_GET["id"]);
        update_category($category_id);
        break;
    case 'DELETE':
        // Delete category
        $category_id = intval($_GET["id"]);
        delete_category($category_id);
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function insert_category()
{
    global $connection;
    $category_name = $_POST["name"];

    $query = "INSERT INTO category SET name='{$category_name}'";
    if (mysqli_query($connection, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'category Added Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'category Addition Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
function get_category($category_id = 0)
{
    global $connection;
    $query = "SELECT * FROM category";
    if ($category_id != 0) {
        $query .= " WHERE id=" . $category_id;
    }
    $response = array();
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($result)) {
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function delete_category($category_id)
{
    global $connection;
    $query = "DELETE FROM category WHERE id=" . $category_id;
    if (mysqli_query($connection, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'category Deleted Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'category Deletion Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
function update_category($category_id)
{
    global $connection;
    //parse_str(file_get_contents("php://input"),$post_vars);
    parse_str(file_get_contents("php://input"), $post_vars);
    $category_name = $post_vars["name"];

    $query = "UPDATE category SET name='{$category_name}' WHERE id=" . $category_id;
    if (mysqli_query($connection, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'category Updated Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'category Updation Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close database connection
mysqli_close($connection);
