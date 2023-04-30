<?php
// 'user' object
class Categories{
 
    // database connection and table name
    private $conn;
    private $table_name = "laundry_categories";
 
    // object properties
    public $categoryId;
    public $categoryName;
    public $costperKilo;

 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function readAll($from_record_num, $records_per_page){
 
        // query to read all user records, with limit clause for pagination
        $query = "SELECT
                    categoryId,
                    categoryName,
                    costperKilo
                FROM " . $this->table_name . "
                ORDER BY categoryId 
                LIMIT ?, ?";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind limit clause variables
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
     
        // execute query
        $stmt->execute();
     
        // return values
        return $stmt;
    }
    // used for paging users
public function countAll(){
 
    // query to select all user records
    $query = "SELECT categoryId FROM " . $this->table_name . "";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // return row count
    return $num;
}
 // used by select drop-down list
 function read(){
    //select all data
    $query = "SELECT
               *
            FROM
                " . $this->table_name . "
            ORDER BY
                categoryName ASC";  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();

    return $stmt;
}
}