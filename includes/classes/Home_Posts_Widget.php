<?php
/**
 * Created by PhpStorm.
 * User: ahmedeltaweel
 * Date: 17/04/16
 * Time: 12:32 م
 */

namespace Allotatto\Home_Posts_Widget;

use WP_Widget;

class Home_Posts_Widget extends WP_Widget
{
	/**
	 * Home_Posts_Widget constructor.
	 *
	 * setup widget name, options and id.
	 */
	public function __construct()
	{
		$widget_options = [
			'classname'   => 'home_posts_widget',
			'description' => 'Display the latest articles.',
		];
		parent::__construct( 'home_posts_widget', __( 'Allotatto Home Posts', ATG_DOMAIN ), $widget_options );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance )
	{
		// default options' values
		$instance = $this->default_options( $instance );

		if ( $instance['ahpw_number_of_articles'] < 1 )
		{
			// skip if number of articles invalid
			return;
		}

		// getting recent number of articles
		$recent_posts = wp_get_recent_posts( [
			'numberposts' => $instance['ahpw_number_of_articles'],
			'post_status' => 'publish',
		], OBJECT );

		if ( !$recent_posts )
		{
			// return if no result found
			return;
		}

		// load style
		wp_enqueue_style( 'ahpw-style', AHPW_URI . ( Helpers::is_script_debugging() ? 'assets/src' : 'assets/dist' ) . '/css/style.css', '', ahpw_version() );

		// load view with variable
		ahpw_view( 'widget_render', [
			'widget_args'  => $args,
			'settings'     => $instance,
			'recent_posts' => $recent_posts,
		] );
	}

	/**
	 * Outputs the options form on admin panel.
	 *
	 * @param array $instance The widget options
	 *
	 * @return string|void
	 */
	public function form( $instance )
	{
		// vars
		$form_fields = [ ];
		$instance    = $this->default_options( $instance );

		foreach ( $instance as $field_name => $field_value )
		{
			// get field input id, name and value
			$form_fields[ $field_name ] = (object) [
				'id'    => $this->get_field_id( $field_name ),
				'name'  => $this->get_field_name( $field_name ),
				'value' => $field_value,
			];
		}

		ahpw_view( 'widget_settings', compact( 'form_fields' ) );
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array of updated new values | false on failure
	 */
	public function update( $new_instance, $old_instance )
	{
		// getting new inputs.
		$new_instance = $this->default_options( $new_instance );

		// sanitizing
		$new_instance['ahpw_title']              = sanitize_text_field( $new_instance['ahpw_title'] );
		$new_instance['ahpw_description']        = sanitize_text_field( $new_instance['ahpw_description'] );
		$new_instance['ahpw_number_of_articles'] = absint( $new_instance['ahpw_number_of_articles'] );
		$new_instance['ahpw_text_of_button']     = sanitize_text_field( $new_instance['ahpw_text_of_button'] );
		$new_instance['ahpw_button_url']         = esc_url_raw( $new_instance['ahpw_button_url'] );

		return $new_instance;
	}

	/**
	 * Parse given options with defaults
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	public function default_options( $options )
	{
		return wp_parse_args( $options, [
			'ahpw_title'              => __( 'Section title', AHPW_DOMAIN ),
			'ahpw_description'        => __( 'Section description', AHPW_DOMAIN ),
			'ahpw_number_of_articles' => 6,
			'ahpw_text_of_button'     => __( 'See More', AHPW_DOMAIN ),
			'ahpw_button_url'         => '#',
		] );
	}
}