<?php
global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
?>
<div id="featured">
<div id="featured_bg"><!----></div>
<div id="iehack">
        <div id="myController3">
<?php for($i=1; $i<=$sp_sliderposts; $i++) { ?>
        <span class="jFlowControl3"></span>
<?php }?>
        </div>
        
        <div id="mySlides3">
        
        <?php if(!($sp_slidecat)) { ?>
        <div class="slide">
        <div style="text-align:center; font-weight:bold;">
        <br /><br /><br />No Category has been defined for the slideshow. Please go to the theme options in your wp-admin and configure the category name!
        </div>
        </div>
        <?php } else { ?>
        
        <?php $my_query = new WP_Query('showposts='.$sp_sliderposts.'&category_name='.$sp_slidecat); while ($my_query->have_posts()) : $my_query->the_post(); ?>
                
                <div class="slide">   
                            <div class="slidetext">
                            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>                 
                            <?php limits(400, "Read More"); ?>
                            </div><!--slidetext-->
                            
                            <?php if (imagesrc()) { ?>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/thumbs.php?src=<?php echo imagesrc(); ?>&w=200&h=200&zc=1&q=90" alt="<?php the_title(); ?>" class="slideimage" /></a>
                            <?php } ?>
                            
                            
                            <div class="clear"><!----></div>
                </div><!--slide-->
                
        <?php endwhile; ?>
        
        <?php } ?>
        
        
        </div>
        <div class="jFlowPrev3"><!-- --></div>
        <div class="jFlowNext3"><!-- --></div>
</div><!--iehack-->
</div><!--featured-->