<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   <url>
      <loc><?php echo Router::url('/',true); ?> </loc>
      <lastmod><?php echo trim($time->toAtom(time())); ?></lastmod>
      <changefreq>monthly</changefreq>
      <priority>1</priority>
   </url>
   <?php foreach ($sitemapData as $node):
        if ($node['Node']['type'] == "page" | $node['Node']['type'] == 'node' | $node['Node']['type'] == 'blog'): 
   ?>
    <url>
        <loc> <?php echo Router::url('/',true).ltrim($node['Node']['path'],'/'); ?> </loc>
        <lastmod> <?php echo trim($time->toAtom(strtotime($node['Node']['updated']))); ?> </lastmod>
        <priority> <?php if(isset($node['Node']['Seo']['priority'])) echo $node['Node']['Seo']['priority']; else echo $defaults['priority']['value']; ?></priority>
        <changefreq> <?php if(isset($node['Node']['Seo']['changefreq'])) echo $node['Node']['Seo']['changefreq']; else echo $defaults['changefreq']['value']; ?> </changefreq>
    </url>
    <?php endif; endforeach; ?>
</urlset> 
