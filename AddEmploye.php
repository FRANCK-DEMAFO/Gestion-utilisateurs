<?php require_once("header.php");

$_SESSION['title']="Ajout d'un employés";

require('./core/Database/connection.php');
$conn = (new Database())->getConnection();
// $sql= "SELECT * FROM roles"

if(isset($_POST['ajouter'])){
    $nom=htmlspecialchars($_POST['nom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $age=htmlspecialchars($_POST['age']);
    $sex=htmlspecialchars($_POST['sex']);
    $statut=htmlspecialchars($_POST['statut']);
    $role=htmlspecialchars($_POST['role']); 
    $email=htmlspecialchars($_POST['email']);
    $pass=htmlspecialchars($_POST['pass']);
    $date=htmlspecialchars($_POST['date']);
    $fonction=htmlspecialchars($_POST['fonction']);
    $login=htmlspecialchars($_POST['login']);
    $photo=htmlspecialchars($_POST['photo']);
    $conn = (new Database())->getConnection();
    $q=$conn->prepare('SELECT*FROM employes WHERE name=?') ;
    $q->execute(array($nom));
    if ($q->rowcount()>0) {
        $_SESSION['erreur']='Cet employé existe deja !';
    } else{
    // $sql= $conn->query("SELECT `Id_role` FROM `roles` WHERE name=$role");
    // $info = $sql->fetch();
    $q = $conn->prepare('INSERT IGNORE INTO employes (name, surname, age, sex, marital_status, id_role, mail, password, begin_date, desactivate, login, photo) VALUES (?,?,?,?,?,?,?,?,NOW(),?,?,?)');
    $q->execute(array($nom,$prenom,$age, $sex, $statut,$role,$email, $pass, $fonction, $login, $photo));
    $conn = (new Database())->getConnection();
    $_SESSION['success'] = "Ajout reussi !!!";

    header("Location:EmployesList.php");
    }

    }
    ?>

    <?php include 'navbar.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include 'aside.php'; ?>

 <link rel="stylesheet" href="./style.css">
    <div class="container admin">
    <center>

        <form class="form" role="form"  method="post">
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
            <!-- row -->
           <br><br> <div class="container-fluid" style="margin-left: 200px;width: auto;">
				    
                
				
				<div class="row">
					<div class="col-xl-12 col-xxl-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
								<h5 class="card-title">Ajouter un employe</h5>
							</div>
							<div class="card-body">
                                <form action="#" method="post">
									<div class="row">
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="form-group">
												<label class="form-label">First Name</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="form-group">
												<label class="form-label">Last Name</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="form-group">
												<label class="form-label">Email Here</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="form-group">
												<label class="form-label">Joining Date</label>
												<input name="datepicker" class="datepicker-default form-control" id="datepicker">
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="form-group">
												<label class="form-label">Password</label>
												<input type="password" class="form-control">
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="form-group">
												<label class="form-label">Confirm Password</label>
												<input type="password" class="form-control">
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="form-group">
												<label class="form-label">Mobile Number</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="form-group">
												<label class="form-label">sexe</label>
												<select class="form-control">
													<option value="Gender">sexe</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="form-group">
												<label class="form-label">role</label>
												<select class="form-control">
													<option value="Department">chef projet</option>
													<option value="html">HTML</option>
												
												</select>
											</div>
										</div>
										
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group fallback w-50">
												<input type="file" class="dropify" data-default-file="">
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12">
											<button type="submit" class="btn btn-success">Ajouter</button>
											<button type="submit" class="btn btn-light">Annuler</button>
										</div>
									</div>
								</form>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>

<?php require_once("footer.php"); ?>