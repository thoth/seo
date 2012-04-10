<?php
	
	$this->Html->css('/seo/css/seo.css', null, array('inline'=>false));

?>
<div class="sitemap">
    <h2><?php echo $title_for_layout; ?></h2>
    <?php
    	if(Configure::read('Seo.organize_by_vocabulary') == 0){
    		echo "<ul>";
	        foreach ($nodes as $node) {
	            echo "<li>".$html->link($node['Node']['title'],$node['Node']['path'])."</li>" ;   
	        }
    		echo "</ul>";
    	} else {
	        foreach ($vocabularies as $vocabulary) {
	        	echo $this->Html->tag('h3', $vocabulary['Vocabulary']['title'], array('class'=>'sitemap-vocabulary'));
	        	foreach($vocabulary['Term'] as $term){
		        	echo $this->Html->tag('h4', $term['title'], array('class'=>'sitemap-term'));
    				echo '<ul class="sitemap-node-list">';	
		        	foreach($term['Node'] as $node){
		        		echo "<li>".$this->Html->link($node['Node']['title'],$node['Node']['path'])."</li>" ;
		        	}
		    		echo "</ul>";
	        	}
    		}
    	}
    ?>
    
</div>
