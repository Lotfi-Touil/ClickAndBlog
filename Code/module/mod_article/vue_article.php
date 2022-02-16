<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}
class VueArticle extends VueGenerique
{

    public function __Construct()
    {
        parent::__Construct();
    }

    public static function affiche_liste($row, $fav)
    {
        ?>
        <div class="card" id="card_article" xmlns:a="http://www.w3.org/1999/html">
            <div class="card-image">
                <figure class="image is-4by3">
                    <img src="<?= $row['image'] ?>" alt="<?= $row['alt_image'] ?>">
                </figure>
            </div>

            <div id="subtile_article">
                <a>
                    <hr>
                    <p class="subtitle"><?= $row['categorie'] ?></p>
                </a>
                <?php if (isset($_SESSION['login']) && $fav == true): ?>
                    <a href="index.php?module=mod_article&action=supp_favoris&idArticle=<?= $row['id'] ?>"
                       class="is-pulled-right">
                        <i class="fas fa-star"></i>
                    </a>
                <?php elseif (isset($_SESSION['login'])): ?>
                    <a href="index.php?module=mod_article&action=ajout_favoris&idArticle=<?= $row['id'] ?>"
                       class="is-pulled-right">
                        <i class="far fa-star subtitle"></i>
                    </a>
                <?php endif ?>
            </div>

            <div class="card-content">
                <div class="media">
                    <div class="media-content">
                        <a href="index.php?module=mod_article&action=detail&id=<?= $row['id'] ?>">
                            <p class="title is-4"><?= $row['titre'] ?></p>
                        </a>
                    </div>
                </div>
                <div class="content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Phasellus nec iaculis mauris.
                    <br>
                    <i class="far fa-calendar"></i>
                    <time datetime="2016-1-1"><?= $row['date'] ?></time>
                    <i class="far fa-clock"></i>
                    <span><?= $row['time_read'] ?> min</span>
                    <span>
                    <i class="far fa-heart">
                        <span><?= $row['nbLikes'] ?></span>
                    </i>
                </span>
                </div>
            </div>
        </div>
        <?php
    }

