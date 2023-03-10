<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}
include_once 'module/mod_connexion/cont_connexion.php';

class ModGenerique
{
    protected $action;
    protected $controlleur;

    public function __construct()
    {
        $this->controlleur = new ContConnexion();
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        } else {
            $this->controlleur;
        }
        switch ($this->action) {
            case "connexion":
                $this->controlleur->connect();
                break;
            case "deconnexion":
                $this->controlleur->deconnect();
                break;
            case "creation":
                $this->controlleur->vue_creation();
                break;
            case "validation":
                $this->controlleur->create();
                break;
        }
    }

}

?>