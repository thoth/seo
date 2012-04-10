<a href="#"><?php __('SEO/OM'); ?></a>
<ul>
    <li><?php echo $html->link(__('General Options', true),array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'index')); ?></li>
    <?php
    	if(Configure::read('Seo.hook_google') == 1){
    ?>
    <li><?php echo $html->link(__('Google Settings', true),array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'google')); ?></li>
    <?php
    	}
    ?>
    <?php
    	if(Configure::read('Seo.hook_twitter') == 1){
    ?>
    <li><?php echo $html->link(__('Twitter Settings', true),array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'twitter')); ?></li>
    <?php
    	}
    ?>
    <?php
    	if(Configure::read('Seo.hook_facebook') == 1){
    ?>
    <li><?php echo $html->link(__('Facebook Settings', true),array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'facebook')); ?></li>
    <?php
    	}
    ?>
</ul>