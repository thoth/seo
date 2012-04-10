<?php
	
	$this->Html->css('/seo/css/seo.css', null, array('inline'=>false));

?>

<div class="seo index">
    <h2><?php echo $title_for_layout; ?></h2>
</div>


<?php

echo $this->Form->create('Settings', array('url' => array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'twitter', 'admin' => true)));

	echo $this->Form->input('Seo.twitter_username.id', array('type' => 'hidden', 'default' => $inputs['twitter_username']['id'] ));
	echo $this->Form->input('Seo.twitter_consumer_key.id', array('type' => 'hidden', 'default' => $inputs['twitter_consumer_key']['id'] ));
	echo $this->Form->input('Seo.twitter_consumer_secret.id', array('type' => 'hidden', 'default' => $inputs['twitter_consumer_secret']['id'] ));
	echo $this->Form->input('Seo.twitter_access_token.id', array('type' => 'hidden', 'default' => $inputs['twitter_access_token']['id'] ));
	echo $this->Form->input('Seo.twitter_access_token_secret.id', array('type' => 'hidden', 'default' => $inputs['twitter_access_token_secret']['id'] ));

	echo $this->Form->inputs(
		array(
			'legend'=>'Twitter Settings',
			'Seo.twitter_username.value'=>array('default' => $inputs['twitter_username']['value'], 'label' => 'Twitter Username' ),
			'Seo.twitter_consumer_key.value'=>array('default' => $inputs['twitter_consumer_key']['value'], 'label' => 'Twitter Consumer Key' ),
			'Seo.twitter_consumer_secret.value'=>array('default' => $inputs['twitter_consumer_secret']['value'], 'label' => 'Twitter Consumer Secret' ),
			'Seo.twitter_access_token.value'=>array('default' => $inputs['twitter_access_token']['value'], 'label' => 'Twitter Access Token' ),
			'Seo.twitter_access_token_secret.value'=>array('default' => $inputs['twitter_access_token_secret']['value'], 'label' => 'Twitter Access Secret'),
		)
	);
	
echo $this->Form->end(__('Submit',true));

?>
