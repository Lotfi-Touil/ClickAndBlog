<?php
session_start();
define('CONST_INCLUDE', NULL);
require_once 'connexion.php';
require_once 'vue_generique.php';
Connexion::initConnexion();

if (isset($_GET['module'])) {
    switch ($_GET['module']) {
        case "mod_article":
            include 'module/mod_article/mod_article.php';
            $main = new ModArticle();
            break;
        case "mod_connexion":
            include 'module/mod_connexion/mod_connexion.php';
            $main = new ModConnexion();
            break;
        case "mod_recherche":
            include 'module/mod_recherche/mod_recherche.php';
            $main = new ModRecherche();
            break;
        case "mod_favoris":
            include 'module/mod_favoris/mod_favoris.php';
            $main = new ModFavoris();
            break;
        case "mod_gestion":
            include 'module/mod_gestion/mod_gestion.php';
            $main = new ModGestion();
            break;
        case "mod_commentaire":
            include 'module/mod_commentaire/mod_commentaire.php';
            $main = new ModCommentaire();
            break;
        case "mod_paiement":
            include 'module/mod_paiement/mod_paiement.php';
            $main = new ModPaiement();
            break;
        case "mod_utilisateur":
            include 'module/mod_utilisateur/mod_utilisateur.php';
            $main = new ModUtilisateur();
            break;
        default:
            echo "Erreur";
            break;
    }
} else {
    include 'module/mod_article/mod_article.php';
    $main = new ModArticle();
}
$contenuTampon = $main->getControlleur()->getVue()->getAffichage();
require_once 'template/header.php';
?>
    <section class="result"></section>
    <section class="container">
<?php
echo $contenuTampon;
require_once 'template/footer.php';