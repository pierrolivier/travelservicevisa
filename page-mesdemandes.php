<?php 
/*
Template Name: mesdemandes
*/
?>

<?php acf_form_head(); ?>
<?php get_header(); ?>
<div class="site-main">
    <?php if ( is_user_logged_in() ) {
    
        global $current_user;
        get_currentuserinfo();
        
        query_posts(array(
            'author'=> $current_user->ID,
            'post_type'=> 'demande'
        ));
    
        if ( have_posts() ): ?>
        <?php while ( have_posts() ): the_post(); ?>
        <div <?php post_class(); ?>>
            <h1 class="post-title">Demande pour <?php the_field('nom').' '.the_field('prenom') ?></h1>
            <h2 class="post-status">Statut de votre demande <?php the_field('statut'); ?></h2>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
    <?php 
        }else{
            echo "Vous devez être connecté";
        }
    ?>
</div>
<?php get_footer(); ?>