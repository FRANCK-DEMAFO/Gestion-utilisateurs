<?php

$_SESSION['title'] = "Liste des congés";
require_once('./../view/includes/header.php');

?>

<div class="container">
    <div class="row">
        <h1 class="text-logo" style="text-align:center;">Archives</h1><br><br><br><br>


        </h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="leave">
                <thead>
                    <tr>
                        <th style="text-align: center;">ID</th>
                        <th style="text-align: center;"> Nom des employe</th>
                        <th style="text-align: center;">Date de debut</th>
                        <th style="text-align: center;">jours de conge annuel</th>
                        <th style="text-align: center;">Duree</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    require('./../../core/Database/connection.php');
                    $conn = (new Database())->getConnection();

                    if (isset($_POST['envoyer'])) {

                        $annee = htmlspecialchars($_POST['annee']);

                        echo '<h4><?= $annee ?></h4>';



                        $sql = "SElECT conges.id_leave, conges.leave_start_date, conges.annee, conges.leave_days, conges.used_days, conges.statut, conges.leave_duration, conges.id_employee,
                        employes.name FROM conges LEFT JOIN employes ON conges.id_employee=employes.id_employee WHERE conges.annee = :annee ";

                        $query = $conn->prepare($sql);
                        $query->bindValue(':annee', $annee, \PDO::PARAM_INT);
                        $query->execute();
                        $conges = $query->fetchAll();
                    }

                    foreach ($conges as $conge) {

                    ?>
                        <tr>
                            <td style="text-align: center;"><?= $conge['id_leave'] ?></td>
                            <td style="text-align: center;"><?= $conge['name'] ?></td>
                            <td style="text-align: center;"><?= $conge['leave_start_date'] ?></td>
                            <td style="text-align: center;"><?= $conge['leave_days'] ?></td>
                            <td style="text-align: center;"><?= $conge['leave_duration'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>

            </table>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><a href="index.php">retour</a></button>
            <button  type="button" class="btn btn-danger" onclick ="imprimer();"><a href="" >Imprimer</a></button>
        </div>
        <script type="text/javascript">
            function imprimer(){
                window.print();
            }

        </script>

    </div>
</div>
<script type="text/javascript">
    $("#leave").dataTable({});
</script>
<?php

require('./../view/includes/footer.php');
?>