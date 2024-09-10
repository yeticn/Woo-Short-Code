<?php

/*
Plugin Name: Yetinc Shortcodes for WooCommerce
Description: Ajoute des shortcodes personnalisés pour WooCommerce et WordPress et l'affichage de ses données ainsi qu'un arrondi de TVA pour les shops en Suisse.

Version: 1.1.3
Author: Yetinc Sàrl
Author URI: https://yetinc.ch 
Plugin URI: https://github.com/yeticn/Woo-Short-Code
GitHub Plugin URI: yeticn/Woo-Short-Code
Text Domain: yetinc-short-code
*/

// Afficher le nom de l'utilisateur connecté ou un lien de connexion avec un shortcode
function show_loggedin_function( $locale ) {
 
    global $current_user, $user_login, $locale;
    if ($user_login)
        return '<a href="/mon-compte/">Bonjour ' . $current_user->display_name .'</a>';
    else
        return '<a href="/mon-compte/">Login</a>';
   
}
add_shortcode( 'show_loggedin_as', 'show_loggedin_function' );
 
// Afficher la catégorie actuelle
// Fonction pour afficher le nom de la catégorie actuelle
function afficher_nom_categorie_actuelle() {
    // Récupérer l'ID de la catégorie actuelle
    $category = get_queried_object();
    $cat_name ="";
    // Récupérer le nom de la catégorie
    if ($category)
        $cat_name = $category->name;
    // Afficher le nom de la catégorie
    echo  $cat_name;
}
 
// Ajouter le shortcode pour afficher le nom de la catégorie 
add_shortcode('afficher_categorie', 'afficher_nom_categorie_actuelle');

// Générer la date d'expédition
// Fonction pour générer la date d'expédition (ajoute 2 jours à la date actuelle)
function afficher_date_expedition() {
    // Définir la timezone
    date_default_timezone_set('Europe/Paris'); // Remplace si nécessaire selon ta timezone

    // Obtenir la date actuelle et ajouter 2 jours
    $date = new DateTime();
    $date->modify('+2 day');

    // Formater la date (exemple: "Expédié avant le 14/09/2023")
    $date_formatee = $date->format('d/m/Y');

    // Retourner le texte avec la date
    return "Expédié avant le " . $date_formatee;
}

// Création du shortcode pour afficher le texte "Expédié avant le ..."
add_shortcode('expedition_date', 'afficher_date_expedition');

// Ajouter une fonction de round TVA pour les shops en Suisse.
add_filter( 'woocommerce_cart_tax_total', 'round_subtotal', 10, 3);
add_filter( 'woocommerce_get_price_excluding_tax', 'round_price_product', 10, 1 );
add_filter( 'woocommerce_get_price_including_tax', 'round_price_product', 10, 1 );
add_filter( 'woocommerce_tax_round', 'round_price_product', 10, 1);
add_filter( 'woocommerce_product_get_price', 'round_price_product', 10, 1);
add_filter( 'woocommerce_calculated_total', 'round_price_product', 10, 1);
add_filter( 'woocommerce_calculated_subtotal', 'round_price_product', 10, 1);
add_filter( 'woocommerce_cart_subtotal', 'round_subtotal', 10, 3);
 
function round_subtotal( $cart_subtotal, $compound, $instance ) {
$origValue = $cart_subtotal;
preg_match( '/\d+\.\d+/', $origValue, $floatValue);
$roundedValue = number_format( round_price_product( $floatValue[0] ), 2 );
$returnValue = str_replace( $floatValue, $roundedValue, $origValue );
return $returnValue;
}
function round_price_product( $price ){
// Return rounded price
return round( $price * 2, 1 ) / 2;

// Fonction pour afficher l'année actuelle
function afficher_copyright_annee() {
    // Récupérer l'année courante
    $annee_actuelle = date('Y');
    
    // Retourner l'année dans un message de copyright
    return '&copy; ' . $annee_actuelle;
}

// Création du shortcode [copyright_year] qui affiche l'année courante
add_shortcode('copyright_year', 'afficher_copyright_annee');

}