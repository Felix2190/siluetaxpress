<?php
if ( ! function_exists( 'boldthemes_breadcrumbs' ) ) {
	function boldthemes_breadcrumbs( $simple = false ) {

		global $post;
		
		$post_type = get_post_type( get_the_ID() );
		
		$post_id = get_the_ID();
		
		$home = esc_html__( 'Home', 'medicare' );
		$home_link = home_url( '/' );
		$title = '';
		$output  = '';
		$item_prefix = '<li>';
		$item_sufix = '</li>';
		if( !$simple ) {
			$item_prefix = '';
			$item_sufix = ' / ';
		}

		if ( ! is_404() && ! is_home() ) {
		
			if( !$simple ) $output .= '<div class="btBreadCrumbs"><nav><ul><li><a href="' . esc_url_raw( $home_link ) . '">' . esc_html( $home ) . '</a></li>';
			else $output .= '<a href="' . esc_url_raw( $home_link ) . '">' . esc_html( $home ) . '</a>';
			
			if ( is_category() ) {

				$title = esc_html__( 'Category:', 'medicare' ) . ' ' . single_cat_title( '', false );
				$output .= $item_prefix . $title . $item_sufix;
		  
			} else if ( is_singular( 'page' ) ) {

				$a_arr = get_post_ancestors( get_the_ID() );
				foreach( $a_arr as $a_id ) {
					$a_post = get_post( $a_id );
					$output .= $item_prefix . '<a href="' . esc_url_raw( get_permalink( $a_id ) ) . '">' . esc_html( $a_post->post_title ) . '</a>' . wp_kses_post( $item_sufix );
				}
				$output .= $item_prefix . get_the_title();

			} else if ( is_singular( 'post' ) ) {
			
				$categories = get_the_category();
				$output .= $item_prefix;
				$n = 0;
				foreach( $categories as $cat ) {
					$n++;
					$output .= '<a href="' . esc_url_raw( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
					if ( $n < count( $categories ) ) $output .= ', ';
				}
				$output .= $item_sufix;
				$output .= $item_prefix . get_the_title() . $item_sufix;
				
			} else if ( is_post_type_archive( 'portfolio' ) ) {
				
				$title = esc_html__( 'Portfolio', 'medicare' );
				$output .= $item_prefix . $title . $item_sufix;
				
			} else if ( is_singular( 'portfolio' ) ) {
				
				$output .= $item_prefix . esc_html__( 'Portfolio', 'medicare' ) . $item_sufix;
				$output .= $item_prefix . get_the_title() . $item_sufix;
				
			} else if ( is_attachment() ) {
			
				$title = get_the_title();
				$output .= $item_prefix . $title . $item_sufix;
		  
			} else if ( is_tag() ) {
			
				$title = esc_html__( 'Tag:', 'medicare' ) . ' ' . single_tag_title( '', false );
				$output .= $item_prefix . $title . $item_sufix;
		  
			} else if ( is_author() ) {
			
				$title = esc_html__( 'Author:', 'medicare' ) . ' ' . get_the_author_meta( 'display_name' );
				$output .= $item_prefix .  $title . $item_sufix;
				
			} else if ( is_day() ) {

				$title = get_the_time( 'Y / m / d' );
				$output .= $item_prefix . $title . $item_sufix;
		  
			} else if ( is_month() ) {
			
				$title = get_the_time( 'Y / m' );
				$output .= $item_prefix . $title . $item_sufix;
		  
			} else if ( is_year() ) {
			
				$title = get_the_time( 'Y' );
				$output .= $item_prefix . $title . $item_sufix;			
				
			} else if ( is_search() ) {
				
				$title = esc_html__( 'Search:', 'medicare' ) . ' ' . get_query_var( 's' );
				$output .= $item_prefix . $title . $item_sufix;			
				
			} else {
				$title = get_the_title();
				$output .= $item_prefix . $title . $item_sufix;
			}
			
			if( !$simple ) $output .= '</ul></nav></div>';
		}
	return $output;
	}
}