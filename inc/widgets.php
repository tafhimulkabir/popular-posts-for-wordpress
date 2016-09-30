<?php

# Create custom widget ...
class ppw_popular_posts_widget extends WP_Widget{
    # Setup the widget name and description e.t.c...
    public function __construct(){
        $widget_pos = array(
            'classname'         => 'popular-posts-widget',
            'description'       => 'A list of your popular posts'
        );
        parent::__construct( 'popular_posts_widget', 'Popular Posts', $widget_pos );
    }
    
    # Back-end display for widget ...
    public function form( $instance ){
        $title      = ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'Popular Posts'  );
        $tot        = ( !empty( $instance[ 'tot' ] ) ? absint( $instance[ 'tot' ] ) : 5 );
        
        $output = '<p>';
        $output .= '<lable for="'.esc_attr( $this->get_field_id( 'title' ) ).'"> Title : </lable>';
        $output .= '<input type="text" class="widefat" id="'.esc_attr( $this->get_field_id( 'title' ) ).'" name="'.esc_attr( $this->get_field_name( 'title' ) ).'" value="'.esc_attr( $title ).'">';
        $output .= '</p>';
        
        $output .= '<p>';
        $output .= '<lable for="'.esc_attr( $this->get_field_id( 'tot' ) ).'"> Numbr of Posts : </lable>';
        $output .= '<input type="number" class="widefat" id="'.esc_attr( $this->get_field_id( 'tot' ) ).'" name="'.esc_attr( $this->get_field_name( 'tot' ) ).'" value="'.esc_attr( $tot ).'">';
        $output .= '</p>';
        
        echo $output;
        
    }
    
    # Update widget data ...
    public function update( $new_instance, $old_instance ){
        $instance = array();
        $instance[ 'title' ] = ( !empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '' );
        $instance[ 'tot' ] = ( !empty( $new_instance['tot'] ) ? absint( strip_tags( $new_instance['tot'] ) ) : 0 );
        
        return $instance;
        
    }
    
    # Front-end display for widget ...
    public function widget( $args, $instance ){
        
        $tot = absint( $instance[ 'tot' ] );
        $post_args = array(
            'post_type'         => 'post',
            'posts_per_page'    => $tot,
            'meta_key'          => 'ppw_posts_view',
            'oderby'            => 'meta_value_num',
            'oder'              => 'DESC'
            
        );
        
        $post_query = new WP_Query( $post_args );
        
        echo $args[ 'before_widget' ];
        
            if( !empty( $instance[ 'title' ] ) ) :
                echo $args[ 'before_title' ].apply_filters( 'widget_title', $instance[ 'title' ] ).$args[ 'after_title' ];
            endif;
        
            if( $post_query->have_posts() ) :
                echo '<div class="popular-posts-custom-widget">';
                    while( $post_query->have_posts() ) : $post_query->the_post();
                        echo '<div class="fix">';
                        echo '<div class="col-xs-5 popular-posts-thumbnail">'.get_the_post_thumbnail(). '</div>';
                        echo '<div class="col-xs-7">';
                        the_title( sprintf( '<h4 class="popular-post-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h4>' );
                        echo '<p>'.excerpt(8).'</p>';
                        echo '</div>';
                        echo '</div>';
                    endwhile;
        
                echo '</div>';
            endif;
        
        echo $args[ 'after_widget' ];
        
    }
    
}

add_action( 'widgets_init', function(){
    register_widget( 'ppw_popular_posts_widget' );
} );