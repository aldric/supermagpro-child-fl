<?php
/**
 * Class for adding posts column
 *
 * @package AcmeThemes
 * @subpackage supermag
 * @since 1.0.0
 */
if ( ! class_exists( 'supermag_posts_col' ) ) {

    class supermag_posts_col extends WP_Widget {
        /*defaults values for fields*/
        private $defaults = array(
            'supermag_cat_title'            => 'Recent Posts',
            'supermag_cat'                  => -1,
            'supermag_post_col_layout'      => 0,
            'supermag_enable_title_link'    => 1,
            'supermag_enable_first_featured'=> 1,
            'supermag_show_image'           => 1,
            'supermag_show_cat'             => 0,
            'supermag_show_date'            => 1,
            'supermag_show_author'          => 1,
            'supermag_show_comment'         => 1,
            'supermag_featured_content_words'=> 48,
            'supermag_content_words'        => 8
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'supermag_posts_col',
                /*Widget name will appear in UI*/
                __('AT Posts Column', 'supermag'),
                /*Widget description*/
                array( 'description' => __( 'Show posts selected category', 'supermag' ) )
            );
        }
        /*Widget Backend*/
        public function form( $instance ) {
            /*defaults values*/
            $instance = wp_parse_args( (array) $instance, $this->defaults );

            /*Main title*/
            $supermag_col_posts_title = esc_attr( $instance['supermag_cat_title'] );

            /*selected cat*/
            $supermag_selected_cat = esc_attr( $instance['supermag_cat'] );

            /*Layout options*/
            $supermag_layout_arrays = array( __('Layout 1','supermag'), __('Layout 2','supermag')  );
            $supermag_post_col_layout = $instance['supermag_post_col_layout'];


            /*Enable title link*/
            $supermag_enable_title_link = esc_attr( $instance['supermag_enable_title_link'] );

            /*Enable first featured*/
            $supermag_enable_first_featured = esc_attr( $instance['supermag_enable_first_featured'] );

            /*Show image*/
            $supermag_show_image = esc_attr( $instance['supermag_show_image'] );

            /*Show cat*/
            $supermag_show_cat = esc_attr( $instance['supermag_show_cat'] );

            /*Show date*/
            $supermag_show_date = esc_attr( $instance['supermag_show_date'] );

            /*Show author*/
            $supermag_show_author = esc_attr( $instance['supermag_show_author'] );

            /*Show comment*/
            $supermag_show_comment = esc_attr( $instance['supermag_show_comment'] );

            /*number of words in content*/
            $supermag_featured_content_words    = absint( $instance['supermag_featured_content_words'] );
            $supermag_content_words    = absint( $instance['supermag_content_words'] );

            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'supermag_cat_title' ); ?>"><?php _e( 'Title:', 'supermag' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'supermag_cat_title' ); ?>" name="<?php echo $this->get_field_name( 'supermag_cat_title' ); ?>" type="text" value="<?php echo $supermag_col_posts_title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('supermag_cat'); ?>"><?php _e('Select category', 'supermag'); ?></label>
                <?php
                $supermag_dropown_cat = array(
                    'show_option_none'   => __('All ( Recent posts )','supermag'),
                    'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $supermag_selected_cat,
                    'hierarchical'       => 1,
                    'name'               => $this->get_field_name('supermag_cat'),
                    'id'                 => $this->get_field_name('supermag_cat'),
                    'class'              => 'widefat',
                    'taxonomy'           => 'category',
                    'hide_if_empty'      => false,
                );
                wp_dropdown_categories($supermag_dropown_cat);
                ?>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'supermag_post_col_layout' ); ?>">
                    <?php _e( 'First Featured Post Layout', 'supermag' ); ?>
                    <br />
                    <small><?php _e( 'Enable First Post Featured to work this layout', 'supermag' ); ?></small>
                </label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'supermag_post_col_layout' ); ?>" name="<?php echo $this->get_field_name( 'supermag_post_col_layout' ); ?>">
                    <?php
                    foreach( $supermag_layout_arrays as $key => $supermag_column_array ){
                        echo ' <option value="'.$key.'"'.selected( $supermag_post_col_layout, $key, 0).'>'.$supermag_column_array.'</option>';
                    }
                    ?>
                </select>
            </p>
            <p>
                <input class="widefat" id="<?php echo $this->get_field_id( 'supermag_enable_title_link' ); ?>" name="<?php echo $this->get_field_name( 'supermag_enable_title_link' ); ?>" type="checkbox" <?php checked( 1, esc_attr( $supermag_enable_title_link ), 1 ); ?>/>
                <label for="<?php echo $this->get_field_id( 'supermag_enable_title_link' ); ?>"><?php _e( 'Enable link in main title' ,'supermag'); ?></label>
            </p>
            <p>
                <input class="widefat" id="<?php echo $this->get_field_id( 'supermag_enable_first_featured' ); ?>" name="<?php echo $this->get_field_name( 'supermag_enable_first_featured' ); ?>" type="checkbox" <?php checked( 1, esc_attr( $supermag_enable_first_featured ), 1 ); ?>/>
                <label for="<?php echo $this->get_field_id( 'supermag_enable_first_featured' ); ?>"><?php _e( 'Enable first post featured' ,'supermag'); ?></label>
            </p>
            <p>
                <input class="widefat" id="<?php echo $this->get_field_id( 'supermag_show_image' ); ?>" name="<?php echo $this->get_field_name( 'supermag_show_image' ); ?>" type="checkbox" value="<?php echo esc_attr( $supermag_show_image ); ?>" <?php checked( 1, esc_attr( $supermag_show_image ), 1 ); ?>/>
                <label for="<?php echo $this->get_field_id( 'supermag_show_image' ); ?>"><?php _e( 'Show image' ,'supermag'); ?></label>
            </p>
            <p>
                <input class="widefat" id="<?php echo $this->get_field_id( 'supermag_show_cat' ); ?>" name="<?php echo $this->get_field_name( 'supermag_show_cat' ); ?>" type="checkbox" value="<?php echo esc_attr( $supermag_show_cat ); ?>" <?php checked( 1, esc_attr( $supermag_show_cat ), 1 ); ?>/>
                <label for="<?php echo $this->get_field_id( 'supermag_show_cat' ); ?>"><?php _e( 'Show categories' ,'supermag'); ?></label>
            </p>
            <p>
                <input class="widefat" id="<?php echo $this->get_field_id( 'supermag_show_date' ); ?>" name="<?php echo $this->get_field_name( 'supermag_show_date' ); ?>" type="checkbox" value="<?php echo esc_attr( $supermag_show_date ); ?>" <?php checked( 1, esc_attr( $supermag_show_date ), 1 ); ?>/>
                <label for="<?php echo $this->get_field_id( 'supermag_show_date' ); ?>"><?php _e( 'Show date' ,'supermag'); ?></label>
            </p>
            <p>
                <input class="widefat" id="<?php echo $this->get_field_id( 'supermag_show_author' ); ?>" name="<?php echo $this->get_field_name( 'supermag_show_author' ); ?>" type="checkbox" value="<?php echo esc_attr( $supermag_show_author ); ?>" <?php checked( 1, esc_attr( $supermag_show_author ), 1 ); ?>/>
                <label for="<?php echo $this->get_field_id( 'supermag_show_author' ); ?>"><?php _e( 'Show author' ,'supermag'); ?></label>
            </p>
            <p>
                <input class="widefat" id="<?php echo $this->get_field_id( 'supermag_show_comment' ); ?>" name="<?php echo $this->get_field_name( 'supermag_show_comment' ); ?>" type="checkbox" value="<?php echo esc_attr( $supermag_show_comment ); ?>" <?php checked( 1, esc_attr( $supermag_show_comment ), 1 ); ?>/>
                <label for="<?php echo $this->get_field_id( 'supermag_show_comment' ); ?>"><?php _e( 'Show number of comments' ,'supermag'); ?></label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'supermag_featured_content_words' ); ?>"><?php _e( 'Number of words in featured contents', 'supermag' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'supermag_featured_content_words' ); ?>" name="<?php echo $this->get_field_name( 'supermag_featured_content_words' ); ?>" type="number" value="<?php echo $supermag_featured_content_words; ?>" />
                <br />
                <small><?php _e( 'Enable First Post Featured to work this', 'supermag' ); ?></small>
                <br />
                <small><?php _e('Enter 0 for not showing content','supermag')?></small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'supermag_content_words' ); ?>"><?php _e( 'Number of words in contents', 'supermag' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'supermag_content_words' ); ?>" name="<?php echo $this->get_field_name( 'supermag_content_words' ); ?>" type="number" value="<?php echo $supermag_content_words; ?>" />
                <br />
                <small><?php _e('Enter 0 for not showing content','supermag')?></small>
            </p>
        <?php
        }
        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['supermag_cat_title'] = ( isset( $new_instance['supermag_cat_title'] ) ) ? sanitize_text_field( $new_instance['supermag_cat_title'] ) : '';
            $instance['supermag_cat'] = ( isset( $new_instance['supermag_cat'] ) ) ? esc_attr( $new_instance['supermag_cat'] ) : -1;
            $instance['supermag_post_col_layout'] = isset($new_instance['supermag_post_col_layout'])? absint( $new_instance['supermag_post_col_layout'] ) : 1;
            $instance['supermag_enable_title_link'] = isset($new_instance['supermag_enable_title_link'])? 1 : 0;
            $instance['supermag_enable_first_featured'] = isset($new_instance['supermag_enable_first_featured'])? 1 : 0;
            $instance['supermag_show_image'] = isset($new_instance['supermag_show_image'])? 1 : 0;
            $instance['supermag_show_cat'] = isset($new_instance['supermag_show_cat'])? 1 : 0;
            $instance['supermag_show_date'] = isset($new_instance['supermag_show_date'])? 1 : 0;
            $instance['supermag_show_author'] = isset($new_instance['supermag_show_author'])? 1 : 0;
            $instance['supermag_show_comment'] = isset($new_instance['supermag_show_comment'])? 1 : 0;
            $instance['supermag_featured_content_words'] = isset($new_instance['supermag_featured_content_words'])? absint( $new_instance['supermag_featured_content_words'] ): 48;
            $instance['supermag_content_words'] = isset($new_instance['supermag_content_words'])? absint( $new_instance['supermag_content_words'] ): 0;
            return $instance;
        }
        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return array
         *
         */
        public function widget($args, $instance) {
            /*defaults values*/
            $instance = wp_parse_args( (array) $instance, $this->defaults );

            /*selected cat*/
            $supermag_selected_cat = esc_attr( $instance['supermag_cat'] );

            /*column layout*/
            $supermag_post_col_layout = absint( $instance['supermag_post_col_layout'] );

            /*Main title*/
            $supermag_col_posts_title = !empty( $instance['supermag_cat_title'] ) ? esc_attr( $instance['supermag_cat_title'] ) : get_cat_name($supermag_selected_cat);
            $supermag_col_posts_title = apply_filters( 'widget_title', $supermag_col_posts_title, $instance, $this->id_base );


            /*Enable title link*/
            $supermag_enable_title_link = esc_attr( $instance['supermag_enable_title_link'] );
            if( 1 == $supermag_enable_title_link ) {
                $supermag_col_posts_title = "<a href='".esc_url( get_category_link( $supermag_selected_cat ) )."'>".$supermag_col_posts_title."</a>";
            }
            /*Enable first featured*/
            $supermag_enable_first_featured = esc_attr( $instance['supermag_enable_first_featured'] );

            /*Show image*/
            $supermag_show_image = esc_attr( $instance['supermag_show_image'] );

            /*Show cat*/
            $supermag_show_cat = esc_attr( $instance['supermag_show_cat'] );

            /*Show date*/
            $supermag_show_date = esc_attr( $instance['supermag_show_date'] );

            /*Show author*/
            $supermag_show_author = esc_attr( $instance['supermag_show_author'] );

            /*Show comment*/
            $supermag_show_comment = esc_attr( $instance['supermag_show_comment'] );

            /*number of words in content*/
            $supermag_featured_content_words    = absint( $instance['supermag_featured_content_words'] );
            $supermag_content_words    = absint( $instance['supermag_content_words'] );

            /* getting values*/
            $supermag_sidebar_id = $args['id'];
            /**
             * Filter the arguments for the Recent Posts widget.
             *
             * @since 1.0.0
             *
             * @see WP_Query
             *
             */

            if( 1 == $supermag_enable_first_featured ){
                $supermag_number = 4;
            }
            else{
                $supermag_number = 6;
            }
            $supermag_other_class = '';
            if( 'supermag-home' != $supermag_sidebar_id ){
                if( 1 != $supermag_enable_first_featured ){
                    $supermag_number = 3;
                }
                $supermag_other_class = 'supermag-except-home';
            }
            else{
                $supermag_other_class = '';
            }

            $supermag_selected_cat_post_args = array(
                'posts_per_page'      => $supermag_number,
                'no_found_rows'       => true,
                'post_status'         => 'publish',
                'post_type' => 'any',
                'ignore_sticky_posts' => true
            );
            if( -1 != $supermag_selected_cat ){
                $supermag_selected_cat_post_args['cat'] = $supermag_selected_cat;
            }
            $supermag_featured_query = new WP_Query($supermag_selected_cat_post_args);

            if ($supermag_featured_query->have_posts()) :
                ?>
                <?php echo $args['before_widget'];
                if ( $supermag_col_posts_title ) {
                    echo $args['before_title'] . $supermag_col_posts_title . $args['after_title'];
                }

                $supermag_post_col_layout_class ='';
                if( 1 == $supermag_post_col_layout ){
                    $supermag_post_col_layout_class = 'sm-col-post-type-2';
                }
                ?>
                <div class="<?php echo esc_attr( $supermag_post_col_layout_class ); ?> <?php echo esc_attr( $supermag_other_class ); ?> featured-entries-col featured-entries featured-acme-col-posts <?php echo esc_attr( $supermag_sidebar_id ); ?>">
                    <?php

                    global $supermag_customizer_all_values;
                    $supermag_no_image_thumbnail = $supermag_customizer_all_values['supermag-no-image-thumbnail'];
                    $supermag_no_image_medium = $supermag_customizer_all_values['supermag-no-image-medium'];
                    $supermag_featured_index = 1;
                    while ( $supermag_featured_query->have_posts() ) :$supermag_featured_query->the_post();
                        if( 1 == $supermag_featured_index && 1 == $supermag_enable_first_featured ){
                            $supermag_list_classes = 'acme-col-3 featured-post-main';
                            $supermag_sidebar_no_thumbnail = $supermag_no_image_medium;
                            $thumb = 'medium';
                            $supermag_main_content_words = $supermag_featured_content_words;
                        }
                        else{
                            $supermag_list_classes = 'acme-col-3';
                            $supermag_sidebar_no_thumbnail = $supermag_no_image_thumbnail;
                            $thumb = 'thumbnail';
                            $supermag_main_content_words = $supermag_content_words;
                        }
                        ?>
                        <div class="<?php echo esc_attr( $supermag_list_classes ); ?>">
                            <?php if ( 1 == $supermag_show_image ) {
                                ?>
                                <figure class="widget-image">
                                    <?php
                                    if ( has_post_thumbnail() ):
                                        $post_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), $thumb );
                                    else:
                                        $post_thumb[0] = $supermag_sidebar_no_thumbnail;
                                    endif;
                                    ?>
                                    <a href="<?php the_permalink()?>">
                                        <img src="<?php echo esc_url( $post_thumb[0] ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
                                    </a>
                                </figure>
                            <?php
                            }
                            ?>
                            <div class="featured-desc">
                                <?php
                                if( 1 == $supermag_show_date || 1 == $supermag_show_author || 1 == $supermag_show_comment ) { ?>
                                    <div class="above-entry-meta">
                                        <?php
                                        if ( 1 == $supermag_show_date ){
                                            $archive_year  = get_the_date('Y');
                                            $archive_month = get_the_date('m');
                                            $archive_day   = get_the_date('d');
                                            ?>
                                            <span><i class="fa fa-calendar"></i><a href="<?php echo esc_url(get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>"><?php echo get_the_date('F d, Y'); ?></a></span>
                                        <?php
                                        }
                                        if( 1 == $supermag_show_author ) { ?>
                                            <span><i class="fa fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span>
                                        <?php
                                        }
                                        if( 1 == $supermag_show_comment ){ ?>
                                            <span><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' );?></span>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                <?php
                                }
                                ?>
                                <a href="<?php the_permalink()?>">
                                    <h4 class="title">
                                        <?php the_title(); ?>
                                    </h4>
                                </a>
                                <?php
                                if( 0 != $supermag_main_content_words){
                                    $content = supermag_words_count( get_the_excerpt(), $supermag_main_content_words );
                                    echo '<div class="details">'.$content.'</div>';
                                }
                                ?>
                                <?php
                                if( 1 == $supermag_show_cat ){?>
                                    <div class="below-entry-meta">
                                        <?php supermag_list_category(); ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        if( 1 == $supermag_enable_first_featured ){
                            if( 1 == $supermag_featured_index ){
                                if( 1 == $supermag_post_col_layout ){
                                    echo '<div class="sm-col-post-type-2-beside">';
                                }
                                else{
                                    echo '<div class="clearfix"></div>';
                                }

                            }
                            if( ($supermag_featured_index - 1) % 3 == 0 ){
                                echo '<div class="clearfix visible-lg"></div>';
                            }
                            if( ( $supermag_featured_index - 1 ) % 2 == 0 ){
                                echo '<div class="clearfix visible-sm"></div>';
                            }
                        }
                        else{
                            if( $supermag_featured_index % 3 == 0 ){
                                echo '<div class="clearfix visible-lg"></div>';
                            }
                            if( $supermag_featured_index % 2 == 0 ){
                                echo '<div class="clearfix visible-sm"></div>';
                            }
                        }
                        $supermag_featured_index++;
                    endwhile;
                    if( 1 == $supermag_enable_first_featured ){
                        if( 1 == $supermag_post_col_layout ){
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
                <?php
                echo "<div class='clearfix'></div>";
                echo $args['after_widget'];
                // Reset the global $the_post as this query will have stomped on it
                wp_reset_query();
            endif;
        }
    } // Class supermag_posts_col ends here
}
/**
 * Function to Register and load the widget
 *
 * @since 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_posts_col' ) ) :

    function supermag_posts_col() {
        register_widget( 'supermag_posts_col' );
    }
endif;
add_action( 'widgets_init', 'supermag_posts_col' );