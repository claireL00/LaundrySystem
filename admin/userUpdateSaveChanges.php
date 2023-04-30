<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
 
// include classes
include_once '../config/database.php';
include_once '../classes/orders.php';
include_once '../classes/user.php';
include_once '../classes/laundryCategories.php';

// get database connection
$database = new Database();
$db = $database->getConnection();


$user_obj = new User($db);


//if form was submitted
if($_POST){
    $user_obj->id=$_POST['id'];
    $user_obj->firstname=$_POST['firstname'];
    $user_obj->lastname=$_POST['lastname'];
    $user_obj->contact_number=$_POST['contact_number'];
    $user_obj->address=$_POST['address'];

    $result=$user_obj->update();
    if($result === TRUE){
        echo '<script>swal("Success!", "Changes saved.", "success");</script>';
    }
    else
        echo '<script>swal("Failed!", "Changes not saved.", "danger");</script>';

}
           // read all users from the database
    $stmt = $user_obj->readAll($from_record_num, $records_per_page);
 
    // count retrieved users
    $num = $stmt->rowCount();
 
    include_once "read_users_template.php";

    
?>