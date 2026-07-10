<?php
/**
 * Comments template.
 *
 * @package Doodle_Poodle
 */

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="dp-comments">
	<?php if ( have_comments() ) : ?>
		<h2 class="dp-comments__title">
			<?php
			$count = get_comments_number();
			/* translators: %s: comment count */
			printf( esc_html( _n( '%s Comment', '%s Comments', $count, 'doodle-poodle' ) ), esc_html( number_format_i18n( $count ) ) );
			?>
		</h2>

		<ol class="dp-comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>

		<?php
		the_comments_pagination(
			array(
				'prev_text' => __( '&larr; Older', 'doodle-poodle' ),
				'next_text' => __( 'Newer &rarr;', 'doodle-poodle' ),
			)
		);
	endif;

	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="dp-comments__closed"><?php esc_html_e( 'Comments are closed.', 'doodle-poodle' ); ?></p>
		<?php
	endif;

	comment_form();
	?>
</div>
