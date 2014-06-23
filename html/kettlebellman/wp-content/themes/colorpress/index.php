<?php get_header(); ?>
<?php
global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
?>
<div id="wrapper">

    <?php include (TEMPLATEPATH . '/navigation.php');?>
	<?php if($sp_slider=="Yes") { include (TEMPLATEPATH . '/featured.php'); } ?>
    <?php if($sp_midposts=="Yes") { include (TEMPLATEPATH . '/midsection.php'); }?>
    <?php include (TEMPLATEPATH . '/blog.php');?>


<?php get_footer(); ?>

