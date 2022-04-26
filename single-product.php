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


$post_fields = get_fields($post->ID);

//print_r($post_fields);

echo '
<div class="single-product">
	<div class="container">
		<div class="row justify-content-between">';

			$template = $post_fields['template'];
			if($template == 'simple'){

				echo '
				<div class="col-lg-6">';

					//Colors - gallery
					if( isset($post_fields['gallery_colors']) && !empty($post_fields['gallery_colors']) ){
						echo '
						<div class="row">';
							
							//Loop all colors
							foreach($post_fields['gallery_colors'] as $color){

								$gallery_count = 1;
								//Loop all images for a color
								foreach($color['gallery_items'] as $color_items){
									if($gallery_count == 1){

										$color_thumb = wp_get_attachment_image_src($color_items["photo"], 'large');
										echo '
										<div class="col-12">
											<img class="img-fluid" src="'.$color_thumb[0].'" width="'.$color_thumb[1].'" height="'.$color_thumb[2].'" />
										</div>
										';
										if( isset($post_fields['extras_youtube_link']) && !empty($post_fields['extras_youtube_link']) ){

											//Fallback if no video image was provided
											$extras_cover_image = wp_get_attachment_image_src($color_items["photo"], 'medium');
											if( isset($post_fields['extras_cover_image']) && !empty($post_fields['extras_cover_image']) ){
												$extras_cover_image = wp_get_attachment_image_src($color["extras_cover_image"][0]["photo"], 'medium');
											}

											echo '
											<div class="col-6">
												<a href="'.$post_fields['extras_youtube_link'].'">
													<img class="img-fluid" src="'.$extras_cover_image[0].'" width="'.$extras_cover_image[1].'" height="'.$extras_cover_image[2].'" />
													'.__( 'Product video', 'airdesigns' ).'
												</a>
											</div>
											';
										}

									
									}else{
										$color_thumb = wp_get_attachment_image_src($color_items["photo"], 'medium');
										echo '
										<div class="col-6">
											<img class="img-fluid" src="'.$color_thumb[0].'" width="'.$color_thumb[1].'" height="'.$color_thumb[2].'" />
										</div>
										';
									}
									$gallery_count++;
								}
								if( isset($post_fields['assembly_youtube_link']) && !empty($post_fields['assembly_youtube_link']) ){

									//Fallback if no assembty image was provided
									if( isset($post_fields['assembly_cover_image']) && !empty($post_fields['assembly_cover_image']) ){
										$assembly_cover_image = wp_get_attachment_image_src($color["assembly_cover_image"], 'medium');
									}else{
										$assembly_cover_image = wp_get_attachment_image_src($color['gallery_items'][0]["photo"], 'medium');
									}

									echo '
									<div class="col-6">
										<a href="'.$post_fields['assembly_youtube_link'].'">
											<img class="img-fluid" src="'.$assembly_cover_image[0].'" width="'.$assembly_cover_image[1].'" height="'.$assembly_cover_image[2].'" />
											'.__( 'How to assemble the product', 'airdesigns' ).'
										</a>
									</div>
									';
								}

							}
							echo '
						</div>';
					}

					echo '
				</div>
				<div class="col-lg-6">';

					//get brand
					$brands_list = get_the_terms( $post->ID, 'product_brand' );
					if( isset($brands_list) && !empty($brands_list) ){
						foreach($brands_list as $brand){
							$brand_logo = get_field("brand_logo", "product_brand_".$brand->term_id);
							echo '<a href="'.get_term_link($brand->term_id).'" title="'.$brand->name.'">'.$brand_logo."</a>";
						}
					}

					//title
					the_title( '<h1 class="entry-title">', '</h1>' );
					
					//SKU
					if( isset($post_fields['sku']) && !empty($post_fields['sku']) ){
						echo '#'.$post_fields['sku'];
					}

					//Short description
					if( isset($post_fields['description_short']) && !empty($post_fields['description_short']) ){
						echo '<p>'.$post_fields['description_short'].'</p>';
					}

					//Colors - navigation
					if( isset($post_fields['gallery_colors']) && !empty($post_fields['gallery_colors']) ){
						echo '
						<div class="row">
							<div class="col">
								<strong>Цвят</strong>: '.$post_fields['gallery_colors'][0]['gallery_color'].'
							</div>
						</div>
						<div class="row">';
							foreach($post_fields['gallery_colors'] as $color){
								$color_thumb = wp_get_attachment_image_src($color["gallery_items"][0]["photo"], 'thumbnail');
								echo '
								<div class="col">
									<img src="'.$color_thumb[0].'" width="'.$color_thumb[1].'" height="'.$color_thumb[2].'" />
								</div>
								';
							}
							echo '
						</div>';
					}

					//Collapsable content
					if( (isset($post_fields['description_content']) && !empty($post_fields['description_content'])) || (isset($post_fields['benefits_content']) && !empty($post_fields['benefits_content']))   ){
						if( isset($post_fields['description_content']) && !empty($post_fields['description_content']) ){
							echo '<p class="text-uppercase">'.__( 'Product description', 'airdesigns' )."</p>";
							echo $post_fields['description_content'];
						}
						if( isset($post_fields['benefits_content']) && !empty($post_fields['benefits_content']) ){
							echo '<p class="mt-3 text-uppercase">'.__( 'Product details', 'airdesigns' )."</p>";
							echo $post_fields['benefits_content'];
						}
					}

					echo '
					
				</div>
				';

			}elseif($template == 'advanced'){

				if( isset($post_fields['description_content']) && !empty($post_fields['description_content']) ){
					echo '
					<div class="row">';
						$product_tumbnail = get_the_post_thumbnail_url($post->ID, 'large');
						if( isset($product_tumbnail) && !empty($product_tumbnail) ){
							echo '
							<div class="col-6">
								<img src="'.$product_tumbnail.'" />
							</div>
							<div class="col-6">';
								echo '<h1>'.get_the_title($post->ID).'</h1>';
								echo $post_fields['description_content'];
								echo '
							</div>
							';
						}else{
							echo '
							<div class="col-12">';
								echo '<h1>'.get_the_title($post->ID).'</h1>';

								echo $post_fields['description_content'];
								echo '
							</div>
							';
						}
						echo '
					</div>';
				}

				if( isset($post_fields['benefits_content']) && !empty($post_fields['benefits_content']) ){
					echo '
					<div class="row">';
						$benefits_image = wp_get_attachment_image_src($post_fields['benefits_image'], 'large');
						if( isset($benefits_image) && !empty($benefits_image) ){
							echo '
							<div class="col-6">';
								echo '<strong>'.__( 'Benefits', 'airdesigns' ).'</strong>';
								echo $post_fields['benefits_content'];
								echo '
							</div>
							<div class="col-6">
								<img src="'.$benefits_image.'" />
							</div>
							';
						}else{
							echo '
							<div class="col-12">';
								echo '<h2>'.__( 'Benefits', 'airdesigns' ).'</h2>';

								echo $post_fields['benefits_content'];
								echo '
							</div>
							';
						}
						echo '
					</div>';
				}

				if( isset($post_fields['technical_details']) && !empty($post_fields['technical_details']) ){
					echo '
					<div class="row">
						<div class="col-12">';
							echo '<h2>'.__( 'Technical details', 'airdesigns' ).'</h2>';

							echo $post_fields['technical_details'];
							echo '
						</div>
					</div>';
				}

				if( isset($post_fields['gallery_colors']) && !empty($post_fields['gallery_colors']) ){
					echo '
					<div class="row">
						<div class="col-12">';
							echo '<h2>'.__( 'Colors', 'airdesigns' ).'</h2>';
							echo '
						</div>
					</div>

					<div class="row">';
						//Colors - navigation
						foreach($post_fields['gallery_colors'] as $color){
							$color_thumb = wp_get_attachment_image_src($color["gallery_items"][0]["photo"], 'thumbnail');
							echo '
							<div class="col">
								<img src="'.$color_thumb[0].'" width="'.$color_thumb[1].'" height="'.$color_thumb[2].'" />
							</div>
							';
						}
						echo '
					</div>

					<div class="row">';
						
						//Loop all colors
						foreach($post_fields['gallery_colors'] as $color){

							//Loop all images for a color
							foreach($color['gallery_items'] as $color_items){
								$color_thumb = wp_get_attachment_image_src($color_items["photo"], 'medium');
								echo '
								<div class="col-6">
									<img class="img-fluid" src="'.$color_thumb[0].'" width="'.$color_thumb[1].'" height="'.$color_thumb[2].'" />
								</div>
								';
							}

						}
						echo '
					</div>';
				}

				if( isset($post_fields['extras_content']) && !empty($post_fields['extras_content']) ){
					echo '
					<div class="row">';
						if( isset($post_fields['extras_youtube_link']) && !empty($post_fields['extras_youtube_link']) ){

							if( isset($post_fields['extras_cover_image']) && !empty($post_fields['extras_cover_image']) ){
								$extras_cover_image = wp_get_attachment_image_src($post_fields['extras_cover_image'], 'medium');
							}else{
								$extras_cover_image = wp_get_attachment_image_src($post_fields['gallery_colors'][0]["gallery_items"][0]["photo"], 'medium');
							}
							
							echo '
							<div class="col-6">
								<a href="'.$post_fields['extras_youtube_link'].'">
									<img src="'.$extras_cover_image[0].'" width="'.$extras_cover_image[1].'" height="'.$extras_cover_image[2].'" />
								</a>
							</div>
							<div class="col-6">';
								echo '<strong>'.__( 'Benefits', 'airdesigns' ).'</strong>';
								echo $post_fields['extras_content'];
								echo '
							</div>
							';
						}else{
							echo '
							<div class="col-12">';
								echo '<h2>'.__( 'Benefits', 'airdesigns' ).'</h2>';

								echo $post_fields['extras_content'];
								echo '
							</div>
							';
						}
						echo '
					</div>';
				}


				$convenience_children_status = 0;
				$convenience_parents_status = 0;
				if( isset($post_fields['convenience_children']) && !empty($post_fields['convenience_children']) ){
					$convenience_children_status = 1;
				}
				if( isset($post_fields['convenience_parents']) && !empty($post_fields['convenience_parents']) ){
					$convenience_parents_status = 1;
				}	
				if( $convenience_children_status && $convenience_parents_status ){
					//both sections are available
					echo '
					<div class="row">
						<div class="col-6">';
							echo '<h2>'.__( 'Convenience for children', 'airdesigns' ).'</h2>';
							echo $post_fields['convenience_children'];
							echo '
						</div>
						<div class="col-6">';
							echo '<h2>'.__( 'Convenience for parents', 'airdesigns' ).'</h2>';
							echo $post_fields['convenience_parents'];
							echo '
						</div>
					</div>';
				}elseif( $convenience_children_status && !$convenience_parents_status ){
					//only the children section is available
					echo '
					<div class="row">
						<div class="col-12">';
							echo '<h2>'.__( 'Convenience for children', 'airdesigns' ).'</h2>';
							echo $post_fields['convenience_children'];
							echo '
						</div>
					</div>';
				}elseif( !$convenience_children_status && $convenience_parents_status ){
					//only the parents section is available
					echo '
					<div class="row">
						<div class="col-12">';
							echo '<h2>'.__( 'Convenience for parents', 'airdesigns' ).'</h2>';
							echo $post_fields['convenience_parents'];
							echo '
						</div>
					</div>';
				}


				if( isset($post_fields['accessories_content']) && !empty($post_fields['accessories_content']) ){
					echo '
					<div class="row">';

						if( isset($post_fields['accessories_images']) && !empty($post_fields['accessories_images']) ){
							echo '
							<div class="col-6">';
								echo '<h2>'.__( 'Benefits', 'airdesigns' ).'</h2>';
								echo $post_fields['accessories_content'];
								echo '
							</div>
							<div class="col-6">
								<div class="row">';
									foreach($post_fields['accessories_images'] as $accessories_gallery_item){
										$accessories_gallery_item_image = wp_get_attachment_image_src($accessories_gallery_item['accessories_gallery_item'], 'thumbnail');
										echo '
										<div class="col-4">
											<img src="'.$accessories_gallery_item_image[0].'" width="'.$accessories_gallery_item_image[0].'" height="'.$accessories_gallery_item_image[1].'" />
										</div>';
									}
									echo '
								</div>
							</div>
							';
						}else{
							echo '
							<div class="col-12">';
								echo '<h2>'.__( 'Benefits', 'airdesigns' ).'</h2>';
								echo $post_fields['accessories_content'];
								echo '
							</div>
							';
						}
						echo '
					</div>';
				}

				if( isset($post_fields['assembly_youtube_link']) && !empty($post_fields['assembly_youtube_link']) ){
					echo '
					<div class="row">';

						if( isset($post_fields['assembly_cover_image']) && !empty($post_fields['assembly_cover_image']) ){
							$assembly_cover_image = wp_get_attachment_image_src($post_fields['assembly_cover_image'], 'large');
						}else{
							$assembly_cover_image = wp_get_attachment_image_src($post_fields['gallery_colors'][0]["gallery_items"][0]["photo"], 'large');
						}
						
						echo '
						<div class="col-6  offset-3">
							<a href="'.$post_fields['extras_youtube_link'].'">
								<img class="img-fluid" src="'.$assembly_cover_image[0].'" width="'.$assembly_cover_image[1].'" height="'.$assembly_cover_image[2].'" />
							</a>
						</div>
						';

						echo '
					</div>';
				}

			}
			echo '
		</div>
	</div>
