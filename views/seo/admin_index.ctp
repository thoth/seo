<?php
	
	$this->Html->css('/seo/css/seo.css', null, array('inline'=>false));

?>

<div class="seo index">
    <h2><?php echo $title_for_layout; ?></h2>
    <p>
    	If you do not wish to include Google, Bing, or Yahoo, simply leave the field blank.
    </p>
    <p>
    	In order to use the META functionality (including many of the popular verification codes, you will need to put:<br />
    	<code>echo $this->Seo->meta();</code><br />
    	between the &lt;head&gt; tags in your layouts.<br />
    	You may have to remove:<br />
    	<code>echo $this->Layout->meta();</code><br />
    	As you could end up with some conflicted functionality.<br />

    </p>
</div>


<?php

	$yes_no = array(1=>'Yes', 0=>'No');

echo $form->create('Settings', array('url' => array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'index', 'admin' => true)));

	echo $form->input('Seo.meta_robots_default.id', array('type' => 'hidden', 'default' => $inputs['meta_robots_default']['id'] ));
	echo $form->input('Seo.insert_meta_robots.id', array('type' => 'hidden', 'default' => $inputs['insert_meta_robots']['id'] ));
	echo $form->input('Seo.insert_meta_description.id', array('type' => 'hidden', 'default' => $inputs['insert_meta_description']['id'] ));
	echo $form->input('Seo.insert_meta_keywords.id', array('type' => 'hidden', 'default' => $inputs['insert_meta_keywords']['id'] ));

	echo $form->inputs(
		array(
			'legend'=>'General Settings',
			'Seo.insert_meta_keywords.value'=>array('default' => $inputs['insert_meta_keywords']['value'], 'label' => 'Insert META Keywords', 'options'=>$yes_no),
			'Seo.insert_meta_description.value'=>array('default' => $inputs['insert_meta_description']['value'], 'label' => 'Insert META Description', 'options'=>$yes_no),
			'Seo.insert_meta_robots.value'=>array('default' => $inputs['insert_meta_robots']['value'], 'label' => 'Insert META Robots', 'options'=>$yes_no),
			'Seo.meta_robots_default.value'=>array('default' => $inputs['meta_robots_default']['value'], 'label' => 'META Robots Default'),
		)
	);

	echo $form->input('Seo.alexa_verification_key.id', array('type' => 'hidden', 'default' => $inputs['alexa_verification_key']['id'] ));
	echo $form->inputs(
		array(
			'legend'=>'Alexa',
			'Seo.alexa_verification_key.value'=>array('default' => $inputs['alexa_verification_key']['value'], 'label' => 'Alexa Verification ID' ),
		)
	);

	echo $form->input('Seo.bing_webmaster_tools_key.id', array('type' => 'hidden', 'default' => $inputs['bing_webmaster_tools_key']['id'] ));
	echo $form->inputs(
		array(
			'legend'=>'Bing',
			'Seo.bing_webmaster_tools_key.value'=>array('default' => $inputs['bing_webmaster_tools_key']['value'], 'label' => 'Bing Webmaster Tools ID' ),
		)
	);


	echo $form->input('Seo.changefreq.id', array('type' => 'hidden', 'default' => $inputs['changefreq']['id'] ));
	echo $form->input('Seo.priority.id', array('type' => 'hidden', 'default' => $inputs['priority']['id'] ));
	echo $form->input('Seo.organize_by_vocabulary.id', array('type' => 'hidden', 'default' => $inputs['organize_by_vocabulary']['id'] ));
	echo $form->inputs(
		array(
			'legend'=>'Sitemap Settings',
			'Seo.changefreq.value'=>array('default' => $inputs['changefreq']['value'], 'label' => 'Change Frequency' ),
			'Seo.priority.value'=>array('default' => $inputs['priority']['value'], 'label' => 'Priority' ),
			'Seo.organize_by_vocabulary.value'=>array('default' => $inputs['organize_by_vocabulary']['value'], 'label' => 'Organize Public Sitemap by Vocabulary', 'options'=>$yes_no ),
		)
	);

	echo $form->input('Seo.show_per_page_stats.id', array('type' => 'hidden', 'default' => $inputs['show_per_page_stats']['id'] ));
	echo $form->input('Seo.hook_google.id', array('type' => 'hidden', 'default' => $inputs['hook_google']['id'] ));
	echo $form->input('Seo.hook_twitter.id', array('type' => 'hidden', 'default' => $inputs['hook_twitter']['id'] ));
	//echo $form->input('Seo.hook_facebook.id', array('type' => 'hidden', 'default' => $inputs['hook_facebook']['id'] ));
	echo $form->inputs(
		array(
			'legend'=>'External Integration',
			'Seo.show_per_page_stats.value'=>array('default' => $inputs['show_per_page_stats']['value'], 'label' => 'Show Page Stats on Edit Page', 'after'=>'This may significantly slow the page load for the admin edit. Service provided by <a href="http://www.nahklick.de/index.php" style="color:#003E82;" target="_blank" title="Angebote und Prospekte aus Ihrer Region">nahklick.de</a>', 'options'=>$yes_no),
			'Seo.hook_google.value'=>array('default' => $inputs['hook_google']['value'], 'label' => 'Provide Hook to Google', 'options'=>$yes_no),
			'Seo.hook_twitter.value'=>array('default' => $inputs['hook_twitter']['value'], 'label' => 'Provide Hook to Twitter', 'options'=>$yes_no),
			//'Seo.hook_facebook.value'=>array('default' => $inputs['hook_facebook']['value'], 'label' => 'Provide Hook to Facebook', 'options'=>$yes_no),
		)
	);


	echo $form->input('Seo.homepage_title.id', array('type' => 'hidden', 'default' => $inputs['homepage_title']['id'] ));
	echo $form->input('Seo.homepage_description.id', array('type' => 'hidden', 'default' => $inputs['homepage_description']['id'] ));
	echo $form->inputs(
		array(
			'legend'=>'Singular Pages',
			'Seo.homepage_title.value'=>array('default' => $inputs['homepage_title']['value'], 'label' => 'Home Page Title' ),
			'Seo.homepage_description.value'=>array('default' => $inputs['homepage_description']['value'], 'label' => 'Home Page META Description' ),
		)
	);

	echo $form->input('Seo.rss_before.id', array('type' => 'hidden', 'default' => $inputs['rss_before']['id'] ));
	echo $form->input('Seo.rss_after.id', array('type' => 'hidden', 'default' => $inputs['rss_after']['id'] ));
	echo $form->inputs(
		array(
			'legend'=>'RSS Settings',
			'Seo.rss_before.value'=>array('default' => $inputs['rss_before']['value'], 'type'=>'textarea', 'label' => 'Content to prefix each post in RSS Feed' ),
			'Seo.rss_after.value'=>array('default' => $inputs['rss_after']['value'], 'type'=>'textarea', 'label' => 'Content to suffix each post in RSS Feed' ),
		)
	);
	
echo $form->end(__('Submit',true));

?>
