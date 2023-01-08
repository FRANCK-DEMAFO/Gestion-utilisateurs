<?php
    session_start();

    require_once('./../../core/Database/connection.php');
    
    class LoginServices{

        private $conne;

        public function __construct()
        {
            $this->conne = (new Database())->getConnection();
        }
        public function login(){

            if (isset($_POST['login'])) {
                $email = $_POST['email'];
                $pass = $_POST['password'];
                if (!empty($email) && !empty($pass)) {
    
                    $conne = (new Database())->getConnection();
                    $q = $conne->prepare("SELECT * FROM `employes` WHERE mail ='$email'");
                    $q->execute();
            
                    if ($q->rowCount() > 0) {

                        $data = $q->fetchall();

                        $_SESSION['email'] = $data[0]['mail'];

                        if ($_SESSION['email'] == $email) {

                            $_SESSION['login'] = $data[0]['login'];

                            $_SESSION['surname'] = $data[0]['surname'];

                            $_SESSION['id_employee'] = $data[0]['id_employee'];

                            $_SESSION['marital_status'] = $data[0]['marital_status'];
                            
                            $_SESSION['password'] = $data[0]['password'];
                            
                            $_SESSION['email'] = $data[0]['mail'];

                            $_SESSION['photo'] = $data[0]['photo'];

                            $_SESSION['name'] = $data[0]['name'];

                            $_SESSION['role'] = $data[0]['id_role'];
                            
                            if($_SESSION['role']==1){
                                

                                header('Location:./../../index.php');

                                

                            }elseif($_SESSION['role']==2){
                                
                                header('Location:./../../userHome.php');


                            }

    
                        } else {

                            $_SESSION['error'][] = "Mots de passe incorrect !";
    
                        }
                    } else {
                        $_SESSION['error'][] = "Nom d'utilisateur incorrect !";
    
                    }
                } else {
                    
                    $_SESSION['error'][] = "Veuillez remplire tous les champs !";
    
                }
            }
            
        }
    }
?>