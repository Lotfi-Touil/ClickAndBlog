<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}
include_once('cont_commentaire.php');
require_once 'module/mod_generique.php';

class ModCommentaire extends ModGenerique
{
    public function __construct()
    {
        $this->controlleur = new ContCommentaire();
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        } else {
            $this->action = "liste";
        }
        switch ($this->action) {
            case "liste":
                $this->controlleur->liste();
                break;
            case "ajout":
                $this->controlleur->ajout();
                break;
            case "delete":
                $this->controlleur->delete();
                break;
            default:
                echo "Valeur inconnue ";
                break;
        }

    }

    /**
     * @return ContCommentaire
     */
    public function getControlleur(): ContCommentaire
    {
        return $this->controlleur;
    }

}