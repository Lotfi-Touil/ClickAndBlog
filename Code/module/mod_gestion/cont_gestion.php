<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}
include_once 'modele_gestion.php';
include_once 'vue_gestion.php';

class ContGestion
{
    protected $modele;
    private $vue;

    public function __construct()
    {
        $this->modele = new ModeleGestion();
        $this->vue = new VueGestion();
        $this->vue->vue_menu($this->modele->get_infos());
    }

    public function vue_profil()
    {
        $this->vue->vue_profil();
    }

    public function affichage_form_art()
    {
        $this->vue->vue_article($this->modele->getCategorie());
    }

    public function sauvegarde_profil()
    {
        $this->modele->sauvegarde_profil();
    }

    public function sauvegarde_securite()
    {
        $this->modele->sauvegarde_securite();
    }

    public function delete_compte()
    {
        $this->modele->delete_compte();
    }

    public function delete_compte_admin()
    {
        $this->modele->supp_compte_adm();
    }

    public function modif_article_vue()
    {
        foreach ($this->modele->getArtById() as $row) {
            $this->vue->vue_article_modif($this->modele->getCategorie(), $row);
        }

    }

    public function gestion_compte()
    {

        $this->vue->vue_compte($this->modele->getMesArticles(), $this->modele->get_favoris(), $this->modele->get_signalements(), $this->modele->get_brouillon());
    }

    public function gestion_securite()
    {
        $this->vue->vue_securite();
    }

    public function delete_signalement()
    {
        $this->modele->delete_signalement();
    }

    public function delete_favori()
    {
        $this->modele->delete_favori();
    }

    public function delete_article()
    {
        $this->modele->delete_article();
    }

    public function admin_opt()
    {
        $this->vue->vue_admin($this->modele->get_article(), $this->modele->get_usr());
    }

    public function arch_art()
    {
        $this->modele->archive_article();
    }

    public function publ_art()
    {
        $this->modele->publier_art();
    }

    public function del_art()
    {
        $this->modele->supprimer_art();
    }

    public function retir_arch()
    {
        $this->modele->rerire_arch();
    }

    /**
     * @return ModeleGestion
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * @return VueGestion
     */
    public function getVue()
    {
        return $this->vue;
    }

}

?>