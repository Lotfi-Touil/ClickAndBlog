<?php
// API de recherche d'article
header("content-type: application/json");
require_once('connexion.php');
Connexion::initConnexion();

class Search extends Connexion
{
    public static function moteur_recherche()
    {
        if (isset($_GET['term'])) {
            $selectPrep = self::$bdd->prepare('select * from article WHERE titre LIKE :term AND etat=TRUE');
            $selectPrep->execute(array('term' => '%' . $_GET['term'] . '%'));
            $result = array();
            while ($article = $selectPrep->fetch(PDO::FETCH_OBJ)) {
                $result[] = array('value' => $article->id, 'label' => $article->titre, 'date' => $article->date);
            }
            echo json_encode($result);
        }
    }
}

Search::moteur_recherche();