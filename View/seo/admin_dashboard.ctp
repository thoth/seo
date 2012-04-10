<style>
.correct_the_dashboard{
/*  padding: -15px -20px; */
 margin: 0px -30px;
/*  height: 500px; */
 overflow: auto;
}
.correct_the_dashboard h3{
/*  padding: -15px -20px; */
 padding-top: 10px;
}
td.data{
	width: 100px;
}
</style>
<div class="correct_the_dashboard">
	<div class="prefix_1 grid_6">
		<h3><?php __('Page Stats'); ?></h3>
		<table>
			<tr>
				<td class="property"><?php __('Total Published Pages'); ?></td>
				<td class="data"><?php echo $published_count; ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Date of Last Publish'); ?></td>
				<td class="link"><?php echo $last_published[0]['last_published']?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Duplicate Titles'); ?></td>
				<td class="data"><?php echo $this->Html->link(count($duplicate_titles), array('controller'=>'seo', 'action'=>'duplicate_titles', 'plugin'=>'seo')); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Pages without Taxonomy'); ?></td>
				<td class="data"><?php echo $this->Html->link($vocabulary_count, array('controller'=>'seo', 'action'=>'no_taxonomy', 'plugin'=>'seo'));?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Pages without META Keywords'); ?></td>
				<td class="data"><?php echo $this->Html->link($meta_keywords_count, array('controller'=>'seo', 'action'=>'no_keywords', 'plugin'=>'seo'));?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Pages without META Descriptions'); ?></td>
				<td class="data"><?php echo $this->Html->link($meta_description_count, array('controller'=>'seo', 'action'=>'no_description', 'plugin'=>'seo'));?></td>
			</tr>
		</table>
		<h3><?php __('Comments'); ?></h3>
		<table>
			<tr>
				<td class="property"><?php __('Total'); ?></td>
				<td class="data"><?php echo $this->Html->link($comment_count, array('controller'=>'comments', 'action'=>'index', 'plugin'=>''));?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Approved'); ?></td>
				<td class="data"><?php echo $this->Html->link($comment_count_approved, array('controller'=>'comments', 'action'=>'index', 'filter'=>'status:1', 'plugin'=>''));?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Pending'); ?></td>
				<td class="data"><?php echo $this->Html->link($comment_count_unapproved, array('controller'=>'comments', 'action'=>'index', 'filter'=>'status:0', 'plugin'=>''));?></td>
			</tr>

		</table>
		<h3><?php __('Messages'); ?></h3>
		<table>
			<tr>
				<td class="property"><?php __('Total'); ?></td>
				<td class="data"><?php echo $this->Html->link($message_count, array('controller'=>'messages', 'action'=>'index', 'plugin'=>'')); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Read'); ?></td>
				<td class="data"><?php echo $this->Html->link($message_count_read, array('controller'=>'messages', 'action'=>'index', 'filter'=>'status:1', 'plugin'=>'')); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Unread'); ?></td>
				<td class="data"><?php echo $this->Html->link($message_count_unread, array('controller'=>'messages', 'action'=>'index', 'filter'=>'status:0', 'plugin'=>'')); ?></td>
			</tr>

		</table>
	</div>
	<div class="grid_8 suffix_1">
		<h3>Tools</h3>
		<table>
			<tr>
				<td class="property"><?php __('Alexa'); ?></td>
				<td class="link"><?php echo $this->Html->link('http://alexa.com/','http://alexa.com/'); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Bing Webmaster Tools'); ?></td>
				<td class="link"><?php echo $this->Html->link('http://www.bing.com/toolbox/webmaster/','http://www.bing.com/toolbox/webmaster/'); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Blogger'); ?></td>
				<td class="link"><?php echo $this->Html->link('http://blogger.google.com/','http://blogger.google.com/'); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Facebook'); ?></td>
				<td class="link"><?php echo Configure::read('Seo.facebook_link'); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Google Analytics'); ?></td>
				<td class="link"><?php echo $this->Html->link('http://www.google.com/analytics','http://www.google.com/analytics'); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Google Adwords'); ?></td>
				<td class="link"><?php echo $this->Html->link('http://www.google.com/adwords','http://www.google.com/adwords'); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Google Places Listing'); ?></td>
				<td class="link"><?php echo $this->Html->link('http://maps.google.com/maps/place?cid='.Configure::read('Seo.google_places_cid'),'http://maps.google.com/maps/place?cid='.Configure::read('Seo.google_places_cid')); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Google Plus Listing'); ?></td>
				<td class="link"><?php echo $this->Html->link('http://plus.google.com/'.Configure::read('Seo.google_places_cid'),'http://plus.google.com/'.Configure::read('Seo.google_places_cid')); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Google Webmaster Tools'); ?></td>
				<td class="link"><?php echo $this->Html->link('https://www.google.com/webmasters/tools/','https://www.google.com/webmasters/tools/'); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Twitter'); ?></td>
				<td class="link"><?php echo $this->Html->link('http://twitter.com/'.Configure::read('Seo.twitter_username'),'http://twitter.com/'.Configure::read('Seo.twitter_username')); ?></td>
			</tr>
		</table>
	</div>
</div>
