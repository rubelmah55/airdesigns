<?php
/**
 * Template Name: Offset Page Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Embrace Nature
 * @since Embrace Nature 1.0
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="container">
			<?php
				while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('col-lg-10 offset-lg-1'); ?>>

                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title text-center fs-2 mt-3 mb-4">', '</h1>' ); ?>
                    </header>
                
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
                <?php				
				endwhile;
			?>
		</div>
	</main>
</div>

<?php get_footer(); ?>
