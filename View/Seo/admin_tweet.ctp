<?php
	
	$this->Html->css('/seo/css/seo.css', null, array('inline'=>false));

?>

<div class="seo index">
    <h2><?php echo $title_for_layout; ?></h2>
</div>


<?php

echo $this->Form->create('Twitter', array('url' => array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'tweet', 'admin' => true)));

	echo $this->Form->inputs(
		array(
			'legend'=>'Twitter Post',
			'post'=>array('default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla semper pellentesque nunc ut porttitor. Praesent sem enim cras amet. http://'.$_SERVER['SERVER_NAME'].$node['Node']['path'], 'label' => false, 'type'=>'textarea'),
		)
	);
	
echo $this->Form->end(__('Submit',true));

?>
