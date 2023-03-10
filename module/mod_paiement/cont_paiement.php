<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}
include_once('modele_paiement.php');
include_once('vue_paiement.php');

class ContPaiement
{
    protected $modele;
    private $vue;

    public function __construct()
    {
        $this->modele = new ModelePaiement();
        $this->vue = new VuePaiement();
    }

    public function payer()
    {
        $this->modele->checkout();
    }

    public function echec_affichage()
    {
        $this->vue->cancel();
    }

    /**
     * @return ModelePaiement
     */
    public function getModele(): ModelePaiement
    {
        return $this->modele;
    }

    /**
     * @return VuePaiement
     */
    public function getVue(): VuePaiement
    {
        return $this->vue;
    }
}
