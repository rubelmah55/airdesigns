<?php
/*
Template Name: Support
Template Post Type: page
*/

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="container">

			<div class="row">
                <div class="row">
                    <div class="col-12">
                        <?php if( function_exists('yoast_breadcrumb' )){ yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
                    </div>
                </div>
            </div>

			<div class="row mt-4">
				<div class="col-lg-3 col-sm-12">
					<div class="support_sidebar p-3">
						<h4 class="mb-0 pb-0"><?php _e( 'Съпорт', 'airdesigns' ) ?></h4>
						<?php 
		                    echo '<div class="">';
		                    echo  wp_nav_menu( array(
		                        'menu' => 'Support',
		                        'container'      => false,
		                        'menu_class'     => 'nav nav-pills nav-fill list-group',
		                        'fallback_cb'    => '__return_false',
		                        'items_wrap'     => '<ul id="%1$s" class="%2$s py-1">%3$s</ul>',
		                        'depth'          => 2,
		                        'walker'         => new wp_bootstrap_navwalker()
		                        ));
		                    echo '</div>';
						?>
					</div>

				</div>
				<div class="col-lg-9 col-sm-12">
					<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'page-support' );				
						endwhile;
					?>
				</div>
			</div>
		</div>
	</main>
</div>

<?php
//get_sidebar();
get_footer();
