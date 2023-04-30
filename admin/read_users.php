<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
 
// include classes
include_once '../config/database.php';
include_once '../classes/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user_obj = new User($db);
 
// set page title
$page_title = "Users";
 
// include page header HTML
include_once "misc/layout_head.php";
 
echo "<div class='col-md-12'>";
 
    // read all users from the database
    $stmt = $user_obj->readAll($from_record_num, $records_per_page);
 
    // count retrieved users
    $num = $stmt->rowCount();
 
    // to identify page for paging
    $page_url="read_users.php?";
 
    // include products table HTML template
    include_once "read_users_template.php";


   
    echo "<div class='center'>";
    include_once 'paging.php';
    echo "</div>";
    echo "</div>";
?>
<!-- Modal for update-->
<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Update Order</h4>
        </div>
     <div id="showModalBodyFooter1"></div>
    </div>
  </div>
</div>
<script language="JavaScript" type="text/javascript" src="../scripts/user.js"></script>
<?php
// include page footer HTML
include_once "misc/layout_foot.php";
?>