    public static function affiche_detail($row, $like, $result, $recommandation) //page article
    {
        ?>
        <div class="columns">
        <div class="column is-8 is-offset-2">
        <figure class="image is-16by9">
            <img src="<?= $row['image'] ?>" alt="<?= $row['alt_image'] ?>">
        </figure>
        <div class="content is-medium">
        <!-- Button Likes -->
        <?php if (isset($_SESSION['login']) && $like == true): ?>
        <a href="index.php?module=mod_article&action=supp_like&idArticle=<?= $row['id'] ?>">
            <button class="button is-danger">
                <i class="fas fa-heart">
                    <span><?= $row['nbLikes'] ?></span>
                </i>
            </button>
        </a>
    <?php elseif (isset($_SESSION['login'])): ?>
        <a href="index.php?module=mod_article&action=ajout_like&idArticle=<?= $row['id'] ?>">
            <button class="button is-danger">
                <i class="far fa-heart">
                    <span><?= $row['nbLikes'] ?></span>
                </i>
            </button>
        </a>
    <?php else: ?>
        <span>
                    <i class="far fa-heart">
                        <span><?= $row['nbLikes'] ?></span>
                    </i>
                </span>
    <?php endif ?>
            <?php if (isset($_SESSION['login'])):?>
        <a href="index.php?module=mod_article&action=ajout_signalement&idArticle=<?= $row['id'] ?>">
            <button class="button is-warning">
                <i class="fas fa-exclamation-triangle"></i>
            </button>
        </a>
    <?php endif;?>
        <h2 class="subtitle is-4"><?= $row['date'] ?></h2>
        <h1 class="title"><?= $row['titre'] ?></h1>
        <p><?php
        if (count($result) >= 1) {
            if (isset($_SESSION['login'])) {
                $retour_val = false;
                foreach ($result as $row_retour) {
                    if ($row_retour['user_id'] == $_SESSION['id']) {
                        $retour_val = true;
                        break;
                    }
                }
                if ($retour_val == true) {
                    echo htmlspecialchars(self::bbc2html($row['contenu']));
                } else {
                    ?>
                    <div class="notification is-success">
                        Cet article est payant paye sur ce <a
                                href="index.php?module=mod_paiement&action=payer&idArticle=<?= $row['id'] ?>">lien.</a>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="notification is-success">
                    <?php $_SESSION['redirection'] = $_SERVER['REQUEST_URI'] ?>
                    Cet article est payant paye sur ce <a
                            href="index.php?module=mod_connexion&action=connexion_redirection">lien.</a>
                </div>
                <?php
            }
            ?>
            </p>
            </div>
            </div>
            </div>
            <?php
        } else {
            echo htmlspecialchars(self::bbc2html($row['contenu']));
        }
        if (!empty($recommandation)) {
            ?>
            <h1>Recommandation :</h1>
            <?php
            foreach ($recommandation as $recom_result) {
                ?>
                <div class="card" id="card_article_suggest" xmlns:a="http://www.w3.org/1999/html">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="<?= $recom_result['image'] ?>" alt="<?= $recom_result['alt_image'] ?>">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <a href="index.php?module=mod_article&action=detail&id=<?= $recom_result['id'] ?>">
                                    <p class="title is-4"><?= $recom_result['titre'] ?></p>
                                </a>
                            </div>
                        </div>
                        <div class="content">
                            <i class="far fa-calendar"></i>
                            <time datetime="2016-1-1"><?= $recom_result['date'] ?></time>
                            <i class="far fa-clock"></i>
                            <span><?= $recom_result['time_read'] ?> min</span>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <div class="container" id="head_com">
            <h1 class="has-text-centered is-size-4"><strong>Commentaires</strong></h1>
            <hr>
        </div>
        <?php
    }
    public function affiche_commentaire($tableaux)
    {
        ?>
        <div class="column is-8 is-offset-2">
            <?php
            if (count($tableaux) == 0) {
                ?>
                <div>
                    <p class="has-text-centered" style="margin-bottom: 2%">Aucun commentaires</p>
                </div>
                <?php
            } else {
                $ind = 0;
                foreach ($tableaux as $row) {
                    ?>
                    <article class="media">
                        <figure class="media-left">
                            <p class="image is-64x64">
                                <?php
                                $photo = ModeleArticle::getPhotoProfil();
                                $infos = ModeleArticle::getInfos();
                                ?>
                                <a href="index.php?module=mod_utilisateur&action=profil&id_user=<?= $infos[$ind]['id'] ?>">
                                    <img class="is-rounded" src="<?= $photo[$ind]['photoProfil'] ?>" alt="logo">
                                </a>
                            </p>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong><?=$infos[$ind]['prenom'].' '.$infos[$ind]['nom']?></strong>
                                    <br>
                                    <?= htmlspecialchars($row['contenu']) ?>
                                    <br>
                                <?php if(isset($_SESSION['id'])): ?>
                                <?php if(ModeleArticle::option_delete_comm($infos[$ind]) == true): ?>
                                    <?php
//                                    var_dump($infos[$ind]['idCommentaire']);
                                    ?>
                                    <form action="index.php?module=mod_commentaire&action=delete&id=<?=$_GET['id']?>&id_com=<?=$infos[$ind]['idCommentaire']?>" method="post">
                                        <div class="media-content">
                                            <div class="field">
                                                <div class="field">
                                                    <p class="control">
                                                        <button class="button is-danger" style="width: 5%; height: 18px; font-size: 12px;" type="submit" name="submit" value="Publier"  id="submit">
                                                            suppr
                                                        </button>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <?php endif ?>
                                <?php endif ?>
                                    <?php $ind++; ?>
                                </p>
                            </div>
                    </article>
                    <br>
                    <?php
                }
                ?>
                </article>
                <?php
            }
            ?>
            <article class="media">
                <?php
                if (isset($_SESSION['id'])) {
                    $currentPhoto = ModeleArticle::getCurrentPhotoProfil();
                    ?>
                    <figure class="media-left">
                        <p class="image is-64x64">
                            <img class="is-rounded" src="<?= $currentPhoto[0]['photoProfil'] ?>" alt="logo">
                        </p>
                    </figure>
                    <form action="index.php?module=mod_commentaire&action=ajout&id=<?= $_GET['id'] ?>" method="post">
                        <div class="media-content">
                            <div class="field">
                                <p class="control">
                                    <input class="textarea" id="comment" name="comment"
                                           placeholder="Add a comment..."></input>
                                </p>
                            </div>
                            <div class="field">
                                <div class="field">
                                    <p class="control">
                                        <button class="button is-info" type="submit" name="submit" value="Publier"
                                                id="submit">
                                            Publier
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                } else {
                    $_SESSION['redirection'] = $_SERVER['REQUEST_URI'];
                    ?>
                    <h1 class="is-size-3"><p><a href="index.php?module=mod_connexion&action=connexion_redirection">Connectez-vous</a>
                            pour commenter :)</p></h1>
                    <?php
                }
                ?>

            </article>
        </div>
        </article>
        </div>
        <?php
    }

    private static function bbc2html($contenu)
    {
        $search = array (
            '/(\[b\])(.*?)(\[\/b\])/',
            '/(\[i\])(.*?)(\[\/i\])/',
            '/(\[u\])(.*?)(\[\/u\])/',
            '/(\[ul\])(.*?)(\[\/ul\])/',
            '/(\[li\])(.*?)(\[\/li\])/',
            '/(\[url=)(.*?)(\])(.*?)(\[\/url\])/',
            '/(\[url\])(.*?)(\[\/url\])/'
        );

        $replace = array(
            '<strong>$2</strong>',
            '<em>$2</em>',
            '<u>$2</u>',
            '<ul>$2</ul>',
            '<li>$2</li>',
            '<a href="$2" target="_blank">$4</a>',
            '<a href="$2" target="_blank">$2</a>'
        );

        return preg_replace($search, $replace, $contenu);
    }

    public function afficheArtIndiponible()
    {
        ?>
        <div class="notification is-danger">
            Vous n'êtes pas en capacité d'accéder a cet article, car vous l'avez signalé si jamais il s'agit d'une
            erreur n'hésitez pas à nous contacter.
        </div>
        <?php
    }

    public function reponseAjoutArt($code_retour)
    {
        switch ($code_retour) {
            case 1:
                echo "<h1 class='title has-text-danger'>⚠️Impossible d'envoyer le fichier sur le serveur.\n</h1>";
                break;
            case 2:
                echo "<h1 class='title has-text-danger'> ⚠️Mauvais format de fichier, seul les formats JPG, JPEG et PNG sont autorisés.\n</h1>";
                break;
            case 3:
                echo "<h1 class='title has-text-danger'>⚠️Veuillez choisir un fichier a envoyer\n</h1>";
                break;
            default:
                echo "<h1 class='title has-text-success'>Article publié avec succès ✨</h1>";
                break;
        }
    }

}