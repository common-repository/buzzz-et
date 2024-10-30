<?php
/*
Plugin Name: buzzZ-Et
Plugin URI: http://blog.rswr.net/2008/11/13/yahoo-buzz-wordpress-plugin/
Description: Automatically displays a "buzz" button for each post. Full <a href="options-general.php?page=buzzZ-Et.php">admin options</a> available.
Version: 1.0.3
Author: Ryan Christenson (The RSWR Network)
Author URI: http://www.rswr.net/
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists("buzzZEt")) {
	class buzzZEt {
		var $adminOptionsName = "buzzZEtAdminOptions";
		function buzzZEt() { //constructor
		}

		//Returns an array of admin options
		function getAdminOptions() {
			$bZEtAdminOptions = array('home' => 'true', 'post' => 'true', 'page' => 'true', 'tag' => 'true', 'arch' => 'true', 'srch' => 'true', 'promote' => 'true', 'display1' => 'true', 'badge' => 'true', 'body' => 'true', 'media' => 'true', 'topic' => 'true');
			$bZEtOptions = get_option($this->adminOptionsName);
			if (!empty($bZEtOptions)) {
				foreach ($bZEtOptions as $key => $option)
				$bZEtAdminOptions[$key] = $option;
			}
			update_option($this->adminOptionsName, $bZEtAdminOptions);
			return $bZEtAdminOptions;
		}
		function init() {
			$this->getAdminOptions();
		}

		//Prints out the admin page
		function printAdminPage() {
			$bZEtOptions = $this->getAdminOptions();
			if (isset($_POST['update_buzzZEtSettings'])) {
			
				// Save Settings
				if($_POST['home'] == "on") update_option('bZEt_home', "checked=on");
  				else update_option('bZEt_home', "");
  				if($_POST['post'] == "on") update_option('bZEt_post', "checked=on");
  				else update_option('bZEt_post', "");
  				if($_POST['page'] == "on") update_option('bZEt_page', "checked=on");
  				else update_option('bZEt_page', "");
  				if($_POST['tag'] == "on") update_option('bZEt_tag', "checked=on");
  				else update_option('bZEt_tag', "");
  				if($_POST['arch'] == "on") update_option('bZEt_arch', "checked=on");
  				else update_option('bZEt_arch', "");
  				if($_POST['srch'] == "on") update_option('bZEt_srch', "checked=on");
  				else update_option('bZEt_srch', "");
  				if($_POST['promote'] == "on") update_option('bZEt_promote', "checked=on");
  				else update_option('bZEt_promote', "");
  				$bz_display1 = $_POST['display1'];
  				$bz_badge = $_POST['badge'];
  				$bz_body = $_POST['body'];
  				$bz_media = $_POST['media'];
  				$bz_topic = $_POST['topic'];

				// Update Settings
				update_option('bZEt_display1', $bz_display1);
				update_option('bZEt_badge', $bz_badge);
				update_option('bZEt_body', $bz_body);
				update_option('bZEt_media', $bz_media);
				update_option('bZEt_topic', $bz_topic);

				// Update Admin
				update_option($this->adminOptionsName, $bZEtOptions);
?>
<div class="updated"><p><span class="tblBold"><?php _e("Options Updated!", "buzzZEt");?></span></p></div>
<?php
			} else {
				// Retrieve Options
				$bz_display1 = get_option('bZEt_display1');
				$bz_badge = get_option('bZEt_badge');
				$bz_body = get_option('bZEt_body');
				$bz_media = get_option('bZEt_media');
				$bz_topic = get_option('bZEt_topic');
			}
?>
<div class="wrap">
<h2><?php _e('buzzZ-Et 1.0.3','buzzZEt'); ?></h2>
<style type="text/css">
<!--
.tblPad td{padding:10px;text-align:left;}
.tblPad th{text-align:left;vertical-align:top;}
.tblRed{color:red;font-weight:700;}
.tblBold{font-weight:700;}
-->
</style>
<form class="form-table" method="post" action="<?php _e($_SERVER["REQUEST_URI"]); ?>">
<div class="updated"><p><span class="tblBold"><?php _e('This plugin is soon to be discontinued. Check out <a href="http://blog.rswr.net/2009/02/14/social-media-wordpress-plugin/" target="_blank">S-ButtonZ</a> the new combined version of all four of our social media button plugins.<br /><br /><a href="http://wordpress.org/extend/plugins/s-buttonz/" target="_blank">Download S-ButtonZ Here</a>', "buzzZEt");?></span></p></div>
<?php //Display Settings ?>
  <div class="postbox" id="poststuff">
    <div class="postbox">
      <h3 class="hndle"><span><?php _e('Display Settings','buzzZEt'); ?></span></h3>
      <div class="inside">
<table width="100%">
<tr>
<th scope="row">
Hide Buttons On...
</td><td>
<span class="tblBold">
<input type="checkbox" name="home" <?php _e(get_option('bZEt_home')); ?> /> Home Page (Recommended to speed up your Home Page's load time.)<br />
<input type="checkbox" name="post" <?php _e(get_option('bZEt_post')); ?> /> Posts<br />
<input type="checkbox" name="page" <?php _e(get_option('bZEt_page')); ?> /> Pages<br />
<input type="checkbox" name="tag" <?php _e(get_option('bZEt_tag')); ?> /> Tag Pages<br />
<input type="checkbox" name="arch" <?php _e(get_option('bZEt_arch')); ?> /> Archives (This is all Category, Author and Date based pages)<br />
<input type="checkbox" name="srch" <?php _e(get_option('bZEt_srch')); ?> /> Search Page Results<br />
<span class="tblRed">Single Page or Post</span>
<br />Note: Add the following html snippet to any page or post you would like to the hide the "Yahoo! Buzz" button on.
<br />&lt;!--buzzZ=none--&gt;
</span>
</td></tr>
<tr>
<th scope="row">
Button Position
</td><td>
<select id="display1" name="display1">
	<option value="" <?php _e($bz_display1=="" ? "selected" : ""); ?>>Top Right</option>
	<option value="left" <?php _e($bz_display1=="left" ? "selected" : ""); ?>>Top Left</option>
	<option value="bottomL" <?php _e($bz_display1=="bottomL" ? "selected" : ""); ?>>Bottom Left</option>
	<option value="bottomR" <?php _e($bz_display1=="bottomR" ? "selected" : ""); ?>>Bottom Right</option>
</select>
</td></tr>
</table>
      </div>
    </div>
  </div>
<?php //Button Settings ?>
  <div class="postbox" id="poststuff">
    <div class="postbox">
      <h3 class="hndle"><span><?php _e('Button Settings','buzzZEt'); ?></span></h3>
      <div class="inside">
<table width="100%">
<tr>
<th scope="row">
Badge Type
</td><td style="vertical-align:top;">
<select id="badge" name="badge">
	<option value="square" <?php _e($bz_badge=="square" ? "selected" : ""); ?>>Square</option>
	<option value="text-votes" <?php _e($bz_badge=="text-votes" ? "selected" : ""); ?>>Text Votes</option>
	<option value="logo" <?php _e($bz_badge=="logo" ? "selected" : ""); ?>>Icon (Without Text)</option>
	<option value="text" <?php _e($bz_badge=="text" ? "selected" : ""); ?>>Icon (With Text Link)</option>
	<option value="small-votes" <?php _e($bz_badge=="small-votes" ? "selected" : ""); ?>>Small Votes</option>
	<option value="medium-votes" <?php _e($bz_badge=="medium-votes" ? "selected" : ""); ?>>Medium Votes</option>
	<option value="large-votes" <?php _e($bz_badge=="large-votes" ? "selected" : ""); ?>>Large Votes</option>
	<option value="small" <?php _e($bz_badge=="small" ? "selected" : ""); ?>>Small Button</option>
	<option value="medium" <?php _e($bz_badge=="medium" ? "selected" : ""); ?>>Medium Button</option>
	<option value="large" <?php _e($bz_badge=="large" ? "selected" : ""); ?>>Large Button</option>
</select>
</td>
<td>
<img src="<?php _e(buzzZEt_Url()); ?>buzz-examples.png" width="550px" height="300px" />
</td></tr>
<tr>
<th scope="row">
Summary
</td><td colspan="2">
<select id="body" name="body">
	<option value="" <?php _e($bz_body=="" ? "selected" : ""); ?>>Manual (Blank Summary)</option>
	<option value="150" <?php _e($bz_body=="150" ? "selected" : ""); ?>>150 Charachter Summary</option>
	<option value="250" <?php _e($bz_body=="250" ? "selected" : ""); ?>>250 Charachter Summary</option>
	<option value="350" <?php _e($bz_body=="350" ? "selected" : ""); ?>>350 Charachter Summary</option>
</select>
</td></tr>
<tr>
<th scope="row">
Media
</td><td colspan="2">
<select id="media" name="media">
	<option value="text" <?php _e($bz_media=="text" ? "selected" : ""); ?>>Text (News)</option>
	<option value="video" <?php _e($bz_media=="video" ? "selected" : ""); ?>>Video</option>
	<option value="image" <?php _e($bz_media=="image" ? "selected" : ""); ?>>Image</option>
</select>
<br /><span style="color:red;font-weight:700;">The default type of media being submitted.</span>
<span class="tblBold">
<br />Note: If you need to use multiple types of media, add one of the following html snippets to your page or post.
<br /> &lt;!--buzzZM=text--&gt;
<br /> &lt;!--buzzZM=image--&gt;
<br /> &lt;!--buzzZM=video--&gt;
</span>
</td></tr>
<tr>
<th scope="row">
Category
</td><td colspan="2">
<select id="topic" name="topic">
	<option value="" <?php _e($bz_topic=="" ? "selected" : ""); ?>>Blank</option>
	<option value="business" <?php _e($bz_topic=="business" ? "selected" : ""); ?>>Business</option>
	<option value="entertainment" <?php _e($bz_topic=="entertainment" ? "selected" : ""); ?>>Entertainment</option>
	<option value="health" <?php _e($bz_topic=="health" ? "selected" : ""); ?>>Health</option>
	<option value="images" <?php _e($bz_topic=="images" ? "selected" : ""); ?>>Images</option>
	<option value="lifestyle" <?php _e($bz_topic=="lifestyle" ? "selected" : ""); ?>>Lifestyle</option>
	<option value="politics" <?php _e($bz_topic=="politics" ? "selected" : ""); ?>>Politics</option>
	<option value="science" <?php _e($bz_topic=="science" ? "selected" : ""); ?>>Science</option>
	<option value="sports" <?php _e($bz_topic=="sports" ? "selected" : ""); ?>>Sports</option>
	<option value="travel" <?php _e($bz_topic=="travel" ? "selected" : ""); ?>>Travel</option>
	<option value="usnews" <?php _e($bz_topic=="usnews" ? "selected" : ""); ?>>US News</option>
	<option value="video" <?php _e($bz_topic=="video" ? "selected" : ""); ?>>Video</option>
	<option value="world-news" <?php _e($bz_topic=="world-news" ? "selected" : ""); ?>>World News</option>
</select>
<br /><span style="color:red;font-weight:700;">Leave this set to "Blank" if you want the poster to choose the category.</span>
</td></tr>
</table>
      </div>
    </div>
  </div>
<?php //Other Settings ?>
  <div class="postbox" id="poststuff">
    <div class="postbox">
      <h3 class="hndle"><span><?php _e('Other Settings','buzzZEt'); ?></span></h3>
      <div class="inside">
<table width="100%">
<tr>
<th scope="row">
Help promote buzzZ-Et?
</td><td>
<input type="checkbox" name="promote" <?php _e(get_option('bZEt_promote')); ?> />  <span class="tblBold">Place a support link at the bottom of each post/page that uses a "Yahoo! Buzz" button. Thanks for your support!</span>
</td></tr>
</table>
      </div>
    </div>
  </div>
<?php //More Plugins ?>
  <div class="postbox" id="poststuff">
    <div class="postbox">
      <h3 class="hndle"><span><?php _e('Like this plugin?','buzzZEt'); ?> Try another Social Bookmarking Plugin by <a href="http://www.rswr.net/">The RSWR Network</a></span></h3>
      <div class="inside">
      <ul>
<li><a href="http://blog.rswr.net/2008/11/13/yahoo-buzz-wordpress-plugin/" target="blank">buzzZ-Et (Yahoo! Buzz Buttons)</a></li>
<li><a href="http://blog.rswr.net/2008/07/28/dzonez-et-wordpress-plugin/" target="blank">dzoneZ-Et (dZone Buttons)</a></li>
<li><a href="http://blog.rswr.net/2008/07/29/reddz-et-wordpress-plugin/" target="blank">reddZ-Et (reddit Buttons)</a></li>
      </ul>
      </div>
    </div>
  </div>
	<input type="submit" name="update_buzzZEtSettings" value="<?php _e('Update Settings', 'buzzZEt') ?>" class="button-primary action" /><br /><br />
</form>
</div>
<?php
		}
	}
}

// Get Plugin URL
function buzzZEt_Url() {
	$path = dirname(__FILE__);
	$path = str_replace("\\","/",$path);
	$path = trailingslashit(get_bloginfo('wpurl')) . trailingslashit(substr($path,strpos($path,"wp-content/")));
	return $path;
}

//Initialize the admin panel
if (!function_exists("buzzZEt_ap")) {
	function buzzZEt_ap() {
		global $bZEt_init;
		if (!isset($bZEt_init)) {
			return;
		}
		if (function_exists('add_options_page')) {
			add_options_page('buzzZ-Et', 'buzzZ-Et', 9, basename(__FILE__), array(&$bZEt_init, 'printAdminPage'));
		}
	}
}

// Truncate the Summary
if (!function_exists("buzzZEt_trunk")) {
	function buzzZEt_trunc($trunc, $tnum) {
		if (strlen($trunc) > 0 && strlen($trunc) > $tnum) {
			$k = 0;
			while ($k >= 0 && $k < strlen($trunc)) {
				$i = strpos($trunc, " ", $k);
				$j = strpos($trunc, chr(10), $k);
				if ($i === FALSE && $j === FALSE) {
					return $trunc;
				} else {
					if ($i > 0 && $j > 0) {
						if ($i < $j) {
							$k = $i;
						} else {
							$k = $j;
						}
					} elseif ($i > 0) {
						$k = $i;
					} elseif ($j > 0) {
						$k = $j;
					}

					if ($k >= $tnum) {
						return substr($trunc, 0, $k) . "...";
					} else {
						$k++;
					}
				}
			}
		} else {
			return $trunc;
		}
	}
}

// Create Button
if (!function_exists("buzzZEt_But")) {
	function buzzZEt_But($content) {
		// Retrieve Options
		$bz_display1 = get_option('bZEt_display1');
		$bz_badge = get_option('bZEt_badge');
		$bz_body = get_option('bZEt_body');
		$bz_media = get_option('bZEt_media');
		$bz_topic = get_option('bZEt_topic');
?>
<?php
// Display Top Right
if($bz_display1 == "") {
	if($bz_badge == "text-votes") {
_e('<div style="float: right; width: 80px; padding-right: 10px; margin: 0 0 10px 10px;">','buzzZEt');
	}
	elseif($bz_badge == "logo") {
_e('<div style="float: right; width: 20px; padding-right: 10px; margin: 0 0 10px 10px;">','buzzZEt');
	}
	elseif($bz_badge == "text") {
_e('<div style="float: right; width: 78px; padding-right: 10px; margin: 0 0 10px 10px;">','buzzZEt');
	}
	elseif($bz_badge == "small-votes" || $bz_badge == "medium-votes" || $bz_badge == "large-votes") {
_e('<div style="float: right; width: 170px; padding-right: 10px; margin: 0 0 0 10px;">','buzzZEt');
	}
	elseif($bz_badge == "small" || $bz_badge == "medium" || $bz_badge == "large") {
_e('<div style="float: right; width: 110px; padding-right: 10px; margin: 0 0 0 10px;">','buzzZEt');
	}
	else {
_e('<div style="float: right; width: 50px; padding-right: 10px; margin: 0 0 0 10px;">','buzzZEt');
	}
}

// Display Top Left
if($bz_display1 == "left") {
	if($bz_badge == "text-votes") {
_e('<div style="float: left; width: 80px; padding-right: 10px; margin: 0 10px 10px 0;">','buzzZEt');
	}
	elseif($bz_badge == "logo") {
_e('<div style="float: left; width: 20px; padding-right: 10px; margin: 0 10px 10px 0;">','buzzZEt');
	}
	elseif($bz_badge == "text") {
_e('<div style="float: left; width: 78px; padding-right: 10px; margin: 0 10px 10px 0;">','buzzZEt');
	}
	elseif($bz_badge == "small-votes" || $bz_badge == "medium-votes" || $bz_badge == "large-votes") {
_e('<div style="float: left; width: 170px; padding-right: 10px; margin: 0 10px 0 0;">','buzzZEt');
	}
	elseif($bz_badge == "small" || $bz_badge == "medium" || $bz_badge == "large") {
_e('<div style="float: left; width: 110px; padding-right: 10px; margin: 0 10px 0 0;">','buzzZEt');
	}
	else {
_e('<div style="float: left; width: 50px; padding-right: 10px; margin: 0 10px 0 0;">','buzzZEt');
	}
}

// Display Bottom Left
if($bz_display1 == "bottomL") {
	if($bz_badge == "square") {
_e('<div style="position:relative; width: 100%; padding: 0 0 100px 0;">','buzzZEt');
_e('<div style="position: absolute; bottom: 10px; width: 220px;">','buzzZEt');
	}
	else {
_e('<div style="position:relative; width: 100%; padding: 0 0 40px 0;">','buzzZEt');
_e('<div style="position: absolute; bottom: 10px; width: 220px;">','buzzZEt');
	}
}

// Display Bottom Right
if($bz_display1 == "bottomR") {
	if($bz_badge == "square") {
_e('<div style="position:relative; width: 100%; padding: 0 0 100px 0;">','buzzZEt');
_e('<div style="position: absolute; bottom: 10px; right:10px; width: 42px;">','buzzZEt');
	}
	elseif($bz_badge == "text-votes" || $bz_badge == "logo" || $bz_badge == "text") {
_e('<div style="position:relative; width: 100%; padding: 0 0 35px 0;">','buzzZEt');
_e('<div style="position: absolute; bottom: 10px; right:0; width: 80px;">','buzzZEt');
	}
	else {
_e('<div style="position:relative; width: 100%; padding: 0 0 35px 0;">','buzzZEt');
_e('<div style="position: absolute; bottom: 10px; right:0; width: 175px;">','buzzZEt');
	}
}
?>
<script type="text/javascript">
<?php
$bz_old = array('/\n/', '/\\[[^\\]]*\\]/');
$bz_new = array('', '');
?>
<!--
yahooBuzzArticleHeadline = '<?php the_title(); ?>';
yahooBuzzArticleSummary = '<?php if($bz_body != "") _e(buzzZEt_trunc(strip_tags(preg_replace($bz_old, $bz_new, $content)),$bz_body)); ?>';
yahooBuzzArticleCategory = '<?php _e($bz_topic); ?>';
yahooBuzzArticleType = '<?php if (strpos($content, "buzzZM=video") == TRUE) {_e("video");} elseif (strpos($content, "buzzZM=image") == TRUE) {_e("image");} elseif (strpos($content, "buzzZM=text") == TRUE) {_e("text");} else {_e($bz_media);}; ?>';
yahooBuzzArticleId = '<?php the_permalink(); ?>';
//-->
</script>
<script type="text/javascript" src="http://d.yimg.com/ds/badge2.js" badgetype="<?php _e($bz_badge); ?>"> </script>
</div>
<?php
	}
}

// Add Button
if (!function_exists("buzzZEt_AddBut")) {
	function buzzZEt_AddBut($content) {
		$bz_display1 = get_option('bZEt_display1');
		//error_reporting(E_ALL);
		if(is_home() && get_option('bZEt_home') == "checked=on") return $content;
		if(is_single() && get_option('bZEt_post') == "checked=on") return $content;
		if(is_page() && get_option('bZEt_page') == "checked=on") return $content;
		if(is_tag() && get_option('bZEt_tag') == "checked=on") return $content;
		if(is_archive() && get_option('bZEt_arch') == "checked=on") return $content;
		if(is_search() && get_option('bZEt_srch') == "checked=on") return $content;
		if (strpos($content, "buzzZ=none") == TRUE) return $content;
		if($bz_display1 == "bottomL" || $bz_display1 == "bottomR") {
			$content = buzzZEt_But($content).$content;
			if(is_page() || is_single()) {
				if (get_option('bZEt_promote') == "checked=on") {
					$content .= "<p>Yahoo! Buzz buttons brought to you by <a href='http://blog.rswr.net/2008/11/13/yahoo-buzz-wordpress-plugin/'>buzzZ-ET (WordPress Plugin)</a></p></div>";
				} else {
					$content .= '</div>';
				}
			} else {
				$content .= '</div>';
			}
			return $content;
		}
		else {
			$content = buzzZEt_But($content).$content;
			if(is_page() || is_single()) {
				if (get_option('bZEt_promote') == "checked=on") {
					$content .= "<p>Yahoo! Buzz buttons brought to you by <a href='http://blog.rswr.net/2008/11/13/yahoo-buzz-wordpress-plugin/'>buzzZ-ET (WordPress Plugin)</a></p>";
				}
			}
			return $content;
		}
	}
}

// Initialize Class
if (class_exists("buzzZEt")) {
	$bZEt_init = new buzzZEt();
}

//Actions and Filters
if (isset($bZEt_init)) {
	//Actions
	add_action('buzzZ-Et/buzzZ-Et.php', array(&$bZEt_init, 'init'));
	add_action('admin_menu', 'buzzZEt_ap');
	//Filters
	add_filter('the_content', 'buzzZEt_AddBut');
}

?>
