<?php
/*
Plugin Name: RSS No More
Version: 1.5
Plugin URI: http://my2cents.info/rss-no-more/
Description: When activated, it will cut your rss feeds at the 'more' tag. And optionnaly add a dynamic and customizable RSS Footer to each article.
Author: Jerome Neuveglise
Author URI: http://my2cents.info/
*/

$plugin_dir = basename(dirname(__FILE__));
load_plugin_textdomain( 'rss-no-more', '/wp-content/plugins' . $plugin_dir , $plugin_dir .'/lang/' );

add_action('admin_menu', 'rss_no_more_menu');
add_action('activate_rss-no-more/rss-no-more.php', 'rss_no_more_install');
add_action('deactivate_rss-no-more/rss-no-more.php', 'rss_no_more_uninstall');

function rss_no_more_install() {
	add_option('rss-no-more-on', 1);
	add_option('rss-no-more-em',0);
	add_option('rss-no-more-link', 'Continue reading: ');
	add_option('rss-no-more-footer', '');
	add_option('rss-no-more-hr', 0);
	add_option('rss-no-more-style','');
	add_option('rss-no-more-tracking', 0);
	add_option('rss-no-more-utm-source', 'feed');
	add_option('rss-no-more-utm-campaign', 'rss-mo-more');
	add_option('rss-no-more-utm-medium', 'rss');

}

function rss_no_more_menu() {
	add_options_page('RSS No More Options', 'RSS No More', 1, 'rss_no_more', 'rss_no_more_options');
}

