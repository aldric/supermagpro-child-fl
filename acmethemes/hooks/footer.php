<?php
/**
 * if front page div end
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_after_content' ) ) :
    function supermag_after_content() {
      ?>
        </div><!-- #content -->
        </div><!-- content-wrapper-->
    <?php
    }
endif;
add_action( 'supermag_action_after_content', 'supermag_after_content', 10 );

/**
 * Footer content
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_footer' ) ) :

    function supermag_footer() {
        global $supermag_customizer_all_values;
        ?>
        <!-- *****************************************
             Footer section starts
         ****************************************** -->
        <div class="clearfix"></div>
        <footer id="colophon" class="site-footer">
            <div class="wrapper footer-wrapper">
            <?php
            if(
            is_active_sidebar( 'footer-top-col-one' ) ||
            is_active_sidebar( 'footer-top-col-two' ) ||
            is_active_sidebar( 'footer-top-col-three' ) ||
            is_active_sidebar( 'footer-top-col-four' )||
            is_active_sidebar( 'footer-bottom-col-one' ) ||
            is_active_sidebar( 'footer-bottom-col-two' ) ||
            is_active_sidebar( 'footer-bottom-col-three' ) ||
            is_active_sidebar( 'footer-bottom-col-four' )
            ){

            ?>
                <div class="top-bottom">
                 <?php
                    $supermag_footer_top_widgets_number = $supermag_customizer_all_values['supermag-footer-top-widgets-number'];

                    if( $supermag_footer_top_widgets_number > 0 ){
                        if( 1 == $supermag_footer_top_widgets_number){
                            $footer_top_col = 'acme-col-1';
                        }
                        elseif( 2== $supermag_footer_top_widgets_number ){
                            $footer_top_col = 'acme-col-2';
                        }
                         elseif( 3 == $supermag_footer_top_widgets_number ){
                            $footer_top_col = 'acme-col-3';
                        }
                         elseif( 4 == $supermag_footer_top_widgets_number ){
                            $footer_top_col = 'acme-col-4';
                        }
                        else{
                            $footer_top_col = 'acme-col-3';
                        }
                     ?>
                        <div id="footer-top">
                            <div class="footer-columns">
                                <?php if( is_active_sidebar( 'footer-top-col-one' ) && $supermag_footer_top_widgets_number > 0 ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_top_col );?>">
                                        <?php dynamic_sidebar( 'footer-top-col-one' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( is_active_sidebar( 'footer-top-col-two' ) && $supermag_footer_top_widgets_number > 1 ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_top_col );?>">
                                        <?php dynamic_sidebar( 'footer-top-col-two' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( is_active_sidebar( 'footer-top-col-three' ) && $supermag_footer_top_widgets_number > 2 ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_top_col );?>">
                                        <?php dynamic_sidebar( 'footer-top-col-three' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( is_active_sidebar( 'footer-top-col-four' ) && $supermag_footer_top_widgets_number > 3 ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_top_col );?>">
                                        <?php dynamic_sidebar( 'footer-top-col-four' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( is_active_sidebar( 'footer-top-col-five' ) && $supermag_footer_top_widgets_number > 4 ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_top_col );?>">
                                        <?php dynamic_sidebar( 'footer-top-col-five' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( is_active_sidebar( 'footer-top-col-six' ) && $supermag_footer_top_widgets_number > 5 ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_top_col );?>">
                                        <?php dynamic_sidebar( 'footer-top-col-six' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div><!-- #foter-top -->
                        <div class="clearfix"></div>
                    <?php
                    }
                    ?>

                    <?php if( isset( $supermag_customizer_all_values['supermag-footer-bottom-widgets-number'] ) ){
                        $supermag_footer_bottom_widgets_number = $supermag_customizer_all_values['supermag-footer-bottom-widgets-number'];
                    }
                    else{
                        $supermag_footer_bottom_widgets_number = 3;
                    }
                    if( $supermag_footer_bottom_widgets_number > 0 ){

                        if( 1 == $supermag_footer_bottom_widgets_number){
                            $footer_bottom_col = 'acme-col-1';
                        }
                        elseif( 2== $supermag_footer_bottom_widgets_number ){
                            $footer_bottom_col = 'acme-col-2';
                        }
                        elseif( 3 == $supermag_footer_bottom_widgets_number ){
                            $footer_bottom_col = 'acme-col-3';
                        }
                        elseif( 4 == $supermag_footer_bottom_widgets_number ){
                            $footer_bottom_col = 'acme-col-4';
                        }
                        else{
                            $footer_bottom_col = 'acme-col-3';
                        }
                        ?>
                        <div id="footer-bottom">
                            <div class="footer-columns">
                                <?php if( is_active_sidebar( 'footer-bottom-col-one' ) && $supermag_footer_bottom_widgets_number > 0 ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_bottom_col );?>">
                                        <?php dynamic_sidebar( 'footer-bottom-col-one' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( is_active_sidebar( 'footer-bottom-col-two' ) && $supermag_footer_bottom_widgets_number > 1 ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_bottom_col );?>">
                                        <?php dynamic_sidebar( 'footer-bottom-col-two' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( is_active_sidebar( 'footer-bottom-col-three' ) && $supermag_footer_bottom_widgets_number > 2 ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_bottom_col );?>">
                                        <?php   dynamic_sidebar( 'footer-bottom-col-three' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( is_active_sidebar( 'footer-bottom-col-four' ) && $supermag_footer_bottom_widgets_number > 3 ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_bottom_col );?>">
                                        <?php dynamic_sidebar( 'footer-bottom-col-four' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( is_active_sidebar( 'footer-bottom-col-five' ) && $supermag_footer_bottom_widgets_number > 4 ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_bottom_col );?>">
                                        <?php dynamic_sidebar( 'footer-bottom-col-five' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( is_active_sidebar( 'footer-bottom-col-six' ) && $supermag_footer_bottom_widgets_number > 5 ) : ?>
                                    <div class="footer-sidebar <?php echo esc_attr( $footer_bottom_col );?>">
                                        <?php dynamic_sidebar( 'footer-bottom-col-six' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div><!-- #foter-bottom -->
                        <div class="clearfix"></div>
                        <?php
                    }
                    ?>
                </div><!-- top-bottom-->
                <?php
                }
                ?>
                <div class="footer-copyright border text-center">
                    <p>
                        <?php if( isset( $supermag_customizer_all_values['supermag-footer-copyright'] ) ): ?>
                            <?php echo wp_kses_post($supermag_customizer_all_values['supermag-footer-copyright']); ?>
                        <?php endif; ?>
                    </p>
                    <?php
                     if( 1 == $supermag_customizer_all_values['supermag-footer-power-text']){
                        ?>
                     <div class="site-info">
                        <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'supermag' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'supermag' ), 'WordPress' ); ?></a>
                        <span class="sep"> | </span>
                        <?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'supermag' ), 'SuperMagPro', '<a href="http://acmethemes.com/">AcmeThemes</a>' ); ?>
                    </div><!-- .site-info -->
                    <?php
                    }
                    ?>
                </div>
            </div><!-- footer-wrapper-->
        </footer><!-- #colophon -->
        <!-- *****************************************
                 Footer section ends
        ****************************************** -->
    <?php
    }
endif;
add_action( 'supermag_action_footer', 'supermag_footer', 10 );

/**
 * Page end
 *
 * @since supermag 1.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_page_end' ) ) :

    function supermag_page_end() {
        global $supermag_customizer_all_values;
        if( 1 == $supermag_customizer_all_values['supermag-footer-gotop']) {
            ?>
           <div class="fab-up fixed-action-btn">
            <a class="btn-floating btn-large primary">
                <i class="fa fa-angle-double-up" aria-hidden="true"></i>
            </a>
            </div>
        <?php
        }
        ?>
        </div><!-- #page -->
    <?php
    }
endif;
add_action( 'supermag_action_after', 'supermag_page_end', 10 );