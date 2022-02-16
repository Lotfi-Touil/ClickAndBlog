<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}
include_once('modele_commentaire.php');
include_once('vue_commentaire.php');

class ContCommentaire
{
    private $modele;
    private $vue;

    public function __construct()
    {
        $this->modele = new ModeleCommentaire();
        $this->vue = new VueCommentaire();
    }

    public function ajout()
    {
        $this->modele->ajout_commentaire();
    }

    public function delete(){
        $this->modele->supprimer_commentaire();
    }

    /**
     * @return ModeleCommentaire
     */
    public function getModele(): ModeleCommentaire
    {
        return $this->modele;
    }

    /**
     * @return VueCommentaire
     */
    public function getVue(): VueCommentaire
    {
        return $this->vue;
    }

}