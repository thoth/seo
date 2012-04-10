<?php
	if(strlen(Configure::read('Seo.twitter_username')) > 0){
?>
<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 4,
  interval: 30000,
  width: 'auto',
  height: 300,
  theme: {
    shell: {
      background: '#999',
      color: '#000'
    },
    tweets: {
      background: '#333',
      color: '#ffffff',
      links: '#4aed05'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: true,
    behavior: 'all'
  }
}).render().setUser('<?php echo Configure::read('Seo.twitter_username') ?>').start();
</script>
<?php
	} else {
		echo 'You need to set your Twitter Username in the Seo Plugin Admin...';
	}
?>
