<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
 
// include classes
include_once '../config/database.php';
include_once '../classes/orders.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$order_obj = new Orders($db);
 
// set page title
$page_title = "Job Orders";
 
// include page header HTML
include_once "misc/layout_head.php";
 
echo "<div class='col-md-12'>";
 
    // read all users from the database
    $stmt = $order_obj->readAll($from_record_num, $records_per_page);
 
    // count retrieved orders
    $num = $stmt->rowCount();

    // to identify page for paging
    $page_url="orders.php?";
 
// search form
echo "<form role='search' action='search.php'>";
    echo "<div class='input-group col-md-6 pull-left margin-right-1em'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type firstname, lastname, or email' name='s' id='srch-term' required {$search_value} />";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form><br><br>";





    // include products table HTML template
    include_once "read_orders_template.php";
    echo "<div class='center'>";
    include_once 'paging.php';
    echo "</div>";
echo "</div>";
?>
<!-- Modal for update-->
<div class="modal fade" id="updateOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Update User</h4>
        </div>
     <div id="showModalBodyFooter1"></div>
    </div>
  </div>
</div>
<script language="JavaScript" type="text/javascript" src="../scripts/order.js"></script>
<?php
// include page footer HTML
include_once "misc/layout_foot.php";
?>