<?php

if ( get_option( 'page_for_posts' ) ) {
	MedicareTheme::$boldthemes_page_for_header_id = get_option( 'page_for_posts' );
}

MedicareTheme::$what = 'index';
if ( is_search() ) {
	MedicareTheme::$what = 'search';
}

get_header();

if ( have_posts() ) {
	
	while ( have_posts() ) {
	
		the_post();
		
		$images = boldthemes_rwmb_meta( BoldThemesPFX . '_images', 'type=image' );
		if ( $images == null ) $images = array();
		$video = boldthemes_rwmb_meta( BoldThemesPFX . '_video' );
		$audio = boldthemes_rwmb_meta( BoldThemesPFX . '_audio' );
		
		$link_title = boldthemes_rwmb_meta( BoldThemesPFX . '_link_title' );
		$link_url = boldthemes_rwmb_meta( BoldThemesPFX . '_link_url' );
		$quote = boldthemes_rwmb_meta( BoldThemesPFX . '_quote' );
		$quote_author = boldthemes_rwmb_meta( BoldThemesPFX . '_quote_author' );
		
		$permalink = get_permalink();
		
		$post_format = get_post_format();
	
		$media_html = '';
		
		if ( has_post_thumbnail() ) {
		
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$img = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
			
			if ( $img != '' ) {
				$media_html = boldthemes_get_media_html( 'image', array( $permalink, $img[0] ) );
			}
			
		}
		
		if ( $post_format == 'image' ) {
		
			foreach ( $images as $img ) {
				$img = wp_get_attachment_image_src( $img['ID'], 'large' );
				$media_html = boldthemes_get_media_html( 'image', array( $permalink, $img[0] ) );
				break;
			}
			
		} else if ( $post_format == 'gallery' ) {
		
			if ( count( $images ) > 0 ) {
				$images_ids = array();
				foreach ( $images as $img ) {
					$images_ids[] = $img['ID'];
				}			
				$media_html = boldthemes_get_media_html( 'gallery', array( $images_ids ) );
			}
			
		} else if ( $post_format == 'video' ) {
			
			$media_html = boldthemes_get_media_html( 'video', array( $video ) );
			
		} else if ( $post_format == 'audio' ) {
			
			$media_html = boldthemes_get_media_html( 'audio', array( $audio ) );
			
		} else if ( $post_format == 'link' ) {
			
			$media_html = boldthemes_get_media_html( 'link', array( $link_url, $link_title ) );
			
		} else if ( $post_format == 'quote' ) {
			
			$media_html = boldthemes_get_media_html( 'quote', array( $quote, $quote_author ) );
			
		}

		$content_html = apply_filters( 'the_content', get_the_content( '', false ) );
		$content_html = str_replace( ']]>', ']]&gt;', $content_html );
		
		$categories = get_the_category();
		$categories_html = '';
		if ( $categories ) {
			$categories_html = '<span class="btArticleCategories">';
			foreach ( $categories as $cat ) {
				$categories_html .= '<a href="' . esc_url_raw( get_category_link( $cat->term_id ) ) . '" class="btArticleCategory">' . esc_html( $cat->name ) . '</a>';
			}
			$categories_html .= '</span>';
		}

		if ( is_search() ) $share_html = '';
		
		$blog_author = boldthemes_get_option( 'blog_author' );
		$blog_date = boldthemes_get_option( 'blog_date' );		
		
		$blog_side_info = boldthemes_get_option( 'blog_side_info' );
		$blog_list_view = boldthemes_get_option( 'blog_list_view' );

		$blog_use_dash = boldthemes_get_option( 'blog_use_dash' );
		
		$class_array = array( 'btArticleListItem', 'animate', 'animate-fadein', 'animate-moveup', 'gutter' );
		
		if ( $blog_side_info ) $class_array[] = 'btHasAuthorInfo';
		if ( $media_html != '' ) $class_array[] = 'wPhoto';
		
		$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
		$author_html = '<a href="' . esc_url_raw( $author_url ) . '" class="btArticleAuthor">' . esc_html( get_the_author() ) . '</a>';

		$comments_open = comments_open();
		$comments_number = get_comments_number();
		$show_comments_number = true;
		if ( ! $comments_open && $comments_number == 0 ) {
			$show_comments_number = false;
		}

		$post_type = get_post_type();
		
		$content_final_html = get_post()->post_excerpt != '' || is_search() ? '<p>' . esc_html( get_the_excerpt() ) . '</p>' : $content_html;

		if ( boldthemes_get_option( 'blog_list_view' ) == 'columns' ) {
			include( get_template_directory() . '/views/post-list-columns.php' );
		} else {
			include( get_template_directory() . '/views/post-list-standard.php' );
		}

	}
	
	boldthemes_pagination();
	
} else {
	if ( is_search() ) { ?>
		<article class="btNoSearchResults boldSection gutter bottomSemiSpaced topSemiSpaced ">
			<div class="port">
			<?php echo boldthemes_get_heading_html( '', esc_html__( 'We are sorry, no results for: ', 'medicare' ) . get_query_var( 's' ), "<a href='" . site_url() . "'>" . esc_html__( 'Back to homepage', 'medicare' )."</a>", 'medium', '', '', '' ) ?>
			</div>
		</article>
	<?php }
}
 
?>

<?php

get_footer();

?>