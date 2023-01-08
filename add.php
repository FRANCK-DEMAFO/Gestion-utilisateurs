<?php
session_start();

require_once('./core/Database/connection.php');
$conn = (new Database())->getConnection();

if (isset($_POST['send'])) {

  $name = htmlspecialchars($_POST['name']);
  $sdate = htmlspecialchars($_POST['leave_start_date']);
  $ld = htmlspecialchars($_POST['leave_duration']);

  $sql = $conn->prepare('SELECT*FROM conges WHERE id_employee =? AND  	disable =1');
  $sql->execute(array($name));

  if ($sql->rowcount() > 0) {

    $_SESSION['erreur'] = "<center> Cet employe a deja un conge </center>";
  } else {

    $q = $conn->prepare("INSERT INTO conges(leave_start_date,id_employee,leave_duration) VALUES (?,?,?)");
    $q->execute(array($sdate, $name, $ld));

    $_SESSION['success'] = "<center>ajouter avec succes</center>";
  }

  if ($ld > 30) {

    $_SESSION['erreur'] = "<center>un employe ne peut pas avoir un conge de plus de 30 jours</center>";
  }
  header("location: LeaveList.php");
}

