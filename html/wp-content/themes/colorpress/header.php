<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script language="javascript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.flow.1.2.js"></script>
<script language="javascript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/superfish.js"></script>
<script language="javascript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>
<script language="javascript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jqueryui.js"></script>
<script language="javascript" type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/accordion.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
	$('form#contactForm').submit(function() {
		$('form#contactForm .error').remove();
		var hasError = false;
		$('.requiredField').each(function() {
			if(jQuery.trim($(this).val()) == '') {
				var labelText = $(this).prev('label').text();
				$(this).parent().append('<span class="error">You forgot to enter your '+labelText+'.</span>');
				hasError = true;
			} else if($(this).hasClass('contactemail')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim($(this).val()))) {
					var labelText = $(this).prev('label').text();
					$(this).parent().append('<span class="error">You entered an invalid '+labelText+'.</span>');
					hasError = true;
				}
			}
		});
		if(!hasError) {
			$('form#contactForm li.buttons button').fadeOut('normal', function() {
				$(this).parent().append('<img src="<?php bloginfo('template_directory'); ?>/images/loading.gif" alt="Loading&hellip;" height="31" width="31" />');
			});
			var formInput = $(this).serialize();
			$.post($(this).attr('action'),formInput, function(data){			   
			$("form#contactForm").before('<div class="thanks"><h1 class="thank">Thanks</h1><p>Your email was successfully sent. We will be in touch soon.</p></div>');
			});
			$("form#contactForm").slideUp("slow",function() {});
		}
		
		return false;
		
	});
});
</script>
<!--[if IE 6]>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/ie6.css" type="text/css" media="screen" />
<style>
img, .jFlowPrev3, .jFlowNext3, .subtext, #featured_bg, .comms a, #accordion ul li a { behavior: url(<?php bloginfo('template_directory'); ?>/iepngfix.htc) }
</style>
<![endif]-->
<!--[if IE 7]>
<style>
.advertise {top:-3px;}
</style>
<![endif]-->
<?php if (function_exists('wp_enqueue_script') && function_exists('is_singular')) : ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php endif; ?>
<?php
global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
?>
<?php wp_head(); ?>
</head>
<body>

<div id="header">

    <div id="logo">
    <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
    <h2><?php bloginfo('description'); ?></h2>
    </div><!--logo-->

	<?php if ($sp_728ad=="Yes") { ?>
            <div id="ad728">
            <?php if (!$sp_ad728code) { ?>
            <a href="#"><img src="<?php bloginfo('template_directory'); ?>/ads/ad_728.gif" alt="Ad" /></a>
            <?php } else { echo stripslashes($sp_ad728code); } ?>
            </div><!--ad728-->
    <?php } ?>
    
<div class="clear"><!----></div>
</div>