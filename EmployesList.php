<?php

require_once("header.php");

?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include './navbar.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include './aside.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Liste des employés</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Liste des employés</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->

      <div class="card">
        <div class="card-header">
          <!-- <h3 class="card-title">DataTable with default features</h3> -->
          <h1 style="margin-left: 900px;"><a href="AddEmploye.php" class="btn btn-danger btn-lg">
              <i class="fas fa-plus"></i>Ajouter</a></h1>
          <?php
          if (!empty($_SESSION['erreur'])) {
            echo '<div class="alert alert-danger" role="alert" aria-label="Close">
                      ' . $_SESSION['erreur'] . ' 
                      </div>';
            $_SESSION['erreur'] = "";
          }
          if (!empty($_SESSION['success'])) {
            echo '<div class="alert alert-success" role="alert" aria-label="Close">
                    ' . $_SESSION['success'] . ' 
                    </div>';
            $_SESSION['success'] = "";
          }
          ?>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>

                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>age</th>
                <th>Sex</th>
                <th>Mail</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>
              <?php
              require('./core/Database/connection.php');
              $conn = (new Database())->getConnection();
              $q = $conn->prepare("SElECT * FROM employes WHERE desactivate=1");
              $q->execute();
              $employes = $q->fetchall(PDO::FETCH_OBJ);

              // $qemploye = $conn->query('SELECT * FROM employes');

              // foreach ($query as $conge) {
              //   $qemploye1 = $conn->query('SELECT * FROM employes');
              // 
              ?>
              <?php for ($i = 0; $i < count($employes); $i++) { ?>
                <tr>
                  <td><?= $employes[$i]->id_employee; ?></td>
                  <td><?= $employes[$i]->name; ?></td>
                  <td><?= $employes[$i]->surname; ?></td>
                  <td><?= $employes[$i]->age; ?></td>
                  <td><?= $employes[$i]->sex; ?></td>
                  <td><?= $employes[$i]->mail; ?></td>
                  <td width=160>
                    <a class="btn btn-default" href="ViewEmployes.php?id= <?= $employes[$i]->id_employee; ?>"><i class="fas fa-eye"></i></a>

                    <a class="btn btn-warning" href="UpdateEmployes.php?id=<?= $employes[$i]->id_employee; ?>"> <i class="fas fa-edit"></i></a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $employes[$i]->id_employee; ?>"><i class="fas fa-trash"></i></button>
                    <div class="modal fade" id="exampleModal<?= $employes[$i]->id_employee; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Gestion des employes</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Voulez vous vraiment cette employé ?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
                            <a class="btn btn-danger" href="DeleteEmploye.php?id=<?= $employes[$i]->id_employee; ?>">Oui</a>

                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                }
                  ?>
            </tbody>
          </table>

          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php

  require_once("footer.php");

  ?>