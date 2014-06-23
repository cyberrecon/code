<?php add_theme_support( 'post-thumbnails' ); ?>
<?php include (TEMPLATEPATH . '/custom-functions.php'); ?>
<?php
if ( function_exists('register_sidebars') ) {
register_sidebars(1, array(
'before_widget' => '<li class="boxes">',
'after_widget' => '</li>',
));
}

$themename = "Color Press";
$shortname = "sp";

$cats_array = get_categories('hide_empty=0');
$pages_array = get_pages('hide_empty=0');
$site_pages = array();
$site_cats = array();

foreach ($pages_array as $pagg) {
	$site_pages[$pagg->ID] = $pagg->post_title;
	$pages_ids[] = $pagg->ID;
}

foreach ($cats_array as $categs) {
	$site_cats[$categs->cat_ID] = $categs->cat_name;
	$cats_ids[] = $categs->cat_ID;
}

$options = array (
				  
array(
"type" => "openwrapper"),
				  
array(
"name" => "Theme Color",
"id" => "themeoptions",
"type" => "title"),

array(
"type" => "open"),

array(
"name" => "Theme Color",
"desc" => "Choose the base color for your theme! This is Magic :)",
"id" => $shortname."_color",
"std" => "0D3A6F",
"type" => "colorjs"),

array(
"type" => "submit"),

array(
"type" => "close"),

array(
"name" => "Navigation Menu",
"id" => "navmenu",
"type" => "title"),

array(
"type" => "open"),

array(  
"name" => "Page Menu Items",
"id" => $shortname."_menupages",
"type" => "checkboxes",
"std" => $pages_ids,
"desc" => "Uncheck to exclude a particular page from the pages menu!",
"usefor" => "pages",
"options" => $pages_ids),

array(
"name" => "Category Menu Enabled?",
"desc" => "Toggle the category navigation below the page menu",
"id" => $shortname."_catnav",
"std" => "Yes",
"type" => "select",
"options" => array("Yes", "No")),

array(
"name" => "Categories Menu Items",
"id" => $shortname."_menucats",
"type" => "checkboxes",
"std" => $cats_ids,
"desc" => "Uncheck to exclude a particular category from the category menu!",
"usefor" => "categories",
"options" => $cats_ids),

array(
"type" => "submit"),

array(
"type" => "close"),

array(
"name" => "Slideshow Options",
"id" => "slideoptions",
"type" => "title"),

array(
"type" => "open"),

array(
"name" => "Slideshow Enabled?",
"desc" => "Toggle the slideshow",
"id" => $shortname."_slider",
"std" => "Yes",
"type" => "select",
"options" => array("Yes", "No")),

array(
"name" => "Use Shiny or Solid Color?",
"desc" => "Choose whether you want a glossy slideshow or a solid-colored",
"id" => $shortname."_slidetype",
"std" => "Glossy",
"type" => "select",
"options" => array("Glossy", "Solid Color")),

array(
"name" => "Slideshow Category",
"desc" => "Choose the category for the featured slideshow",
"id" => $shortname."_slidecat",
"std" => "",
"type" => "text"),

array(
"name" => "No. of posts in the slideshow",
"desc" => "Specify the number of posts to show in the slideshow",
"id" => $shortname."_sliderposts",
"std" => 4,
"type" => "select",
"options" => array(1,2,3,4,5,6,7,8,9,10)),

array(
"type" => "submit"),

array(
"type" => "close"),

array(
"name" => "Mid Block Posts",
"id" => "midblockoptions",
"type" => "title"),

array(
"type" => "open"),

array(
"name" => "Mid Block Posts Enabled?",
"desc" => "Toggle the Mid Block Posts",
"id" => $shortname."_midposts",
"std" => "Yes",
"type" => "select",
"options" => array("Yes", "No")),

array(
"name" => "Mid Block Category",
"desc" => "Choose the category for the Mid block posts",
"id" => $shortname."_midcat",
"std" => "",
"type" => "text"),

array(
"name" => "No. of Posts",
"desc" => "The number of posts you want to show in the mid block",
"id" => $shortname."_noposts",
"std" => 3,
"type" => "select",
"options" => array(3,2,1)),

array(
"type" => "submit"),

array(
"type" => "close"),

array(
"name" => "Blog Posts",
"id" => "blogoptions",
"type" => "title"),

array(
"type" => "open"),

array(
"name" => "Blog Layout",
"desc" => "Choose the layout of your blog posts",
"id" => $shortname."_layout",
"std" => "Grid",
"type" => "radio",
"options" => array("Excerpt","Full Post","Grid")),

array(
"type" => "submit"),

array(
"type" => "close"),

array(
"name" => "Sidebar",
"id" => "sidebar",
"type" => "title"),

array(
"type" => "open"),

array(
"name" => "Sidebar Position",
"desc" => "Choose the positioning of your sidebar",
"id" => $shortname."_sidebar",
"std" => "Right",
"type" => "select",
"options" => array("Right","Left")),

array(
"name" => "Feedburner Id",
"desc" => "Enter your Feedburner ID for the subscribe by e-mail option",
"id" => $shortname."_feedburner",
"std" => "Blogohblog",
"type" => "text"),

array(
"name" => "Twitter Id",
"desc" => "Enter your Twitter ID",
"id" => $shortname."_twitter",
"std" => "Blogohblog",
"type" => "text"),

array(
"name" => "Facebook Id",
"desc" => "Enter your Facebook ID",
"id" => $shortname."_facebook",
"std" => "Blogohblog",
"type" => "text"),

array(
"name" => "About Text",
"desc" => "Enter text for the 'About' section",
"id" => $shortname."_about",
"std" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vel tellus metus. Pellentesque volutpat facilisis mauris convallis imperdiet. Etiam bibendum dui a odio dictum.",
"type" => "textarea"),

array(
"name" => "Enable Accordion?",
"desc" => "Do you want to keep the accordion which shows recent posts, recent comments etc...",
"id" => $shortname."_accordion",
"std" => "Yes",
"type" => "select",
"options" => array("Yes","No")),

array(
"type" => "submit"),

array(
"type" => "close"),

array(
"name" => "Advertisements",
"id" => "ads",
"type" => "title"),

array(
"type" => "open"),

array(
"name" => "Enable 728x90 Header Ad?",
"desc" => "Enable or disable the 728x90 ad in the header",
"id" => $shortname."_728ad",
"std" => "Yes",
"type" => "select",
"options" => array("Yes","No")),

array(
"name" => "728x90 HTML Code",
"desc" => "Enter HTML code for the 728x90 ad",
"id" => $shortname."_ad728code",
"std" => "",
"type" => "textarea"),

array(
"name" => "Enable 125x125 Ads in the sidebar?",
"desc" => "Enable or disable the 125x125 ads in the sidebar",
"id" => $shortname."_125ads",
"std" => "Yes",
"type" => "select",
"options" => array("Yes","No")),

array(
"name" => "125x125 Banner 1 HTML Code",
"desc" => "Enter HTML code for the 125x125 ad",
"id" => $shortname."_125code1",
"std" => "",
"type" => "textarea"),

array(
"name" => "125x125 Banner 2 HTML Code",
"desc" => "Enter HTML code for the 125x125 ad",
"id" => $shortname."_125code2",
"std" => "",
"type" => "textarea"),

array(
"name" => "125x125 Banner 3 HTML Code",
"desc" => "Enter HTML code for the 125x125 ad",
"id" => $shortname."_125code3",
"std" => "",
"type" => "textarea"),

array(
"name" => "125x125 Banner 4 HTML Code",
"desc" => "Enter HTML code for the 125x125 ad",
"id" => $shortname."_125code4",
"std" => "",
"type" => "textarea"),

array(
"type" => "submit"),

array(
"type" => "close"),

array(
"name" => "Contact Form",
"id" => "contactform",
"type" => "title"),

array(
"type" => "open"),

array(
"name" => "Your E-mail Address",
"desc" => "Enter the e-mail address on which you want to recieve the e-mails from the 'contact form' page template",
"id" => $shortname."_contactmail",
"std" => "",
"type" => "text"),

array(
"type" => "submit"),

array(
"type" => "close"),

array(
"type" => "closewrapper"),

);

