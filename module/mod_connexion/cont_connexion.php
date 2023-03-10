<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}
include_once 'modele_connexion.php';
include_once 'vue_connexion.php';

class ContConnexion
{
    protected $modele;
    private $vue;

    public function __construct()
    {
        $this->modele = new ModeleConnexion();
        $this->vue = new VueConnexion();
    }

    public function connect($redirection = NULL)
    {
        if ($this->modele->verif_pwd()) {
            if ($redirection == NULL) {
                header("Location: index.php");
            } else {
                header("Location: $redirection");
            }
        } else {
            $this->vue->form_failed();
        }
    }

    public function deconnect()
    {
        $this->modele->decon_user();
    }

    public function vue_creation($redirection = NULL)
    {
        if ($redirection == NULL) {
            $this->vue->form_ajout_vue();
        } else {
            $this->vue->form_ajout_vue($redirection);
        }
    }

    public function vue_connexion($redirection = NULL)
    {
        if ($redirection == NULL) {
            $this->vue->form_connexion_vue();
        } else {
            $this->vue->form_connexion_vue($redirection, '');
        }
    }

    public function create($redirection = NULL)
    {
        $result = $this->modele->verif_creation();
        if ($result == 0) {
            if ($redirection == NULL) {
                header("Location: index.php");
            } else {
                header("Location: $redirection");
            }
        } else {
            $this->vue->creation_failed($result);
        }
    }

    /**
     * @return ModeleArticle
     */
    public function getModele(): ModeleConnexion
    {
        return $this->modele;
    }

    /**
     * @return VueArticle
     */
    public function getVue(): VueConnexion
    {
        return $this->vue;
    }

}

?>