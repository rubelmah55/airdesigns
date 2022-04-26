<?php

get_header();

//get url variables
$current_relative_url = $_SERVER['REDIRECT_URL'];
$current_query = array();
parse_str($_SERVER['QUERY_STRING'],$current_query);

//get current category
$category = get_queried_object();

//get fitlers data
$terms_categories = get_terms(array(
	'taxonomy' => 'product_categories',
	'hide_empty' => true,
));
$terms_genders = get_terms(array(
	'taxonomy' => 'product_gender',
	'hide_empty' => true,
));
$terms_ages = get_terms(array(
	'taxonomy' => 'product_age',
	'hide_empty' => true,
));
$terms_types = get_terms(array(
	'taxonomy' => 'product_type',
	'hide_empty' => true,
));
$terms_colors = get_terms(array(
	'taxonomy' => 'product_color',
	'hide_empty' => true,
));
$terms_brands = get_terms(array(
	'taxonomy' => 'product_brand',
	'hide_empty' => true,
));

//match applied filters
$filter_gender = '';
if( isset($_GET['gender']) && !empty($_GET['gender']) ){
	foreach($terms_genders as $terms_gender){
		if($_GET['gender'] == $terms_gender->slug){
			$filter_gender = $terms_gender->slug;
		}
	}
}
$filter_age = '';
if( isset($_GET['age']) && !empty($_GET['age']) ){
	foreach($terms_ages as $terms_age){
		if($_GET['age'] == $terms_age->slug){
			$filter_age = $terms_age->slug;
		}
	}
}
$filter_type = '';
if( isset($_GET['type']) && !empty($_GET['type']) ){
	foreach($terms_types as $terms_type){
		if($_GET['type'] == $terms_type->slug){
			$filter_type = $terms_type->slug;
		}
	}
}
$filter_color = '';
if( isset($_GET['color']) && !empty($_GET['color']) ){
	foreach($terms_colors as $terms_color){
		if($_GET['color'] == $terms_color->slug){
			$filter_color = $terms_color->slug;
		}
	}
}
$filter_brand = '';
if( isset($_GET['brand']) && !empty($_GET['brand']) ){
	foreach($terms_brands as $terms_brand){
		if($_GET['brand'] == $terms_brand->slug){
			$filter_brand = $terms_brand->slug;
		}
	}
}

$sortin_options = array('default','a-z','z-a');
$sorting = 'default';
if( isset($_GET['sorting']) && !empty($_GET['sorting']) ){
	foreach($sortin_options as $sortin_option){
		if($_GET['sorting'] == $sortin_option){
			$sorting = $sortin_option;
		}
	}
}


//Apply main fitler - by category
$filters_query["relation"] = 'AND';
$filters_query[0]["taxonomy"] = 'product_categories';
$filters_query[0]["field"] = 'id';
$filters_query[0]["terms"] = array($category->term_id);
$filters_count = 1;

//Apply conditional fitlers
if( !empty($filter_gender) ){
	$filters_query[$filters_count]["taxonomy"] = 'product_gender';
	$filters_query[$filters_count]["field"] = 'slug';
	$filters_query[$filters_count]["terms"] = array($filter_gender);
	$filters_count++;
}
if( !empty($filter_age) ){
	$filters_query[$filters_count]["taxonomy"] = 'product_age';
	$filters_query[$filters_count]["field"] = 'slug';
	$filters_query[$filters_count]["terms"] = array($filter_age);
	$filters_count++;
}
if( !empty($filter_type) ){
	$filters_query[$filters_count]["taxonomy"] = 'product_type';
	$filters_query[$filters_count]["field"] = 'slug';
	$filters_query[$filters_count]["terms"] = array($filter_type);
	$filters_count++;
}
if( !empty($filter_color) ){
	$filters_query[$filters_count]["taxonomy"] = 'product_color';
	$filters_query[$filters_count]["field"] = 'slug';
	$filters_query[$filters_count]["terms"] = array($filter_color);
	$filters_count++;
}
if( !empty($filter_brand) ){
	$filters_query[$filters_count]["taxonomy"] = 'product_brand';
	$filters_query[$filters_count]["field"] = 'slug';
	$filters_query[$filters_count]["terms"] = array($filter_brand);
	$filters_count++;
}

