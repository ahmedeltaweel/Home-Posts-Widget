<?php
$labels = [
	'ahpw_title'              => __( 'Title:', AHPW_DOMAIN ),
	'ahpw_description'        => __( 'Description:', AHPW_DOMAIN ),
	'ahpw_number_of_articles' => __( 'No. of Articles:', AHPW_DOMAIN ),
	'ahpw_text_of_button'     => __( 'Text Of Button:', AHPW_DOMAIN ),
	'ahpw_button_url'         => __( 'URL Of Button:', AHPW_DOMAIN ),
];
?>

<?php foreach ( $form_fields as $field_name => $field_args ) : ?>
	<p>
		<label for="<?php echo esc_attr( $field_args->id ); ?>"><?php echo $labels[ $field_name ]; ?></label>
		<input class="widefat" id="<?php echo esc_attr( $field_args->id ); ?>"
		       name="<?php echo esc_attr( $field_args->name ); ?>" type="text"
		       value="<?php echo esc_attr( $field_args->value ); ?>">
	</p>
<?php endforeach; ?>