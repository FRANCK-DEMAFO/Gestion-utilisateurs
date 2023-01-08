<?php
require_once("header.php");
?>
<script src="./assets/js/main2.js"></script>

<body class="hold-transition sidebar-mini layout-fixed" style="background: black;">
  <div class="wrapper">
    <?php include 'navbar.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include 'aside.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
            </div>
          </div>
        </div>
      </section>


      <!-- Main content -->
      <br><br>
      <section class="content">
        <div class="container">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>150</h3>

                  <p>Demande de conges</p>
                  <div class="icon">
                    <i class="fas fa-calendar"></i>
                  </div>
                </div>
                <!-- <div class="icon">
                <i class="ion ion-bag"></i>
              </div> -->
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>
                    <?php
                    require_once('./core/Database/connection.php');
                    $conn = (new Database())->getConnection();
                    $reqt = $conn->prepare("select * from conges where conges.disable=1");

                    $reqt->execute();
                    $nbr = $reqt->fetchall(PDO::FETCH_OBJ);
                    $nb_user = count($nbr);
                    echo $nb_user;
                    ?></h3>

                  <p>Conges en cours</p>

                  <div class="icon">

                    <i class="fas fa-thumbs-up"></i>
                  </div>
                </div>
                <!-- <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div> -->
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php
                      require_once('./core/Database/connection.php');
                      $conn = (new Database())->getConnection();
                      $reqt = $conn->prepare("select * from employes where employes.desactivate=1");

                      $reqt->execute();
                      $nbr = $reqt->fetchall(PDO::FETCH_OBJ);
                      $nb_user = count($nbr);
                      echo $nb_user;
                      ?></h3>

                  <p>Employes</p>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                </div>
                <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
              </div> -->
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php
                      require_once('./core/Database/connection.php');
                      $conn = (new Database())->getConnection();
                      $reqt = $conn->prepare("select * from demande_permissions where demande_permissions.deleted=0");

                      $reqt->execute();
                      $nbr = $reqt->fetchall(PDO::FETCH_OBJ);
                      $nb_user = count($nbr);
                      echo $nb_user;
                      ?></h3>

                  <p>Demandes de permission</p>
                  <div class="icon">
                    <i class="fas fa-book"></i>
                  </div>
                </div>
                <!-- <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div> -->
                <a href="PermissionInfo.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
      </section>
      <!-- /.content -->
    </div>
    <?php

    require_once("footer.php");

    ?>