function rss_no_more_options() {
	if ( isset($_POST['submit']) ) {

		if (!current_user_can('manage_options')) die(__('You cannot edit the RSS No More options.', 'rss-no-more'));
		check_admin_referer('rss_no_more-config');
		
		update_option('rss-no-more-on', $_POST['rss_cut']);
		update_option('rss-no-more-link', $_POST['rss_text']);
		update_option('rss-no-more-footer', strip_tags($_POST['rss_footer']));
		update_option('rss-no-more-hr', $_POST['rss_hr']);
		update_option('rss-no-more-em', $_POST['rss_em']);
		update_option('rss-no-more-style', $_POST['rss_style']);
		update_option('rss-no-more-tracking', $_POST['rss_tracking']);
		update_option('rss-no-more-utm-source', $_POST['rss_utm_source']);
		update_option('rss-no-more-utm-campaign', $_POST['rss_utm_campaign']);
		update_option('rss-no-more-utm-medium', $_POST['rss_utm_medium']);
		
		echo '<div id="message" class="updated fade"><p><strong>' . __('RSS No More settings saved', 'rss-no-more') . '</strong></p></div>';
		
	
	} 	
	
	if ( isset($_POST['reset']) ) {

		if (!current_user_can('manage_options')) die(__('You cannot edit the RSS No More options.', 'rss-no-more'));
		check_admin_referer('rss_no_more-config');
		
		delete_option('rss-no-more-on');
		delete_option('rss-no-more-link');
		delete_option('rss-no-more-footer');
		delete_option('rss-no-more-hr');
		delete_option('rss-no-more-em');
		delete_option('rss-no-more-style');
		delete_option('rss-no-more-tracking');
		delete_option('rss-no-more-utm-source');
		delete_option('rss-no-more-utm-medium');
		delete_option('rss-no-more-utm-campaign');
		
		echo '<div id="message" class="updated fade"><p><strong>' . __('RSS No More settings deleted. You may now remove this plugin.', 'rss-no-more') . '</strong></p></div>';
		
	
	} 	
			

		echo '<div class="wrap">';
		echo '<div id="icon-options-general" class="icon32"><br /></div>';
		echo '<h2>'.__('RSS No More configuration pannel', 'rss-no-more').'</h2>';
		echo '<form name="form1" method="post">';
		if ( function_exists('wp_nonce_field') )
			wp_nonce_field('rss_no_more-config');
		echo '<table class="form-table">';
		echo '<tr valign="top">';
		echo '<th scope="row"><label for="rss_cut">'.__('Truncate RSS feeds at the more sign', 'rss-no-more').':</label></th>';
		echo '<td><input name="rss_cut" type="checkbox" id="rss_cut"'; echo get_option('rss-no-more-on')?'checked':''; echo ' value="1" /><br /><span class="description">'; _e('If this is checked, it will cut the RSS feed at the more sign. If not, you can still use [rss-cut] tag in your article to choose where to cut the RSS feed on a per article basis.','rss-no-more'); echo '</span></td>';
		echo '</tr>';
		echo '<tr valign="top">';
		echo '<th scope="row"><label for="rss_cut">'.__('Text to prepend the article link', 'rss-no-more').':</label></th>';
		echo '<td><input name="rss_text" type="text" id="rss_text" value="'; echo stripslashes(get_option('rss-no-more-link')); echo '" class="regular-text" /></td>';
		echo '</tr>';
		echo '<tr valign="top">';
		echo '<th scope="row"><label for="rss_em">'.__('Emphasis Link (italic)', 'rss-no-more').':</label></th>';
		echo '<td><input name="rss_em" type="checkbox" id="rss_em"'; echo get_option('rss-no-more-em')?'checked':''; echo ' value="1" /></td>';
		echo '</tr>';
		echo '<tr valign="top">';
		echo '<th scope="row"><label for="rss_tracking">'.__('Track clicks', 'rss-no-more').':</label></th>';
		echo '<td><input name="rss_tracking" type="checkbox" id="rss_tracking"'; echo get_option('rss-no-more-tracking')?'checked':''; echo ' value="1" /><br /><span class="description">'; _e('Add utm_* trackers to the full article link for your analytics','rss-no-more'); echo '</span></td>';
		echo '</tr>';
		echo '<tr valign="top">';
		echo '<th scope="row"><label for="rss_utm_campaign">'.__('utm_campaign', 'rss-no-more').':</label></th>';
		echo '<td><input name="rss_utm_campaign" type="text" id="rss_utm_campaign" value="'; echo stripslashes(get_option('rss-no-more-utm-campaign')); echo '" class="regular-text" /><br /><span class="description">'; _e('utm_campaign value. Ex: rss-no-more','rss-no-more'); echo '</span></td>';
		echo '</tr>';
		echo '<tr valign="top">';
		echo '<th scope="row"><label for="rss_utm_medium">'.__('utm_medium', 'rss-no-more').':</label></th>';
		echo '<td><input name="rss_utm_medium" type="text" id="rss_utm_medium" value="'; echo stripslashes(get_option('rss-no-more-utm-medium')); echo '" class="regular-text" /><br /><span class="description">'; _e('utm_medium value. Ex: rss','rss-no-more'); echo '</span></td>';
		echo '</tr>';
		echo '<tr valign="top">';
		echo '<th scope="row"><label for="rss_utm_source">'.__('utm_source', 'rss-no-more').':</label></th>';
		echo '<td><input name="rss_utm_source" type="text" id="rss_utm_source" value="'; echo stripslashes(get_option('rss-no-more-utm-source')); echo '" class="regular-text" /><br /><span class="description">'; _e('utm_source value. Ex: feed','rss-no-more'); echo '</span></td>';
		echo '</tr>';
		echo '<tr valign="top">';
		echo '<th scope="row"><label for="rss_cut">'.__('RSS Footer to append to all articles', 'rss-no-more').':<br/><em>'.__('(leave it blank for no footer)','rss-no-more').'</em></label></th>';
		echo '<td><textarea name="rss_footer" id="rss_footer" class="large-text" rows="4" />'; echo stripslashes(get_option('rss-no-more-footer')); echo '</textarea><br /><span class="description">'; _e('You can use specific keywords such as:','rss-no-more'); echo '<ul><li>'; _e('%%POSTLINK%% for the post link with title as anchor','rss-no-more'); echo '</li><li>'; _e('%%BLOGLINK%% for your blog url with blog title as anchor','rss-no-more'); echo '</li><li>'; _e('%%BLOGDESCLINK%% for your blog url with blog title and description as anchor', 'rss-no-more'); echo '</li><li>'; _e('%%AUTHOR%% for the post author\'s name' ,'rss-no-more'); echo '</li></ul></span></td>';
		echo '</tr>';
		echo '<tr valign="top">';
		echo '<th scope="row"><label for="rss_hr">'.__('Add an horizontal rule before the footer', 'rss-no-more').':</label></th>';
		echo '<td><input name="rss_hr" type="checkbox" id="rss_hr"'; echo get_option('rss-no-more-hr')?'checked':''; echo ' value="1" /></td>';
		echo '</tr>';
		echo '<tr valign="top">';
		echo '<th scope="row"><label for="rss_style">'.__('Footer css style', 'rss-no-more').':</label></th>';
		echo '<td><input name="rss_style" type="text" id="rss_style" value="'; echo stripslashes(get_option('rss-no-more-style')); echo '" class="regular-text" /><br /><span class="description">'; _e('CSS style to apply to the footer.<br />Example : padding: 5px; border: 1px solid #333; background: #eee; font-size: 0.9em;','rss-no-more'); echo '</span></td>';
		echo '</tr>';
		echo '</table>';
		echo '<p class="submit">';
		echo '<input type="submit" name="submit" class="button-primary" value="'; _e('Save settings', 'rss-no-more'); echo '" />';
		echo '</p>';
		echo '</form>';
		echo '<h3>'; _e('Delete all plugin setting from database?', 'rss-no-more'); echo '</h3>';
		echo '<p>'; _e('Just press the button below. Beware there is no undo !', 'rss-no-more'); echo '</p>';
		echo '<form name="form2" method="post">';
		if ( function_exists('wp_nonce_field') )
			wp_nonce_field('rss_no_more-config');
		echo '<p class="submit">';
		echo '<input type="submit" name="reset" class="button-primary" value="'; _e('Delete settings', 'rss-no-more'); echo '" />';
		echo '</p>';
		echo '</form>';
		echo '</div>';
	

}

