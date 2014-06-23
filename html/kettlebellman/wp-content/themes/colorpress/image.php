<?php get_header(); ?>

<div id="wrapper">


    <?php include (TEMPLATEPATH . '/navigation.php');?>


<div id="contents">
<div id="entry">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="breadcrumbs"><?php breadcrumbs(); ?></div>
      <div class="post" id="post-<?php the_ID(); ?>">   
			        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>             
                    <div class="date"><div class="month"><?php the_time('M'); ?></div><div class="day"><?php the_time('d'); ?></div></div>   
                    				<!-- gallerycode -->
				<p class="attachment"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>
                <div class="caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></div>
				<!-- gallerycode -->
                         
       				<div class="content"><?php the_content("Read More"); ?></div>
                    
                    				
				<!-- gallerynavigation -->
				<div class="imgnav">
					<div class="imgleft"><?php previous_image_link() ?></div>
					<div class="imgright"><?php next_image_link() ?></div>
				</div>
				<br clear="all" />
				<!-- gallerynavigation -->
                    
                    
		<div class="tag"><?php the_tags(' ', ', ', ''); ?><span class="edit"><?php edit_post_link('Edit this post', '&nbsp;&nbsp;&nbsp;&raquo;&nbsp;&nbsp;', ''); ?></span></div>
        <br clear="all" />
			<?php  //for use in the loop, list 5 post titles related to first tag on current post
              $backup = $post;  // backup the current object
              $tags = wp_get_post_tags($post->ID);
			  echo "<div class=\"relposts\"><h3>Related Posts</h3>";
              $tagIDs = array();
              if ($tags) {
                $tagcount = count($tags);
                for ($i = 0; $i < $tagcount; $i++) {
                  $tagIDs[$i] = $tags[$i]->term_id;
                }
                $args=array(
                  'tag__in' => $tagIDs,
                  'post__not_in' => array($post->ID),
                  'showposts'=>5,
                  'caller_get_posts'=>1
                );
                $my_query = new WP_Query($args);
                if( $my_query->have_posts() ) {
				  echo "<ul class=\"relatedposts\">";
                  while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                  <?php endwhile;
				  echo "</ul>";
                } 
			 } else echo "<span class=\"noposts\">No related posts were found!</span>";
              $post = $backup;  // copy it back
              wp_reset_query(); // to use the original query again
            ?>
        <div class="bookmarks">
        <a class="btn_email" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink() ?>">E-mail</a>
        <a class="btn_comment"  href="#respond">Comment</a>
        <a href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>" title="Submit to Del.icio.us" target="_blank" class="btn_delicious">Del.icio.us</a>
        <a href="http://www.digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>" title="Submit Post to Digg" target="_blank" class="btn_digg">Digg</a>
        <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>" title="Submit to Facebook" target="_blank" class="btn_facebook">Facebook</a>
        <a href="http://furl.net/storeIt.jsp?t=<?php the_title() ?>&amp;u=<?php the_permalink() ?>" title="Submit to Furl" target="_blank" class="btn_furl">Furl</a>
        </div>
        <br clear="all" />
        </div><!--relposts-->
	</div><!--post-->
    <?php comments_template(); ?>
        
<?php endwhile; ?>
<?php endif; ?>
</div>

<?php include (TEMPLATEPATH . '/sidebar.php'); ?>
<div class="clear"><!----></div>
<br clear="all" />
</div><!--contents-->

<?php get_footer(); ?>


