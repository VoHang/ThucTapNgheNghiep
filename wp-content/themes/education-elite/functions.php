<?php 
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * After setup theme hook
 */
function education_elite_theme_setup(){
    /*
     * Make chile theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'education-elite', get_stylesheet_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'education_elite_theme_setup', 100 );

function education_elite_styles() {
    $my_theme = wp_get_theme();
    $version  = $my_theme['Version'];

    wp_enqueue_style( 'education-zone-style', get_template_directory_uri()  . '/style.css' );
    wp_enqueue_style( 'education-elite-style', get_stylesheet_directory_uri() . '/style.css', array( 'education-zone-style' ), $version );
    wp_enqueue_script( 'education-elite-custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), $version, true );
}
add_action( 'wp_enqueue_scripts', 'education_elite_styles', 10 );


function education_zone_fonts_url() {
    $fonts_url = '';

    /*
    * translators: If there are characters in your language that are not supported
    * by Nunito Sans, translate this to 'off'. Do not translate into your own language.
    */
    $nunitosans = _x( 'on', 'Nunito Sans font: on or off', 'education-elite' );
    
    /*
    * translators: If there are characters in your language that are not supported
    * by Oxygen, translate this to 'off'. Do not translate into your own language.
    */
    $oxygen = _x( 'on', 'Oxygen font: on or off', 'education-elite' );

    if ( 'off' !== $nunitosans || 'off' !== $oxygen ) {
        $font_families = array();

        if( 'off' !== $nunitosans ){
            $font_families[] = 'Nunito Sans:300,300i,400,400i,600,600i,700,700i,800,800i';
        }

        if( 'off' !== $oxygen ){
            $font_families[] = 'Oxygen:400,700';
        }

        $query_args = array(
            'family'  => urlencode( implode( '|', $font_families ) ),
            'display' => urlencode( 'fallback' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url( $fonts_url );
}


/**
 * Customize resgister settings and controls 
 */
function education_elite_customize_register( $wp_customize ){

    /** remove menu label */
    $wp_customize->remove_control( 'education_zone_top_menu_label' );

    $wp_customize->add_section( 'theme_info' , array(
        'title'       => __( 'Demo and Documentation' , 'education-elite' ),
        'priority'    => 6,
        ));

    $wp_customize->add_setting('theme_info_theme',array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
        ));
    
    $theme_info = '';

    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Documentation', 'education-elite' ) . ': </label><a href="' . esc_url( 'https://docs.rarathemes.com/docs/education-elite/' ) . '" target="_blank">' . __( 'Click here', 'education-elite' ) . '</a></span><br />';
    
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Demo', 'education-elite' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/previews/?theme=education-elite' ) . '" target="_blank">' . __( 'Click here', 'education-elite' ) . '</a></span><br />';

    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme info', 'education-elite' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/wordpress-themes/education-elite/' ) . '" target="_blank">' . __( 'Click here', 'education-elite' ) . '</a></span><br />';

    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Support Ticket', 'education-elite' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/support-ticket/' ) . '" target="_blank">' . __( 'Click here', 'education-elite' ) . '</a></span><br />';

    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'More WordPress Themes', 'education-elite' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/wordpress-themes/' ) . '" target="_blank">' . __( 'Click here', 'education-elite' ) . '</a></span><br />';

    $wp_customize->add_control( new Education_Zone_Theme_Info( $wp_customize ,'theme_info_theme',array(
        'label' => __( 'About Education Elite' , 'education-elite' ),
        'section' => 'theme_info',
        'description' => $theme_info
        )));

    $wp_customize->add_setting('theme_info_more_theme',array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    /** CTA Label */
    $wp_customize->add_setting(
        'education_elite_cta_label',
        array(
            'default'           => __( 'Apply Now', 'education-elite' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'education_elite_cta_label',
        array(
            'label'   => __( 'CTA Label', 'education-elite' ),
            'section' => 'education_zone_top_header_settings',
            'type'    => 'text',
        )
    );

    /** CTA Link */
    $wp_customize->add_setting(
        'education_elite_cta_link',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'education_elite_cta_link',
        array(
            'label'   => __( 'CTA Link', 'education-elite' ),
            'section' => 'education_zone_top_header_settings',
            'type'    => 'text',
        )
    );

    /** Enable/Disable Search Form */
    $wp_customize->add_setting( 
        'education_elite_ed_search_form', 
        array(
            'default'           => true,
            'sanitize_callback' => 'education_zone_sanitize_checkbox'
        ) 
    );

    $wp_customize->add_control(
        'education_elite_ed_search_form',
        array(
            'section'     => 'education_zone_top_header_settings',
            'label'       => __( 'Enable Search Form', 'education-elite' ),
            'description' => __( 'Enable to show search form in header.', 'education-elite' ),
            'type'        => 'checkbox',
        )
    );

    /** Enable Social Links in Header */   
    $wp_customize->add_setting(
        'education_zone_ed_social_header',
        array(
            'default'           => '',
            'sanitize_callback' => 'education_zone_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'education_zone_ed_social_header',
        array(
            'label'   => __( 'Enable Social Links', 'education-elite' ),
            'section' => 'education_zone_top_header_settings',
            'type'    => 'checkbox',
        )
    );
    
    /** Banner enquiry button text */
    $wp_customize->add_setting(
        'education_zone_banner_btn_two_label',
        array(
            'default'           => __( 'Enquiry', 'education-elite' ),
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    
    $wp_customize->add_control(
        'education_zone_banner_btn_two_label',
        array(
            'label'   => __( 'Button Two Texts', 'education-elite' ),
            'section' => 'education_zone_banner_settings', 
            'type'    => 'text',
        )
    );

    /** Banner enquiry button URL */
    $wp_customize->add_setting(
        'education_zone_banner_btn_two_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    
    $wp_customize->add_control(
        'education_zone_banner_btn_two_url',
        array(
            'label'   => __( 'Button Two Link', 'education-elite' ),
            'section' => 'education_zone_banner_settings', 
            'type'    => 'text',
        )
    );

    /** Featured Course Button Text */
    $wp_customize->add_setting(
        'education_zone_featured_course_btn_label',
        array(
            'default'           => __( 'Learn More', 'education-elite' ),
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    
    $wp_customize->add_control(
        'education_zone_featured_course_btn_label',
        array(
            'label'       => __( 'Button Label', 'education-elite' ),
            'section'     => 'education_zone_featured_courses_section_settings', 
            'description' => __( 'CTA button label to view courses listing page', 'education-elite'),
            'type'        => 'text',
        )
    );

    /** Featured Course Button URL */
    $wp_customize->add_setting(
        'education_zone_featured_course_btn_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    
    $wp_customize->add_control(
        'education_zone_featured_course_btn_url',
        array(
            'label'       => __( 'Button Link', 'education-elite' ),
            'section'     => 'education_zone_featured_courses_section_settings', 
            'description' => __( 'CTA button link to view courses listing page', 'education-elite'),
            'type'        => 'text',
        )
    );

    /** Testimonial Readmore */
    $wp_customize->add_setting(
        'education_elite_testimonial_readmore',
        array(
            'default'           => __( 'Read All Testimonials', 'education-elite' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'education_elite_testimonial_readmore',
        array(
            'section' => 'education_zone_testimonials_section_settings',
            'label'   => __( 'Button Label', 'education-elite' ),
            'type'    => 'text',
        )
    );

    /**  Link */
    $wp_customize->add_setting(
        'education_elite_testimonial_readmore_link',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'education_elite_testimonial_readmore_link',
        array(
            'section' => 'education_zone_testimonials_section_settings',
            'label'   => __( 'Button Link', 'education-elite' ),
            'type'    => 'text',
        )
    );

    /**  View All blog Label */
    $wp_customize->add_setting(
        'education_elite_blog_viewall_label',
        array(
            'default'           => __( 'View All Blog', 'education-elite' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'education_elite_blog_viewall_label',
        array(
            'section'     => 'education_zone_blog_section_settings',
            'label'       => __( 'Button Label', 'education-elite' ),
            'description' => __( 'CTA button label to view blog listing page', 'education-elite'),
            'type'        => 'text',
        )
    );

}
add_action( 'customize_register', 'education_elite_customize_register', 100 );

/**
 * Site Header
*/   
function education_zone_site_header(){

    $phone          = get_theme_mod( 'education_zone_phone' );
    $email          = get_theme_mod( 'education_zone_email' );
    $ed_social_link = get_theme_mod( 'education_zone_ed_social', false ); // From customizer
    $ed_search_form = get_theme_mod( 'education_elite_ed_search_form', true ); // From customizer
    $cta_label      = get_theme_mod( 'education_elite_cta_label', __( 'Apply Now', 'education-elite' ) );
    $cta_links      = get_theme_mod( 'education_elite_cta_link' );
    $social_links   = get_theme_mod( 'education_zone_ed_social_header' );
    ?>
     
    <header id="masthead" class="site-header header-two" role="banner" itemscope itemtype="https://schema.org/WPHeader">
        <div class="header-holder">
            <?php 
            if( has_nav_menu( 'secondary' ) || $ed_social_link ){ ?>
                <div class="header-top">
                    <div class="container">
                        <?php 
                            if( has_nav_menu( 'secondary' ) ){ ?>
                                <div class="top-links">
                                    <nav id="secondary-navigation" class="secondary-nav" role="navigation">               
                                        <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'fallback_cb' => false ) ); ?>
                                    </nav><!-- #site-navigation -->
                                </div>
                            <?php 
                            } 
                        
                            if( $social_links && $ed_social_link ) do_action('education_zone_social'); 
                        ?>
                    </div>
                </div>
            <?php } ?>

            <div class="header-m">
                <div class="container">

                    <?php 
                        education_zone_site_branding(); 
                        
                        if( $email || $phone || ( $cta_label && $cta_links ) ){

                            ?>
                            <div class="header-info">
                                <?php 
                                    if( $email || $phone ){
                                        if( $phone ){ ?>
                                           <div class="phone">
                                               <span class="label"><?php esc_html_e( 'Phone Number','education-elite' ); ?></span>
                                               <a href="<?php echo esc_url( 'tel:'. preg_replace('/[^\d+]/', '', $phone ) ); ?>" class="tel-link"><?php echo esc_html( $phone ); ?></a>
                                           </div>
                                        <?php } 

                                        if( $email ){ ?>   
                                           <div class="email">
                                               <span class="label"><?php esc_html_e( 'E-Mail','education-elite' ); ?></span>
                                               <a href="<?php echo esc_url( 'mailto:'. $email ); ?>"><?php echo esc_html( $email ); ?></a>
                                           </div>
                                       <?php } 
                                    } 

                                    if( $cta_label && $cta_links ){ ?>
                                       <div class="btn-cta">
                                           <a href="<?php echo esc_url( $cta_links ); ?>"><?php echo esc_html( $cta_label ); ?></a>
                                       </div>
                                    <?php } ?>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="sticky-holder"></div>  
        <div class="header-bottom">
            <div class="container">
                <nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">                        
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                </nav><!-- #site-navigation -->
                <?php 
                
                if( $ed_search_form ){ ?>
                    <div class="form-section">
                        <a href="#" id="search-btn" class="search-toggle-btn" data-toggle-target=".header-search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".header-search-modal .search-field">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </a>
                        <div class="example head-search-form search header-searh-wrap header-search-modal cover-modal" data-modal-target-string=".header-search-modal">                       
                            <?php get_search_form(); ?>
                            <button class="btn-form-close" data-toggle-target=".header-search-modal" data-toggle-body-class="showing-search-modal" aria-expanded="false" data-set-focus=".header-search-modal">  </button>
                        </div>
                    </div>
                 <?php 
                } ?>
            </div>
        </div>
        
    </header><!-- #masthead -->
    <?php
}

// Site Footer
function education_zone_footer_bottom(){
    ?>
    <div class="site-info">
        <?php if( get_theme_mod('education_zone_ed_social') ) do_action('education_zone_social'); 

        $copyright_text = get_theme_mod( 'education_zone_footer_copyright_text' ); ?>
            
        <p> 
        <?php 
            if( $copyright_text ){
                echo '<span>' .wp_kses_post( $copyright_text ) . '</span>';
            }else{
                echo '<span>';
                echo  esc_html__( 'Copyright &copy;', 'education-elite' ) . date_i18n( esc_html__( 'Y', 'education-elite' ) ); 
                echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>.</span>';
            }?>
            <span class="by">
                <?php echo esc_html__( 'Education Elite | Developed By', 'education-elite' ); ?>
                <a rel="nofollow" href="<?php echo esc_url( 'https://rarathemes.com/' ); ?>" target="_blank"><?php echo esc_html__( 'Rara Theme', 'education-elite' ); ?></a>.
                <?php printf( esc_html__( 'Powered by %s.', 'education-elite' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'education-elite' ) ) .'" target="_blank">WordPress</a>' ); ?>
            </span>
            <?php 
                if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link();
                }
            ?>
        </p>
    </div><!-- .site-info -->
    <?php
}