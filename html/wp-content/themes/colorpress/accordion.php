<div id="accordion">

	<h3><a href="#">Recent Posts</a></h3>
	<div>
    <ul>
    <?php get_archives('postbypost', '10', 'custom', '<li>', '</li>'); ?>
    </ul>
	</div>
    
    <h3><a href="#">Popular Posts</a></h3>
	<div>
    <ul>
    <?php popular_posts(); ?>
    </ul>
	</div>
    
	<h3><a href="#">Recent Comments</a></h3>
	<div>
 	<?php recent_comments(); ?>
	</div>
    
    <h3><a href="#">Categories</a></h3>
	<div>
    <ul>
    <?php wp_list_cats('sort_column=name&hierarchical=0'); ?>
    </ul>
	</div>
    
	<h3><a href="#">Archives</a></h3>
	<div>
    <ul>
    <?php wp_get_archives('type=monthly'); ?>
    </ul>
	</div>
    
    <h3><a href="#">Links</a></h3>
	<div>
    <ul>
    <?php get_links(2, '<li>', '</li>', '', TRUE, 'url', FALSE); ?>
    </ul>
	</div>
</div><!--accordion-->