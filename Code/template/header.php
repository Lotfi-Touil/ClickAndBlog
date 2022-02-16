<!doctype html>
<html lang="fr">
<head>
    <title>Click & Blog</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bulma CSS -->
    <link rel="stylesheet" href="template/style/bulma.min.css">
    <!-- my CSS -->
    <link rel="stylesheet" href="template/style/styles.css?1" type="text/css">
    <!-- icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
          integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!-- Jquery -->
    <script src="composants/Js/Jquery/jquery.js"></script>
    <!-- Jquery UI TODO:Ajouter les fichier physique-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <!-- TinyMCE -->
    <script src="composants/Js/TinyMce/tinymce.min.js"></script>
    <!-- JS -->
    <script defer src="scripts.js?1"></script>
    <!-- ScriptTinyMCE -->
    <script src="composants/Js/Script/tiny.js"></script>
    <!-- Stripe-->
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<?php
require_once './composants/comp_profil/cont_profil.php';
$cont = new ContProfil();
$cont->affiche();