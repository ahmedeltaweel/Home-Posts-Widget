<?php
/**
 * Created by Nabeel
 * Date: 2016-01-22
 * Time: 2:38 AM
 *
 * @package WP_Plugins\Boilerplate
 */

use Allotatto\Home_Posts_Widget\Plugin;

if ( !function_exists( 'allotatto_home_posts_widget' ) ):
	/**
	 * Get plugin instance
	 *
	 * @return Plugin
	 */
	function allotatto_home_posts_widget()
	{
		return Plugin::get_instance();
	}
endif;

if ( !function_exists( 'ahpw_view' ) ):
	/**
	 * Load view
	 *
	 * @param string $view_name
	 * @param array  $args
	 *
	 * @return void
	 */
	function ahpw_view( $view_name, $args = null )
	{
		allotatto_home_posts_widget()->load_view( $view_name, $args );
	}
endif;

if ( !function_exists( 'ahpw_version' ) ):
	/**
	 * Get plugin version
	 *
	 * @return string
	 */
	function ahpw_version()
	{
		return allotatto_home_posts_widget()->version;
	}
endif;