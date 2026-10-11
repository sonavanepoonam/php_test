<?php
include 'db.php';
header("Content-type=text/csv");
header("Content-disposition:attachment;filename=products.csv");
$output=fopen("php://output","w");
fputcsv($output,array("id","user_id","pname","category","price,quantity,description"));
$result=$conn->query("select * from products");
while($row=$result->fetch_assoc()){
    fputcsv($output,$row);
}
?>