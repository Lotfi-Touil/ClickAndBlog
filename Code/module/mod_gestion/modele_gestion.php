<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}

class ModeleGestion extends Connexion
{

    public function sauvegarde_profil()
    {
        $messageRetour = "";
        $messageRetour;
        $dossier_destination = "public/image/";
        $fichier_destination = $dossier_destination . basename($_FILES["image"]["name"]);
        $image_extension = strtolower(pathinfo($fichier_destination, PATHINFO_EXTENSION));
        // Mise en place des verification
        if (!empty($_FILES["image"]["tmp_name"])) {
            $typeAutoriser = array('jpg', 'png', 'jpeg');
            if (in_array($image_extension, $typeAutoriser)) {
                $selectPrep = self::$bdd->prepare('UPDATE user_connect SET nom = ?, prenom = ?, username= ?, bio = ?, photoProfil = ? where id = ?');
                if ($selectPrep->execute(array($_POST['nom'], $_POST['prenom'], $_POST['username'], $_POST['bio'], $fichier_destination, $_SESSION['id']))) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], $fichier_destination);
                } else {
                    echo 1;
                }
            } else {
                echo 2;
            }
        } else {
            $selectPrep = self::$bdd->prepare('UPDATE user_connect SET nom = ? where id = ?');
            $selectPrep->execute(array($_POST['nom'], $_SESSION['id']));
            $selectPrep = self::$bdd->prepare('UPDATE user_connect SET prenom = ? where id = ?');
            $selectPrep->execute(array($_POST['prenom'], $_SESSION['id']));
            $selectPrep = self::$bdd->prepare('UPDATE user_connect SET username = ? where id = ?');
            $selectPrep->execute(array($_POST['username'], $_SESSION['id']));
            $selectPrep = self::$bdd->prepare('UPDATE user_connect SET bio = ? where id = ?');
            $selectPrep->execute(array($_POST['bio'], $_SESSION['id']));
        }
        header('Location: index.php?module=mod_gestion&action=profil');
    }

    public function sauvegarde_securite()
    {
        $current = $_POST['current'];
        $password = $_POST['pass2'];
        $id = $_SESSION['id'];
        var_dump($current, $password, $id);
        $check_user_exist = self::$bdd->prepare('SELECT * FROM user_connect WHERE id = ? and password = ?');
        $check_user_exist->execute(array($id, hash('sha256', $current)));
        $result = $check_user_exist->fetchAll();
        if (count($result) < 1) {
            echo "mdp incorrect";
            return 1;
        } else {
            try {
                $requete = self::$bdd->prepare('UPDATE user_connect SET password = ? where id = ?');
                $requete->execute(array(hash('sha256', $password), $id));
            } catch (PDOException $p) {
                echo $p->getCode() . $p->getMessage();
                return 2;
            }
        }
        header('Location: index.php?module=mod_connexion&action=deconnexion');
    }

    public function get_infos()
    {
        $selectPrep = self::$bdd->prepare('SELECT * FROM user_connect WHERE id = ?');
        $selectPrep->execute(array($_SESSION['id']));
        while ($user = $selectPrep->fetch(PDO::FETCH_OBJ)) {
            $result[] = array('nom' => $user->nom, 'prenom' => $user->prenom, 'username' => $user->username, 'bio' => $user->bio, 'admin' => $user->admin);
        }
        return $result;
    }

    public function delete_compte()
    {
        $selectPrep = self::$bdd->prepare('DELETE FROM user_connect where id = ?');
        $selectPrep->execute(array($_SESSION['id']));
        header('Location: index.php?module=mod_connexion&action=deconnexion');
    }

    public function get_favoris()
    {
        $selectPrep = self::$bdd->prepare('SELECT * FROM article INNER JOIN favoris ON article.id=favoris.url WHERE favoris.user_id= ?');
        $selectPrep->execute(array($_SESSION['id']));
        return $selectPrep->fetchall();
    }

    public function get_signalements()
    {
        $selectPrep = self::$bdd->prepare('SELECT * FROM article INNER JOIN signalement ON signalement.url = article.id WHERE signalement.user_id = ?');
        $selectPrep->execute(array($_SESSION['id']));
        return $selectPrep->fetchall();
    }

    public function delete_signalement()
    {
        $selectPrep = self::$bdd->prepare('DELETE FROM signalement WHERE id= ?');
        $selectPrep->execute(array($_GET['id_signalement']));
        header('Location: index.php?module=mod_gestion&action=compte');
    }

    public function delete_favori()
    {
        $selectPrep = self::$bdd->prepare('DELETE FROM favoris WHERE user_id= ? AND url= ?');
        $selectPrep->execute(array($_SESSION['id'], $_GET['url']));
        header('Location: index.php?module=mod_gestion&action=compte');
    }

    public static function getCurrentPhotoProfil(): array
    {
        $selectPrep = self::$bdd->prepare('SELECT user_connect.photoProfil FROM user_connect where id = ?');
        $selectPrep->execute(array($_SESSION['id']));
        $result = $selectPrep->fetchall();
        return $result;
    }

    public function get_brouillon()
    {
        $selectPrep = self::$bdd->prepare('SELECT * FROM article WHERE etat=0 AND user_id=?');
        $selectPrep->execute(array($_SESSION['id']));
        return $selectPrep->fetchall();
    }

    public function getCategorie()
    {
        $selectPrep = self::$bdd->prepare('SELECT *  from categorie');
        $selectPrep->execute();
        return $selectPrep->fetchall();
    }

    public function get_article()
    {
        $selectPrep = self::$bdd->prepare('SELECT article.*,user_connect.email from article INNER JOIN user_connect ON article.user_id = user_connect.id');
        $selectPrep->execute();
        return $selectPrep->fetchall();
    }

    public function getMesArticles(): array
    {
        $selectPrep = self::$bdd->prepare('SELECT * FROM article WHERE etat=TRUE and user_id = ?');
        $selectPrep->execute(array($_SESSION['id']));
        return $result = $selectPrep->fetchall();
    }

    public function delete_article()
    {
        $selectPrep = self::$bdd->prepare('DELETE FROM article WHERE id= ?');
        $selectPrep->execute(array($_GET['idArticle']));
        header('Location: index.php?module=mod_gestion&action=compte');
    }

    public function archive_article()
    {
        $requete = self::$bdd->prepare('UPDATE article SET archive = 1 where id = ?');
        $requete->execute(array($_GET['idArticle']));
        header('Location: index.php?module=mod_gestion&action=admin_option');
    }

    public function publier_art()
    {
        $requete = self::$bdd->prepare('UPDATE article SET etat = 1 where id = ?');
        $requete->execute(array($_GET['idArticle']));
    }

    public function supprimer_art()
    {
        $selectPrep = self::$bdd->prepare('DELETE FROM article where id = ?');
        $selectPrep->execute(array($_GET['idArticle']));
        header('Location: index.php?module=mod_gestion&action=admin_option');
    }

    public function rerire_arch()
    {
        $requete = self::$bdd->prepare('UPDATE article SET archive = 0 where id = ?');
        $requete->execute(array($_GET['idArticle']));
        header('Location: index.php?module=mod_gestion&action=admin_option');
    }

    public function get_usr()
    {
        $selectPrep = self::$bdd->prepare('SELECT *  from user_connect');
        $selectPrep->execute();
        return $selectPrep->fetchall();
    }

    public function supp_compte_adm()
    {
        $selectPrep = self::$bdd->prepare('DELETE FROM user_connect where id = ?');
        $selectPrep->execute(array($_GET['idUser']));
        header('Location: index.php?module=mod_gestion&action=admin_option');
    }

    public function getArtById()
    {
        $selectPrep = self::$bdd->prepare('SELECT *  from article WHERE id = ?');
        $selectPrep->execute(array($_GET['idArticle']));
        return $selectPrep->fetchall();
    }
}

?>