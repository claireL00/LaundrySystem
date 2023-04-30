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
$page_title = "Reports-PDF";
 
// include page header HTML
include_once "misc/layout_head.php";
 
$categories = array(1 => '	
Clothes', 2 => 'Blankets', 3 => 'Comforter', 4 => 'Seat Cover', 5 => 'Curtains');
echo "<div class='col-md-12'>";
?>

<form class="form-inline" method="get"  action="generatePDF.php" target="_blank">
<label>Laundry Category</label>
    <div class="form-inline">
          <select class="form-control " id="inputGroupSelect04" aria-label="Example select with button addon" name="category">
          <option selected>Choose...</option>
          <?php
        foreach ($categories as $num => $category) {
            echo "<option value='".$num."'>".$category."</option>";
        }
    ?>
          </select>
          <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-file-pdf"></i>Generate PDF</button>
    </div>

</form>

<?php
echo "</div>";
?>