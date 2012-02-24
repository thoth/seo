<div id="node-stats">

<?php
 		$alexa = array(
 			'Global Rank'=>$seostats->Alexa_Global_Rank_Array(),
 			'Pageviews'=>$seostats->Alexa_Pageviews(),
 			'Reach'=>$seostats->Alexa_Reach(),
 			'Bounce Rate'=>$seostats->Alexa_Bounce_Rate(),
 			'Time On Site'=>$seostats->Alexa_Time_On_Site(),
 			'Search Visits'=>$seostats->Alexa_Search_Visits(),
 			'Average Load Time'=>$seostats->Alexa_Avg_Load_Time(),
 		);
 
?>
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
	<div class="prefix_1 grid_10 suffix_1">
		<h3><?php __('Google Stats'); ?></h3>
		<table>
			<tr>
				<td class="property"><?php __('Google Page Rank'); ?></td>
				<td class="data"><?php echo $seostats->Google_Page_Rank(); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Google Backlinks'); ?></td>
				<td class="link"><?php echo $seostats->Google_Backlinks_Total_API(); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Google Page Speed'); ?></td>
				<td class="data"><?php echo $seostats->Google_Pagespeed_Score();?></td>
			</tr>
		</table>
		<h3><?php __('Alexa Stats'); ?></h3>
		<table>
			<tr>
				<td class="property"><?php __('Alexa Global Rank'); ?></td>
				<td class="data"><?php echo $alexa['Global Rank']['1 Month']['value']; ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Alexa Pageviews'); ?></td>
				<td class="link"><?php echo $alexa['Pageviews']['1 Month']['value']; ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Alexa Reach'); ?></td>
				<td class="data"><?php echo $alexa['Reach']['1 Month']['value'];?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Alexa Bounce Rate'); ?></td>
				<td class="data"><?php echo $alexa['Bounce Rate']['1 Month']['value'];?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Alexa Time On Site'); ?></td>
				<td class="data"><?php echo $alexa['Time On Site']['1 Month']['value'];?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Alexa Search Visits'); ?></td>
				<td class="data"><?php echo $alexa['Search Visits']['1 Month']['value'];?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Alexa Average Load Time'); ?></td>
				<td class="data"><?php echo $alexa['Average Load Time'];?></td>
			</tr>
		</table>
		<h3><?php __('Mentions'); ?></h3>
		<table>
			<tr>
				<td class="property"><?php __('Google Mentions'); ?></td>
				<td class="data"><?php echo $seostats->Google_Mentions_Total(); ?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Facebook Mentions'); ?></td>
				<td class="data"><?php echo $seostats->Facebook_Mentions_Total();?></td>
			</tr>
			<tr>
				<td class="property"><?php __('Twitter Mentions'); ?></td>
				<td class="data"><?php echo $seostats->Twitter_Mentions_Total();?></td>
			</tr>
		</table>
	</div>
</div>	
</div>