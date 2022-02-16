<?php

class VueGenerique
{

    public function __Construct()
    {
        ob_start();
    }

    public static function getAffichage()
    {
        return ob_get_clean();
    }

}