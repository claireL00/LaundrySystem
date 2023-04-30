<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
// include database and object files
include_once '../config/database.php';
include_once '../classes/orders.php';;
include_once '../classes/laundryCategories.php';
include_once '../classes/user.php'; 
// instantiate database and objects
$database_obj = new Database();
$db = $database_obj->getConnection();
$order_obj = new Orders($db);
$category_obj = new Categories($db);
$user_obj = new User($db);

// get search term
$search_term=isset($_GET['s']) ? $_GET['s'] : '';
  
$page_title = "You searched for \"{$search_term}\"";

// include page header HTML
include_once "misc/layout_head.php";

// query laundry orders
$stmt = $order_obj->search($search_term, $from_record_num, $records_per_page);
  
// specify the page where paging is used
$page_url="search.php?s={$search_term}&";
  
// count total rows - used for pagination
$num=$order_obj->countAll_BySearch($search_term);
$total_rows=$num;

echo "<div class='alert alert-info'>
<strong>".$num ." records found.</strong>
</div>";

   // include products table HTML template
include_once "read_orders_template.php";
echo "<div class='center'>";
include_once 'paging.php';
echo "</div>";

// include page footer HTML
include_once "misc/layout_foot.php";
?>