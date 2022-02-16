<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}
include_once 'cont_paiement.php';
require_once 'module/mod_generique.php';

class ModPaiement extends ModGenerique
{
    public function __construct()
    {
        $this->controlleur = new ContPaiement();
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        } else {
            $this->controlleur;
        }
        switch ($this->action) {
            case "payer":
                $this->controlleur->payer();
                break;
            case "cancel":
                $this->controlleur->echec_affichage();
                break;
            case "success":
                $this->controlleur->success_affichage();
                break;
            default:
                echo "Valeur inconnue ";
                break;
        }
    }

    public function getControlleur(): ContPaiement
    {
        return $this->controlleur;
    }
}