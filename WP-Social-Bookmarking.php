<?php
/*
Plugin Name: WP Social Bookmarking
Version: 1.0
Plugin URI: http://wordpress.org/extend/plugins/wp-social-bookmarking/
Description: WP-Social-Bookmarking plugin will add a image below your posts, allowing your visitors to share your posts with their friends, on FaceBook, Twitter, Myspace, Friendfeed, Technorati, del.icio.us, Digg, Google, Yahoo Buzz, StumbleUpon, OnlineRel
Author: A. Kilius
Author URI: http://www.onlinerel.com/wp-social-bookmarking/
*/

function WP_Social_Bookmarking($content) {

    global $post;
	$images = plugins_url().'/wp-social-bookmarking/images/';
	$post_link = get_permalink($post->ID);	
	$post_l =  base64_encode( $post_link );
    $post_title = get_the_title($post->ID);

	if ( !is_feed() && !is_page() ) {  
		$content .= '<!-- Begin WP-Social-Bookmarking --> <div style="padding:16px 0 16px 0;text-align:center;width:95%;">' . "\n"  
				. '<a href="http://www.onlinerel.com/sfeed/?f=' . $post_l . '" target="_blank" title="Onlinerel"><img src="' . $images . 'onlinerel.png" style="width:30px;height:30px;border:0px;" alt="Onlinerel" title="Onlinerel" /></a>' . "\n"
				. '<a href="http://facebook.com/sharer.php?u=' . $post_link . '&amp;t=' . $post_title . '" target="_blank" rel="nofollow" title="Facebook"><img src="' . $images . 'facebook.png" style="width:30px;height:30px;border:0px;" alt="Facebook" title="Facebook" /></a>' . "\n"
				 . '<a href="http://twitter.com/home?status=' . $post_link . '  ' . $post_title . '" target="_blank" rel="nofollow" title="Twitter"><img src="' . $images . 'twitter.png" style="width:30px;height:30px;border:0px;" alt="Twitter" title="Twitter" /></a>' . "\n"
		         . '<a href="http://www.myspace.com/Modules/PostTo/Pages/?c=' . $post_link . '&t=' . $post_title . '" target="_blank" rel="nofollow" title="Myspace"><img src="' . $images . 'myspace.png" style="width:30px;height:30px;border:0px;" alt="Myspace" title="Myspace" /></a>' . "\n"				 
			 . '<a href="http://friendfeed.com/share?url=' . $post_link . '&title=' . $post_title . '" target="_blank" rel="nofollow" title="Friendfeed"><img src="' . $images . 'friendfeed.png" style="width:30px;height:30px;border:0px;" alt="Friendfeed" title="Friendfeed" /></a>' . "\n"
	 . '<a href="http://www.technorati.com/faves?add=' . $post_link . '" target="_blank" rel="nofollow" title="Technorati"><img src="' . $images . 'technorati.png" style="width:30px;height:30px;border:0px;" alt="Technorati" title="Technorati" /></a>' . "\n"
	               . '<a href="http://del.icio.us/post?url=' . $post_link . '&amp;title=' . $post_title . '" target="_blank" rel="nofollow" title="del.icio.us"><img src="' . $images . 'delicious.png" style="width:30px;height:30px;border:0px;" alt="del.icio.us" title="del.icio.us" /></a>' . "\n"
                  . '<a href="http://digg.com/submit?phase=2&amp;url=' . $post_link . '&amp;title=' . $post_title . '" target="_blank" rel="nofollow" title="Digg"><img src="' . $images . 'digg.png" style="width:30px;height:30px;border:0px;" alt="Digg" title="Digg" /></a>' . "\n"
         
                  . '<a href="http://google.com/bookmarks/mark?op=add&amp;bkmk=' . $post_link . '&amp;title=' . $post_title . '" target="_blank" rel="nofollow" title="Google"><img src="' . $images . 'google.png" style="width:30px;height:30px;border:0px;" alt="Google" title="Google" /></a>' . "\n"
                  . '<a href="http://buzz.yahoo.com/submit?submitUrl=' . $post_title . '&amp;u=' . $post_link . '" target="_blank" rel="nofollow" title="Yahoo Buzz"><img src="' . $images . 'yahoobuzz.png" style="width:30px;height:30px;border:0px;" alt="Yahoo Buzz" title="Yahoo Buzz" /></a>' . "\n"
                  . '<a href="http://stumbleupon.com/submit?url=' . $post_link . '&amp;title=' . $post_title . '&amp;newcomment=' . $post_title . '" target="_blank" rel="nofollow" title="StumbleUpon"><img src="' . $images . 'stumbleupon.png" style="width:30px;height:30px;border:0px;" alt="StumbleUpon" title="StumbleUpon" /></a>' . "\n"
                  . '</div> <!-- End WP-Social-Bookmarking -->' . "\n\n";				  
    }				  
	return $content;
}

add_filter('the_content', 'WP_Social_Bookmarking', 40);

?>