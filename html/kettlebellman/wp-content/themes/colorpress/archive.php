<?php get_header(); ?>
<?php
global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
?>
<div id="wrapper">

    <?php include (TEMPLATEPATH . '/navigation.php');?>

<div id="contents">
<div id="entry">

<?php if (have_posts()) : ?>

  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<div class="breadcrumbs">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category &raquo;</div>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<div class="breadcrumbs">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</div>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<div class="breadcrumbs">Archive for <?php the_time('F jS, Y'); ?>:</div>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<div class="breadcrumbs">Archive for <?php the_time('F, Y'); ?>&raquo;</div>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<div class="breadcrumbs">Archive for <?php the_time('Y'); ?>:</div>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<div class="breadcrumbs">Author Archive</div>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<div class="breadcrumbs">Blog Archives</div>
 	  <?php } ?>
      
<?php while (have_posts()) : the_post(); ?>        
   

                    <?php if($sp_layout=="Excerpt") { ?>
                        <div class="post" id="post-<?php the_ID(); ?>">
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>             
                        <div class="date"><div class="month"><?php the_time('M'); ?></div><div class="day"><?php the_time('d'); ?></div></div>        
                        <div class="content">				
                        <?php if (imagesrc()) { ?>
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/thumbs.php?src=<?php echo imagesrc(); ?>&w=180&h=110&zc=1" alt="<?php the_title(); ?>" class="postimage" /></a>
                        <?php } ?>                  
                        <?php limits(240, "Read More"); ?> | <span class="comms"><?php comments_popup_link('0', '1', '%'); ?></span>                             
                        </div><!--content-->
                        <div class="clear"><!-- --></div>  
                        <br clear="all" />
						</div><!--post-->  
                        <br clear="all" />      
                    
                    <?php } elseif($sp_layout=="Full Post") { ?>
                        <div class="post" id="post-<?php the_ID(); ?>">
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>             
                        <div class="date"><div class="month"><?php the_time('M'); ?></div><div class="day"><?php the_time('d'); ?></div></div>        
                        <div class="content">
                        <?php the_content("Read More"); ?><span class="comms"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span>
                        </div><!--content-->
                        <div class="clear"><!-- --></div>  
                        <br clear="all" />
						</div><!--post-->   
                        <br clear="all" />
                                        
                     <?php } elseif($sp_layout=="Grid") { ?>
                     		
                        <div class="gridpost" id="post-<?php the_ID(); ?>">
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php echo shorten_text(get_the_title(), 36); ?></a></h2>    
                        <div class="griddate">Posted on <?php the_time('M d Y'); ?> | <span class="comms"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span></div>
                        <div class="content">
                        <?php if (imagesrc()) { $chrs=220;?>
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/thumbs.php?src=<?php echo imagesrc(); ?>&w=230&h=70&zc=1" alt="<?php the_title(); ?>" class="postimage" style="margin-bottom:10px;" /></a>
                        <?php } else {$chrs=360;}?> 
                        <?php limits($chrs, "Read More &raquo;"); ?>
                        </div><!--content-->
                        <br clear="all" />
                        </div><!--post--> 

 
                    <?php } ?>

<?php endwhile; ?>
<br clear="all" />
<?php
include('wp-pagenavi.php');
if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
?>

<?php endif; ?>
</div>

<?php include (TEMPLATEPATH . '/sidebar.php'); ?>
<div class="clear"><!----></div>
<br clear="all" />

</div><!--contents-->


<?php get_footer(); ?>


