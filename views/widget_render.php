<?php
// before widget
echo $widget_args['before_widget'];

// Section title and description
echo $widget_args['before_title'], $settings['ahpw_title'], '</h2>',
'<h2 class="home-widget-description">', $settings['ahpw_description'], $widget_args['after_title'];
?>
<!--articles-->
<?php if ( isset( $recent_posts[0] ) ): ?>
	<ul class="posts-grid row">
		<?php foreach ( $recent_posts as $single_post ): ?>
			<li class="post-item col-xs-12 col-sm-6 col-md-4">
				<h1 itemprop="name" class="post-title job_listing-title"
				    style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( $single_post->ID, 'large' ) ); ?>');">
					<a href="<?php echo esc_url( get_permalink( $single_post->ID ) ); ?>" class="post-link">
						<span class="post-title-holder"><?php echo $single_post->post_title; ?></span>
					</a>
				</h1><!-- .post-title -->
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>

<!--button-->	<p class="aso-content">
	<a href="<?php echo esc_url( $settings['ahpw_button_url'] ) ?>" target="_blank" class="button button-big">
		<?php echo $settings['ahpw_text_of_button']; ?>
	</a>
</p>
<?php

// after widget
echo $widget_args['after_widget'];