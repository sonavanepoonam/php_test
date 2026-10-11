<?php 
include 'db.php'; 
require 'vendor/autoload.php'; 
 
$result = $conn->query("select * from products"); 
 
$pdf = new TCPDF(); 
$pdf->AddPage(); 
$pdf->setFont("times","I",12); 
 
$html = '<table border="1" cellpadding="5" bgcolor="lightblue"> 
<tr> 
<td> Id</td> 
<td>User Id</td> 
<td>Product Name</td>
<td>Category</td>
<td>Price</td>
<td>Quantity</td>
<td>Description</td>
</tr> 
'; 
 
while($row = $result->fetch_assoc()){ 

$html .= '<tr> 
<td>'.$row["id"].'</td> 
<td>'.$row["user_id"].'</td> 
<td>'.$row["pname"].'</td>
<td>'.$row["category"].'</td>
<td>'.$row["price"].'</td>
<td>'.$row["quantity"].'</td>
<td>'.$row["description"].'</td>
</tr>'; 

} 
 
$html .= '</table>'; 
 
$pdf->writeHTML($html,true,false,true,false,''); 
$pdf->Output('products.pdf','D'); 
?>