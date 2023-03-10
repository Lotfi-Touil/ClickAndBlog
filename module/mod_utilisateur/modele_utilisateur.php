<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}

class ModeleUtilisateur extends Connexion
{

    public function getListeArticles(): array
    {
        $selectPrep = self::$bdd->prepare('SELECT * FROM article WHERE etat=TRUE and user_id = ?');
        $selectPrep->execute(array($_GET['id_user']));
        return $result = $selectPrep->fetchall();
    }

    public function verifSignalement($resp): bool
    {
        $selectPrep = self::$bdd->prepare('SELECT * FROM signalement WHERE user_id = ? AND url = ?');
        $selectPrep->execute(array($_SESSION['id'], $resp));
        $result = $selectPrep->fetchall();
        if (count($result) == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function verifArticleFav($resp): bool
    {
        $selectPrep = self::$bdd->prepare('SELECT * FROM favoris INNER JOIN article ON favoris.url = article.id WHERE favoris.user_id = ? AND article.id = ?');
        $selectPrep->execute(array($_SESSION['id'], $resp));
        $result = $selectPrep->fetchall();
        if (count($result) == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function get_infos()
    {
        $selectPrep = self::$bdd->prepare('SELECT * FROM user_connect WHERE id = ?');
        $selectPrep->execute(array($_GET['id_user']));
        while ($user = $selectPrep->fetch(PDO::FETCH_OBJ)) {
            $result[] = array('nom' => $user->nom, 'prenom' => $user->prenom, 'username' => $user->username, 'bio' => $user->bio);
        }
        return $result;
    }

    public function getNbAbonnements()
    {
        $nbAbonnements = self::$bdd->prepare('SELECT count(abonnement_utilisateur.user_id_abonne) FROM abonnement_utilisateur WHERE user_id_abonne = ?');
        $nbAbonnements->execute(array($_GET['id_user']));
        $resultAbonnements = $nbAbonnements->fetchAll();
        $nbAbonnes = self::$bdd->prepare('SELECT count(abonnement_utilisateur.user_id_abonne) FROM abonnement_utilisateur WHERE user_id_abonnement = ?');
        $nbAbonnes->execute(array($_GET['id_user']));
        $resultAbonnes = $nbAbonnes->fetchAll();
        $result = array(
            "nbAbonnes" => $resultAbonnes,
            "nbAbonnements" => $resultAbonnements
        );
        return $result;
    }

    public function estDejaAbonne()
    {
        $estAbonne = self::$bdd->prepare('SELECT * FROM abonnement_utilisateur WHERE user_id_abonne = ? and user_id_abonnement = ?');
        $estAbonne->execute(array($_SESSION['id'], $_GET['id_user']));
        $result = $estAbonne->fetchAll();
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAbonnes()
    {
        $selectPrep = self::$bdd->prepare('SELECT user_connect.* FROM user_connect INNER JOIN abonnement_utilisateur ON user_connect.id = abonnement_utilisateur.user_id_abonne WHERE abonnement_utilisateur.user_id_abonnement = ?');
        $selectPrep->execute(array($_GET['id_user']));
        $result = $selectPrep->fetchAll();
        return $result;
    }

    public function getAbonnements()
    {
        $selectPrep = self::$bdd->prepare('SELECT user_connect.* FROM user_connect INNER JOIN abonnement_utilisateur ON user_connect.id = abonnement_utilisateur.user_id_abonnement WHERE abonnement_utilisateur.user_id_abonne = ?; ');
        $selectPrep->execute(array($_GET['id_user']));
        $result = $selectPrep->fetchAll();
        return $result;
    }

    public function suivreOuPas($dejaAbonne)
    {
        if (!$dejaAbonne) {
            ModeleUtilisateur::suivre();
        } else {
            ModeleUtilisateur::nePlusSuivre();
        }
        $id = $_GET['id_user'];
        header("Location: index.php?module=mod_utilisateur&action=profil&id_user=$id");
    }

    public static function suivre()
    {
        $estAbonne = self::$bdd->prepare('INSERT INTO abonnement_utilisateur(user_id_abonne, user_id_abonnement) VALUES(?, ?)');
        $estAbonne->execute(array($_SESSION['id'], $_GET['id_user']));
        $result = $estAbonne->fetchAll();
    }

    public static function nePlusSuivre()
    {
        $estAbonne = self::$bdd->prepare('DELETE FROM abonnement_utilisateur WHERE user_id_abonne = ? and user_id_abonnement = ?');
        $estAbonne->execute(array($_SESSION['id'], $_GET['id_user']));
        $result = $estAbonne->fetchAll();
    }

    public static function getPhotoProfil(): array
    {
        $selectPrep = self::$bdd->prepare('SELECT user_connect.photoProfil FROM user_connect where user_connect.id = ?');
        $selectPrep->execute(array($_GET['id_user']));
        $result = $selectPrep->fetchall();
        return $result;
    }

    public function get_favoris()
    {
        $selectPrep = self::$bdd->prepare('SELECT * FROM article INNER JOIN favoris ON article.id=favoris.url WHERE favoris.user_id= ?');
        $selectPrep->execute(array($_SESSION['id']));
        return $selectPrep->fetchall();
    }


}

?>