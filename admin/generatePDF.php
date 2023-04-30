<?php
//include connection file 
include_once "../config/database.php";
include_once 'fpdf.php';
 // instantiate database and objects
$database_obj = new Database();
$db = $database_obj->getConnection();

class PDF extends FPDF{
   
    function headerTable(){
        $this->SetFont('Arial','B',11);
        $this->Cell(30,10,'ID',1,0,'C');
        $this->Cell(80,10,'Customer Name',1,0,'C');
        $this->Cell(40,10,'Weight',1,0,'C');
        $this->Cell(50,10,'Total Cost',1,0,'C');
        $this->Ln();
    }
    function viewTable($db){
        $this->SetFont('Arial','',10);
        $stmt=$db->query("SELECT *, (o.kilo*l.costperKilo)as totalCost
        FROM orders o
        INNER JOIN users u ON o.customerId=u.id
        INNER JOIN laundry_categories l ON o.categoryId = l.categoryId 
        WHERE o.categoryId='".$_GET['category']."' 
        ");
       
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
        $this->Cell(30,10,$orderId,1,0,'C');
        $this->Cell(80,10,$firstname." ".$lastname,1,0,'C');
        $this->Cell(40,10,$kilo,1,0,'C');
        $this->Cell(50,10,$totalCost,1,0,'C');
        $this->Ln();
        }
    }
    function sum($db){
        $this->SetFont('Arial','B',10);
        $stmt=$db->query("SELECT SUM(o.kilo*l.costperKilo) as sumCost FROM orders o
        INNER JOIN users u ON o.customerId=u.id
        INNER JOIN laundry_categories l ON o.categoryId = l.categoryId 
        WHERE o.categoryId='".$_GET['category']."' 
        ");
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
        $this->Cell(150,10,"Total cost ",1,0,'R');
        $this->Cell(50,10,$sumCost,1,0,'C');
        $this->Ln();
        }
        
    }
    function count($db){
  
        $stmt=$db->query("SELECT COUNT(orderId) as total_rows FROM orders  WHERE categoryId='".$_GET['category']."' 
        ");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
        $this->SetFont('Arial','B',10);
        // Title
        $this->Cell(100,10,'Number of Orders: '. $total_rows,0,0,'L');
        // Line break
        $this->Ln(10);
        }
    }
}

$pdf = new PDF();
//header
$pdf->AddPage('L', 'A4', 0);
//footer page
$pdf->AliasNbPages();
if ($_GET['category']!="Choose..."){
$num=$pdf->count($db);
    $pdf->headerTable();
    $pdf->viewTable($db);
    $pdf->sum($db);
    $pdf->Output();
}
else{
    echo "<div class='alert alert-info'>No category selected.</div>";
}

?>