function rss_no_more($content) {
	if(is_feed()) {

		$more = strpos($content,'[rss-cut]');

		if(get_option('rss-no-more-on')) {
		
			if($more === false)
				$more = strpos($content,'<p><span id="more-');
			
			if($more === false)
				$more = strpos($content,'<span id="more-'); 
		
		}

		if($more) {

			$content = substr($content, 0, $more - 1);
			
			$more_link = get_permalink();
			
			if (get_option('rss-no-more-tracking')) {
			
				if (strpos($more_link, '?')) {
					$more_link .= "&";
				} else {
					$more_link .= "?";
				}

				$more_link .= "utm_source=" . get_option('rss-no-more-utm-source') . "&utm_campaign=" . get_option('rss-no-more-utm-campaign') . "&utm_medium=" . get_option('rss-no-more-utm-medium') ;
			
			}

			
			if (get_option('rss-no-more-em'))
				$content .= '<em><p><a href="'.$more_link.'">'.stripslashes(get_option('rss-no-more-link')).get_the_title().'</a></p></em>';
			else	
				$content .= '<p><a href="'.$more_link.'">'.stripslashes(get_option('rss-no-more-link')).get_the_title().'</a></p>';
				

		}
		
		$footer = trim(get_option('rss-no-more-footer'));
		
		if($footer) {
		
			$permalink = get_permalink();
		
			if (get_option('rss-no-more-tracking')) {
				
				if (strpos($permalink, '?')) {
					$permalink .= "&";
				} else {
					$permalink .= "?";
				}
				
				$permalink .= "utm_source=" . get_option('rss-no-more-utm-source') . "&utm_campaign=" . get_option('rss-no-more-utm-campaign') . "&utm_medium=" . get_option('rss-no-more-utm-medium') ;
				
				$blog_url = get_bloginfo('url');
				
				if (strpos($blog_url, '?')) {
					$blog_url .= "&";
				} else {
					$blog_url .= "?";
				}
				
				$blog_url .= "utm_source=" . get_option('rss-no-more-utm-source') . "&utm_campaign=" . get_option('rss-no-more-utm-campaign') . "&utm_medium=" . get_option('rss-no-more-utm-medium') ;
			}
						
			$tags_array = array(
				'%%POSTLINK%%',
				'%%BLOGLINK%%',
				'%%BLOGDESCLINK%%',
				'%%BLOGDESC',
				'%%AUTHOR%%'
			);
			
			$replace_array =array(
				'<a href="'.$permalink.'">'.get_the_title().'</a>',
				'<a href="'.$blog_url.'">'.get_bloginfo('name').'</a>',
				'<a href="'.$blog_url.'">'.get_bloginfo('name').' - '.get_bloginfo('description').'</a>',
				get_bloginfo('description'),
				get_the_author()
			);
			
			if(get_option('rss-no-more-hr'))
				$content .= '<hr />';
			
			$p_open = get_option('rss-no-more-style')?'<p style="'.get_option('rss-no-more-style').'">':'<p>';
			
			$content .= $p_open.stripslashes(str_replace($tags_array, $replace_array, $footer)).'</p>';
		}
	} else {
	
		$content = str_replace('[rss-cut]', '', $content);
	
	}
	return $content;
}

add_filter('the_content', 'rss_no_more');
add_filter('the_excerpt_rss', 'rss_no_more');

?>
