<?php
require('./core/Database/connection.php');

$conn = (new Database())->getConnection();

$sql = "SElECT conges.id_leave, conges.leave_start_date, conges.annee, conges.used_days, conges.statut, conges.leave_duration, conges.id_employee,
employes.name FROM conges LEFT JOIN employes ON conges.id_employee=employes.id_employee WHERE conges.disable = :disable AND conges.annee = :annee ";

$query = $conn->prepare($sql);
$query->bindValue(':disable', 1, \PDO::PARAM_INT);
$query->bindValue(':annee', date('Y'), \PDO::PARAM_INT);
$query->execute();

$conges = $query->fetchAll(\PDO::FETCH_ASSOC);

$nb_errors = 0;

if (!empty($conges)) {
    foreach ($conges as $conge) {
        $nb_used_days = 0;

        $permission_sql = "SELECT * FROM demande_permissions dp WHERE dp.statut = :statut AND dp.deleted = :deleted AND dp.id_employee = :id_employee AND YEAR(creation_date) = :y";
        $permission_query = $conn->prepare($permission_sql);
        $permission_query->bindValue(':statut', 'Approuvée', \PDO::PARAM_STR);
        $permission_query->bindValue(':deleted', 0, \PDO::PARAM_BOOL);
        $permission_query->bindValue(':id_employee', $conge['id_employee'], \PDO::PARAM_INT);
        $permission_query->bindValue(':y', date('Y'), \PDO::PARAM_INT);
        $permission_query->execute();

        $employee_permissions = $permission_query->fetchAll();

        if (!empty($employee_permissions)) {
            foreach ($employee_permissions as $epermission) {
                $perm_start_date =  new \DateTime($epermission['depart_date']);
                $perm_end_date = new \DateTime($epermission['ending_date']);

                $diff = $perm_start_date->diff($perm_end_date)->d + 1;

                $nb_used_days += $diff;
            }
        }

        $update_leave_sql = "UPDATE conges SET used_days = :used_days WHERE id_leave = :id";
        $update_leave_query = $conn->prepare($update_leave_sql);
        $update_leave_query->bindValue(':used_days', $nb_used_days, \PDO::PARAM_INT);
        $update_leave_query->bindValue(':id', $conge['id_leave'], \PDO::PARAM_INT);
        $leave_updated = $update_leave_query->execute();
        if (!$leave_updated) {
            $nb_errors++;
        }
    }
    header('location: LeaveList.php');
}

