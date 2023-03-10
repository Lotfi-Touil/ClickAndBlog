<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}

class VueConnexion extends VueGenerique
{
    public function form_ajout_vue($redirection = NULL)
    {
        ?>
        <div>
            <!--            <img src="/public/image/undraw_reading_time_gvg0.png" alt="image">-->
        </div>
        <div>
            <div>
                <h1 class="title">
                    Créer un compte
                </h1>
                <p class="subtitle">
                    Une fois votre compte créé, vous pourrez directement commencer à naviguer sur notre site
                </p>
            </div>
            <?php if ($redirection == NULL): ?>
            <form action="index.php?module=mod_connexion&action=validation" method="post" enctype="multipart/form-data">
                <?php else : ?>
                <form action="index.php?module=mod_connexion&action=validation_redirection" method="post"
                      enctype="multipart/form-data">
                    <?php endif ?>
                    <div class="field" style="width: 40%">
                        <label class="label">Nom</label>
                        <p>
                            <input class="input" type="text" id="name" name="lastname" placeholder="Nom" required/>
                        </p>
                    </div>

                    <div class="field" style="width: 40%">
                        <label class="label">Prénom</label>
                        <p>
                            <input class="input" type="text" id="name" name="firstname" placeholder="Prenom" required/>
                        </p>
                    </div>

                    <div class="field" style="width: 40%">
                        <label class="label">Nom d'utilisateur</label>
                        <p class="control has-icons-left has-icons-right">
                            <input class="input" type="text" id="username" name="username"
                                   placeholder="nom d'utilisateur" required/>
                            <span class="icon is-small is-left">
                          <i class="fas fa-user"></i>
                        </span>
                            <span class="icon is-small is-right">
                          <i class="fas fa-check"></i>
                        </span>
                        </p>
                    </div>

                    <div class="field" style="width: 40%">
                        <label class="label">Email</label>
                        <p class="control has-icons-left has-icons-right">
                            <input class="input" type="email" id="mail" name="mail" placeholder="mail@gmail.com"
                                   required/>
                            <span class="icon is-small is-left">
                      <i class="fas fa-envelope"></i>
                    </span>
                            <span class="icon is-small is-right">
                      <i class="fas fa-check"></i>
                    </span>
                        </p>
                    </div>

                    <div class="field" style="width: 40%">
                        <label class="label">Mot de passe</label>
                        <p class="control has-icons-left">
                            <input class="input" type="password" id="pass" name="pass" onchange="check_pass()" required
                                   placeholder="**********"/>
                            <span class="icon is-small is-left">
                      <i class="fas fa-lock"></i>
                    </span>
                        </p>
                    </div>
                    <div class="field" style="width: 40%">
                        <label class="label">Confirmer mot de passe</label>
                        <p class="control has-icons-left">
                            <input class="input" type="password" id="confirm_pass" name="confirm_pass"
                                   onchange="check_pass()" required placeholder="Confirmer"/>
                            <span class="icon is-small is-left">
                      <i class="fas fa-lock"></i>
                    </span>
                        </p>
                    </div>
                    <div class="field" style="width: 40%">
                        <div class="file is-boxed">
                            <label class="file-label">
                                <input class="file-input" type="file" name="image" id="image">
                                <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                        <span class="file-label">
                        Choisissez un fichier...
                        </span>
                    </span>
                            </label>
                        </div>
                    </div>
                    <div class="field">
                        <p class="control">
                            <input class="button is-info" type="submit" name="submit" value="S'inscrire" id="submit"
                                   disabled/>
                        </p>
                    </div>

        </div>
        </form>
        <?php
    }

    public function form_connexion_vue($redirection = NULL, $valide = '')
    {
        ?>
        <div>
            <h1 class="title">
                Se connecter
            </h1>
        </div>
        <?php if ($redirection == NULL): ?>
        <form action="index.php?module=mod_connexion&action=connexion&action=validation_connexion" method="post">
    <?php else : ?>
        <form action="index.php?module=mod_connexion&action=connexion&action=validation_connexion_redirection" method="post">
    <?php endif ?>
        <div class="field" style="width: 40%">
            <p class="control has-icons-left has-icons-right">
                <input class="input <?= $valide ?>" type="email" id="mail" name="mail" placeholder="mail@gmail.com"
                       required/>
                <span class="icon is-small is-left">
              <i class="fas fa-envelope"></i>
            </span>
                <span class="icon is-small is-right">
              <i class="fas fa-check"></i>
            </span>
            </p>
        </div>
        <div class="field" style="width: 40%">
            <p class="control has-icons-left">
                <input class="input <?= $valide ?>" type="password" id="pass" name="pass" required
                       placeholder="**********"/>
                <span class="icon is-small is-left">
              <i class="fas fa-lock"></i>
            </span>
            </p>
        </div>
        <div class="field">
            <p class="control">
                <input class="button is-info" type="submit" name="submit" value="Se connecter" id="submit"/>
            </p>
        </div>
        </form>
        <?php if ($redirection == NULL): ?>
        <h2>Vous n'avez pas de compte ? <a href="index.php?module=mod_connexion&action=creation" class=" has-text-info">
                Inscrivez-vous </a></h2>
    <?php else : ?>
        <h2>Vous n'avez pas de compte ? <a href="index.php?module=mod_connexion&action=creation_redirection"
                                           class=" has-text-info"> Inscrivez-vous </a></h2>
    <?php endif ?>
        <?php
    }

    public function form_failed()
    {
        $this->form_connexion_vue("is-danger");
    }

    public function creation_failed($code_erreur)
    {
        if ($code_erreur == 1) {
            echo "L'adresse mail existe deja !";
        } else {
            echo "erreur creation";
        }
    }
}