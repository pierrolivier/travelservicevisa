<aside class="site-side">
  <!-- Pages -->
  <ul class="list">
    	<li><a href="<?= get_permalink(pll_get_post(33)); ?>"><?= pll__('Nouvelle demande')?></a></li>
    <?php if ( is_user_logged_in() ): ?>
    	<li><a href="<?= get_permalink(pll_get_post(48)); ?>"><?= pll__('Mes demandes')?></a></li>
    	<li><a href="<?= wp_logout_url(site_url('/')) ?>"><?= pll__('Déconnexion')?></a></li>
	<?php else: ?>
    	<li><a href="<?= get_permalink(pll_get_post(46)); ?>"><?= pll__('Inscription'); ?></a></li>
    	<li><a href="<?= get_permalink(pll_get_post(44)); ?>"><?= pll__('Connexion')?></a></li>
    <?php endif; ?>
  </ul>
</aside>