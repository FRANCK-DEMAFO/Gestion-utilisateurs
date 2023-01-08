<?php require('header.php'); ?>
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
                            <h1>Modifier la demande</h1>
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

 
 <?php
if(isset($_GET['id'])){
  
  require_once('./core/Database/connection.php');
  $conn = (new Database())->getConnection();
$q = $conn->prepare("SElECT demande_permissions.id_request, demande_permissions.reason, demande_permissions.creation_date, demande_permissions.depart_date,
demande_permissions.ending_date,demande_permissions.deleted,employes.name FROM `demande_permissions` LEFT JOIN employes
 ON demande_permissions.id_employee=employes.id_employee WHERE id_request=:id ");
$q->bindValue(':id',$_GET['id']);
$q->execute();
 $result = $q->fetchAll();
  

if(isset($_POST['Modifier'])){
  $motif = htmlspecialchars ($_POST['motif']);
  $bdate = htmlspecialchars($_POST['bdate']);
  $edate = htmlspecialchars ($_POST['edate']);
  if(!empty($motif) && !empty($bdate) && !empty($edate) ){
  $id = $_GET['id'];
  $q = $conn->prepare("UPDATE `demande_permissions` SET `reason`=?,`creation_date`=NOW(),`depart_date`=?,`ending_date`=? WHERE id_request=?");
  $q->execute(array($motif,$bdate,$edate,$id));

  $_SESSION['success'] = "<center>Demande modifiée avec success!</center>";
  
  header('Location:PermissionList.php'); 
}
}

}
?> 

    <main class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
           
                    <form method="post">
                    <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">
            <h3>Nom</h3>
          </label>
          <input type="text" class="form-control" disabled value=<?= $result[0]['name']; ?> id="exampleFormControlInput1" name="name">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTexterea" class="form-label" name="motif">
            <h3>Motif</h3>
          </label>
          <textarea class="form-control" id="exampleFormControlTexterea" name="motif" required>
                        <?= $result[0]['reason']; ?>
                      </textarea>
          <div class="invalid-feedback">Veuillez renseigner le motif de la demande.</div>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">
            <h3>Date de depart</h3>
          </label>
          <div class="row">
            <div class="mb-3">
              <input type="date" min="<?= date('Y-m-d') ?>" class="form-control" name="bdate" id="prstartdate" value=<?= $result[0]['depart_date']; ?> required>
              <div class="invalid-feedback">Veuillez renseigner la date de début.</div>
            </div>

          </div>

        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">
            <h3>Date de retour</h3>
          </label>
          <div class="row">
            <div class="mb-3">
              <input type="date" min="<?= date('Y-m-d') ?>" class="form-control" name="edate" id="prstartdate" value=<?= $result[0]['ending_date']; ?> required>
              <div class="invalid-feedback">Veuillez renseigner la date de fin.</div>
            </div>
          </div>

        </div>
                  
                      <button type="submit" name="Modifier" class="btn btn-outline-success">Modifier</button>
                      <button type="submit" name="Modifier" class="btn btn-outline-primary">Retour</button>
                    </form>
            </div>
        </div>
    </main>

<?php require('footer.php'); ?>
