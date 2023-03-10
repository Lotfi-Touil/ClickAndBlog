<?php
if(!defined('CONST_INCLUDE')){
    die('interdit !');
}
class VueProfil {
    public static function affiche_icon()
    {
        ?>
            <nav class="navbar is-light">
                <div id="navbarExampleTransparentExample" class="navbar-menu" >
                    <div class="navbar-start" id="categories">
                        <div class="columns navbar-item">
                        <div class="column">
                        <a class="has-text-black" href="index.php?module=mod_article&action=categorie&nom_categorie=actualite">actualité</a>
                        </div>
                        <div class="column">
                        <a class="has-text-black" href="index.php?module=mod_article&action=categorie&nom_categorie=sport">sport</a>
                        </div>
                        <div class="column">
                        <a class="has-text-black" href="index.php?module=mod_article&action=categorie&nom_categorie=politique">politique</a>
                        </div>
                        <div class="column">
                        <a class="has-text-black" href="index.php?module=mod_article&action=categorie&nom_categorie=sante">santé</a>
                        </div>
                        <div class="column">
                        <a class="has-text-black" href="index.php?module=mod_article&action=categorie&nom_categorie=technologie">technologie</a>
                        </div>
                        </div>
                    </div>
                </div>
                <?php if(!isset($_SESSION['login'])): ?>
                    <div class="navbar-end ">
                    <div class="navbar-item">
                        <div class="field is-grouped">
                            <p class="control">
                                <a class="button is-light" href="index.php?module=mod_connexion&action=connexion">
                        <span class="icon">
                            <i class="fas fa-user" style="color: #70a1ff"></i>
                        </span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                    <div class="navbar-end ">
                        <div class="navbar-item">
                            <div class="dropdown is-hoverable is-right">
                                <div class="dropdown-trigger">
                                    <div class="field is-grouped">
                                        <p class="control">
                                            <a class="button is-light" href="#">
                                            <span class="icon">
                                                <i class="fas fa-user" style="color: #70a1ff" ></i>
                                            </span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="dropdown-menu menu_deroulant" id="dropdown-menu4" role="menu">
                                    <div class="dropdown-content has-background-light">
                                        <a href="index.php?module=mod_gestion&action=profil" class="dropdown-item">
                                            Profil
                                        </a>
                                        <hr class="dropdown-divider">
                                        <a href="index.php?module=mod_connexion&action=deconnexion" class="dropdown-item">
                                            se deconnecter
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

            </nav>
            <div>
                    <hr style="width:100%; margin:auto; color:black; background-color:#70a1ff; height:5px; opacity: 0.7;">
                    <h1 style="text-align: center; color: #70a1ff; font-size: larger"><a href="index.php"> Click & Blog </a></h1>
                    <hr style="width:100%; margin:auto; color:black; background-color:#70a1ff; height:5px; opacity: 0.7;">
                    <div class="field has-addons" id="barre_de_recherche">
                        <input class="input is-rounded" type="text" id="productName" name="term" placeholder="rechercher....">
                    </div>
            </div>
            </div>
      <?php  
    }
}
?>