</div>
';

//TODO - SUGGESTIONS

?>
<div class="related-product">
	<h1 class="text-center"><?php _e( 'Other suggestions', 'airdesigns' ); ?></h1>
	<div class="wrapper-container container">
		<div class="entry_content row">
			<?php foreach ($posts as $post) {?>
				<div class="post_card col-md-4 mb-5">
					<div class="post-item">
						<a href="<?php echo get_the_permalink($post->ID) ?>"><div class="post_thumbnail"><?php echo get_the_post_thumbnail($post->ID, 'medium') ?></div> 
							<div class="post-content">
								<div class="post_product_label"><?php echo get_post_meta($post->ID, 'product_label', true) ?></div>
								<div class="post_permalink"><a href="<?php echo get_the_permalink() ?>">Read More</a></div>
								<div class="post_title"><a href="<?php echo get_the_permalink($post->ID) ?>"><?php echo get_the_title(); ?></a></div>
								<div class="post_sku"><?php echo get_post_meta($post->ID, 'sku', true); ?></div>
								<div class="nav-previous alignleft"><?php next_posts_link('Older posts');?></div>
								<div class="nav-previous alignleft"><?php previous_posts_link('Older posts');?></div>
							</div>
						</a>
					</div>
				</div>
			<?php }?>
		</div>
	</div>
</div>
<?php
get_footer();
?>