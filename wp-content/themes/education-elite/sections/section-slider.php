<?php
/**
 * Banner Section
*/ 
    
$banner_post   = get_theme_mod( 'education_zone_banner_post' );
$read_more     = get_theme_mod( 'education_zone_banner_read_more', __( 'Read More', 'education-elite' ) );
$btn_two_label = get_theme_mod( 'education_zone_banner_btn_two_label', __( 'Enquiry', 'education-elite' ) );
$btn_two_url   = get_theme_mod( 'education_zone_banner_btn_two_url', '#' );
 do_action( 'register_form_subject' ) ;
if( $banner_post ){
    echo '<div class="banner-wrapper">';
        $qry = new WP_Query( "p=$banner_post" );

        if( $qry->have_posts() ){ 
            while( $qry->have_posts() ){   
                $qry->the_post();
                if( has_post_thumbnail() ){ 
                    the_post_thumbnail( 'education-zone-banner' ); ?>  
                    <div class="banner-text">
                        <div class="container">
                            <div class="text">
                                <h2 class="title"><?php the_title(); ?></h2>
                                <?php if( $read_more ): ?>
                                <a href="<?php the_permalink(); ?>" class="apply-now"><?php echo esc_html( $read_more ); ?></a>
                                <?php endif; 

                                if ( $btn_two_label && $btn_two_url ) {
                                    echo '<a href="'. esc_url( $btn_two_url ) .'" class="apply-now btn-two">' . esc_html( $btn_two_label ) . '</a>';
                                } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    
                }
            }
            
            wp_reset_postdata();
        }
    echo '</div>';
} 