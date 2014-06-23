<?php
global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
?>
<div id="sidebar">
<ul>
        <li class="boxes">
        <h2 class="subtext">Subscribe to our newsletter</h2>
        <ul>
        
        <form action="http://feedburner.google.com/fb/a/mailverify" target="popupwindow" method="post" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $sp_feedburner; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true" class="subform">
        <p><input type="text" class="subemail" name="email" value="Enter your e-mail..." onfocus="if (this.value == 'Enter your e-mail...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Enter your e-mail...';}"/></p>
        <input type="hidden" value="<?php echo $sp_feedburner; ?>" name="uri"/>
        <input type="hidden" name="loc" value="en_US"/>
        <input type="image" src="<?php bloginfo('template_directory'); ?>/images/button.jpg" class="sub_button" />
        </form>
        
        <div class="socials">
        <a href="<?php bloginfo('rss2_url'); ?>" title="RSS Feed"><img src="<?php bloginfo('template_directory'); ?>/images/feed.png" alt="RSS Feed" width="32" height="32" /></a>
        <a href="http://www.twitter.com/<?php echo $sp_twitter; ?>" title="Follow on Twitter!"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png" alt="Follow on Twitter!" width="32" height="32" /></a>
        <a href="http://www.facebook.com/<?php echo $sp_facebook; ?>" title="Follow on Facebook!"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.png" alt="Follow on Facebook!" width="32" height="32" /></a>
        </div><!--socials-->
        </ul>
        </li>


        <li class="boxes">
        <h2>About</h2>
        <ul>
       <p class="about"><?php echo stripslashes($sp_about); ?></p>
        </ul>
        </li>
        
</ul>

<?php if ($sp_125ads=="Yes") { ?>
<?php include (TEMPLATEPATH . '/125ads.php'); ?>
<?php } ?>

<?php if ($sp_accordion=="Yes") { ?>
<?php include (TEMPLATEPATH . '/accordion.php'); ?>
<?php } ?>

<ul>
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>
<?php endif; ?>
</ul>

</div><!--sidebar-->
