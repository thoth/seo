<?php
	
	$this->Html->css('/seo/css/seo.css', null, array('inline'=>false));

?>

<div class="seo index">
    <h2><?php echo $title_for_layout; ?></h2>
</div>

<div class="al2fb_instructions">
	<h4>To get an App ID and App Secret you have to create a Facebook application</h4>
	<span><strong>You have to fill in the following:</strong></span>
	<table>
		<tbody><tr>
			<td><span class="al2fb_label"><strong>App Name:</strong></span></td>
			<td><span class="al2fb_data">Anything you like, will appear as "via ..." below the message</span></td>
		</tr>
		<tr>
			<td><span class="al2fb_label"><strong>Website &gt; Site URL:</strong></span></td>
			<td><span class="al2fb_data" style="color: red;"><strong><?php echo 'http://'.$_SERVER['SERVER_NAME'] ?></strong></span></td>
		</tr>
	</tbody></table>
	<a href="http://developers.facebook.com/" target="_blank">Click here to create</a>
	<span>and navigate to '<em>Apps</em>' and then to '<em>Create New App</em>'</span>
	</div>
<?php

echo $this->Form->create('Settings', array('url' => array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'facebook', 'admin' => true)));

	echo $this->Form->input('Seo.facebook_link.id', array('type' => 'hidden', 'default' => $inputs['facebook_link']['id'] ));
	echo $this->Form->inputs(
		array(
			'legend'=>'Facebook General Settings',
			'Seo.facebook_link.value'=>array('default' => $inputs['facebook_link']['value'], 'label' => 'Facebook Page' ),
		)
	);

	echo $this->Form->input('Seo.facebook_app_key.id', array('type' => 'hidden', 'default' => $inputs['facebook_app_key']['id'] ));
	echo $this->Form->input('Seo.facebook_app_secret.id', array('type' => 'hidden', 'default' => $inputs['facebook_app_secret']['id'] ));
	echo $this->Form->inputs(
		array(
			'legend'=>'Facebook Application Settings',
			'Seo.facebook_app_key.value'=>array('default' => $inputs['facebook_app_key']['value'], 'label' => 'Facebook App ID' ),
			'Seo.facebook_app_secret.value'=>array('default' => $inputs['facebook_app_secret']['value'], 'label' => 'Facebook App Secret' ),
		)
	);
	
echo $this->Form->end(__('Submit',true));

?>
