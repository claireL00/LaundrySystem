<?php
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../classes/user.php'; 


if($_POST){
    // instantiate database and objects
    $database_obj = new Database();
    $db = $database_obj->getConnection();
    $user_obj = new User($db);
    $user_obj->id=$_POST['userId_js'];



        $result= $user_obj->deleteUser();
        
        // query users
        $stmt =  $user_obj->readAll($from_record_num, $records_per_page);
        $num =$stmt->rowCount();
        $total_rows =  $user_obj->countAll();
        include_once 'read_users_template.php';

        
}
?>