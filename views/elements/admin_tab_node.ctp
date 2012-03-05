<?php
	
	$this->Html->script('/seo/js/charCount.js', array('inline'=>false));

    echo $this->Form->input('Seo.id');
    echo $this->Form->input('Seo.node_id', array('type'=>'hidden', 'value'=>$this->data['Node']['id']));
    echo $this->Form->input('Seo.meta_keywords');
    echo $this->Form->input('Seo.meta_description', array('after'=>'<span class="counter"></span>'));
    echo $this->Form->input('Seo.meta_robots');
    echo $this->Form->input('Seo.changefreq', array('label'=>'Sitemap Change Frequency','after'=>'only change this if you want to override the default of '.Configure::read('Seo.changefreq')));
    echo $this->Form->input('Seo.priority', array('label'=>'Sitemap Priority','after'=>'only change this if you want to override the default of '.Configure::read('Seo.priority')));


	if(Configure::read('Seo.show_per_page_stats')){	
		echo '<hr /><div id="node-stats"><div id="loading-progress">';
		echo $this->Html->link('Load Page Stats', '#', array('onclick'=>'loadPageStats()'));
		echo '</div></div>';
?>
<style>
.loading{
	text-align: center;
}	
#node-stats{
	margin-top: 25px;
}
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
function loadPageStats(){
	//load content
	$.get('/admin/seo/nodestats/<?php echo $this->data['Node']['id'] ?>', function(data){
		$('#node-stats').replaceWith(data);
	});
	$("#loading-progress").addClass('loading').html('loading page stats...<br /><img src="/seo/img/ajax-loader.gif" />');

}
	$('#SeoMetaDescription').charCount({allowed:150});


</script>
<?php
	}
	
?>

