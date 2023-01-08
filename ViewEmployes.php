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

            </section>
            <?php
            $_SESSION['title'] = "Detail sur un employé";
            require('./core/Database/connection.php');
            if (!empty($_GET['id_employee'])) {
                $id_employee = checkInput($_GET['id_employee']);
            }

            $conn = (new Database())->getConnection();
            $q = $conn->prepare("SElECT employes.id_employee, employes.name, employes.surname, employes.marital_status, roles.name AS id_role  , 
    employes.begin_date, employes.desactivate, employes.photo FROM employes LEFT JOIN roles ON employes.id_role =roles.id_role WHERE id_employee=:id_employee ");
            $q->execute([
                'id_employee' => $_GET['id']
            ]);
            $employes = $q->fetch(PDO::FETCH_ASSOC);

            function checkInput($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            ?>
            <div class="wrapper">

                <div class="container admin" style="margin-left: 100px;">
                    <div class="row">
                        <div class="">
                            <h4><strong>Détails sur l'employé <?= ' ' . $employes['name'] . ' ' .   $employes['surname']; ?></strong></h4>
                            <br>
                            <form>
                                <div class="form-groupe">
                                    <strong><label>Nom:</label></strong><?= ' ' . $employes['name']; ?>
                                </div>
                                <br>
                                <div class="form-groupe">
                                    <strong><label>Prenom:</label></strong><?= ' ' . $employes['surname']; ?>
                                </div>
                                <br>
                                <div class="form-groupe">
                                    <strong><label>Status:</label></strong><?= ' ' . $employes['marital_status']; ?>
                                </div>
                                <br>
                                <div class="form-groupe">
                                    <strong><label>role:</label></strong><?= ' ' . $employes['id_role']; ?>
                                </div>
                                <br>
                                <div class="form-groupe">
                                    <strong><label>Date debut:</label></strong><?= ' ' . $employes['begin_date']; ?>
                                </div>
                            </form>
                            <br>
                            <div class="form-actions">
                                <a href="EmployesList.php" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Retour </a>

                            </div>
                        </div>
                        <div class="col-sm-6" style="margin-left: 250px; margin-top: -300px;">
                            <div class="thumbnail">
                                <img class="rounded-circle" src="<?= './assets/images/' . $employes['photo']; ?>" width=50% height=50%>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            require_once("footer.php");

            ?>