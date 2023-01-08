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
                            <h1>Liste des demandes de permission</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Liste des demandes de permission</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->

            <div class="card">
                <div class="card-header">
                    <!-- <h3 class="card-title">DataTable with default features</h3> -->

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
                    <div class="tableresponsive-">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Numero</th>
                                    <th>Nom</th>
                                    <th>Motif</th>
                                    <th>Date de creation</th>
                                    <th>Date de depart</th>
                                    <th>Date de retour</th>
                                    <th>Statut</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once('./core/Database/connection.php');
                                $conn = (new Database())->getConnection();
                                $q = $conn->prepare("SElECT demande_permissions.id_request, demande_permissions.reason, demande_permissions.creation_date, demande_permissions.depart_date,
                            demande_permissions.ending_date,demande_permissions.statut,employes.name FROM demande_permissions LEFT JOIN employes 
                            ON demande_permissions.id_employee=employes.id_employee WHERE deleted=0 ");
                                $q->execute();
                                $qemploye = $conn->query('SELECT * FROM employes');


                                // $permission=$q->fetchAll(PDO::FETCH_OBJ);
                                foreach ($q as $permission) {
                                    $qemploye1 = $conn->query('SELECT * FROM employes');
                                ?>
                                    <tr>
                                        <td><?= $permission['id_request'] ?></td>
                                        <td><?= $permission['name'] ?></td>
                                        <td><?= $permission['reason'] ?></td>
                                        <td><?= $permission['creation_date'] ?></td>
                                        <td><?= $permission['depart_date'] ?></td>
                                        <td><?= $permission['ending_date'] ?></td>
                                        <td><?= $permission['statut'] ?></td>
                                        <td width="160px">
                                            <?php

                                            if ($permission['statut'] == 'En attente') { ?>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#disapprove<?= $permission['id_request'] ?>">
                                                    <i class="fas fa-circle"></i>
                                                </button>
                                                <div class="modal fade" id="disapprove<?= $permission['id_request'] ?>" tabindex="-1" aria-labelledby="disapproveLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="disapproveLabel">Desapprouver une demande</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Etes vous sûre de vouloir desapprouver cette demande?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a class="btn btn-success" href="DesapprouveDemande.php?id=<?= $permission['id_request'] ?>">Oui</a>
                                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#approve<?= $permission['id_request'] ?> "><i class="fas fa-check cicle"></i></button>

                                                <div class="modal fade" id="approve<?= $permission['id_request'] ?>" tabindex="-1" aria-labelledby="approveLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="approveLabel">Approuver une demande</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Etes-vous sûre de vouloir approuver cette demande?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a class="btn btn-success" href="ApproveDemande.php?id=<?= $permission['id_request'] ?>"> Oui</a>
                                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $permission['id_request'] ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <div class="modal fade" id="delete<?= $permission['id_request'] ?>" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteLabel">Supprimer une demande</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Etes vous sûre de vouloir supprimer?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a class="btn btn-danger" href="DeleteDemande.php?id=<?= $permission['id_request'] ?>"> Oui</a>
                                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php
                                            if ($permission['statut'] == 'Approuvée') { ?>
                                                <center>
                                                    <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $permission['id_request'] ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <div class="modal fade" id="delete<?= $permission['id_request'] ?>" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteLabel">Supprimer une demande</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Etes vous sûre de vouloir supprimer?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a class="btn btn-success" href="delete.php?id=<?= $permission['id_request'] ?>"> Oui</a>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </center>

                                            <?php } ?>
                                            <?php
                                            if ($permission['statut'] == 'Desapprouvée') { ?>


                                            <?php } ?>
                                        </td>

                                    </tr>

                                <?php
                                }
                                ?>
                        </table>
                    </div>
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