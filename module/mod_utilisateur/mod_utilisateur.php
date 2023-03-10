<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}
include_once 'cont_utilisateur.php';
require_once 'module/mod_generique.php';

class ModUtilisateur extends ModGenerique
{
    public function __construct()
    {
        $this->controlleur = new ContUtilisateur();
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        } else {
            $this->controlleur;
        }
        switch ($this->action) {
            case "profil":
                $this->controlleur->vue_profil();
                break;
            case "abonnement":
                $this->controlleur->abonnement();
                break;
        }
    }

    public function getControlleur()
    {
        return $this->controlleur;
    }
}

?>