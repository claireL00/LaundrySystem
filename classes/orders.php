<?php
// 'order' object
class Orders{
 
    // database connection and table name
    private $conn;
    private $table_name = "orders";
 
    // object properties
    public $orderId;
    public $customerId;
    public $categoryId;
    public $kilo;
    public $laundry_status;
    public $firstname;
    public $lastname;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    // read all user records
    function readAll($from_record_num, $records_per_page){
 
    // query to read all user records, with limit clause for pagination
    $query = " SELECT *, (o.kilo*l.costperKilo)as totalCost
            FROM orders o
            INNER JOIN users u ON o.customerId=u.id
            INNER JOIN laundry_categories l ON o.categoryId = l.categoryId 
            ORDER BY orderId
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
    $query = "SELECT orderId FROM " . $this->table_name . "";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // return row count
    return $num;
}
function readOne(){
  
    $query = "SELECT *, (o.kilo*l.costperKilo)as totalCost
            FROM orders o
            INNER JOIN users u ON o.customerId=u.id
            INNER JOIN laundry_categories l ON o.categoryId = l.categoryId
            WHERE
                orderId = ?
            LIMIT
                0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->orderId);
    $stmt->execute();
  
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    $this->orderId = $row['orderId'];
    $this->customerId = $row['customerId'];
    $this->categoryId = $row['categoryId'];
    $this->kilo = $row['kilo'];
    $this->laundry_status = $row['laundry_status'];
    $this->firstname = $row['firstname'];
    $this->lastname = $row['lastname'];
    $this-> totalCost = $row['totalCost'];
}
function update(){
    try
        {
    $query="UPDATE " . $this->table_name . "  SET categoryId=?, kilo=?, laundry_status=?
    WHERE orderId=? "; //query to update

    $stmt = $this->conn->prepare( $query );
     // posted values
    $stmt->bindparam(1, $this->categoryId);
    $stmt->bindparam(2, $this->kilo);
    $stmt->bindparam(3, $this->laundry_status);
    $stmt->bindparam(4, $this->orderId);
    $stmt->execute();
    if (!$stmt->execute())
    {
        throw new Exception('Could not execute SQL statement: ' . var_export($stmt->errorInfo(), TRUE));   
    }
    return true;

    }
catch(Exception $e)
    {
    // Here you can filter on error messages and display a proper one.
    return $e->getMessage();
    }
}


public function deleteOrder(){
    try
    {
    $query="DELETE FROM " . $this->table_name . "  WHERE orderId=?"; //query to delete

    $stmt = $this->conn->prepare($query);
    $stmt->bindparam(1, $this->orderId);
    if (!$stmt->execute())
    {
        throw new Exception('Could not execute SQL statement: ' . var_export($stmt->errorInfo(), TRUE));   
    }
    return true;

    }
catch(Exception $e)
    {
    // Here you can filter on error messages and display a proper one.
    return $e->getMessage();
    }

}

    
    // create event
    function create(){
        try
        {
        $query="INSERT INTO " . $this->table_name . " SET customerId=?, categoryId=?, kilo=?, laundry_status=?"; //query to insert

        $stmt = $this->conn->prepare( $query );


        $stmt->bindparam(1, $this->customerId);
        $stmt->bindparam(2, $this->categoryId);
        $stmt->bindparam(3, $this->kilo);
        $stmt->bindparam(4, $this->laundry_status);
        if (!$stmt->execute())
    {
        throw new Exception('Could not execute SQL statement: ' . var_export($stmt->errorInfo(), TRUE));   
    }
    return true;

    }
catch(Exception $e)
    {
    // Here you can filter on error messages and display a proper one.
    return $e->getMessage();
    }
        
}
    function readOrder(){
 
    // query to read all user records, with limit clause for pagination
    $query = " SELECT *, (o.kilo*l.costperKilo)as totalCost
            FROM orders o
            INNER JOIN users u ON o.customerId=u.id
            INNER JOIN laundry_categories l ON o.categoryId = l.categoryId 
            where o.customerId=?
            ORDER BY orderId";
 

    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
  
    $stmt->bindParam(1,$this->customerId);
    // execute query
    $stmt->execute();
 
    // return values
    return $stmt;
}

public function countOrder(){
  
    // select query
    $query = "SELECT
                COUNT(*) as total_rows
            FROM
                " . $this->table_name . " 
            WHERE customerId = ?";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind variable values
    $stmt->bindParam(1,$this->customerId);
  
  
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    return $row['total_rows'];
}


//cancel order
function cancelOrder(){
    try
        {
    $query="UPDATE " . $this->table_name . "  SET laundry_status=?
    WHERE orderId=? "; //query to update

    $stmt = $this->conn->prepare( $query );
     // posted values
    $stmt->bindparam(1, $this->laundry_status);
    $stmt->bindparam(2, $this->orderId);
    $stmt->execute();
    if (!$stmt->execute())
    {
        throw new Exception('Could not execute SQL statement: ' . var_export($stmt->errorInfo(), TRUE));   
    }
    return true;

    }
catch(Exception $e)
    {
    // Here you can filter on error messages and display a proper one.
    return $e->getMessage();
    }
}


// read products by search term
public function search($search_term, $from_record_num, $records_per_page){
    // select query
    $query = "SELECT *, (o.kilo*l.costperKilo)as 
            totalCost
            FROM orders o
            INNER JOIN users u ON o.customerId=u.id
            INNER JOIN laundry_categories l ON o.categoryId = l.categoryId 
            WHERE
                u.firstname LIKE ? OR u.lastname LIKE ? OR u.email LIKE ?
            LIMIT
                ?, ?";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind variable values
    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);
    $stmt->bindParam(2, $search_term);
    $stmt->bindParam(3, $search_term);
    $stmt->bindParam(4, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(5, $records_per_page, PDO::PARAM_INT);
  
    // execute query
    $stmt->execute();
  
    // return values from database
    return $stmt;
}

//count search result
public function countAll_BySearch($search_term){
  
    // select query
    $query = "SELECT COUNT(*) as total_rows
            FROM orders o
            INNER JOIN users u ON o.customerId=u.id
            INNER JOIN laundry_categories l ON o.categoryId = l.categoryId 
            WHERE
                u.firstname LIKE ? OR u.lastname LIKE ? OR u.email LIKE ?";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind variable values
    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);
    $stmt->bindParam(2, $search_term);
    $stmt->bindParam(3, $search_term);
  
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    return $row['total_rows'];
}

}