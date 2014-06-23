<?php
/*
Template Name: Archives Template
*/
?>
<?php get_header(); ?>

<div id="wrapper">

    <?php include (TEMPLATEPATH . '/navigation.php');?>

    
<div id="contents">
<div id="entry">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="breadcrumbs"><?php breadcrumbs(); ?></div>
        <div class="post" id="post-<?php the_ID(); ?>">   
		<h2 style="margin-left:0;"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2> 
		<div class="content"><?php the_content("Read More"); ?></div>
			<div class="alist">			
				<h3>Categories</h3>	
				<ul>
				<?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
				</ul>							
			</div><!--alist-->
			
			<div class="alist">			
				<h3>Posts by Month</h3>
				<ul>
				<?php wp_get_archives('type=monthly&show_post_count=1') ?>	
				</ul>							
			</div><!--alist-->
            
            <div class="alist">			
				<h3>Posts by Year</h3>
				<ul>
				<?php wp_get_archives('type=yearly&show_post_count=1') ?>	
				</ul>							
			</div><!--alist-->
			
			<br clear="all" />
			
			<?php if (function_exists('wp_tag_cloud')) { ?>			
				<div class="alist" style="width:100%;">				
						<h3>Popular Tags</h3>
						<ul class="list1">
						<?php wp_tag_cloud('smallest=8&largest=14'); ?>
						</ul>						        		
				</div><!--/archivebox-->			
			<?php } ?>															

        <br clear="all" />
		</div><!--post-->
<?php endwhile; ?>
<?php endif; ?>
</div><!--entry-->

<?php include (TEMPLATEPATH . '/sidebar.php'); ?>
<div class="clear"><!----></div>
<br clear="all" />
</div><!--contents-->

<?php get_footer(); ?>
	