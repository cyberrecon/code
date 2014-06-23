<?php
global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
?>
<div id="midsection">
        <?php if(!($sp_midcat)) { ?>
        <div style="text-align:center; font-weight:bold;">
        <br /><br /><br />No Category has been defined for the mid section posts. Please go to the theme options in your wp-admin and configure the category name!
        </div>
        <?php } else { ?>
        
					<?php $my_query = new WP_Query('showposts='.$sp_noposts.'&category_name='.$sp_midcat); while ($my_query->have_posts()) : $my_query->the_post(); ?>
                            
                            <div class="<?php if($sp_noposts==3) {echo "midpost3";} elseif($sp_noposts==2) {echo "midpost2";} elseif($sp_noposts==1) {echo "midpost1";} ?> midpost">  
                                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php echo shorten_text(get_the_title(), 26); ?></a></h2> 
                                        <?php if($sp_noposts==3) {$chars=160;} elseif($sp_noposts==2) {$chars=280;} elseif($sp_noposts==1) {$chars=640;} ?>              
                                        <p><?php limits($chars, "Read More"); ?></p>
                            </div><!--midpost-->
                            
                    <?php endwhile; ?>
                    
         <?php } ?>

<div class="clear"><!-- --></div>
</div><!--midsection-->