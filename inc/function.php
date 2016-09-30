<?php

# Posts view count ...
function ppw_posts_view_count( $postID ){
    $metakey = 'ppw_posts_view';
    $views = get_post_meta( $postID, $metakey, true );
    
    $count = ( empty( $views ) ? 0 : $views );
    $count++;
    
    update_post_meta( $postID, $metakey, $count );
    
    //echo $views;
    //ppw_posts_view_count( get_the_ID() );
}

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

/*** Code for post read more ***/

function excerpt($num) {
    $limit = $num+1;
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt)."<a href='" .get_permalink($post->ID) ." ' class='".readMore."'>Read
    More &raquo;</a>";
    return $excerpt;
}