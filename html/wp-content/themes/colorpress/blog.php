<?php
global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
?>
<div id="contents">
<div id="entry">
<?php 
$paged = intval(get_query_var('paged'));
if($paged == 0) {
    $paged = 1;
}

$category_id = get_cat_ID($sp_slidecat);
query_posts("paged=$paged&cat=-".$category_id);
?>

<?php $col = 1; ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
   

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
                     <?php if ($col == 1) echo "<div class=\"row\">"; ?>
                        <div class="gridpost col<?php echo $col;?>" id="post-<?php the_ID(); ?>">
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php echo shorten_text(get_the_title(), 55); ?></a></h2>    
                        <div class="griddate">Posted on <?php the_time('M d Y'); ?> | <span class="comms"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span></div>
                        <div class="content">
                        <?php if (imagesrc()) { $chrs=220;?>
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/thumbs.php?src=<?php echo imagesrc(); ?>&w=230&h=70&zc=1" alt="<?php the_title(); ?>" class="postimage" style="margin-bottom:10px;" /></a>
                        <?php } else {$chrs=360;}?> 
                        <?php limits($chrs, "Read More &raquo;"); ?>
                        </div><!--content-->
                        <?php if ($col == 1) echo "</div>"; (($col==1) ? $col=2 : $col=1); ?>
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