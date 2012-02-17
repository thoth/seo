<?php
	
	$this->Html->css('/seo/css/seo.css', null, array('inline'=>false));
	$yes_no = array(1=>'Yes', 0=>'No');

?>

<div class="seo index">
    <h2><?php echo $title_for_layout; ?></h2>
</div>

<?php

echo $form->create('Settings', array('url' => array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'google', 'admin' => true)));

	echo $form->input('Seo.google_places_cid.id', array('type' => 'hidden', 'default' => $inputs['google_places_cid']['id'] ));
	echo $form->input('Seo.google_plus_cid.id', array('type' => 'hidden', 'default' => $inputs['google_plus_cid']['id'] ));
	echo $form->inputs(
		array(
			'legend'=>'Google General Settings',
			'Seo.google_places_cid.value'=>array('default' => $inputs['google_places_cid']['value'], 'label' => 'Google Places Page' ),
			'Seo.google_plus_cid.value'=>array('default' => $inputs['google_plus_cid']['value'], 'label' => 'Google Plus Page' ),
		)
	);

	echo $form->input('Seo.google_adwords_tracking_for_messages.id', array('type' => 'hidden', 'default' => $inputs['google_webmaster_tools_key']['id'] ));
	echo $form->input('Seo.google_webmaster_tools_key.id', array('type' => 'hidden', 'default' => $inputs['google_webmaster_tools_key']['id'] ));
	echo $form->input('Seo.google_analytics_ua.id', array('type' => 'hidden', 'default' => $inputs['google_analytics_ua']['id'] ));
	echo $form->input('Seo.google_analytics_domain.id', array('type' => 'hidden', 'default' => $inputs['google_analytics_domain']['id'] ));
	echo $form->inputs(
		array(
			'legend'=>'Google',
			'Seo.google_adwords_tracking_for_messages.value'=>array('default' => $inputs['google_adwords_tracking_for_messages']['value'], 'label' => 'Google AdWords Tracking for Messages', 'options'=>$yes_no),
			'Seo.google_webmaster_tools_key.value'=>array('default' => $inputs['google_webmaster_tools_key']['value'], 'label' => 'Google Webmaster Tools Key' ),
			'Seo.google_analytics_ua.value'=>array('default' => $inputs['google_analytics_ua']['value'], 'label' => 'Google Analytics UA' ),
			'Seo.google_analytics_domain.value'=>array('default' => $inputs['google_analytics_domain']['value'], 'label' => 'Google Analytics Domain' ),
		)
	);	
	/*

	{{google_conversion_id}};
var google_conversion_language = "{{google_conversion_language}}";
var google_conversion_format = "{{google_conversion_format}}";
var google_conversion_color = "{{google_conversion_color}}";
var google_conversion_label = "{{google_conversion_label}}";
var google_conversion_value = {{google_conversion_value}};
	
*/
	foreach($contacts as $contact){

		echo $form->input('Seo.adwords_conversion_key_'.$contact['Contact']['alias'].'.id', array('type' => 'hidden', 'default' => $inputs['adwords_conversion_key_'.$contact['Contact']['alias']]['id'] ));
		echo $form->input('Seo.adwords_conversion_language_'.$contact['Contact']['alias'].'.id', array('type' => 'hidden', 'default' => $inputs['adwords_conversion_language_'.$contact['Contact']['alias']]['id'] ));
		echo $form->input('Seo.adwords_conversion_format_'.$contact['Contact']['alias'].'.id', array('type' => 'hidden', 'default' => $inputs['adwords_conversion_format_'.$contact['Contact']['alias']]['id'] ));
		echo $form->input('Seo.adwords_conversion_color_'.$contact['Contact']['alias'].'.id', array('type' => 'hidden', 'default' => $inputs['adwords_conversion_color_'.$contact['Contact']['alias']]['id'] ));
		echo $form->input('Seo.adwords_conversion_label_'.$contact['Contact']['alias'].'.id', array('type' => 'hidden', 'default' => $inputs['adwords_conversion_label_'.$contact['Contact']['alias']]['id'] ));
		echo $form->input('Seo.adwords_conversion_value_'.$contact['Contact']['alias'].'.id', array('type' => 'hidden', 'default' => $inputs['adwords_conversion_value_'.$contact['Contact']['alias']]['id'] ));
		echo $form->inputs(
			array(
				'legend'=>'Google Adwords Conversion for "'.$contact['Contact']['title']. '" Contact Form',
				'Seo.adwords_conversion_key_'.$contact['Contact']['alias'].'.value'=>array('default' => $inputs['adwords_conversion_key_'.$contact['Contact']['alias']]['value'], 'label' => 'Conversion ID' ),
				
				'Seo.adwords_conversion_language_'.$contact['Contact']['alias'].'.value'=>array('default' => $inputs['adwords_conversion_language_'.$contact['Contact']['alias']]['value'], 'label' => 'Conversion Language' ),
				
				'Seo.adwords_conversion_format_'.$contact['Contact']['alias'].'.value'=>array('default' => $inputs['adwords_conversion_format_'.$contact['Contact']['alias']]['value'], 'label' => 'Conversion Format' ),
				
				'Seo.adwords_conversion_color_'.$contact['Contact']['alias'].'.value'=>array('default' => $inputs['adwords_conversion_color_'.$contact['Contact']['alias']]['value'], 'label' => 'Conversion Color' ),
				
				'Seo.adwords_conversion_label_'.$contact['Contact']['alias'].'.value'=>array('default' => $inputs['adwords_conversion_label_'.$contact['Contact']['alias']]['value'], 'label' => 'Conversion Label' ),
				
				'Seo.adwords_conversion_value_'.$contact['Contact']['alias'].'.value'=>array('default' => $inputs['adwords_conversion_value_'.$contact['Contact']['alias']]['value'], 'label' => 'Conversion Value' ),
			)
		);		
	}


echo $form->end(__('Submit',true));

?>
