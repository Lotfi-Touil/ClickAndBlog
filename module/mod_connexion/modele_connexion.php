<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}

class ModeleConnexion extends Connexion
{
    public function verif_pwd()
    {
        $selectPrep = self::$bdd->prepare('SELECT * FROM user_connect WHERE email=? AND password=?');
        $selectPrep->execute(array($_POST['mail'], hash('sha256', $_POST['pass'])));
        $result = $selectPrep->fetchall();
        if (count($result) == 1) {
            $_SESSION["login"] = $_POST['mail'];
            foreach ($result as $row) {
                $_SESSION["id"] = $row['id'];
            }
            return true;
        } else {
            return false;
        }
    }

    public function auto_connexion($mail, $password)
    {
        $selectPrep = self::$bdd->prepare('SELECT * FROM user_connect WHERE email=? AND password=?');
        $selectPrep->execute(array($mail, hash('sha256', $password)));
        $result = $selectPrep->fetchall();
        if (count($result) == 1) {
            $_SESSION["login"] = $mail;
            foreach ($result as $row) {
                $_SESSION["id"] = $row['id'];
            }
            return true;
        } else {
            return false;
        }
    }

    public function verif_creation()
    {
        $messageRetour = "";
        $messageRetour;
        $dossier_destination = "public/image/";
        $fichier_destination = $dossier_destination . basename($_FILES["image"]["name"]);
        $image_extension = strtolower(pathinfo($fichier_destination, PATHINFO_EXTENSION));
        $nom = $_POST['lastname'];
        $prenom = $_POST['firstname'];
        $mail = $_POST['mail'];
        $username = $_POST['username'];
        $mdp = $_POST['pass'];
        // Ajout de la verification si l'utilisateur existe deja
        $check_user_exist = self::$bdd->prepare('SELECT * FROM user_connect WHERE email= ?');
        $check_user_exist->execute(array($mail));
        $result = $check_user_exist->fetchAll();
        if (count($result) >= 1) {
            return 1;
        } else {
            try {
                if (!empty($_FILES["image"]["tmp_name"])) {
                    $typeAutoriser = array('jpg', 'png', 'jpeg');
                    if (in_array($image_extension, $typeAutoriser)) {
                        $requete = self::$bdd->prepare('INSERT INTO user_connect(email, password, username, nom, prenom,photoProfil) VALUES(?,?, ?, ?, ?,?)');
                        if ($requete->execute(array($mail, hash('sha256', $mdp), $username, $nom, $prenom, $fichier_destination))) {
                            move_uploaded_file($_FILES["image"]["tmp_name"], $fichier_destination);
                        } else {
                            return 3;
                        }

                    } else {
                        return 4;
                    }
                } else {
                    $requete = self::$bdd->prepare('INSERT INTO user_connect(email, password, username, nom, prenom) VALUES(?,?, ?, ?, ?)');
                    $requete->execute(array($mail, hash('sha256', $mdp), $username, $nom, $prenom));
                }
                $this->auto_connexion($mail, $mdp);
                return 0;
            } catch (PDOException $p) {
                echo $p->getCode() . $p->getMessage();
                return 2;
            }
        }
    }

    public function decon_user()
    {
        session_destroy();
        header("Location: index.php");
    }
}

?>