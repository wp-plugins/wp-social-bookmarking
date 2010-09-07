<?php
/*
Plugin Name: WP Social Bookmarking
Version: 1.9
Plugin URI: http://wordpress.org/extend/plugins/wp-social-bookmarking/
Description: Plugin to help people share and bookmark your posts on Facebook, Twitter, Myspace, Friendfeed, Technorati, del.icio.us, Digg, Google, Yahoo Buzz, StumbleUpon, OnlineRel 
Author: A. Kilius
Author URI: http://www.onlinerel.com/wp-social-bookmarking/
*/

register_activation_hook( __FILE__, 'wp_social_activate' );
add_action('admin_menu', 'wp_social_menu');

function wp_social_activate() {
	update_option('wp_social_ico', '24px');	
}

function wp_social_menu() {
	add_options_page('WP Social Bookmarking', 'Social Bookmarking', 8, __FILE__, 'wp_social_options');
}


function WP_Social_Bookmarking($content) {

    global $post;
	$images = plugins_url().'/wp-social-bookmarking/images/';
	$post_link = get_permalink($post->ID);	
    $lang = get_bloginfo('language'); 
	$post_l =  base64_encode( $post_link );
    $post_title = get_the_title($post->ID);
    $img_var =  get_option('wp_social_ico');   //"30px";

	if ( is_single ) {  
		$content .= '<!-- Begin WP-Social-Bookmarking -->' . "\n";

		$content .= '<div class="WP-Social-Bookmarking"> ' . "\n"  
	 		. '<a href="http://www.onlinerel.com/sfeed/?f='.$post_l.'&l='.$lang.'" target="_blank" title="Onlinerel"><img src="' . $images . 'onlinerel.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Onlinerel" title="Onlinerel" /></a>' . "\n"
				. '<a href="http://facebook.com/sharer.php?u=' . $post_link . '&amp;t=' . $post_title . '" target="_blank" rel="nofollow" title="Facebook"><img src="' . $images . 'facebook.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Facebook" title="Facebook" /></a>' . "\n"
				 . '<a href="http://twitter.com/home?status=' . $post_link . '  ' . $post_title . '" target="_blank" rel="nofollow" title="Twitter"><img src="' . $images . 'twitter.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Twitter" title="Twitter" /></a>' . "\n"
		         . '<a href="http://www.myspace.com/Modules/PostTo/Pages/?c=' . $post_link . '&t=' . $post_title . '" target="_blank" rel="nofollow" title="Myspace"><img src="' . $images . 'myspace.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Myspace" title="Myspace" /></a>' . "\n"				 
			 . '<a href="http://friendfeed.com/share?url=' . $post_link . '&title=' . $post_title . '" target="_blank" rel="nofollow" title="Friendfeed"><img src="' . $images . 'friendfeed.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Friendfeed" title="Friendfeed" /></a>' . "\n"
	 . '<a href="http://www.technorati.com/faves?add=' . $post_link . '" target="_blank" rel="nofollow" title="Technorati"><img src="' . $images . 'technorati.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Technorati" title="Technorati" /></a>' . "\n"
	               . '<a href="http://del.icio.us/post?url=' . $post_link . '&amp;title=' . $post_title . '" target="_blank" rel="nofollow" title="del.icio.us"><img src="' . $images . 'delicious.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="del.icio.us" title="del.icio.us" /></a>' . "\n"
                  . '<a href="http://digg.com/submit?phase=2&amp;url=' . $post_link . '&amp;title=' . $post_title . '" target="_blank" rel="nofollow" title="Digg"><img src="' . $images . 'digg.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Digg" title="Digg" /></a>' . "\n"         
                  . '<a href="http://google.com/bookmarks/mark?op=add&amp;bkmk=' . $post_link . '&amp;title=' . $post_title . '" target="_blank" rel="nofollow" title="Google"><img src="' . $images . 'google.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Google" title="Google" /></a>' . "\n"
                  . '<a href="http://buzz.yahoo.com/submit?submitUrl=' . $post_title . '&amp;u=' . $post_link . '" target="_blank" rel="nofollow" title="Yahoo Buzz"><img src="' . $images . 'yahoobuzz.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Yahoo Buzz" title="Yahoo Buzz" /></a>' . "\n"
                  . '<a href="http://stumbleupon.com/submit?url=' . $post_link . '&amp;title=' . $post_title . '&amp;newcomment=' . $post_title . '" target="_blank" rel="nofollow" title="StumbleUpon"><img src="' . $images . 'stumbleupon.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="StumbleUpon" title="StumbleUpon" /></a>' . "\n"
                  . '</div><br /> <!-- End WP-Social-Bookmarking -->' . "\n\n";				  
    }				  
	return $content;
}

function SetStyle() {
	echo '<link rel="stylesheet" type="text/css" media="all" href="'.plugins_url().'/wp-social-bookmarking/style.css">';
}

function wp_social_options() {
	
	if(isset($_POST['b_update'])) {
		if(!empty($_POST['wp_social_ico'])) {
			update_option('wp_social_ico', $_POST['wp_social_ico']);
		}
	echo "<div class='updated fade'><p><strong>Options saved</strong></p></div>";
	}
	
	?>
	<div class="wrap">
		<h2>WP Social Bookmarking  Settings </h2>

		<form method="post" action="#">
	 			<table class="form-table">
				 
				<th scope="row"> Change Icon Size </th>
					<td>
						<select name="wp_social_ico">
							<option value="30px" <?php echo get_option('wp_social_ico') == '30px'?'selected':'';?>>30x30px (Big)</option>
							<option value="24px" <?php echo get_option('wp_social_ico') == '24px'?'selected':'';?>>24x24px</option>
							<option value="20px" <?php echo get_option('wp_social_ico') == '20px'?'selected':'';?>>20x20px</option>
							<option value="16px" <?php echo get_option('wp_social_ico') == '16px'?'selected':'';?>>16x16px (Small)</option>
						</select>
					</td> 	</tr>	</table>
			<p class="submit">
				<input type="submit" name="b_update" class="button-primary" value="  Save Changes  " />
			</p>
		</form>
<hr />
<p><b>WP-Social-Bookmarking plugin will add a image below your posts, allowing your visitors to share your posts with their friends, on FaceBook, Twitter, Myspace, Friendfeed, Technorati, del.icio.us, Digg, Google, Yahoo Buzz, StumbleUpon.</b></p>
<p><b>Plugin suport sharing your posts feed on <a href="http://www.onlinerel.com/">OnlineRel</a>. This helps to promote your blog and get more traffic.</b></p>
<p>Advertise your real estate, cars, items... Buy, Sell, Rent. Free promote your site:
<ul>
	<li><a href="http://www.onlinerel.com/">OnlineRel</a></li>
	<li><a href="http://www.easyfreeads.com/">Easy Free Ads</a></li>
	<li><a href="http://www.worldestatesite.com/">World Estate Site</a></li>
	<li><a href="http://www.facebook.com/pages/EasyFreeAds/106166672771355">Promote site on Facebook</a></li>	
</ul>
</p>
<hr /><hr />
<h2>More Plugins:  Recipe of the Day</h2>
<p><b>Plugin "Recipe of the Day" displays categorized recipes on your blog. There are over 20,000 recipes in 40 categories. Recipes are saved on our database, so you don't need to have space for all that information.</b> </p>
<h3>Get plugin <a target="_blank" href="http://wordpress.org/extend/plugins/recipe-of-the-day/">Recipe of the Day</h3></a>
	</div>
	<?php
}
add_action('wp_head', 'SetStyle');
add_filter('the_content', 'WP_Social_Bookmarking', 40);
?>