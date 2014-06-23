<?php
function limits($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
	$content = strip_tags($content, '');

   if (strlen($_GET['p']) > 0) {
      echo $content;
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo $content;

        echo "...";
        echo "<span class=";
		echo "'rmore'>";
		echo " <a href='";
        the_permalink();
        echo "'>".$more_link_text."</a></span>";
   }
   else {
      echo $content;
   }
}
function shorten_text($title, $length) {
	
				if (strlen($title)>$length) 
					{$dots="...";} 
				else 
					{$dots="";}  
				$shorttext = strip_tags($title, '');
				$shorttext=substr($shorttext, 0, $length).$dots;
				return $shorttext;
}

function imagesrc() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches [1] [0];
if (!($first_img))
{
	$attachments = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order'));
if (is_array($attachments))
	{
	$count = count($attachments);
	$first_attachment = array_shift($attachments);
	$imgsrc = wp_get_attachment_image_src($first_attachment->ID, 'large');
	$first_img = $imgsrc[0];
	}
}
return $first_img;
}

function recent_comments($src_count=10, $src_length=32, $pre_HTML='<ul>', $post_HTML='</ul>') {
	global $wpdb;
	
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, 
			SUBSTRING(comment_content,1,$src_length) AS com_excerpt 
		FROM $wpdb->comments 
		LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) 
		WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' 
		ORDER BY comment_date_gmt DESC 
		LIMIT $src_count";
	$comments = $wpdb->get_results($sql);

	$output = $pre_HTML;
	foreach ($comments as $comment) {
		$output .= "<li><a href=\"" . get_permalink($comment->ID) . "#comment-" . $comment->comment_ID  . "\" title=\"on " . $comment->post_title . "\">".$comment->comment_author."&raquo; ".strip_tags($comment->com_excerpt) ."...</a></li>";
	}
	$output .= $post_HTML;
	echo $output;
}

function popular_posts($no_posts = 6, $before = '<li>', $after = '</li>', $show_pass_post = false, $duration='') {
    global $wpdb;
	$request = "SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'";
	if(!$show_pass_post) $request .= " AND post_password =''";

        if($duration !="") { $request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
}

	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
    $posts = $wpdb->get_results($request);
    $output = '';
	if ($posts) {
		foreach ($posts as $post) {
			$post_title = stripslashes($post->post_title);
			$comment_count = $post->comment_count;
			$permalink = get_permalink($post->ID);
			$output .= $before . '<a href="' . $permalink . '" title="' . $post_title.'">' . $post_title . ' <em>(' . $comment_count.' comments)</em></a>' . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
    echo $output;
}

function remove_title($input) {
  return preg_replace_callback('#\stitle=["|\'].*["|\']#',
    create_function(
      '$matches',
      'return "";'
      ),
      $input
    );
  }
add_filter('wp_list_pages','remove_title');

function hexDarker($hex,$factor = 30)
        {
        $new_hex = '';
        
        $base['R'] = hexdec($hex{0}.$hex{1});
        $base['G'] = hexdec($hex{2}.$hex{3});
        $base['B'] = hexdec($hex{4}.$hex{5});
        
        foreach ($base as $k => $v)
                {
                $amount = $v / 100;
                $amount = round($amount * $factor);
                $new_decimal = $v - $amount;
        
                $new_hex_component = dechex($new_decimal);
                if(strlen($new_hex_component) < 2)
                        { $new_hex_component = "0".$new_hex_component; }
                $new_hex .= $new_hex_component;
                }
                
        return $new_hex;        
        }
		
/*this function gets page name by its id*/
function get_pagename($page_id)
{
	global $wpdb;
	$page_name = $wpdb->get_var("SELECT post_title FROM $wpdb->posts WHERE ID = '".$page_id."' AND post_type = 'page'");
	return $page_name;
}

/*this function gets category name by its id*/
function get_categname($cat_id)
{
	global $wpdb;
	$cat_name = $wpdb->get_var("SELECT name FROM $wpdb->terms WHERE term_id = '".$cat_id."'");
	return $cat_name;
}

// breadcrump Navigation
function breadcrumbs() {
		if ( !is_home() || !is_front_page() ) {
			_e('<p class="breadcrumb"><a href="') . _e( get_option('home') ) . _e('">') . bloginfo('name') . _e('</a> &raquo; ');
			if ( is_category() ) {
				single_cat_title();
				//the_category(', ');
			} elseif ( is_single() ) {
					the_category(', ') . _e(' &raquo; ') . the_title();
			} elseif ( is_page() ) {
				_e( the_title() . '</p>');
			} elseif (is_page() && $post->post_parent ) {
				_e( get_the_title($post->post_parent) );
				_e(' &raquo; ');
				_e( the_title() );
			} elseif ( is_search() ) {
				_e('Search Results: ') . the_search_query() . _e('</p>');
			}
		}
	}
	
function relatedposts($postid) {
 
$limit=6;
global $wpdb, $post, $table_prefix;

$retval = '<ul class=\"relatedposts\">';
 
		// Get tags
		$tags = wp_get_post_tags($postid);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);
 
		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p
			WHERE tt.taxonomy ='post_tag'
				AND tt.term_taxonomy_id = tr.term_taxonomy_id
				AND tr.object_id  = p.ID
				AND tt.term_id IN ($tagslist)
				AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";
 
		$related = $wpdb->get_results($q);
 
		if ( $related ) {
			foreach($related as $r) {
				$retval .= '
		<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
			}
		} 
		else { $retval .= '<li>No related posts found</li>'; }
		$retval .= '</ul>';
		return $retval;
	}
?>