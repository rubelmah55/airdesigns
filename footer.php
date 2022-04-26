<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Embrace Nature
 * @since Embrace Nature 1.0
 */

?>
        <div class="newsletter-subscribe-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-12">
                        <div class="newsletter-wrapper d-lg-flex justify-content-around align-items-center">
                            <div class="newsletter-title text-center text-lg-start">
                                <h4 class="mb-0">Абонирай се за нашия бюлетин</h4>
                            </div>

                            <div class="news-letter-form mt-2 mt-lg-0">
                                <form action="#">
                                    <input type="email" placeholder="Имейл">
                                    <input type="submit" value="АБОНИРАЙ СЕ">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer-wrapper">
            <div class="footer-widgets-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-2 col-sm-6">
                            <div class="single-footer-wid">
                                <?php   
                                    wp_nav_menu( array(
                                        'menu'               => 'Footer One',
                                        'theme_location'     => 'footer-1',
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
                        <div class="col-xl-2 col-sm-6">
                            <div class="single-footer-wid">
                                <?php   
                                    wp_nav_menu( array(
                                        'menu'               => 'Footer Two',
                                        'theme_location'     => 'footer-2',
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
                        <div class="col-xl-6 col-sm-12 special-footer">
                            <div class="special-footer-title me-md-3 text-center">
                                <h4>нашият съпорт</h4>
                            </div>

                            <div class="row">
                                <div class="col-xl-4 col-sm-6">
                                    <div class="single-footer-wid">
                                        <?php   
                                            wp_nav_menu( array(
                                                'menu'               => 'Footer Three',
                                                'theme_location'     => 'footer-3',
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
                                <div class="col-xl-4 col-sm-6">
                                    <div class="single-footer-wid">
                                        <?php   
                                            wp_nav_menu( array(
                                                'menu'               => 'Footer Four',
                                                'theme_location'     => 'footer-4',
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
                                <div class="col-xl-4 col-sm-6">
                                    <div class="single-footer-wid">
                                        <?php   
                                            wp_nav_menu( array(
                                                'menu'               => 'Footer Five',
                                                'theme_location'     => 'footer-5',
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
                        <div class="col-xl-2 col-sm-6">
                            <div class="single-footer-wid">
                                <?php dynamic_sidebar( 'left-sidebar' ); ?>
                                <ul>
                                    <?php 
                                        $footer = get_field('footer', 'options');
                                        $contact = $footer['contact_info'];

                                        if(!empty($contact['email'])){
                                            printf('<li><a href="mailto:%s">%s</a></li>', $contact['email'], $contact['email']);
                                        }
                                        if(!empty($contact['phone'])){
                                            printf('<li><a href="mailto:%s">%s</a></li>', $contact['phone'], $contact['phone']);
                                        }
                                        if(!empty($contact['address'])){
                                            printf('<li><a href="#">%s</a></li>', $contact['address']);
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom-wrapper">
                <div class="container text-center">
                    <div class="social-links">
                        <?php 
                            $socials = $footer['socials'];

                            if(!empty($socials['facebook_url'])):
                        ?>
                        <a href="<?php echo $socials['facebook_url']; ?>">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 362.1 362.1" style="enable-background:new 0 0 362.1 362.1;" xml:space="preserve">
                            <path d="M351.5,170.4c0,6.9,0,13.8,0,20.6c-0.2,1.1-0.4,2.1-0.6,3.2c-0.9,6.7-1.5,13.5-2.8,20.1c-13.3,68.6-68.8,122.9-137.8,134.6
                                c-6.2,1.1-12.5,1.8-18.7,2.6c-7.1,0-14.2,0-21.3,0c-0.7-0.2-1.5-0.5-2.2-0.5c-14.5-1-28.6-3.7-42.2-8.7
                                c-61.9-22.9-99.5-66.9-112.8-131.5c-1.3-6.3-1.8-12.7-2.7-19c0-7.1,0-14.2,0-21.3c0.9-6.2,1.5-12.5,2.6-18.7
                                C25,82.6,79.1,27.2,147.7,13.9c7.7-1.5,15.5-2.3,23.3-3.4c6.9,0,13.8,0,20.6,0c0.9,0.2,1.7,0.5,2.6,0.5C219.9,13,244,20.2,266,33.3
                                c45.3,27,73.1,66.4,82.9,118.4C350.1,157.9,350.7,164.1,351.5,170.4z M160.9,159.9c-6.2,0-11.8,0-17.5,0c-4.1,0-5.6,1.6-5.7,5.7
                                c0,5.5,0,11.1,0,16.6c0,10.4,0,10.4,10.3,10.4c4.3,0,8.5,0,13,0c0,1.9,0,3.2,0,4.6c0,21.4-0.1,42.8-0.1,64.3c0,4.2,0.7,4.9,4.8,4.9
                                c7,0,14,0,21,0c4.9,0,5.6-0.7,5.6-5.6c0-21.3,0-42.6,0-63.9c0-1.3,0-2.6,0-4.2c8,0,15.7,0,23.3,0c4.2,0,5.6-1.3,6-5.4
                                c0.7-6.4,1.4-12.8,2.2-19.2c0.9-6.9-0.3-8.2-7.3-8.2c-8,0-15.9,0-24.1,0c0-7.8-0.1-15.2,0-22.6c0.2-7.6,4.1-11.6,11.7-12.2
                                c4.6-0.3,9.3-0.2,14-0.3c3.6-0.1,5.2-1.5,5.3-5c0.1-6.3,0.1-12.7,0-19c-0.1-3.3-1.7-4.9-5-4.9c-7.2,0-14.4-0.2-21.6,0.1
                                c-17,0.7-29.8,10.5-33.8,26.4c-1.4,5.3-1.6,10.9-1.8,16.5C160.7,145.7,160.9,152.5,160.9,159.9z"/>
                            <path style="fill:#FFFFFF;" d="M160.9,159.9c0-7.4-0.2-14.2,0.1-21.1c0.2-5.5,0.5-11.2,1.8-16.5c4.1-15.9,16.8-25.7,33.8-26.4
                                c7.2-0.3,14.4-0.2,21.6-0.1c3.3,0,5,1.6,5,4.9c0.1,6.3,0.1,12.7,0,19c-0.1,3.5-1.7,4.9-5.3,5c-4.7,0.1-9.3,0-14,0.3
                                c-7.6,0.6-11.5,4.6-11.7,12.2c-0.2,7.4,0,14.8,0,22.6c8.2,0,16.2,0,24.1,0c7.1,0,8.2,1.3,7.3,8.2c-0.8,6.4-1.5,12.8-2.2,19.2
                                c-0.5,4.1-1.8,5.4-6,5.4c-7.6,0-15.3,0-23.3,0c0,1.6,0,2.9,0,4.2c0,21.3,0,42.6,0,63.9c0,4.8-0.7,5.6-5.6,5.6c-7,0-14,0-21,0
                                c-4.1,0-4.8-0.7-4.8-4.9c0-21.4,0.1-42.8,0.1-64.3c0-1.3,0-2.7,0-4.6c-4.4,0-8.7,0-13,0c-10.3,0-10.3,0-10.3-10.4
                                c0-5.5,0-11.1,0-16.6c0-4.1,1.6-5.6,5.7-5.7C149.1,159.9,154.8,159.9,160.9,159.9z"/>
                            </svg>
                        </a>
                        <?php 
                            endif;
                            if(!empty($socials['instagram_url'])):
                         ?>
                        <a href="<?php echo $socials['instagram_url']; ?>">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 362.1 362.1" style="enable-background:new 0 0 362.1 362.1;" xml:space="preserve">
                            <path d="M351.5,170.4c0,6.9,0,13.8,0,20.6c-0.2,1.1-0.4,2.1-0.6,3.2c-0.9,6.7-1.5,13.5-2.8,20.1c-13.2,68.6-68.8,122.9-137.8,134.6
                                c-6.2,1.1-12.5,1.8-18.7,2.6c-7.1,0-14.2,0-21.3,0c-0.7-0.2-1.5-0.5-2.2-0.5c-14.5-1-28.6-3.7-42.2-8.7
                                c-61.9-22.9-99.5-66.9-112.8-131.5c-1.3-6.3-1.8-12.7-2.7-19c0-7.1,0-14.2,0-21.3c0.9-6.2,1.5-12.5,2.6-18.7
                                C25,82.6,79.1,27.2,147.7,13.9c7.7-1.5,15.5-2.3,23.3-3.4c6.9,0,13.8,0,20.6,0c0.9,0.2,1.7,0.5,2.6,0.5C219.9,13,244,20.2,266,33.3
                                c45.3,27,73.1,66.4,82.9,118.4C350.1,157.9,350.7,164.1,351.5,170.4z M95.8,180.8c0,11.3,0,22.6,0,34c0.1,29.1,22.4,51.5,51.5,51.5
                                c22.5,0.1,45.1,0.1,67.6,0c29.1-0.1,51.4-22.4,51.4-51.5c0.1-22.5,0.1-45.1,0-67.6c-0.1-28.9-22.4-51.3-51.3-51.4
                                c-22.6-0.1-45.3-0.1-67.9,0c-28.9,0.1-51.2,22.5-51.3,51.4C95.8,158.4,95.8,169.6,95.8,180.8z"/>
                            <path style="fill:#FFFFFF;" d="M95.8,180.8c0-11.2,0-22.4,0-33.6c0.1-28.9,22.4-51.3,51.3-51.4c22.6-0.1,45.3-0.1,67.9,0
                                c28.9,0.1,51.2,22.5,51.3,51.4c0.1,22.5,0.1,45.1,0,67.6c-0.1,29.1-22.4,51.5-51.4,51.5c-22.5,0.1-45.1,0.1-67.6,0
                                c-29.1-0.1-51.4-22.5-51.5-51.5C95.8,203.4,95.8,192.1,95.8,180.8z M181.4,113c-11.3,0-22.6,0-34,0c-19.8,0.1-34.3,14.3-34.4,34.1
                                c-0.1,22.5-0.1,45.1,0,67.6c0.1,19.9,14.4,34.2,34.2,34.3c22.5,0.1,45.1,0.1,67.6,0c19.9-0.1,34.1-14.4,34.2-34.3
                                c0.1-22.5,0.1-45.1,0-67.6c-0.1-19.9-14.5-34.1-34.4-34.1C203.6,113,192.5,113,181.4,113z"/>
                            <path d="M181.4,113c11.1,0,22.2,0,33.3,0c19.8,0.1,34.3,14.3,34.4,34.1c0.1,22.5,0.1,45.1,0,67.6c-0.1,19.9-14.4,34.2-34.2,34.3
                                c-22.5,0.1-45.1,0.1-67.6,0c-19.9-0.1-34.1-14.4-34.2-34.3c-0.1-22.5-0.1-45.1,0-67.6c0.1-19.8,14.6-34.1,34.4-34.1
                                C158.7,113,170.1,113,181.4,113z M137,181c0,24.4,19.5,43.9,43.9,44.1c24.3,0.1,44.1-19.6,44.1-43.9c0-24.5-19.4-44.1-43.8-44.2
                                C156.7,136.9,137,156.5,137,181z M225.4,147.8c5.9,0,10.8-4.8,10.9-10.7c0.1-6-4.9-11.1-10.9-11.1c-5.9,0-10.8,4.9-10.9,10.7
                                C214.3,142.8,219.3,147.8,225.4,147.8z"/>
                            <path style="fill:#FFFFFF;" d="M137,181c0-24.5,19.7-44.1,44.3-44c24.3,0.1,43.8,19.8,43.8,44.2c0,24.3-19.8,44-44.1,43.9
                                C156.5,225,137,205.4,137,181z M207.9,181.1c0.1-14.9-11.8-26.8-26.7-27c-14.9-0.1-26.9,11.7-27,26.6c-0.2,15,11.9,27.1,26.9,27.1
                                C196,207.9,207.9,196,207.9,181.1z"/>
                            <path style="fill:#FFFFFF;" d="M225.4,147.8c-6.1,0-11-5-10.9-11c0.1-5.9,5-10.7,10.9-10.7c6,0,11,5,10.9,11.1
                                C236.2,143,231.3,147.8,225.4,147.8z"/>
                            <path d="M207.9,181.1c-0.1,14.9-12,26.8-26.9,26.8c-15,0-27-12.1-26.9-27.1c0.2-14.9,12.2-26.7,27-26.6
                                C196.1,154.3,208,166.2,207.9,181.1z"/>
                            </svg>
                        </a>
                        <?php 
                            endif;
                            if(!empty($socials['youtube_url'])):
                         ?>
                        <a href="<?php echo $socials['youtube_url']; ?>">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 362.1 362.1" style="enable-background:new 0 0 362.1 362.1;" xml:space="preserve">
                            <path d="M351.5,170.4c0,6.9,0,13.8,0,20.6c-0.2,1.1-0.4,2.1-0.6,3.2c-0.9,6.7-1.5,13.5-2.8,20.1c-13.3,68.6-68.8,122.9-137.8,134.6
                                c-6.2,1.1-12.5,1.8-18.7,2.6c-7.1,0-14.2,0-21.3,0c-0.7-0.2-1.5-0.5-2.2-0.5c-14.5-1-28.6-3.7-42.2-8.7
                                c-61.9-22.9-99.5-66.9-112.8-131.5c-1.3-6.3-1.8-12.7-2.7-19c0-7.1,0-14.2,0-21.3c0.9-6.2,1.5-12.5,2.6-18.7
                                C25,82.6,79.1,27.2,147.7,13.9c7.7-1.5,15.5-2.3,23.3-3.4c6.9,0,13.8,0,20.6,0c0.9,0.2,1.7,0.5,2.6,0.5C219.9,13,244,20.2,266,33.3
                                c45.3,27,73.1,66.4,82.9,118.4C350.1,157.9,350.7,164.1,351.5,170.4z M176.4,243.8c16.3-0.6,28.1-0.9,39.8-1.6
                                c8.3-0.5,16.7-0.8,24.8-2.7c11.6-2.7,20.1-9.1,22.3-22.1c3.9-23.8,4-47.5,0.3-71.2c-0.9-5.8-2.6-11.2-7.1-15.4
                                c-5.5-5.1-11.9-8.1-19.3-9c-30.1-3.3-60.2-3.8-90.4-1.9c-8.5,0.6-17.2,0.9-25.4,2.7c-11.4,2.6-20.2,8.7-22.3,21.6
                                c-4,23.6-4.2,47.2-0.5,70.9c0.9,6,2.4,11.7,7.1,16.1c5.5,5.1,11.9,8.5,19.2,9C143.5,241.8,162.2,242.8,176.4,243.8z"/>
                            <path style="fill:#FFFFFF;" d="M176.4,243.8c-14.2-0.9-32.9-2-51.6-3.5c-7.4-0.6-13.8-3.9-19.2-9c-4.7-4.4-6.1-10.1-7.1-16.1
                                c-3.7-23.7-3.5-47.3,0.5-70.9c2.2-12.9,10.9-19,22.3-21.6c8.3-1.8,16.9-2.2,25.4-2.7c30.2-2,60.3-1.5,90.4,1.9
                                c7.4,0.8,13.8,3.9,19.3,9c4.5,4.2,6.2,9.5,7.1,15.4c3.7,23.8,3.6,47.5-0.3,71.2c-2.1,13-10.7,19.4-22.3,22.1
                                c-8,1.9-16.5,2.2-24.8,2.7C204.5,242.9,192.7,243.1,176.4,243.8z M160.9,148.5c0,22,0,43.3,0,65.1c17.8-10.9,35.2-21.6,53-32.6
                                C196,170.1,178.7,159.4,160.9,148.5z"/>
                            <path d="M160.9,148.5c17.8,10.9,35.1,21.6,53,32.5c-17.8,10.9-35.2,21.6-53,32.6C160.9,191.8,160.9,170.5,160.9,148.5z"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                    </div>

                    <div class="copyright-text">
                        <?php 
                            if(!empty($footer['copyright'])){
                                printf('<p>%s</p>', $footer['copyright']);
                            }
                         ?>
                    </div>
                </div>
            </div>
        </footer>

		<?php wp_footer(); ?>
	</body>
</html>