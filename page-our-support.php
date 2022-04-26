<?php
/*
Template Name: Our Support Page
Template Post Type: page
*/

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title text-center fs-3 mt-3 mb-6">', '</h1>' ); ?>
        </header>
		<div class="container">
			<div class="row">
            <?php
                $page_id = get_the_ID();
                $args = array(
                    'post_type'      => 'page',
                    'posts_per_page' => -1,
                    'post_parent'    => $page_id,
                    'order'          => 'ASC',
                    'orderby'        => 'menu_order'
                );
                $parent = new WP_Query( $args );
                if ( $parent->have_posts() ) { 
                    while ( $parent->have_posts() ) { 
                    $parent->the_post(); ?>
                    <div class="col-xl-4 col-md-6 col-12 mb-3">
                        <div class="single-products-cat-card">
                            <?php 
                                $post_img = get_the_post_thumbnail_url();
                                printf('<div class="product-cat-thumb" style="background-image: url(%s)"></div>', $post_img);
                                printf('<div class="product-cat-name"><h4><a href="%s">%s</a></h4></div>', get_permalink(), get_the_title());
                            ?>
                        </div>
                    </div>
                <?php } 
                } 
                wp_reset_postdata(); ?>
			</div>
		</div>
	</main>
</div>

<?php
//get_sidebar();
get_footer();