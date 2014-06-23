<?php
global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
?>

<?php $include_pages = implode(",", $sp_menupages); 
$include_cats = implode(",", $sp_menucats); ?>

<div id="nav">
<ul class="menu superfish">
<li class="<?php if (((is_home()) && !(is_paged())) or (is_archive()) or (is_single()) or (is_paged()) or (is_search())) { ?>current_page_item<?php } else { ?>page_item<?php } ?>"><a href="<?php echo get_settings('home'); ?>">Home<?php echo $langblog;?></a></li>
<?php wp_list_pages('sort_column=menu_order&depth=3&title_li=&include='.$include_pages); ?>
</ul>
</div><!--nav-->

<?php if ($sp_catnav=="Yes") { ?>
<div id="catnavbar">
<ul id="catnav">
<?php wp_list_categories('orderby=name&title_li=&depth=4&include='.$include_cats); ?>
</ul>
</div>
<?php } ?>
<div class="clear"></div>

