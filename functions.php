<?php

//PLL TRADUCTIONS
pll_register_string('Copyright', 'Copyright');
pll_register_string('Paramètres', 'Paramètres');
pll_register_string('Déconnexion', 'Déconnexion');
//PLL TRADUCTIONS END

add_action('init','register_my_menus');
function register_my_menus(){
    register_nav_menus( array(
        'header-logged' => __( 'Header for logged user' ),
        'header-not-logged' => __( 'Header for unlogged users' )
    ));
}

add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'demande',array(
        'labels' => array(
            'name' => __( 'Demandes' ),
            'singular_name' => __( 'Demande' )
        ),
        'public' => true,
        'show_ui' => true,
        'has_archive' => true,
        'supports' => false

    ));
}

// if you don't add 3 as as 4th argument, this will not work as expected
add_action( 'save_post', 'save_post_function', 10, 3 );

function save_post_function( $post_ID, $post, $update ) {
    $post = get_post($post_ID); 
    if($post->post_type=='demande'){
        if($post->send_mail=='true'){
            if($post->contenu_mail=='auto'){
                wp_mail( $post->email, $post->nom.' '.$post->prenom .' [TRAVEL SERVICE VISA]' , 'Bonjour '.$post->prenom .' votre dossier a été mis à jour. Etat actuel de votre dossier : '. $post->statut  );
            }else{
                wp_mail( $post->email, $post->nom.' '.$post->prenom .' [TRAVEL SERVICE VISA]' , 'Bonjour '.$post->prenom .' votre dossier a été mis à jour. '. $post->perso_mail );
            }
        }
    }
}

// Formulaire d'inscription
function register_user_form() {
    echo '<form action="' . admin_url( 'admin-post.php?action=nouvel_utilisateur' ) . '" method="post" id="register-user">';

    // Les champs requis
    echo '<p><label for="nom-user">Nom</label><input type="text" name="username" id="nom-user" required></p>';
    echo '<p><label for="email-user">Email</label><input type="email" name="email" id="email-user" required></p>';
    echo '<p><label for="pass-user">Mot de passe</label><input type="password" name="pass" id="pass-user" required><br>';
    echo '<input type="checkbox" id="show-password"><label for="show-password">Voir le mot de passe</label></p>';

    // Nonce (pour vérifier plus tard que l'action a bien été initié par l'utilisateur)
    wp_nonce_field( 'create-' . $_SERVER['REMOTE_ADDR'], 'user-front', false );

    //Validation
    echo '<input type="submit" value="Créer mon compte">';
    echo '</form>';

    // Enqueue de scripts qui vont nous permettre de vérifier les champs
    wp_enqueue_script( 'inscription-front' );
}

// Enregistrement de l'utilisateur
add_action( 'admin_post_nopriv_nouvel_utilisateur', 'ajouter_utilisateur' );
function ajouter_utilisateur() {
    // Vérifier le nonce (et n'exécuter l'action que s'il est valide)
    if( isset( $_POST['user-front'] ) && wp_verify_nonce( $_POST['user-front'], 'create-' . $_SERVER['REMOTE_ADDR'] ) ) {

        // Vérifier les champs requis
        if ( ! isset( $_POST['username'] ) || ! isset( $_POST['email'] ) || ! isset( $_POST['pass'] ) ) {
            wp_redirect( site_url( '/inscription/?message=not-user' ) );
            exit();
        }

        $nom = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Vérifier que l'user (email ou nom) n'existe pas
        if ( is_email( $email ) && ! username_exists( $nom )  && ! email_exists( $email ) ) {
            // Création de l'utilisateur
            $user_id = wp_create_user( $nom, $pass, $email );
            $user = new WP_User( $user_id );
            // On lui attribue un rôle
            $user->set_role( 'subscriber' );
            // Envoie un mail de notification au nouvel utilisateur
            wp_new_user_notification( $user_id, $pass );
        } else {
            wp_redirect( site_url( '/inscription/?message=already-registered' ) );
            exit();
        }

        // Connecter automatiquement le nouvel utilisateur
        $creds = array();
        $creds['user_login'] = $nom;
        $creds['user_password'] = $pass;
        $creds['remember'] = false;
        $user = wp_signon( $creds, false );

        // Redirection
        wp_redirect( site_url( '/?message=welcome' ) );
        exit();
    }
}

function bbx_theme_setup() {
    if ( ! isset( $content_width ) ) $content_width = 1200;
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'menus' );
    add_theme_support( 'post-thumbnails' );
    add_filter( 'show_admin_bar', '__return_false' );
}
add_action( 'after_setup_theme', 'bbx_theme_setup' );


function bbx_enqueue_scripts() {
    $js_directory = get_template_directory_uri() . '/public/js/';
    wp_register_script( 'app', $js_directory . 'app.js');
    wp_enqueue_script( 'app' );
}
add_action( 'wp_enqueue_scripts', 'bbx_enqueue_scripts' );

