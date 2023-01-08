<?php
session_start();

   if(isset($_GET['id'])){
    
   if(isset($_POST['send'])){

    require_once('./../../core/Database/connection.php');
    $conn = (new Database())->getConnection();
    $sdate = htmlspecialchars($_POST['leave_start_date']);
    $ld = htmlspecialchars($_POST['leave_duration']);
        $id = $_GET['id'];
      $q = $conn->prepare("UPDATE conges SET leave_start_date=?,leave_duration=? WHERE id_leave =?");
      $q->execute(array($sdate,$ld,$id));
    }
      $_SESSION['success'] = "<center>Modifier avec succes</center>";

 }
  header("location: index.php");
