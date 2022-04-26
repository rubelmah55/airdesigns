<?php
/**
 * The single post template file
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

get_header(); 

if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb( '<p id="breadcrumbs" class="container">','</p>' );
}
?>
    <div class="blog-single-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 mt-3">
                    <?php the_title( '<h1 class="entry-title text-center">', '</h1>' ); ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();
?>