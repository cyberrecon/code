<?php
header('Content-type: text/css');
header("Cache-Control: must-revalidate");
$offset = 72000 ;
$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
header($ExpStr);
?>
<?php
require_once( dirname(__FILE__) . '../../../../wp-config.php');
require_once( dirname(__FILE__) . '/functions.php');
header("Content-type: text/css");
global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
?>
<?php
$bgCol = hexDarker($sp_color, 80);
$logocol = hexDarker($sp_color, 60);
$linksCol = hexDarker($sp_color, 40);
$linksCollight = hexDarker($sp_color, 10);
?>
body {background:#<?php echo $bgCol; ?>;}
#logo h1 { background-color:#<?php echo $logocol; ?>; border-color:#<?php echo $linksCol; ?>;}
#logo h1 a {color:#<?php echo $sp_logocolor; ?>;}
#featured {background-color:#<?php echo $sp_color; ?>;}
a:link, a:visited {color:#<?php echo $linksCol; ?>;}
.current_page_item a:link, .current_page_item a:visited  {color: #<?php echo $sp_color; ?>;}
.midpost p a:link, .midpost p a:visited {text-decoration:underline; color: #<?php echo $linksCollight; ?>;}
.content span.rmore a:link, .content span.rmore a:visited {color: #<?php echo $linksCollight; ?>;}
#footer a {color:#<?php echo $linksCollight; ?>;}
#featured_bg {background:<?php if($sp_slidetype=="Glossy") { echo "url(images/featured.png)"; } elseif ($sp_slidetype=="Solid Color")  {echo $sp_color;} ?>;}
.menu li li a:link, .menu li li a:visited {background-color:#<?php echo $bgCol; ?> !important; background-image:none !important;}
#entry { float:<?php if($sp_sidebar=="Right") {echo "left;";} elseif ($sp_sidebar=="Left") {echo "right;";}  ?> }
.ad125 { float:<?php if($sp_sidebar=="Right") {echo "left; padding:0 6px 6px 0;";} elseif ($sp_sidebar=="Left") {echo "right; padding:0 0 6px 6px;";}  ?> }
.advertise { <?php if($sp_sidebar=="Right") {echo "right:0px";} elseif ($sp_sidebar=="Left") {echo "left:0px";}  ?>; }
#catnavbar {background-color:#<?php echo $linksCol; ?>;}
#catnav li li a, #catnav li li a:link, #catnav li li a:visited {background-color:#<?php echo $bgCol; ?>;}
#footer {background: #<?php echo $linksCol; ?>;}
.reply a:link, .reply a:visited {background-color: #ccc;}
#submit {background-color: #ccc;}