

<?php
session_start();

   require_once('./core/Database/connection.php');
   $conn = (new Database())->getConnection();
   if(isset($_GET['id']))
   { 
    $id= $_GET['id'];
       $q = $conn->prepare("UPDATE conges SET disable=? WHERE id_leave=?;");
       $q->execute(array(0,$id));
    $_SESSION['success'] = "<center>Supprimer avec succes</center>";
   }
  header("location: LeaveList.php");
?>
