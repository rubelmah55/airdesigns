<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package airdesigns
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<!-- <header class="entry-header">
		<?php //the_title( '<h1 class="entry-title text-left fs-3 mt-0 mb-4">', '</h1>' ); ?>
	</header> -->

	<?php 
	/*
	//TODO - show only subpages
	$parents_ids   = get_post_ancestors($post->ID);
	$top_parent_id = (count($parents_ids) > 0) ? $parents_ids[count($parents_ids)-1] : $post->ID;
	show_all_children($top_parent_id, $post->ID, 1);
	*/
	?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'airdesigns' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
