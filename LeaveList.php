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
                            <h1>Liste des Demandes de conges</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Liste des Demandes de conges</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="card">
                <div class="card-header">
                    <!-- <h1>
                       
                        <button class="btn btn-warning"><a href="update_leaves.php">Actualiser</a></button>
                    </h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="example1"> -->
                    <?php
                    if (!empty($_SESSION['erreur'])) {
                        echo '<div class="alert alert-danger" role="alert">
                                        ' . $_SESSION['erreur'] . ' 
                                        </div>';
                        $_SESSION['erreur'] = "";
                    }
                    if (!empty($_SESSION['success'])) {
                        echo '<div class="alert alert-success" role="alert">
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
                                <th> Nom des employes</th>
                                <th>Date de debut</th>
                                <th>Nombre de jours</th>
                                <th>Duree</th>
                                <th>Nombre de jours restant</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require('./core/Database/connection.php');
                            $conn = (new Database())->getConnection();

                            $sql = "SElECT conges.id_leave, conges.leave_start_date, conges.annee, conges.leave_days, conges.used_days, conges.statut, conges.leave_duration, conges.id_employee,
                                 employes.name FROM conges LEFT JOIN employes ON conges.id_employee=employes.id_employee WHERE conges.disable = :disable";

                            $query = $conn->prepare($sql);
                            $query->bindValue(':disable', 1, \PDO::PARAM_INT);
                            $query->execute();
                            $qemploye = $conn->query('SELECT * FROM employes');

                            foreach ($query as $conge) {
                                $qemploye1 = $conn->query('SELECT * FROM employes');
                            ?>
                                <tr>
                                    <td><?= $conge['id_leave'] ?></td>
                                    <td><?= $conge['name'] ?></td>
                                    <td><?= $conge['leave_start_date'] ?></td>
                                    <td><?= $conge['leave_days'] ?></td>
                                    <td><?= $conge['leave_duration'] ?></td>
                                    <td><?= $diff = $conge['leave_days'] - $conge['used_days'] - $conge['leave_duration'] ?></td>

                                    <td width=160>
                                        <a class="btn btn-light" href="view.php?id=<?= $conge['id_leave'] ?>"><i class="fas fa-eye"></i> </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $conge['id_leave'] ?>"><i class="fas fa-trash"></i></button>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModale<?= $conge['id_leave'] ?>"><i class="fas fa-edit"></i></button>


                                        <!-- supprimer -->

                                        <div class="modal fade" id="exampleModal<?= $conge['id_leave'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Gestion conges</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Voulez vous vraiment supprimer?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
                                                        <a class="btn btn-danger" href="delete.php?id=<?= $conge['id_leave'] ?>">Oui</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- modifier -->
                                        <div class="modal fade" id="exampleModale<?php echo $conge['id_leave'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier un congé</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5> </h5><br>
                                                        <div class="row">
                                                            <div class="col-md-12 m-auto">
                                                                <label for="name"><strong>Nom de l'employe</strong></label>
                                                                <form class="form" action="update.php?id=<?php echo $conge['id_leave'] ?>" role="form" method="post" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <label for="name" hidden=""><strong>Nom de l'employe</strong></label>
                                                                        <input disabled type="text" class="form-control" value="<?= $conge['name'] ?>" id="" name="name" placeholder="" disabled>
                                                                    </div><br>
                                                                    <div class="form-group">
                                                                        <label for="leave_start_date"><strong>Date debut conge</strong></label>
                                                                        <input type="date" min="<?= date('Y-m-d') ?>" class="form-control" value="<?= $conge['leave_start_date'] ?>" id="" name="leave_start_date" placeholder="" required>
                                                                    </div><br>
                                                                    <div class="form-group">
                                                                        <label for="leave_duration"><strong>Duree du conge</strong></label>
                                                                        <input type="number" class="form-control" id="" value="<?= $conge['leave_duration'] ?>" name="leave_duration" placeholder="" required>
                                                                    </div><br>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="send" class="btn btn-success" href="update.php?id=<?php $conge['id_leave'] ?>">Modifier</button>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                        ?>
                                </tr>
                        </tbody>

                    </table>
                </div>


            </div>
        </div>
        <!-- Main content -->


    </div>
    <!-- /.col -->
    
    <!-- /.content-wrapper -->
    <?php

    require_once("footer.php");

    ?>