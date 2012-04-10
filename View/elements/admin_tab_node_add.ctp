<?php
	
	$this->Html->script('/seo/js/charCount.js', array('inline'=>false));

    //echo $this->Form->input('Seo.node_id');
    echo $this->Form->input('Seo.meta_keywords');
    echo $this->Form->input('Seo.meta_description', array('after'=>'<span class="counter"></span>'));
    echo $this->Form->input('Seo.meta_robots');
    echo $this->Form->input('Seo.changefreq', array('label'=>'Sitemap Change Frequency','after'=>'only change this if you want to override the default of '.Configure::read('Seo.changefreq')));
    echo $this->Form->input('Seo.priority', array('label'=>'Sitemap Priority','after'=>'only change this if you want to override the default of '.Configure::read('Seo.priority')));
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
	$('#SeoMetaDescription').charCount({allowed:150});

</script>
