<?php require_once("header.php");
?>


<div class="content-wrapper" style="margin-left: 0px;">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-left: 0px;">
        <div class="container-fluid">
            <div class="row mb-2">
              
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal4">Deconnexion</button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel4" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel4">Se déconnecte</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal4" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous vraiment vous deconnecté ?
                                        </div>
                                        <div class="modal-footer">
                                            <a href="./disconnect.php"><button class="btn btn-primary">Oui</button></a>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="margin-left: 0px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline" style="margin-top: -50px;">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="rounded-circle" width=50% height=80% src="<?= './assets/images/' . $_SESSION['photo']; ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $_SESSION['name'] . " " . $_SESSION['surname']; ?></h3>

                            <p class="text-muted text-center">Software Engineer</p>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">A propos de vous</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i>Email</strong>

                                <p class="text-muted">
                                    <?= $_SESSION['email']; ?>
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Localisation</strong>

                                <p class="text-muted">Dschang, Ouest Cameroun</p>

                                <strong><i class="far fa-file-alt mr-1"></i>Statut conjugale</strong>

                                <p class="text-muted"><?= $_SESSION['marital_status'] ?></p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="container" style="margin-left: 300px; margin-right: auto; display: block;">
                
            </div>


    </section>
    <!-- /.content -->
</div>

<?php require_once("footer.php"); ?>