//Get products
$args = array(
	'post_type' => 'product',
	'numberposts' => 12,
	'paged' => get_query_var('page'),
    'tax_query' => array($filters_query)
);

//Apply sorting
if( !empty($sorting) ){
	if($sorting == 'a-z'){
		$args['order'] = 'ASC';
		$args['orderby'] = 'title';

	}elseif($sorting == 'a-a'){
		$args['order'] = 'DESC';
		$args['orderby'] = 'title';
	}else{
		//default sorting
		$args['order'] = 'ASC';
		$args['orderby'] = 'menu_order';
	}
}else{
	//default sorting
	$args['order'] = 'ASC';
	$args['orderby'] = 'menu_order';
}

$posts = get_posts($args);

//Other variables
$active_class = '';


?>


<div class="container">
	<div class="row">
		<div class="col pt-4 pb-5 text-center"><h1 class="fs-2"><?php echo $category->name ?></h1></div>
	</div>

	<div class="row filter_products border-bottom border-gray pb-1">
		<div class="col-9 filters">
			
			<?php 

			if (!empty($terms_categories)) {
				echo '
				<div class="btn-group">
					<a class="btn btn-outline-primary border-0 btn-sm dropdown-toggle" href="#" role="button" id="filter_brand" data-bs-toggle="dropdown" aria-expanded="false">'.$category->name.'</a>
					<ul class="dropdown-menu py-0" aria-labelledby="filter_brand">';
						foreach ($terms_categories as $terms_category) {
							$active_class = '';
							if($category->term_id == $terms_category->term_id){
								$active_class = 'active ';
							}
							echo '<li><a class="'.$active_class.'dropdown-item" href="'.get_term_link($terms_category).'">'.$terms_category->name.'</a></li>';
						}
						echo '
					</ul>
				</div>';
			}

			if (!empty($terms_genders)) {

				echo '
				<div class="btn-group">
					<a class="btn btn-outline-primary border-0 btn-sm dropdown-toggle" href="#" role="button" id="fitler_gender" data-bs-toggle="dropdown" aria-expanded="false">'.esc_html__('Gender', 'airdesigns').'</a>
					<ul class="dropdown-menu py-0" aria-labelledby="fitler_gender">';

						$active_class = '';
						$filter_url = '?';
						foreach($current_query as $current_query_key => $current_query_item){
							if($current_query_key != 'gender'){
								$filter_url .= $current_query_key.'='.$current_query_item.'&';
							}
						}
						$filter_url = substr($filter_url, 0, -1);
						echo '<li><a class="'.$active_class.'dropdown-item" href="'.$current_relative_url.$filter_url.'">'.esc_html__('All', 'airdesigns').'</a></li>';

						foreach ($terms_genders as $terms_gender) {
							$active_class = '';
							if( !empty($filter_gender) ){
								if($filter_gender == $terms_gender->slug){
									$active_class = 'active ';
								}
							}

							$filter_url = '?';
							foreach($current_query as $current_query_key => $current_query_item){
								if($current_query_key != 'gender'){
									$filter_url .= $current_query_key.'='.$current_query_item.'&';
								}
							}
							$filter_url .= 'gender='.$terms_gender->slug;
							echo '<li><a class="'.$active_class.'dropdown-item" href="'.$current_relative_url.$filter_url.'">'.$terms_gender->name.'</a></li>';
						}
						echo '
					</ul>
				</div>';
			}

			if (!empty($terms_ages)) {

				echo '
				<div class="btn-group">
					<a class="btn btn-outline-primary border-0 btn-sm dropdown-toggle" href="#" role="button" id="fitler_age" data-bs-toggle="dropdown" aria-expanded="false">'.esc_html__('Age', 'airdesigns').'</a>
					<ul class="dropdown-menu py-0" aria-labelledby="fitler_age">';

						$active_class = '';
						$filter_url = '?';
						foreach($current_query as $current_query_key => $current_query_item){
							if($current_query_key != 'age'){
								$filter_url .= $current_query_key.'='.$current_query_item.'&';
							}
						}
						$filter_url = substr($filter_url, 0, -1);
						echo '<li><a class="'.$active_class.'dropdown-item" href="'.$current_relative_url.$filter_url.'">'.esc_html__('All', 'airdesigns').'</a></li>';

						foreach ($terms_ages as $terms_age) {
							$active_class = '';
							if( !empty($filter_age) ){
								if($filter_age == $terms_age->slug){
									$active_class = 'active ';
								}
							}

							$filter_url = '?';
							foreach($current_query as $current_query_key => $current_query_item){
								if($current_query_key != 'age'){
									$filter_url .= $current_query_key.'='.$current_query_item.'&';
								}
							}
							$filter_url .= 'age='.$terms_age->slug;
							echo '<li><a class="'.$active_class.'dropdown-item" href="'.$current_relative_url.$filter_url.'">'.$terms_age->name.'</a></li>';
						}
						echo '
					</ul>
				</div>';
			}

			if (!empty($terms_types)) {

				echo '
				<div class="btn-group">
					<a class="btn btn-outline-primary border-0 btn-sm dropdown-toggle" href="#" role="button" id="fitler_type" data-bs-toggle="dropdown" aria-expanded="false">'.esc_html__('Type', 'airdesigns').'</a>
					<ul class="dropdown-menu py-0" aria-labelledby="fitler_type">';

						$active_class = '';
						$filter_url = '?';
						foreach($current_query as $current_query_key => $current_query_item){
							if($current_query_key != 'type'){
								$filter_url .= $current_query_key.'='.$current_query_item.'&';
							}
						}
						$filter_url = substr($filter_url, 0, -1);
						echo '<li><a class="'.$active_class.'dropdown-item" href="'.$current_relative_url.$filter_url.'">'.esc_html__('All', 'airdesigns').'</a></li>';

						foreach ($terms_types as $terms_type) {
							$active_class = '';
							if( !empty($filter_type) ){
								if($filter_type == $terms_type->slug){
									$active_class = 'active ';
								}
							}

							$filter_url = '?';
							foreach($current_query as $current_query_key => $current_query_item){
								if($current_query_key != 'type'){
									$filter_url .= $current_query_key.'='.$current_query_item.'&';
								}
							}
							$filter_url .= 'type='.$terms_type->slug;
							echo '<li><a class="'.$active_class.'dropdown-item" href="'.$current_relative_url.$filter_url.'">'.$terms_type->name.'</a></li>';
						}
						echo '
					</ul>
				</div>';
			}

			if (!empty($terms_colors)) {

				echo '
				<div class="btn-group">
					<a class="btn btn-outline-primary border-0 btn-sm dropdown-toggle" href="#" role="button" id="fitler_color" data-bs-toggle="dropdown" aria-expanded="false">'.esc_html__('Color', 'airdesigns').'</a>
					<ul class="dropdown-menu py-0" aria-labelledby="fitler_color">';

						$active_class = '';
						$filter_url = '?';
						foreach($current_query as $current_query_key => $current_query_item){
							if($current_query_key != 'color'){
								$filter_url .= $current_query_key.'='.$current_query_item.'&';
							}
						}
						$filter_url = substr($filter_url, 0, -1);
						echo '<li><a class="'.$active_class.'dropdown-item" href="'.$current_relative_url.$filter_url.'">'.esc_html__('All', 'airdesigns').'</a></li>';

						foreach ($terms_colors as $terms_color) {
							$active_class = '';
							if( !empty($filter_color) ){
								if($filter_color == $terms_color->slug){
									$active_class = 'active ';
								}
							}

							$filter_url = '?';
							foreach($current_query as $current_query_key => $current_query_item){
								if($current_query_key != 'color'){
									$filter_url .= $current_query_key.'='.$current_query_item.'&';
								}
							}
							$filter_url .= 'color='.$terms_color->slug;
							echo '<li><a class="'.$active_class.'dropdown-item" href="'.$current_relative_url.$filter_url.'">'.$terms_color->name.'</a></li>';
						}
						echo '
					</ul>
				</div>';
			}

			if (!empty($terms_brands)) {

				echo '
				<div class="btn-group">
					<a class="btn btn-outline-primary border-0 btn-sm dropdown-toggle" href="#" role="button" id="fitler_brand" data-bs-toggle="dropdown" aria-expanded="false">'.esc_html__('Brand', 'airdesigns').'</a>
					<ul class="dropdown-menu py-0" aria-labelledby="fitler_brand">';

						$active_class = '';
						$filter_url = '?';
						foreach($current_query as $current_query_key => $current_query_item){
							if($current_query_key != 'brand'){
								$filter_url .= $current_query_key.'='.$current_query_item.'&';
							}
						}
						$filter_url = substr($filter_url, 0, -1);
						echo '<li><a class="'.$active_class.'dropdown-item" href="'.$current_relative_url.$filter_url.'">'.esc_html__('All', 'airdesigns').'</a></li>';

						foreach ($terms_brands as $terms_brand) {
							$active_class = '';
							if( !empty($filter_brand) ){
								if($filter_brand == $terms_brand->slug){
									$active_class = 'active ';
								}
							}

							$filter_url = '?';
							foreach($current_query as $current_query_key => $current_query_item){
								if($current_query_key != 'brand'){
									$filter_url .= $current_query_key.'='.$current_query_item.'&';
								}
							}
							$filter_url .= 'brand='.$terms_brand->slug;

							echo '<li><a class="'.$active_class.'dropdown-item" href="'.$current_relative_url.$filter_url.'">'.$terms_brand->name.'</a></li>';
						}
						echo '
					</ul>
				</div>';
			}

			?>
		</div>

		<div class="col-3 sorting text-end">
			<div class="product_count d-inline-block text-uppercase me-1">
				<?php echo count($posts); ?> <?php esc_html_e( 'products', 'airdesigns'); ?>
			</div>
			<div class="product_sort d-inline-block">
				<?php 
				echo '
				<div class="btn-group">
					<a class="btn btn-outline-primary border-0 btn-sm dropdown-toggle" href="#" role="button" id="fitler_brand" data-bs-toggle="dropdown" aria-expanded="false">'.esc_html__('Sort by', 'airdesigns').'</a>
					<ul class="dropdown-menu py-0 dropdown-menu-end" aria-labelledby="fitler_brand">';

						foreach($sortin_options as $sortin_option){

							$active_class = '';
							if( !empty($sorting) ){
								if($sorting == $sortin_option){
									$active_class = 'active ';
								}
							}
							
							$filter_url = '?';
							foreach($current_query as $current_query_key => $current_query_item){
								if($current_query_key != 'sorting'){
									$filter_url .= $current_query_key.'='.$current_query_item.'&';
								}
							}
							$filter_url = substr($filter_url, 0, -1);



							if($sortin_option == 'default'){
								echo '<li><a class="'.$active_class.'dropdown-item" href="'.$current_relative_url.$filter_url.'">'.esc_html__('Default', 'airdesigns').'</a></li>';
							}else{

								if( empty($filter_url) ){
									$filter_url = '?sorting=';
								}else{
									$filter_url .= '&sorting=';
								}

								echo '<li><a class="'.$active_class.'dropdown-item text-uppercase" href="'.$current_relative_url.$filter_url.$sortin_option.'">'.esc_html__($sortin_option, 'airdesigns').'</a></li>';
							}
						}


						echo '
					</ul>
				</div>';
				?>
			</div>
		</div>

	</div>

	<?php 
	//Show applied filters
	if( !empty($current_query) ){
		echo '
		<div class="row">
			<div class="col applied_filters mt-2">';
				foreach($current_query as $key => $item){
					if($key == 'gender'){
						foreach($terms_genders as $terms_gender){
							if($terms_gender->slug == $item){
								$filter_url = '?';
								foreach($current_query as $current_query_key => $current_query_item){
									if($current_query_key != 'gender'){
										$filter_url .= $current_query_key.'='.$current_query_item.'&';
									}
								}
								$filter_url = substr($filter_url, 0, -1);
								echo '<a class="btn btn-sm border-1 btn-outline-primary me-1" href="'.$current_relative_url.$filter_url.'">'.$terms_gender->name.' <svg class="close" width="10" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g data-name="02 User"><path fill="currentColor" d="M25 512a25 25 0 0 1-17.68-42.68l462-462a25 25 0 0 1 35.36 35.36l-462 462A24.93 24.93 0 0 1 25 512z"/><path fill="currentColor" d="M487 512a24.93 24.93 0 0 1-17.68-7.32l-462-462A25 25 0 0 1 42.68 7.32l462 462A25 25 0 0 1 487 512z"/></g></svg></a>';
							}
						}
					}
					if($key == 'age'){
						foreach($terms_ages as $terms_age){
							if($terms_age->slug == $item){
								$filter_url = '?';
								foreach($current_query as $current_query_key => $current_query_item){
									if($current_query_key != 'age'){
										$filter_url .= $current_query_key.'='.$current_query_item.'&';
									}
								}
								$filter_url = substr($filter_url, 0, -1);
								echo '<a class="btn btn-sm border-1 btn-outline-primary me-1" href="'.$current_relative_url.$filter_url.'">'.$terms_age->name.' <svg class="close" width="10" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g data-name="02 User"><path fill="currentColor" d="M25 512a25 25 0 0 1-17.68-42.68l462-462a25 25 0 0 1 35.36 35.36l-462 462A24.93 24.93 0 0 1 25 512z"/><path fill="currentColor" d="M487 512a24.93 24.93 0 0 1-17.68-7.32l-462-462A25 25 0 0 1 42.68 7.32l462 462A25 25 0 0 1 487 512z"/></g></svg></a></a>';
							}
						}
					}
					if($key == 'type'){
						foreach($terms_types as $terms_type){
							if($terms_type->slug == $item){
								$filter_url = '?';
								foreach($current_query as $current_query_key => $current_query_item){
									if($current_query_key != 'type'){
										$filter_url .= $current_query_key.'='.$current_query_item.'&';
									}
								}
								$filter_url = substr($filter_url, 0, -1);
								echo '<a class="btn btn-sm border-1 btn-outline-primary me-1" href="'.$current_relative_url.$filter_url.'">'.$terms_type->name.' <svg class="close" width="10" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g data-name="02 User"><path fill="currentColor" d="M25 512a25 25 0 0 1-17.68-42.68l462-462a25 25 0 0 1 35.36 35.36l-462 462A24.93 24.93 0 0 1 25 512z"/><path fill="currentColor" d="M487 512a24.93 24.93 0 0 1-17.68-7.32l-462-462A25 25 0 0 1 42.68 7.32l462 462A25 25 0 0 1 487 512z"/></g></svg></a></a>';
							}
						}
					}
					if($key == 'color'){
						foreach($terms_colors as $terms_color){
							if($terms_color->slug == $item){
								$filter_url = '?';
								foreach($current_query as $current_query_key => $current_query_item){
									if($current_query_key != 'color'){
										$filter_url .= $current_query_key.'='.$current_query_item.'&';
									}
								}
								$filter_url = substr($filter_url, 0, -1);
								echo '<a class="btn btn-sm border-1 btn-outline-primary me-1" href="'.$current_relative_url.$filter_url.'">'.$terms_color->name.' <svg class="close" width="10" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g data-name="02 User"><path fill="currentColor" d="M25 512a25 25 0 0 1-17.68-42.68l462-462a25 25 0 0 1 35.36 35.36l-462 462A24.93 24.93 0 0 1 25 512z"/><path fill="currentColor" d="M487 512a24.93 24.93 0 0 1-17.68-7.32l-462-462A25 25 0 0 1 42.68 7.32l462 462A25 25 0 0 1 487 512z"/></g></svg></a></a>';
							}
						}
					}
					if($key == 'brand'){
						foreach($terms_brands as $terms_brand){
							if($terms_brand->slug == $item){
								$filter_url = '?';
								foreach($current_query as $current_query_key => $current_query_item){
									if($current_query_key != 'brand'){
										$filter_url .= $current_query_key.'='.$current_query_item.'&';
									}
								}
								$filter_url = substr($filter_url, 0, -1);
								echo '<a class="btn btn-sm border-1 btn-outline-primary me-1" href="'.$current_relative_url.$filter_url.'">'.$terms_brand->name.' <svg class="close" width="10" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g data-name="02 User"><path fill="currentColor" d="M25 512a25 25 0 0 1-17.68-42.68l462-462a25 25 0 0 1 35.36 35.36l-462 462A24.93 24.93 0 0 1 25 512z"/><path fill="currentColor" d="M487 512a24.93 24.93 0 0 1-17.68-7.32l-462-462A25 25 0 0 1 42.68 7.32l462 462A25 25 0 0 1 487 512z"/></g></svg></a></a>';
							}
						}
					}
				}
				echo '
			</div>
		</div>';
	}
	?>


	<div class="entry_content row mt-3">  
		<?php 
		foreach ($posts as $post) {

			$brands_list = get_the_terms( $post->ID, 'product_brand' );
			$brands_string = join(', ', wp_list_pluck($brands_list, 'name'));

			echo ' 
			<div class="col-md-4">
				<div class="card product_card px-1 mb-5 border-0">
				
					<div class="product_card_image" style="background-image: url('.get_the_post_thumbnail_url($post->ID, 'medium').');"></div>
					<div class="post-content">
						<div class="product_card_brand text-uppercase mt-3 mb-1">'.$brands_string.'</div>
						<div class="product_card_title fw-bold"><a href="'.get_the_permalink($post->ID).'">'.get_the_title().'</a></div>
						<div class="product_card_sku my-3">'.get_post_meta($post->ID, 'sku', true).'</div>
						<div class="product_card_icon"><a href="'.get_the_permalink($post->ID).'"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 362.1 362.1" xml:space="preserve"><path fill="currentColor" d="M179.7 74.1h4.2c5.4.4 10.7.8 16.1 1.3 24.9 2.2 48.4 9.6 70.6 21 31.7 16.2 57.9 39.2 80.4 66.6 4.1 5 7.4 10.7 11.1 16.1v5.6c-1.1 2.1-1.8 4.4-3.2 6.2-24.5 32.1-53.5 59-89.8 77.3-21.6 10.9-44.5 17.9-68.7 20.1-5.5.5-10.9.9-16.4 1.4h-4.2c-5.4-.4-10.7-.8-16.1-1.3-24.9-2.2-48.4-9.6-70.6-21-31.7-16.2-57.9-39.2-80.4-66.6-4.1-5-7.4-10.7-11.1-16.1v-5.6c1.1-2.1 1.8-4.4 3.2-6.2 24.5-32.1 53.5-59 89.8-77.3 21.6-10.9 44.5-17.9 68.7-20.1 5.5-.6 10.9-1 16.4-1.4zm1.2 32c-42.5.6-75.4 34.9-74.8 77.9.5 40.5 35.5 74.2 76.3 73.6 42.7-.6 75.8-34.9 75.2-77.9-.6-40.7-35.5-74.2-76.7-73.6z"/><path fill="currentColor" d="M222.6 181.9c-.2 22.6-18.9 40.9-41.6 40.7-22.1-.2-40.1-18.8-40-41.1.1-22.3 18.8-40.6 41.4-40.5 22.2.1 40.4 18.6 40.2 40.9z"/></svg></a></div>
					</div>
					<div class="product_card_overlay">
						<a class="btn btn-primary" href="'.get_the_permalink($post->ID).'">'.__( 'View', 'airdesigns' ).'</a>
						<div class="product_card_overlay_bg"></div>
					</div>
					
				
				</div>
			</div>
			';
		}
		?>
		</div>
		<nav class="pagination"><?php pagination_bar();?></nav>
	</div>


</div>

<?php get_footer();?>
