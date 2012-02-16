<?php
    echo $this->Form->input('Seo.0.meta_keywords');
    echo $this->Form->input('Seo.0.meta_description');
    echo $this->Form->input('Seo.0.meta_robots');
    echo $this->Form->input('Seo.0.changefreq', array('label'=>'Sitemap Change Frequency','after'=>'only change this if you want to override the default of '.Configure::read('Seo.changefreq')));
    echo $this->Form->input('Seo.0.priority', array('label'=>'Sitemap Priority','after'=>'only change this if you want to override the default of '.Configure::read('Seo.priority')));
?>