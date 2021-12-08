<?php
/**
 * Courses Section
*/
 
$section_title = get_theme_mod( 'education_zone_courses_section_title' );
$post_one      = get_theme_mod( 'education_zone_featured_courses_post_one' );
$post_two      = get_theme_mod( 'education_zone_featured_courses_post_two' );
$post_three    = get_theme_mod( 'education_zone_featured_courses_post_three' );
$post_four     = get_theme_mod( 'education_zone_featured_courses_post_four' );
$btn_label     = get_theme_mod( 'education_zone_featured_course_btn_label', __( 'Learn More', 'education-elite' ) );
$btn_link      = get_theme_mod( 'education_zone_featured_course_btn_url', '#' );

$course_posts = array( $post_one, $post_two, $post_three, $post_four );
$course_posts = array_diff( array_unique( $course_posts ), array('') );

    $args = array(
        'post__in'  => $course_posts,
        'orderby'   => 'post__in',
        'tax_query' => array(
			array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array( 'post-format-gallery' ),
			'operator' => 'NOT IN',
			)
        ),
    );

$qry = new WP_Query( $args );
?>
<div class="container">
	<?php education_zone_get_section_header( $section_title );
	
    if( $course_posts && $qry->have_posts() ){ ?>
        <ul>
        <?php           
            while( $qry->have_posts() ){ 
                $qry->the_post(); ?>
                
                <li>
        
        			<div class="image-holder" tabindex="0">
        				<?php 
                        if(has_post_thumbnail()){
                            the_post_thumbnail( 'education-zone-featured-course' );
                        }else{ 
                            education_zone_get_fallback_svg( 'education-zone-featured-course' );
                        } ?>
        				<div class="text">
        					<span><?php the_title(); ?></span>
        				</div>
        				<div class="description">
        					<h2><?php the_title(); ?></h2>
        					<?php the_excerpt();?>
        					<a href="<?php the_permalink(); ?>" class="learn-more"><?php echo esc_html__( 'Learn More', 'education-elite' ); ?></a>
        				</div>
        			</div>
                   

                </li>
                
		<?php } 
            wp_reset_postdata();
        ?>
        </ul>
        <?php 
        if ( $btn_label && $btn_link ) {
            echo '<a href="'. esc_url( $btn_link ) .'" class="learn-more">'. esc_html( $btn_label ) .'</a>';
        }
    } ?>
</div>
