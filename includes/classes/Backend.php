<?php namespace Allotatto\Home_Posts_Widget;

/**
 * Backend logic
 *
 * @package WP_Plugins\Boilerplate
 */
class Backend extends Component
{
	/**
	 * Constructor
	 *
	 * @return void
	 */
	protected function init()
	{
		parent::init();

		// adding the widget after default widgets has bees loaded.
		add_action( 'widgets_init', [ $this, 'register_home_post_widget' ] );
	}

	/**
	 * register widget.
	 *
	 * @return void
	 */
	public function register_home_post_widget()
	{
		register_widget( __NAMESPACE__ . '\Home_Posts_Widget' );
	}
}
