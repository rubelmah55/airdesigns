<?php
/*
Template Name: Front Page

*/
get_header(); ?>

    <div class="hero-product-wrapper">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-6 col-12">
                    <?php 
                        $banner = get_field('banner');

                        if(!empty($banner['left_image'])){
                            printf('<div class="product-img-wrapper" style="background-image: url(%s)"></div>', $banner['left_image']);
                        }
                     ?>
                    
                </div>
                <div class="col-lg-6 col-12">
                    <?php 
                        if(!empty($banner['right_image'])):
                     ?>
                    <div class="product-popup-video justify-content-center align-items-center d-flex" style="background-image: url('<?php echo $banner['right_image']; ?>')">
                        <a href="<?php echo $banner['video_link']; ?>" class="popup-video play-video"><i class="bi bi-play-fill"></i></a> 
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="best-features-wrapper">
        <div class="container">
            <div class="row">
                <?php 
                    $best = get_field('best_features');

                    if(!empty($best)):
                        foreach ($best as $i => $bf):
                 ?>
                <div class="<?php if($i == 0){echo "col-lg-6 col-12 text-center";}else{echo "col-lg-6 mt-5 mt-lg-0 col-12 text-center";}?>">
                    <div class="best-features-contents">
                        <?php 
                            if(!empty($bf['title'])){
                                printf('<h3>%s</h3>', $bf['title']);
                            }
                            if(!empty($bf['content'])){
                                printf('<p>%s</p>', $bf['content']);
                            }
                        ?>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
    
    <div class="products-category-grid-wrapper">
        <div class="container">
            <div class="section-heading text-center">
                <?php 
                    $product_cat = get_field('products_cat');
                    if(!empty($product_cat)){
                        printf('<h2>%s</h2>', $product_cat['title']);
                    }
                ?>
            </div>

            <div class="row">
                <?php 
                    if(!empty($product_cat['select_product_cat'])):
                        foreach ($product_cat['select_product_cat'] as $cat):
                 ?>
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="single-products-cat-card">
                        <?php 
                            $term = get_term_by('id', $cat, 'product_categories');
                            $cat_img = get_field('cat_image', $term);
                            
                            if(!empty($cat_img)){
                                printf('<div class="product-cat-thumb" style="background-image: url(%s)"></div>', $cat_img);
                            }
                            if(!empty($term->name)){
                                printf('<div class="product-cat-name"><h4><a href="%s">%s</a></h4></div>', get_term_link($term), $term->name);
                            }
                         ?>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
    <div class="custom-products-grid-wrapper">
        <div class="container">
            <div class="section-heading text-center">
                <?php 
                    $another_brands = get_field('another_brands');
                    if(!empty($another_brands)){
                        printf('<h2>%s</h2>', $another_brands['title']);
                    }
                ?>
            </div>

            <div class="row">
                <?php 
                    if(!empty($another_brands['select_cat'])):
                        foreach ($another_brands['select_cat'] as $brand):
                ?>
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="single-products-cat-card">
                        <?php 
                            $term = get_term_by('id', $brand, 'product_categories');
                            $cat_img = get_field('cat_image', $term);
                            
                            if(!empty($cat_img)){
                                printf('<div class="product-cat-thumb" style="background-image: url(%s)"></div>', $cat_img);
                            }
                            if(!empty($term->name)){
                                printf('<div class="product-cat-name"><h4><a href="%s">%s</a></h4></div>', get_term_link($term), $term->name);
                            }
                         ?>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
<?php 
    get_footer();
?>