/*Adding scripts*/
function admin_js(){
	if ( $_GET['page'] == basename(__FILE__) ) {
?>
    <script language="javascript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory') ?>/js/jscolor.js"></script>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory') ?>/js/collapsiblediv.js"></script>
    <style>
	.outerwrapper {border:5px solid #ccc; background-color: #999; padding:50px 0 50px 0; width:600px; margin:auto; -moz-border-radius:10px;background:url(<?php bloginfo('stylesheet_directory') ?>/images/gradmin.jpg) repeat-y;}
	.headertitle { background:#111111 url(<?php bloginfo('stylesheet_directory') ?>/images/blogohblog.png) 20px 20px no-repeat; padding:10px 10px 0px 200px; height:146px; width:400px; line-height:140px; font-size:32px; font-family: Georgia, "Times New Roman", Times, serif; font-weight:normal; text-transform:uppercase;letter-spacing:-1px; color:#fff; margin:auto; text-align:center; display:block; margin-bottom:20px; -moz-border-radius:10px;}
	.color { background:url(<?php bloginfo('stylesheet_directory') ?>/images/color.png) right no-repeat;}
	.inputs {font-size:11px; margin:5px; padding:0;}
	.clearfix {clear:both;}
	.clicktitles {width:405px; display:block; height:24px; text-decoration:none;  overflow:hidden; margin:auto; font-family: Arial, Helvetica, sans-serif; padding:4px 0 0 20px; font-size:12px;color: #333; margin-bottom:2px; font-weight:bold; background:url(<?php bloginfo('stylesheet_directory') ?>/images/admintab.png) right no-repeat;  text-shadow:2px 2px #fff;
}
	.opendiv {width:370px; background: #F4F4F4; border:1px solid #ddd; padding:20px; margin:auto;}
	.divboxes {width:370px; padding:0px 0px 10px; margin:0px 0px 10px; border-bottom:1px solid #ddd; overflow:hidden; }
	.desc {font-family:Arial, sans-serif; font-size:11px; font-weight:bold; color:#444; display:block; padding:5px 0px;color: #066; text-shadow:1px 1px #fff;}
	.names {font-family:Arial, sans-serif; font-size:16px; font-weight:bold; color:#444; display:block; padding:5px 0px; text-shadow:1px 1px #fff;}
	.submitbuttons { margin:auto; width:200px;}
	.submission {float:left; margin-right:10px;}
	.resetting {float:left;}
	.catinputs {font-size:11px; margin:5px; padding:0;}
	</style>
<?php }
}

/*Add a Theme Options Page*/
function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {

        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

?>
<div class="wrap" style="margin:0 auto; padding:20px 0px 0px;">

<h1 class="headertitle"><?php echo $themename; ?> <span style="color: #09C;">CPANEL</span></h1>

<form method="post">

<?php foreach ($options as $value) {
switch ( $value['type'] ) {
	
case "openwrapper":	
?>

<div class="outerwrapper">

<?php break;

case "open":
?>
<div class="opendiv">

<?php break;

case "close":
?>
</div>
</div>

<?php break;

case "closewrapper":
?>
</div>

<?php break;

case "title":
?>

<a href="javascript:;" onmousedown="toggleSlide('<?php echo $value['id']; ?>');" class="clicktitles"><?php echo $value['name']; ?></a>
<div id="<?php echo $value['id']; ?>" style="overflow: hidden; display: none; height:100%;">
<?php break;

case 'text':
?>

<div class="divboxes">
	<span class="names"><?php echo $value['name']; ?></span>
    
	<input style="width:200px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" />
	<br/>
    
	<span class="desc"><?php echo $value['desc']; ?></span>
</div>

<?php break;

case 'colorjs':
?>

<div class="divboxes">
	<span class="names"><?php echo $value['name']; ?></span>

	<input style="width:200px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" class="color" />
	<br/>
    
	<span class="desc"><?php echo $value['desc']; ?></span>
</div>

<?php
break;

case 'textarea':
?>

<div class="divboxes">
	<span class="names"><?php echo $value['name']; ?></span>
<?php $input = get_settings( $value['id'] ); $output = stripslashes ($input); ?>
	<textarea name="<?php echo $value['id']; ?>" style="width:360px; height:120px; font-family:Arial, Helvetica, sans-serif; font-size:12px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo $output; } else { echo $value['std']; } ?></textarea>
	<br/>
    
	<span class="desc"><?php echo $value['desc']; ?></span>
</div>

<?php
break;

case 'radio':
?>
<div class="divboxes">
	<span class="names"><?php echo $value['name']." "; ?></span>
<?php foreach ($value['options'] as $option) { ?>
			<input name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo $option; ?>" <?php if ( get_settings($value['id']) == $option) { echo 'checked'; } ?>/> <?php echo $option."&nbsp;"; ?>
		<?php } ?>
	<span class="desc"><?php echo $value['desc']; ?></span>
</div>

<?php
break;

case 'select':
?>

<div class="divboxes">
	<span class="names"><?php echo $value['name']; ?></span>

	<select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select>
	<br/>
    
	<span class="desc"><?php echo $value['desc']; ?></span>
</div>

<?php
break;

case "checkboxes":
?>
<div class="divboxes">
	<span class="names"><?php echo $value['name']; ?></span>
<?php
			if (empty($value['options'])) {
				echo("You don't have pages");
			} else {

			foreach ($value['options'] as $option) {
				$checked = ""; 
				if (get_option( $value['id'])) { 
					if (in_array($option, get_option( $value['id'] ))) $checked = "checked=\"checked\"";
				} else { $checked = "checked=\"checked\""; } ?>
				<p class="inputs"><input type="checkbox" class="usual-checkbox" name="<?php echo $value['id']; ?>[]" id="<?php echo $option; ?>" value="<?php echo ($option); ?>" <?php echo $checked; ?> />
				<label for="<?php echo $option; ?>"><?php if ($value['usefor']=='pages') echo get_pagename($option); else echo get_categname($option); ?></label> 
				</p>

		  <?php }
			}; ?>
	<br/>
    
	<span class="desc"><?php echo $value['desc']; ?></span>
</div>

<?php
break;

case "catmenu":
?>
<div class="divboxes">
	<span class="names"><?php echo $value['name']; ?></span>

	<div class="catinputs">
	<?php $categoriesSubMenu = (is_array(get_settings( $shortname."_categoriesSubmenu" ))) ? get_settings( $shortname."_categoriesSubmenu" ) : array();
themeOption_cat_rows(0, 0, $categories, $categoriesSubMenu); ?>
    </div>

	<br/>
</div>

<?php
break;

case "submit":
?>

<p class="submit">
<input name="save" type="submit" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>

<?php break;
}
}
?>
<div class="submitbuttons">

    <div class="submission">
    <p class="submit">
    <input name="save" type="submit" value="Save changes" />
    <input type="hidden" name="action" value="save" />
    </p>
    </form>
    </div>
    
    <div class="resetting">
    <form method="post">
    <p class="submit">
    <input name="reset" type="submit" value="Reset" />
    <input type="hidden" name="action" value="reset" />
    </p>
    </form>
    
</div><!--submitbuttons -->
<br clear="all" />
</div>

<?php
}
function mytheme_wp_head() { ?>
<link href="<?php bloginfo('template_directory'); ?>/style.php" rel="stylesheet" type="text/css" />
<?php }
add_action('wp_head', 'mytheme_wp_head');
add_action('admin_head', 'admin_js');
add_action('admin_menu', 'mytheme_add_admin'); ?>