<?php
/* 
Template Name: signup
*/
?>

<?php get_header(); ?>
<div class="site-main">
<h1><?php pll_e('Inscription'); ?></h1>
<?php
    if ( !is_user_logged_in() ) {
        register_user_form(); 
    }else{
        wp_redirect( home_url() ); exit;
    }
?>

</div>
<?php get_footer(); ?>