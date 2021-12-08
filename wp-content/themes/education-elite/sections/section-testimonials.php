<?php 
/**
 * 
 * Testimonial Section
*/

$section_title       = get_theme_mod( 'education_zone_testimonials_section_title' );
$testimonial_cat     = get_theme_mod( 'education_zone_testimonial_category' );
$testimonial_btn     = get_theme_mod( 'education_elite_testimonial_readmore', __( 'Read All Testimonials', 'education-elite' ) ); 
$testimonial_btn_url = get_theme_mod( 'education_elite_testimonial_readmore_link' ); ?>
 
<div class="image-wrapper">
	<div class="container">
		
        <?php education_zone_get_section_header( $section_title );
        
        
		if( $testimonial_cat ){
            $args = array(
                'posts_per_page' => -1,
                'post_type'      => 'post',
                'tax_query'      => array(
					array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => array( 'post-format-gallery' ),
					'operator' => 'NOT IN',
					)),
                'cat' => $testimonial_cat,
            );		  
		  
            $qry = new WP_Query( $args );

            if( $qry->have_posts() ){ ?>
                <ul class="testimonial-slide owl-carousel">
                    <?php 
                    while( $qry->have_posts() ){ $qry->the_post(); ?>
                    <li>
                        <blockquote>
                        <?php the_content(); ?>
                            <cite>
                                <div class="text">
                                    <?php if(has_post_thumbnail()) the_post_thumbnail( 'education-zone-testimonial' ); ?>
                                    <span><?php the_title(); ?></span>
                                </div>
                            </cite>
                        </blockquote>
                    </li>
                    <?php 
                    }
                    wp_reset_postdata(); ?>
                </ul>
                
            <?php 
                if ( $testimonial_btn && $testimonial_btn_url ) {
                    echo '<a class="learn-more" href="'. esc_url( $testimonial_btn_url ) .'">'. esc_html( $testimonial_btn ) .'</a>';
                }
            } 
        } 
        ?>        
    </div>
</div>
