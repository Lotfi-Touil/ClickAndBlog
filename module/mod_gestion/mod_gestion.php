<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}
include_once 'cont_gestion.php';
require_once 'module/mod_generique.php';

class ModGestion extends ModGenerique
{
    public function __construct()
    {
        $this->controlleur = new ContGestion();
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        } else {
            $this->controlleur;
        }
        switch ($this->action) {
            case "profil":
                $this->controlleur->vue_profil();
                break;
            case "article":
                $this->controlleur->affichage_form_art();
                break;
            case "sauvegarde_profil":
                $this->controlleur->sauvegarde_profil();
                break;
            case "delete_compte":
                $this->controlleur->delete_compte();
                break;
            case "delete_compte_adm":
                $this->controlleur->delete_compte_admin();
            case "compte":
                $this->controlleur->gestion_compte();
                break;
            case "securite":
                $this->controlleur->gestion_securite();
                break;
            case "modif_article_vue":
                $this->controlleur->modif_article_vue();
                break;
            case "sauvegarde_securite":
                $this->controlleur->sauvegarde_securite();
                break;
            case "delete_signalement":
                $this->controlleur->delete_signalement();
                break;
            case "delete_favori":
                $this->controlleur->delete_favori();
                break;
            case "delete_article":
                $this->controlleur->delete_article();
                break;
            case "admin_option":
                $this->controlleur->admin_opt();
                break;
            case "archiver_art":
                $this->controlleur->arch_art();
                break;
            case "retirer_archive":
                $this->controlleur->retir_arch();
                break;
            case 'publier_art':
                $this->controlleur->publ_art();
                break;
            case 'supprimer_art':
                $this->controlleur->del_art();
                break;
        }
    }

    public function getControlleur()
    {
        return $this->controlleur;
    }
}

?>