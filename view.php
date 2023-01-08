<?php
require('./header.php');
$_SESSION['title'] = "detail sur un congés";


require('./../../core/Database/connection.php');
if (!empty($_GET['id_leave'])) {
    $id_conges = checkInput($_GET['id_leave']);
}
$conn = (new Database())->getConnection();
$q = $conn->prepare("SElECT conges.id_leave, conges.leave_start_date,conges.annee, conges.leave_days, conges.used_days, conges.statut, conges.leave_duration,
    employes.name FROM conges LEFT JOIN employes ON conges.id_employee=employes.id_employee WHERE id_leave=:id_leave");


$q->execute([
    'id_leave' => $_GET['id']
]);
$conges = $q->fetch(PDO::FETCH_ASSOC);

function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<body>
    <section class="container col-lg-offset-3 col-lg-6">
        <div class="container admin">
            <div class="row">
                <h1><strong>Détails sur le conge</strong></h1>
                <form>
                    <table class="table table-striped table-bordered" style="border-color: black;">
                        <thead>
                            <tr><br><br>
                                <th>Nom de l'employe</th>
                                <th>Debut</th>
                                <th>Duree </th>
                                <th>Annee </th>

                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td><?= ' ' . $conges['name']; ?></td>
                                <td><?= ' ' . $conges['leave_start_date']; ?> </td>
                                <td><?= ' ' . $conges['leave_duration']; ?> </td>
                                <td><?=' ' . $conges['annee']; ?></td>

                            </tr>
                        </tbody>
                    </table>

                    <div class="form-actions">
                        <a href="index.php" class="btn btn-primary">Retour </a>

                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
</body>

</html>
<?php require('./footer.php') ?>