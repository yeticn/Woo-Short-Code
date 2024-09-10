<?php

/*
Plugin Name: Yetinc Short Code
Plugn URL : https://yetinc.ch 
Description: Ajoute des shortcodes personnalisés pour Woocommmerce et Wordpress et l'affichage de ses données
Version: 1.1.2
Author: Yetinc Sàrl
Author URI: https://yetinc.ch 
Update URI: https://yetinc.ch 
Text domain: Yetinc Short Code by Coding Manufactory
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