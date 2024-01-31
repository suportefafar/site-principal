<?php


function get_custom_banner() {
	
	global $wpdb;
    
	
	if( !is_search() && !is_404() ) {

		$banner_image_url = '';
        $title = '';
        $subtitle = '';

        $categories = get_the_category();
    
        $category = $categories[0];
    
        if( isset( $category ) ) {
                
            $slider = $wpdb->get_row( "SELECT * FROM wp_revslider_sliders WHERE alias = '$category->slug'" );

            // Banner Content
            $title  = $category->description;
            $subtitle  = '';

        } else {

            $post_data = get_queried_object();

            $author_id = $post_data->post_author;
    
            $author_nicename = get_the_author_meta('user_nicename', $author_id);

            $slider = $wpdb->get_row( "SELECT * FROM wp_revslider_sliders WHERE alias = '$author_nicename'" );

            // Banner Content
            $title  = get_the_author_meta( 'description', $author_id );
            
            $subtitle  = '';

        }

        $slides = $wpdb->get_results( "SELECT * FROM wp_revslider_slides WHERE slider_id = $slider->id" );

        if( count( $slides ) > 0 ) {

            $newest_slide =  end($slides);

            $image_slide_url = json_decode( $newest_slide->params )->image;

            $relative_image_slide_url = explode( 'wp-content', $image_slide_url )[1];

            $banner_image_url = site_url( '/wp-content' . $relative_image_slide_url, 'https' );

        } else { 

            // Set a default image URL
            $banner_image_url = 'https://www.farmacia.ufmg.br/wp-content/uploads/2015/06/fafar1.jpg';

        }

   
        $html = '<div class="page-banner-container banner-image-custom-transition" style="background-image: url(' . $banner_image_url . ');">' .
                        '<div class="page-banner-body">' .
                            '<h2 class="page-banner-title">' . $title  . '</h2>' .
                            '<h3 class="page-banner-subtitle">' . $subtitle  . '</h3>' .
                    '</div>' .
                '</div>';
    
        echo $html;
    }
}

add_action( 'astra_content_before', 'get_custom_banner' );