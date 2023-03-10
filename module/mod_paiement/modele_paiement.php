<?php
if (!defined('CONST_INCLUDE')) {
    die('interdit !');
}

class ModelePaiement extends Connexion
{
    // Module de paiement du site web
    public function checkout()
    {
        require 'Stripe/init.php';
// This is your test secret API key.
        \Stripe\Stripe::setApiKey('sk_test_51KHSX0Hfm0vTSHwadnCPM5sODDg8XJ1bfPKEg7sneA1RB1kZ2JaaKfJBWbVA4vfXzY8JpSV09weJbKa1XBRoDKV400Z5hlDYgA');

        //header('Content-Type: application/json');

//        $YOUR_DOMAIN = 'http://localhost:80/PHPS3/ProjetS3/ClickAndBlog/Code';
            $YOUR_DOMAIN = 'https://localhost/progWeb/ClickAndBlog/Code';
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Article',
                    ],
                    'unit_amount' => 200,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/index.php?module=mod_article&action=ajout_payement&idArticle=' . $_GET['idArticle'],
            'cancel_url' => $YOUR_DOMAIN . '/index.php?module=mod_paiement&action=cancel',
        ]);

        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);
    }
}