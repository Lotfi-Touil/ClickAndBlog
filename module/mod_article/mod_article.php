<?php
if(!defined('CONST_INCLUDE')){
    die('interdit !');
}
include_once('cont_article.php');
require_once 'module/mod_generique.php';

class ModArticle extends ModGenerique
{
    public function __construct()
    {
        $this->controlleur = new ContArticle();
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        } else {
            $this->action = "liste";
        }
        switch ($this->action) {
            case "bienvenue":
                $this->controlleur->bienvenue();
                break;
            case "liste":
                $this->controlleur->liste();
                break;
            case "detail":
                $this->controlleur->details();
                break;
            case "ajout":
                $this->controlleur->ajout();
                break;
            case "update_article":
                $this->controlleur->modif_article();
                break;
            case "categorie":
                $this->controlleur->categorie();
                break;
            case "ajout_favoris":
                $this->controlleur->ajout_fav();
                break;
            case "supp_favoris";
                $this->controlleur->supp_fav();
                break;
            case "ajout_like":
                $this->controlleur->ajt_like();
                break;
            case "ajout_signalement":
                $this->controlleur->add_signalement();
                break;
            case "supp_like":
                $this->controlleur->retir_like();
                break;
            case "ajout_payement":
                $this->controlleur->ajout_article_payant();
                break;
            default:
                echo "Valeur inconnue ";
                break;
        }

    }

    /**
     * @return ContArticle
     */
    public function getControlleur(): ContArticle
    {
        return $this->controlleur;
    }

}