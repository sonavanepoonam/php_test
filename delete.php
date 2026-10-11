<?php
include "db.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = $conn->prepare("DELETE FROM products WHERE id=?");

    $sql->bind_param("i", $id);

    if($sql->execute()){

        header("Location: dashboard.php");
        exit();

    }

}
?>