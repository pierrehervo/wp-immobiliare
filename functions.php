<?php

function immobiliare_enqueue_styles(){
    wp_enqueue_style( 'style',get_template_directory_uri() . '/style.css');
    
    
    
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.3.1.slim.min.js',[],false,true);
    wp_enqueue_script('popper.js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',[],false,true);
    wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',[],false,true);

}

//On attache la fonction 'immobiliare_enqueue_styles' au hook "wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'immobiliare_enqueue_styles');


function register_my_menu() {
    register_nav_menu('main-menu', 'Menu principal');
}

add_action( 'init', 'register_my_menu' );


// Register Custom Navigation Walker
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';


//Images à la une 
add_theme_support( 'post-thumbnails' );


function register_housing(){
    register_post_type('housing', [
        'label' => 'logements',
        'labels' => [
            'name' => 'Logements',
            'singular_name' => 'Logement',
            'all_items' => 'Tous les logements',
            'add_new_item' => 'Ajouter un logement',
            'edit_item' => 'Éditer le logement',
            'new_item' => 'Nouveau logement',
            'view_item' => 'Voir le logement',
            'search_items' => 'Rechercher parmi les logements',
            'not_found' => 'Pas de logement trouvé',
            'not_found_in_trash' => 'Pas de logement dans la corbeille'
        ],
        'public' => true,
        'supports' => ['title', 'editor', 'author', 'thumbnail'],
        'has_archive' => true,
        'show_in_rest' => true, // Si on veut activer Gutenberg;
    ]);
}
//Ajout des annonces
add_action ('init','register_housing');


//Ajouter des types
function registerTypes(){
    register_taxonomy('types', 'housing', [
    'label' => 'Types',
    'labels' => [
        'name' => 'Types',
        'singular_name' => 'Type',
        'all_items' => 'Tous les types',
        'edit_item' => 'Éditer le type',
        'view_item' => 'Voir le type',
        'update_item' => 'Mettre à jour le type',
        'add_new_item' => 'Ajouter un type',
        'new_item_name' => 'Nouveau type',
        'search_items' => 'Rechercher parmi les types',
        'popular_items' => 'Types les plus utilisés'
    ],
    'hierarchical' => true,
    'show_in_rest' => true, // Pour Gutenberg
]);
}
//Ajout des annonces
add_action ('init','registerTypes');


//Ajouter des villes
function registerVilles() {
register_taxonomy('villes', 'housing', [
    'label' => 'Villes',
    'labels' => [
        'name' => 'Villes',
        'singular_name' => 'Ville',
        'all_items' => 'Tous les villes',
        'edit_item' => 'Éditer le ville',
        'view_item' => 'Voir le ville',
        'update_item' => 'Mettre à jour le ville',
        'add_new_item' => 'Ajouter un ville',
        'new_item_name' => 'Nouveau ville',
        'search_items' => 'Rechercher parmi les villes',
        'popular_items' => 'Villes les plus utilisés'
    ],
    'hierarchical' => true,
    'show_in_rest' => true, // Pour Gutenberg
]);
}
//Ajout des annonces
add_action ('init','registerVilles');