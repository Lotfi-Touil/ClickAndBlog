<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}

class VuePaiement extends VueGenerique
{
    public function cancel()
    {
        ?>
        <section>
            <p>Vous avez oublié d'ajouter quelque chose à votre panier ? Faites vos achats puis revenez pour payer !</p>
        </section>
        <?php
    }
}