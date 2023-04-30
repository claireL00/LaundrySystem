<?php
// core configuration
include_once "config/core.php";

include_once 'config/database.php';
include_once 'classes/orders.php';;
// instantiate database and objects
$database_obj = new Database();
$db = $database_obj->getConnection();
$order_obj = new Orders($db);

// set page title
$page_title=$_SESSION['firstname'] ." Dashboard";
 
// include login checker
$require_login=true;
include_once "login_checker.php";
 
// include page header HTML
include_once 'misc/layout_head.php';
 
echo "<div class='col-md-12'>";
 
    // to prevent undefined index notice
    $action = isset($_GET['action']) ? $_GET['action'] : "";
    
    // if user is already logged in, shown when user tries to access the login page
     if($action=='already_logged_in'){
        echo "<div class='alert alert-info'>";
            echo "<strong>You are already logged in.</strong>";
        echo "</div>";
    }

        echo " <div class='row'>
        <div class='col'>
        <button type='button' class='btn btn-primary orderButton center' customerId=' ";
         echo $_SESSION['user_id'];
         echo "'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> New Entry</button>
        </div>";
     $order_obj->customerId= $_SESSION['user_id'];
     
      echo "<br>";
       // read all order from the database
     $stmt = $order_obj->readOrder();
     
     
     include_once "read_orders_template.php";

?>




</div><br>
<!-- Modal for adding job order-->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Add</h4>
        </div>
     <div id="showModalBodyFooter1"></div>
    </div>
  </div>
</div>

<script src="scripts/order.js"></script>
<?php
// footer HTML and JavaScript codes
include 'misc/layout_foot.php';
?>

