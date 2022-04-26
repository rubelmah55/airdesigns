<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Embrace Nature
 * @since Embrace Nature 1.0
 */

get_header(); ?>
    <div class="blog-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 text-center mt-3">
                    <h1><?php echo $our_title = get_the_title( get_option('page_for_posts', true) ); ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-listing">
        <div class="container">
            <div class="row mt-6 mb-6">
                <?php 
                if ( have_posts() ) { 
                    while ( have_posts() ) {
                        
                        the_post();

                        ?>
                        <div class="col-lg-4 text-center d-flex align-items-stretch">
                            <div class="card border rounded-0 m-1">
                                <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => esc_html ( get_the_title() ) ) );  ?>
                                <div class="card-body d-flex flex-column">
                                    <div class="card-date mt-2 mb-1"><?php echo get_the_date( 'd.m.Y' ); ?></div>
                                    <h6 class="card-title mb-2"><?php echo get_the_title(); ?></h6>
                                    <p class="card-text"><?php echo get_the_excerpt(); ?></p>
                                    <a href="<?php echo get_the_permalink(); ?>" class="read-more btn btn-primary mt-auto align-self-center"><?php esc_html_e( 'ПРОЧЕТИ ОЩЕ', 'airdesigns'); ?></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php

    //pagination
    $prev_text = sprintf( '%s <span class="nav-prev-text">%s</span>', '<span aria-hidden="true"><</span>', __( 'ПРЕДИШНА СТРАНИЦА', 'airdesigns' ) );
    $next_text = sprintf( '<span class="nav-next-text">%s</span> %s', __( 'СЛЕДВАЩА СТРАНИЦА', 'airdesigns' ), '<span aria-hidden="true">></span>' );
    
    $posts_pagination = get_the_posts_pagination(
        array(
            'mid_size'  => 3,
            'prev_text' => $prev_text,
            'next_text' => $next_text,
            'class'    => 'ziz-pagination'
        )
    );
    
    // If we're not outputting the previous page link, prepend a placeholder with `visibility: hidden` to take its place.
    if ( strpos( $posts_pagination, 'prev page-numbers' ) === false ) {
        $posts_pagination = str_replace( '<div class="nav-links">', '<div class="nav-links"><span class="prev page-numbers placeholder" aria-hidden="true">' . $prev_text . '</span>', $posts_pagination );
    }
    
    // If we're not outputting the next page link, append a placeholder with `visibility: hidden` to take its place.
    if ( strpos( $posts_pagination, 'next page-numbers' ) === false ) {
        $posts_pagination = str_replace( '</div>', '<span class="next page-numbers placeholder" aria-hidden="true">' . $next_text . '</span></div>', $posts_pagination );
    }
    
    if ( $posts_pagination ) { ?>
    
        <div class="pagination-wrapper section-inner text-center mb-10">
            <div class="container">
                <?php echo $posts_pagination; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- already escaped during generation. ?>
            </div>
        </div><!-- .pagination-wrapper -->
    
        <?php
    }

    get_footer();
?>