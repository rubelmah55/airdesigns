<?php
/**
 * Header file for the Embrace Nature WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package airdesigns
 */

if($_GET['import'] == 1){


    $images = "https://zizito.com/33610/detska-koshara-i-lyulka-elias-2-v-1-16946.jpg,https://zizito.com/33605/detska-koshara-i-lyulka-elias-2-v-1-16946.jpg,https://zizito.com/33606/detska-koshara-i-lyulka-elias-2-v-1-16946.jpg,https://zizito.com/33607/detska-koshara-i-lyulka-elias-2-v-1-16946.jpg,https://zizito.com/33608/detska-koshara-i-lyulka-elias-2-v-1-16946.jpg,https://zizito.com/33609/detska-koshara-i-lyulka-elias-2-v-1-16946.jpg,https://zizito.com/33611/detska-koshara-i-lyulka-elias-2-v-1-16946.jpg,https://zizito.com/33612/detska-koshara-i-lyulka-elias-2-v-1-16946.jpg,https://zizito.com/33613/detska-koshara-i-lyulka-elias-2-v-1-16946.jpg,https://zizito.com/33614/detska-koshara-i-lyulka-elias-2-v-1-16946.jpg,https://zizito.com/33615/detska-koshara-i-lyulka-elias-2-v-1-16946.jpg";

    $images_array = explode(",",$images);

    $upload_dir = wp_upload_dir();

    foreach($images_array as $image_url){

        $filename = basename($image_url);
        $image_url_data = explode("/",$image_url);

        $zizit_image_id = $image_url_data['3'];

        $PATHINFO_FILENAME = pathinfo($filename, PATHINFO_FILENAME);
        $PATHINFO_EXTENSION = pathinfo($filename, PATHINFO_EXTENSION);

        $filename_new = $PATHINFO_FILENAME.'-'.$zizit_image_id.'.'.$PATHINFO_EXTENSION;

        $image_data = file_get_contents($image_url);
        
        if(wp_mkdir_p($upload_dir['path']))
            $file = $upload_dir['path'] . '/' . $filename_new;
        else
            $file = $upload_dir['basedir'] . '/' . $filename_new;
        file_put_contents($file, $image_data);

        $wp_filetype = wp_check_filetype($filename_new, null );
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename_new),
            'post_content' => '',
            'post_status' => 'inherit'
        );
        $attach_id = wp_insert_attachment( $attachment, $file, 1248 );
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        wp_update_attachment_metadata( $attach_id, $attach_data );
        

    }
}
?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

    <header class="header-wrapper">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 d-none d-md-block col-md-6 order-1 order-lg-1">
                        <div class="header-left">
                            <div class="wpml-button-wrapper">
                                <div class="select-language">
                                    <?php echo do_shortcode('[wpml_language_selector_widget]'); ?>
                                </div>
                            </div>
                            <div class="top-left-menu">
                                <div class="main-menu">
                                    <?php   
                                        wp_nav_menu( array(
                                            'menu'               => 'Header Top Left',
                                            'theme_location'     => 'header-left',
                                            'depth'              => 2,
                                            'menu_id'            => '',
                                            'container'          => false,
                                            'menu_class'         => '',
                                            'fallback_cb'        => 'wp_bootstrap_navwalker::fallback',
                                            'walker'             => new wp_bootstrap_navwalker(),
                                        ));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-12 mt-2 mt-lg-0 order-3 order-lg-2 text-center">
                        <div class="header-middle">
                            <div class="logos">
                                <div class="site_logo">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 913.7 165.2" xml:space="preserve"><path d="M328.4 120h-49.3l63.7-83.4c4.2-5.5 4.9-12.8 1.8-19-3.1-6.3-9.3-10.2-16.4-10.2h-85.8c-10 0-18.2 8.1-18.2 18.1 0 10 8.2 18.2 18.2 18.2h49.2L228 127.1l-.2.3-.6.9c-.2.3-.3.5-.4.7-.2.3-.3.6-.5 1-.1.1-.2.3-.2.4-1.8 3.7-2.2 7.8-1.2 12.1.1.4.2.8.3 1 1 3.2 2.8 6.1 5.6 8.5l.4.3c.2.2.4.4.7.5.2.2.5.3.9.6.1.1.4.3.5.3.4.2.8.4 1.4.8 1 .5 2.1.9 3.4 1.2.5.1 1.1.3 1.6.3h.1c.5.1.9.1 1.4.2h87.2c10 0 18.2-8.1 18.2-18.2-.1-9.9-8.2-18-18.2-18M386.9 7c-10 0-18.2 8.1-18.2 18.1v112.8c0 10 8.1 18.2 18.2 18.2 10 0 18.1-8.1 18.1-18.4V25.2c0-10-8.1-18.2-18.1-18.2m160.9 10.6c-3.1-6.3-9.3-10.2-16.4-10.2h-85.8c-10 0-18.2 8.1-18.2 18.1 0 10 8.1 18.2 18.2 18.2h49.3l-63.7 83.4-.2.3-.6.9c-.2.3-.3.5-.4.7-.2.3-.3.6-.5 1 0 .1-.2.3-.2.4-1.8 3.7-2.2 7.8-1.3 12 .1.4.2.9.3 1.1 1 3.2 2.9 6.1 5.7 8.6.1.1.2.2.4.3.2.1.4.3.6.5.2.2.5.4.9.6.1.1.4.3.5.3.4.2.8.4 1.5.8 1 .5 2.1.9 3.4 1.2.5.1 1 .2 1.6.3h.2c.5.1.9.1 1.4.1h87.3c10 0 18.1-8.1 18.1-18.2 0-10-8.1-18.1-18.1-18.1h-49.3L546 36.6c4.2-5.5 4.9-12.8 1.8-19M590 7c-10 0-18.2 8.1-18.2 18.1v112.8c0 10 8.2 18.2 18.2 18.2s18.1-8.1 18.1-18.4V25.2C608.2 15.2 600 7 590 7m144.7.4h-94.5c-10 0-18.1 8.1-18.1 18.2 0 10 8.1 18.1 18.1 18.1h29.1v94.4c0 10 8.1 18.2 18.1 18.2 10 0 18.2-8.1 18.2-18.2V43.7h29.1c10 0 18.2-8.1 18.2-18.1-.1-10-8.2-18.2-18.2-18.2m156 19.7c-14.8-14.8-34.6-23-55.5-23h-1.3c-42.6.7-77.2 35.8-77.2 78.5 0 20.9 8.2 40.6 23 55.5 14.8 14.8 34.6 23 55.6 23 43.2 0 78.5-35.2 78.5-78.5-.1-21-8.2-40.7-23.1-55.5m-13.3 55.5c0 23.3-19 42.2-42.2 42.2-5.7 0-11.2-1.1-16.4-3.3-15.7-6.6-25.8-21.9-25.8-38.9 0-23.3 18.9-42.2 42.2-42.2 23.3 0 42.2 18.9 42.2 42.2M28.9 57.7c15.9 0 28.9-12.9 28.9-28.9S44.9 0 28.9 0C13 0 .1 12.9.1 28.9S13 57.7 28.9 57.7m82 49.7H87.4L118.9 66l14.9-19.5c0-.1.1-.2.2-.3 6.6-8.8 7.7-20.3 2.8-30.2-1-2-2.2-3.8-3.6-5.5-1.2-1.4-2.5-2.6-3.9-3.8-12.6-9.7-30.8-7.5-40.6 5L52.4 57.8 38.6 76 5.9 118.7c-.2.2-.3.4-.5.7l-.1.1c-.2.2-.3.5-.6.8-.1.1-.1.2-.2.3-.3.4-.5.8-.7 1.2-.3.4-.5.8-.7 1.3v.1c0 .1-.1.2-.2.3-.1.1-.1.3-.2.4-2.8 5.9-3.5 12.6-2.1 18.9v.1c0 .1.1.3.1.5.1.5.3 1.1.5 1.6 1.6 5 4.5 9.5 8.5 13.1.2.1.3.3.5.4 0 0 .1.1.2.1l.1.1c.4.4.9.7 1.4 1.1.3.2.5.4.9.6.4.3.8.5 1.2.8.5.3 1 .6 1.6.9.3.2.6.3.9.4 1.5.7 3.1 1.3 4.6 1.7.2.1.5.1.8.2.8.2 1.6.4 2.4.5h.2c.7.1 1.4.2 2.2.2h84.2c15.9 0 28.9-13 28.9-28.9 0-15.9-12.9-28.8-28.9-28.8" fill="#e11b22"/></svg>  
                                    </a>
                                </div>
                                <div class="external_logo">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 402.8 293.6" xml:space="preserve"><path fill="#e11b22" d="M119.5 106.3H26.1V26.9h245.6L155.5 211.3h103.4v82.3H0zm190.3.1h91.8v187.3h-91.8zm93-60.5c0 25.4-20.6 45.9-45.9 45.9-25.4 0-45.9-20.6-45.9-45.9C311 20.6 331.5 0 356.9 0c25.3 0 45.9 20.6 45.9 45.9"/></svg>
                                    </a>
                                </div>
                            </div>
                            <div class="search-box-wrapper">
                                <?php 
                                //TODO
                                ?>
                                <form action="#">
                                    <input type="text" placeholder="търсене на продукт">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 d-none d-md-block order-2 order-lg-3 text-md-end">
                        <div class="header-right">
                            <div class="header-cta-btn">
                                <?php 
                                    $header = get_field('header', 'options');
                                    if(!empty($header['button'])){
                                        printf('<a href="%s" class="theme-btn" %s>%s <i class="bi bi-arrow-right"></i></a>',$header['button']['url'], $header['button']['target'], $header['button']['title'] );
                                    }
                                 ?>
                                
                            </div>
                            <div class="top-right-menu">
                                <div class="main-menu">
                                    <?php   
                                        wp_nav_menu( array(
                                            'menu'               => 'Header Top Right',
                                            'theme_location'     => 'header-right',
                                            'depth'              => 2,
                                            'menu_id'            => '',
                                            'container'          => false,
                                            'menu_class'         => '',
                                            'fallback_cb'        => 'wp_bootstrap_navwalker::fallback',
                                            'walker'             => new wp_bootstrap_navwalker(),
                                        ));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="main-menu-wrapper mt-1 mt-lg-0 mb-1 mb-lg-0">
            <div class="container d-flex justify-content-lg-start justify-content-between  align-items-center">
                <div class="menu-icon">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo AIRDESIGNS_DIR_IMG.'/home.svg' ?>" alt="<?php bloginfo('name'); ?>"></a>
                </div>
                <div class="main-menu d-none d-lg-block">
                    <?php   
                        wp_nav_menu( array(
                            'menu'               => 'Primary Header',
                            'theme_location'     => 'primary',
                            'depth'              => 2,
                            'menu_id'            => '',
                            'container'          => false,
                            'menu_class'         => '',
                            'fallback_cb'        => 'wp_bootstrap_navwalker::fallback',
                            'walker'             => new wp_bootstrap_navwalker(),
                        ));
                    ?>
                </div>

                <div class="d-block d-lg-none">
                    <div class="mobile-nav-wrap">
                        <div id="hamburger"><i class="bi bi-list"></i></div>
                        <!-- mobile menu - responsive menu  -->
                        <div class="mobile-nav">
                            <button type="button" class="close-nav">
                                <i class="bi bi-x-circle"></i>
                            </button>
                            <nav class="sidebar-nav">
                                <?php 
                                //TODO
                                ?>
                                <ul class="metismenu" id="mobile-menu">
                                    <li><a href="#">колички</a></li>
                                    <li><a href="#">столчета за кола</a> </li>
                                    <li><a href="#">кошари</a></li>
                                    <li><a href="#">столчета за хранене</a></li>
                                    <li><a href="#">велосипеди</a></li>
                                    <li><a href="#">тротинетки</a></li>
                                    <li><a href="#">велосипеди</a></li>
                                    <li><a href="#">тротинетки</a></li>
                                </ul>
                            </nav>

                            <div class="menu-btn mt-4">
                                <a href="https://b2b.zizito.com" class="theme-btn bg-color d-block">B2B <i class="bi bi-arrow-right"></i></a>
                            </div>

                            <div class="select-language">
                                <form>
                                    <?php 
                                    //TODO
                                    ?>
                                    <select id="lan">
                                        <option>English</option>
                                        <option>France</option>
                                    </select>
                                </form>
                            </div>
                        </div> 
                    </div>
                    <div class="overlay"></div>
                </div>

            </div>
        </div>
    </header>
