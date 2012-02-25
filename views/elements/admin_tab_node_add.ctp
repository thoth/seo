<?php
	
	$this->Html->script('/seo/js/charCount.js', array('inline'=>false));

    echo $this->Form->input('Seo.0.meta_keywords');
    echo $this->Form->input('Seo.0.meta_description', array('after'=>'<span class="counter"></span>'));
    echo $this->Form->input('Seo.0.meta_robots');
    echo $this->Form->input('Seo.0.changefreq', array('label'=>'Sitemap Change Frequency','after'=>'only change this if you want to override the default of '.Configure::read('Seo.changefreq')));
    echo $this->Form->input('Seo.0.priority', array('label'=>'Sitemap Priority','after'=>'only change this if you want to override the default of '.Configure::read('Seo.priority')));
?>
<style>

form .counter {
	position: absolute;
	right: 30px;
	top: 200px;
	font-size: 20px;
	font-weight: bold;
	color: #CCC;
}
form .exceeded {
color: #E00;
}
</style>
<script type="text/javascript">
	$('#Seo0MetaDescription').charCount({allowed:150});

</script>
