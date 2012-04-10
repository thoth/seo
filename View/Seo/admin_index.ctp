<?php
	
	$this->Html->css('/seo/css/seo.css', null, array('inline'=>false));
	$this->Html->script('/seo/js/charCount.js', array('inline'=>false));

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

echo $this->Form->create('Settings', array('url' => array('plugin' => 'seo', 'controller' => 'seo', 'action' => 'index', 'admin' => true)));

	echo $this->Form->input('Seo.remove_settings_on_deactivate.id', array('type' => 'hidden', 'default' => $inputs['remove_settings_on_deactivate']['id'] ));
	echo $this->Form->inputs(
		array(
			'legend'=>'Plugin Settings',
			'Seo.remove_settings_on_deactivate.value'=>array('default' => $inputs['remove_settings_on_deactivate']['value'], 'label' => 'Remove Settings on Deactivate', 'after'=>'You must type "YES" exactly to remove settings. This is to prevent losing keys, etc.' ),
		)
	);

	echo $this->Form->input('Seo.meta_robots_default.id', array('type' => 'hidden', 'default' => $inputs['meta_robots_default']['id'] ));
	echo $this->Form->input('Seo.insert_meta_robots.id', array('type' => 'hidden', 'default' => $inputs['insert_meta_robots']['id'] ));
	echo $this->Form->input('Seo.insert_meta_description.id', array('type' => 'hidden', 'default' => $inputs['insert_meta_description']['id'] ));
	echo $this->Form->input('Seo.insert_meta_keywords.id', array('type' => 'hidden', 'default' => $inputs['insert_meta_keywords']['id'] ));

	echo $this->Form->inputs(
		array(
			'legend'=>'General Settings',
			'Seo.insert_meta_keywords.value'=>array('default' => $inputs['insert_meta_keywords']['value'], 'label' => 'Insert META Keywords', 'options'=>$yes_no),
			'Seo.insert_meta_description.value'=>array('default' => $inputs['insert_meta_description']['value'], 'label' => 'Insert META Description', 'options'=>$yes_no),
			'Seo.insert_meta_robots.value'=>array('default' => $inputs['insert_meta_robots']['value'], 'label' => 'Insert META Robots', 'options'=>$yes_no),
			'Seo.meta_robots_default.value'=>array('default' => $inputs['meta_robots_default']['value'], 'label' => 'META Robots Default', 'after'=>$this->Html->link('Click to import META from "Custom Fields"', array('plugin'=>'seo', 'action'=>'convertfromcustom')).' (this will overwrite anything you have put in SEO tab...)' ),
		)
	);

	echo $this->Form->input('Seo.alexa_verification_key.id', array('type' => 'hidden', 'default' => $inputs['alexa_verification_key']['id'] ));
	echo $this->Form->inputs(
		array(
			'legend'=>'Alexa',
			'Seo.alexa_verification_key.value'=>array('default' => $inputs['alexa_verification_key']['value'], 'label' => 'Alexa Verification ID' ),
		)
	);

	echo $this->Form->input('Seo.bing_webmaster_tools_key.id', array('type' => 'hidden', 'default' => $inputs['bing_webmaster_tools_key']['id'] ));
	echo $this->Form->inputs(
		array(
			'legend'=>'Bing',
			'Seo.bing_webmaster_tools_key.value'=>array('default' => $inputs['bing_webmaster_tools_key']['value'], 'label' => 'Bing Webmaster Tools ID' ),
		)
	);


	echo $this->Form->input('Seo.changefreq.id', array('type' => 'hidden', 'default' => $inputs['changefreq']['id'] ));
	echo $this->Form->input('Seo.priority.id', array('type' => 'hidden', 'default' => $inputs['priority']['id'] ));
	echo $this->Form->input('Seo.organize_by_vocabulary.id', array('type' => 'hidden', 'default' => $inputs['organize_by_vocabulary']['id'] ));
	echo $this->Form->inputs(
		array(
			'legend'=>'Sitemap Settings',
			'Seo.changefreq.value'=>array('default' => $inputs['changefreq']['value'], 'label' => 'Change Frequency' ),
			'Seo.priority.value'=>array('default' => $inputs['priority']['value'], 'label' => 'Priority' ),
			'Seo.organize_by_vocabulary.value'=>array('default' => $inputs['organize_by_vocabulary']['value'], 'label' => 'Organize Public Sitemap by Vocabulary', 'options'=>$yes_no ),
		)
	);

	echo $this->Form->input('Seo.show_per_page_stats.id', array('type' => 'hidden', 'default' => $inputs['show_per_page_stats']['id'] ));
	echo $this->Form->input('Seo.hook_google.id', array('type' => 'hidden', 'default' => $inputs['hook_google']['id'] ));
	echo $this->Form->input('Seo.hook_twitter.id', array('type' => 'hidden', 'default' => $inputs['hook_twitter']['id'] ));
	//echo $this->Form->input('Seo.hook_facebook.id', array('type' => 'hidden', 'default' => $inputs['hook_facebook']['id'] ));
	echo $this->Form->inputs(
		array(
			'legend'=>'External Integration',
			'Seo.show_per_page_stats.value'=>array('default' => $inputs['show_per_page_stats']['value'], 'label' => 'Show Page Stats on Edit Page', 'after'=>'This may significantly slow the page load for the admin edit. Service provided by <a href="http://www.nahklick.de/index.php" style="color:#003E82;" target="_blank" title="Angebote und Prospekte aus Ihrer Region">nahklick.de</a>', 'options'=>$yes_no),
			'Seo.hook_google.value'=>array('default' => $inputs['hook_google']['value'], 'label' => 'Provide Hook to Google', 'options'=>$yes_no),
			'Seo.hook_twitter.value'=>array('default' => $inputs['hook_twitter']['value'], 'label' => 'Provide Hook to Twitter', 'options'=>$yes_no),
			//'Seo.hook_facebook.value'=>array('default' => $inputs['hook_facebook']['value'], 'label' => 'Provide Hook to Facebook', 'options'=>$yes_no),
		)
	);


	echo $this->Form->input('Seo.homepage_title.id', array('type' => 'hidden', 'default' => $inputs['homepage_title']['id'] ));
	echo $this->Form->input('Seo.homepage_description.id', array('type' => 'hidden', 'default' => $inputs['homepage_description']['id'] ));
	echo $this->Form->inputs(
		array(
			'legend'=>'Singular Pages',
			'Seo.homepage_title.value'=>array('default' => $inputs['homepage_title']['value'], 'label' => 'Home Page Title' ),
			'Seo.homepage_description.value'=>array('default' => $inputs['homepage_description']['value'], 'label' => 'Home Page META Description' ),
		)
	);

	echo $this->Form->input('Seo.add_rss_ga_campaign_tags.id', array('type' => 'hidden', 'default' => $inputs['add_rss_ga_campaign_tags']['id'] ));
	echo $this->Form->input('Seo.rss_ga_medium.id', array('type' => 'hidden', 'default' => $inputs['rss_ga_medium']['id'] ));
	echo $this->Form->input('Seo.rss_ga_campaign_name.id', array('type' => 'hidden', 'default' => $inputs['rss_ga_campaign_name']['id'] ));
	echo $this->Form->input('Seo.rss_before.id', array('type' => 'hidden', 'default' => $inputs['rss_before']['id'] ));
	echo $this->Form->input('Seo.rss_after.id', array('type' => 'hidden', 'default' => $inputs['rss_after']['id'] ));
	echo $this->Form->inputs(
		array(
			'legend'=>'RSS Settings',
			'Seo.add_rss_ga_campaign_tags.value'=>array('default' => $inputs['add_rss_ga_campaign_tags']['value'], 'options'=>$yes_no, 'label' => 'Add Google Analytics Campaign Trackers to link?' ),
			'Seo.rss_ga_medium.value'=>array('default' => $inputs['rss_ga_medium']['value'], 'label' => 'Campaign Medium' ),
			'Seo.rss_ga_campaign_name.value'=>array('default' => $inputs['rss_ga_campaign_name']['value'], 'label' => 'Campaign Name' ),
			'Seo.rss_before.value'=>array('default' => $inputs['rss_before']['value'], 'type'=>'textarea', 'label' => 'Content to prefix each post in RSS Feed', 'after'=>'Use the following tags: {{current_page}}, {{website}}, {{page_title}}, {{site_title}}, {{year}}, {{month}}, {{monthname}}, {{day}}'  ),
			'Seo.rss_after.value'=>array('default' => $inputs['rss_after']['value'], 'type'=>'textarea', 'label' => 'Content to suffix each post in RSS Feed', 'after'=>'Use the following tags: {{current_page}}, {{website}}, {{page_title}}, {{site_title}}, {{year}}, {{month}}, {{monthname}}, {{day}}'  ),
		)
	);

	echo $this->Form->input('Seo.add_copy_link.id', array('type' => 'hidden', 'default' => $inputs['add_copy_link']['id'] ));
	echo $this->Form->input('Seo.add_copy_link_ga_campaign_tags.id', array('type' => 'hidden', 'default' => $inputs['add_copy_link_ga_campaign_tags']['id'] ));
	echo $this->Form->input('Seo.copy_link_ga_medium.id', array('type' => 'hidden', 'default' => $inputs['copy_link_ga_medium']['id'] ));
	echo $this->Form->input('Seo.copy_link_ga_campaign_name.id', array('type' => 'hidden', 'default' => $inputs['copy_link_ga_campaign_name']['id'] ));
	echo $this->Form->input('Seo.copy_link_text.id', array('type' => 'hidden', 'default' => $inputs['copy_link_text']['id'] ));
	echo $this->Form->inputs(
		array(
			'legend'=>'Copied Text Behavior',
			'Seo.add_copy_link.value'=>array('default' => $inputs['add_copy_link']['value'], 'options'=>$yes_no, 'label' => 'Append some text if anyone copies text from the site?' ),
			'Seo.add_copy_link_ga_campaign_tags.value'=>array('default' => $inputs['add_copy_link_ga_campaign_tags']['value'], 'options'=>$yes_no, 'label' => 'Add Google Analytics Campaign Trackers to link?' ),
			'Seo.copy_link_ga_medium.value'=>array('default' => $inputs['copy_link_ga_medium']['value'], 'label' => 'Campaign Medium' ),
			'Seo.copy_link_ga_campaign_name.value'=>array('default' => $inputs['copy_link_ga_campaign_name']['value'], 'label' => 'Campaign Name' ),
			'Seo.copy_link_text.value'=>array('default' => $inputs['copy_link_text']['value'], 'type'=>'textarea', 'label' => 'Appended Text', 'after'=>'Use the following tags: {{current_page}}, {{website}}, {{page_title}}, {{site_title}}, {{year}}, {{month}}, {{monthname}}, {{day}}' ),
		)
	);
	
echo $this->Form->end(__('Submit',true));

?>