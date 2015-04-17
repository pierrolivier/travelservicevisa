<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/public/css/style.css">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>

    <?php get_template_part('login-popup'); ?>

    <header class="site-header">
      <div class="inside">
        <div class="site-name">
          <a href="<?php bloginfo('home'); ?>">
            <span class="travel-service">travel service</span>
            <span class="visa">visa</span>
          </a>
        </div>

        <?php
          if ( ! is_user_logged_in() ):
            wp_nav_menu(array('theme_location'=>'header-not-logged','container_class'=>'header-menu'));
          else:
            wp_nav_menu(array('theme_location'=>'header-logged','container_class'=>'header-menu'));
          endif;
        ?>

        <?php if ( ! is_user_logged_in() ): ?>
        <div class="log-box unlogged">
          <a href="<?= get_permalink(pll_get_post(46)); ?>"><?= get_the_title(pll_get_post(46)); ?></a> | 
          <a class="login-popup-button" href="<?= get_permalink(pll_get_post(44)); ?>"><?= get_the_title(pll_get_post(44)); ?></a>
        </div>
        <?php else: ?>
          <div class="log-box logged">
              <div class="head"><span class="icon-sort-down align"></span> Mon compte</div>
              <div class="img-user"></div>
          </div>
          <div class="display">
              <ul class="dropdown">
                <li><a href="<?= admin_url('user-edit.php?user_id='.get_current_user_id()); ?>"><?= pll__('Paramètres'); ?></a></li>
                <li><a href="<?= wp_logout_url(site_url('/')) ?>"><?= pll__('Déconnexion')?></a></li>
              </ul>
          </div>
        <?php endif; ?>
        <div class="getVisa"><a href="<?= get_permalink(pll_get_post(33)); ?>"><?= get_the_title(pll_get_post(33)); ?></a></div>
    </header>