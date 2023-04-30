<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
 
// include classes
include_once '../config/database.php';
include_once '../classes/laundryCategories.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$category = new Categories($db);
 
// set page title
$page_title = "Laundry Categories";
 
// include page header HTML
include_once "misc/layout_head.php";
 
echo "<div class='col-md-12'>";
 
    // read all category from the database
    $stmt = $category->readAll($from_record_num, $records_per_page);
 
    // count retrieved category
    $num = $stmt->rowCount();
 
    // to identify page for paging
    $page_url="laundryCategories.php?";
 
    // include products table HTML template
    include_once "laundryCategories_template.php";
 
echo "</div>";
 
// include page footer HTML
include_once "misc/layout_foot.php";
?>