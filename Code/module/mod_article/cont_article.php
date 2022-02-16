<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}
include_once('modele_article.php');
include_once('vue_article.php');
include_once('module/mod_commentaire/cont_commentaire.php');

class ContArticle
{
    private $modele;
    private $vue;

    public function __construct()
    {
        $this->modele = new ModeleArticle();
        $this->vue = new VueArticle();
    }

    public function liste()
    {
        foreach ($this->modele->getListe() as $value) {
            if (isset($_SESSION['login'])) {
                if ($this->modele->verifSignalement($value['id']) == FALSE) {
                    $this->vue->affiche_liste($value, $this->modele->verifArticleFav($value['id']));
                }
            } else {
                $this->vue->affiche_liste($value, false);
            }
        }
    }

    public function details()
    {
        foreach ($this->modele->getDetail() as $row) {
            if (isset($_SESSION['login'])) {
                if ($this->modele->verifSignalement($row['id']) == FALSE) {
                    $this->vue->affiche_detail($row, $this->modele->verifLike($row['id']), $this->modele->verifArticlePayant($row['id']), $this->modele->getRecommandation($row));
                    $this->vue->affiche_commentaire($this->modele->getCommentaires());
                } else {
                    // Affiche ce message si l'utilisateur tente d'acceder a un article qu'il a signalé.
                    $this->vue->afficheArtIndiponible();
                }
            } else {
                $this->vue->affiche_detail($row, false, $this->modele->verifArticlePayant($row['id']), $this->modele->getRecommandation($row));
                $this->vue->affiche_commentaire($this->modele->getCommentaires());
            }
        }
    }

    public function ajout()
    {
        // reponseAjoutArt renvoie les code de succés et d'echec lors de la création des articles
        $this->vue->reponseAjoutArt($this->modele->ajout_article());
    }

    public function ajout_fav()
    {
        $this->modele->add_bookmark();
    }

    public function supp_fav()
    {
        $this->modele->dell_bookmark();
    }

    public function ajt_like()
    {
        $this->modele->add_like();
    }

    public function add_signalement()
    {
        $this->modele->ajt_signalement();
    }

    public function retir_like()
    {
        $this->modele->retirer_like();
    }

    public function modif_article()
    {
        $this->modele->modifi_article();
    }

    public function categorie()
    {
        foreach ($this->modele->getArticleBYCateg() as $value) {
            if (isset($_SESSION['login'])) {
                if ($this->modele->verifSignalement($value['id']) == FALSE) {
                    $this->vue->affiche_liste($value, $this->modele->verifArticleFav($value['id']));
                }
            } else {
                $this->vue->affiche_liste($value, false);
            }

        }
    }

    public function ajout_article_payant()
    {
        $this->modele->add_articlePayant();
    }

    /**
     * @return ModeleArticle
     */
    public function getModele(): ModeleArticle
    {
        return $this->modele;
    }

    /**
     * @return VueArticle
     */
    public function getVue(): VueArticle
    {
        return $this->vue;
    }
}