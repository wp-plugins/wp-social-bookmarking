<?php
/*
Plugin Name: WP Social Bookmarking
Version: 2.8.3
Plugin URI: http://wordpress.org/extend/plugins/wp-social-bookmarking/
Description: Plugin to help people share and bookmark your posts on Facebook, Twitter, Myspace, Friendfeed, Technorati, del.icio.us, Digg, Google, Yahoo Buzz, StumbleUpon, OnlineRel.com, EasyFreeAds.com, MegaWN.com
Author: A. Kilius
Author URI: http://www.onlinerel.com/wordpress-plugins/
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
	//$images = plugins_url().'/wp-social-bookmarking/images/';
	$pldir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)); 
$images = $pldir.'images/';
	$post_link = get_permalink($post->ID);	
	$post_link = get_permalink($post->ID);	
    $lang = get_bloginfo('language'); 
	$post_l =  base64_encode( $post_link );
	$post_tweet = site_url().'/?p='.$post->ID;
    $post_title = get_the_title($post->ID);
    $img_var =  get_option('wp_social_ico');   //"30px";

	if ( is_single() && !is_home() && !is_front_page() && !is_page() && !is_front_page() && !is_archive()) {
		$content .= '<!-- Begin WP-Social-Bookmarking -->' . "\n";
		$content .= '<div class="WP-Social-Bookmarking"> ' . "\n"  
	 		. '<a href="http://www.easyfreeads.com/sfeed/?f='.$post_l.'&l='.$lang.'" target="_blank" title="EasyFreeAds Blog News"><img src="' . $images . 'onlinerel.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="EasyFreeAds Blog News" title="EasyFreeAds Blog News" /></a>' . "\n"
				. '<a href="http://facebook.com/sharer.php?u=' . $post_link . '&amp;t=' . $post_title . '" target="_blank" rel="nofollow" title="Facebook"><img src="' . $images . 'facebook.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Facebook" title="Facebook" /></a>' . "\n"
				 . '<a href="http://twitter.com/home?status=' . $post_tweet . '  ' . $post_title . '" target="_blank" rel="nofollow" title="Twitter"><img src="' . $images . 'twitter.png" style="width:' . $img_var . ';height:' . $img_var . ';border:0px;" alt="Twitter" title="Twitter" /></a>' . "\n"
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

	add_filter("plugin_action_links", 'WP_Social_Bookmarking_ActionLink', 10, 2);

function WP_Social_Bookmarking_ActionLink( $links, $file ) {
	    static $this_plugin;		
		if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__); 
        if ( $file == $this_plugin ) {
			$settings_link = "<a href='".admin_url( "options-general.php?page=".$this_plugin )."'>". __('Settings') ."</a>";
			array_unshift( $links, $settings_link );
		}
		return $links;
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
<p><b>Plugin suport sharing your posts feed on <a href="http://www.megawn.com/">EasyFreeAds</a>. This helps to promote your blog and get more traffic.</b></p>
<p>Advertise your real estate, cars, items... Buy, Sell, Rent. Free promote your site:
<ul>
	<li><a href="http://www.onlinerel.com/">OnlineRel</a></li>
	<li><a href="http://www.easyfreeads.com/">Easy Free Ads</a></li>
	<li><a href="http://www.worldestatesite.com/">World Estate Site</a></li>
	<li><a href="http://jobs.onlinerel.com/">Jobs OnlineRel</a></li>
	<li><a href="http://www.megawn.com/">Mega World News</a></li>
</ul>
</p>
<hr /><hr />
 <h2>Blog Promotion</h2>
<p><b>If you produce original news or entertainment content, you can tap into one of the most technologically advanced traffic exchanges among blogs! Start using our Blog Promotion plugin on your site and receive 150%-300% extra traffic free! 
Idea is simple - the more traffic you send to us, the more we can send you back.</b> </p>
 <h3>Get plugin <a target="_blank" href="http://wordpress.org/extend/plugins/blog-promotion/">Blog Promotion</h3></a> 
 <hr />
 <h2>Funny video online</h2>
<p><b>Plugin "Funny video online" displays Funny video on your blog. There are over 10,000 video clips.
Add Funny YouTube videos to your sidebar on your blog using  a widget.</b> </p>
 <h3>Get plugin <a target="_blank" href="http://wordpress.org/extend/plugins/funny-video-online/">Funny video online</h3></a> 
 <hr />
 <h2>Funny photos</h2>
<p><b>Plugin "Funny Photos" displays Best photos of the day and Funny photos on your blog. There are over 5,000 photos.
Add Funny Photos to your sidebar on your blog using  a widget.</b> </p>
 <h3>Get plugin <a target="_blank" href="http://wordpress.org/extend/plugins/funny-photos/">Funny photos</h3></a> 
 <hr />
   		<h2>Joke of the Day</h2>
<p><b>Plugin "Joke of the Day" displays categorized jokes on your blog. There are over 40,000 jokes in 40 categories. Jokes are saved on our database, so you don't need to have space for all that information. </b> </p>
 <h3>Get plugin <a target="_blank" href="http://wordpress.org/extend/plugins/joke-of-the-day/">Joke of the Day</h3></a>
   <hr />
 <h2>Real Estate Finder</h2>
<p><b>Plugin "Real Estate Finder" gives visitors the opportunity to use a large database of real estate.
Real estate search for U.S., Canada, UK, Australia</b>
                                                                             </p>
<h3>Get plugin <a target="_blank" href="http://wordpress.org/extend/plugins/real-estate-finder/">Real Estate Finder</h3></a>
 <hr />

 <h2>Jobs Finder</h2>
<p><b>Plugin "Jobs Finder" gives visitors the opportunity to more than 1 million offer of employment.
Jobs search for U.S., Canada, UK, Australia</b> </p>
<h3>Get plugin <a target="_blank" href="http://wordpress.org/extend/plugins/jobs-finder/">Jobs Finder</h3></a>
 <hr />
		<h2>Recipe of the Day</h2>
<p><b>Plugin "Recipe of the Day" displays categorized recipes on your blog. There are over 20,000 recipes in 40 categories. Recipes are saved on our database, so you don't need to have space for all that information.</b> </p>
<h3>Get plugin <a target="_blank" href="http://wordpress.org/extend/plugins/recipe-of-the-day/">Recipe of the Day</h3></a>
	</div>
	<?php
}
add_action('wp_head', 'SetStyle');
add_filter('the_content', 'WP_Social_Bookmarking', 40);
//  ----- Image RSS
	$plugin_var= "blog-promotion";
  if (!in_array( $plugin_var.'/'.$plugin_var.'.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
add_action('rss_item', 'wp_social_rss_include');
add_action('rss2_item', 'wp_social_rss_include');
  }
function wp_social_rss_include (){
$image_size = get_option('rss_image_size_op');
if (isset($image_size)) $image_url = wp_social_rss_image_url($image_size);

else  $image_url = wp_social_rss_image_url('medium');

if ($image_url != '') :

$filename = $image_url;
$ary_header = get_headers($filename, 1);   
           
$filesize = $ary_header['Content-Length'];

echo "<enclosure url='".$image_url."' length ='".$filesize."'  type='image/jpg' />";
endif;
}

function wp_social_rss_image_url($default_size = 'medium') {	
global $post;
	$attachments = get_children( array('post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'numberposts' => 1) );
	if($attachments == true) :
		foreach($attachments as $id => $attachment) :
			$img = wp_get_attachment_image_src($id, $default_size);			
		endforeach;		
	endif;
	return $img[0];
}
                        
?>