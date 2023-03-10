<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}
include_once 'modele_utilisateur.php';
include_once 'vue_utilisateur.php';

class ContUtilisateur
{
    protected $modele;
    private $vue;

    public function __construct()
    {
        $this->modele = new ModeleUtilisateur();
        $this->vue = new VueUtilisateur();
        $this->vue->vue_utilisateur($this->modele->get_infos(), $this->modele->getNbAbonnements(), $this->modele->getAbonnes(), $this->modele->getAbonnements(), ContUtilisateur::estAbonne());
    }

    public function vue_profil()
    {
        $articles = $this->modele->getListeArticles();
        if (count($articles) > 0) {
            ?>
            <h1><strong>Articles publiés :</strong></h1>
            <?php
            foreach ($articles as $value) {
                if (isset($_SESSION['login'])) {
                    // Veririfaction des articles signalés pour les utilisateur connectés
                    if ($this->modele->verifSignalement($value['id']) == FALSE) {
                        // Affiche liste prend les donnes de l'articles et verifie si l'article est en favoris pour l'utilisateur courant
                        $this->vue->affiche_liste($value, $this->modele->verifArticleFav($value['id']));
                    }
                } else {
                    $this->vue->affiche_liste($value, false);
                }
            }
        }
    }

    public function abonnement()
    {
        $this->modele->suivreOuPas($this->modele->estDejaAbonne());
    }

    public function estAbonne()
    {
        if (isset($_SESSION['id'])) {
            if (!$this->modele->estDejaAbonne()) {
                return 'suivre';
            } else {
                return 'ne plus suivre';
            }
        } else {
            return 'suivre';
        }
    }

    /**
     * @return ModeleUtilisateur
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * @return VueUtilisateur
     */
    public function getVue()
    {
        return $this->vue;
    }

}

?>