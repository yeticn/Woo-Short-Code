<?php

/*
Plugin Name: Yetinc Short Code
Plugn URL : https://yetinc.ch 
Description: Ajoute des shortcodes personnalisés pour Woocommmerce et Wordpress et l'affichage de ses données
Version: 1.1.1
Author: Yetinc Sàrl
Author URI: https://yetinc.ch 
Update URI: https://yetinc.ch 
Text domain: Yetinc Short Code by Coding Manufactory
*/
function show_loggedin_function( $locale ) {
 
    global $current_user, $user_login, $locale;
    if ($user_login)
        return '<a href="/mon-compte/">Bonjour ' . $current_user->display_name .'</a>';
    else
        return '<a href="/mon-compte/">Login</a>';
   
}
add_shortcode( 'show_loggedin_as', 'show_loggedin_function' );
 
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