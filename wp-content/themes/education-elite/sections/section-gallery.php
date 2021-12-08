<?php 
/**
 * 
 * Gallary Section
*/

$gallery_post = get_theme_mod( 'education_zone_gallery_post' );

if( $gallery_post ){
    
    $gallery_qry = new WP_Query( "p=$gallery_post" );
    
    if( $gallery_qry->have_posts()){
        while( $gallery_qry->have_posts()){ 
            $gallery_qry->the_post();
            the_title( '<h2 class="section-title">', '</h2>' );
            the_content(); 
        } 
        wp_reset_postdata();
    } 
    
}