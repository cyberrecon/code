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
                    <div class="clear"><!-- --></div>
        <br clear="all" />
		</div><!--post-->
        <br clear="all" />

<?php endwhile; ?>
<?php endif; ?>
</div>

<?php include (TEMPLATEPATH . '/sidebar.php'); ?>
<div class="clear"><!----></div>
<br clear="all" />
</div><!--contents-->

<?php get_footer(); ?>


