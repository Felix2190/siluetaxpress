<?php
/**
 * Post media HTML
 *
 * @param string
 * @param array
 * @return string
 */
if ( ! function_exists( 'boldthemes_get_media_html' ) ) {
	function boldthemes_get_media_html( $type, $data ) {
		
		$html = '';
		
		if ( $type == 'image' ) {
		
			$data_attr = '';
			if ( isset( $data[2] ) ) {
				$data_attr = 'data-hw="' . esc_attr( $data[2] ) . '"';
			}
			$html = '<div class="btMediaBox" ' . ( $data_attr ) . '><div class="bpbItem">';
			$html .= '<a href="' . esc_url_raw( $data[0] ) . '"><img src="' . esc_url_raw( $data[1] ) . '" alt="' . esc_attr( basename( $data[1] ) ) . '"></a>';
			$html .= '</div></div>';
			
		} else if ( $type == 'image_single_post' ) {
		
			$data_attr = '';
			if ( isset( $data[2] ) ) {
				$data_attr = 'data-hw="' . esc_attr( $data[2] ) . '"';
			}
			$html = '<div class="btMediaBox" ' . ( $data_attr ) . '><div class="bpbItem">';
			$html .= '<img src="' . esc_url_raw( $data[1] ) . '" alt="' . esc_attr( basename( $data[1] ) ) . '">';
			$html .= '</div></div>';			
			
		} else if ( $type == 'gallery' ) {
			
			$data_attr = '';
			if ( isset( $data[1] ) ) {
				$data_attr = ' ' . 'data-hw="' . esc_attr( $data[1] ) . '"';
			}
			if ( isset( $data[2] ) ) {
				$html = '<div class="btMediaBox"' . sanitize_text_field( $data_attr ) . '>' . do_shortcode( '[gallery ids="' . join( ',', $data[0] ) . '" size="' . esc_attr( $data[2] ) . '"]' ) . '</div>';
			} else {
				$html = '<div class="btMediaBox"' . sanitize_text_field( $data_attr ) . '>' . do_shortcode( '[gallery ids="' . join( ',', $data[0] ) . '"]' ) . '</div>';
			}
			
		} else if ( $type == 'grid_gallery' ) {
			
			$html = '<div class="btMediaBox">' . do_shortcode( '[bt' . '_grid_gallery ids="' . join( ',', $data[0] ) . '" columns="' . esc_attr( $data[1] ) . '" has_thumb="' . 
				esc_attr( $data[2] ) . '" format="' . esc_attr( $data[3] ) . '" lightbox="' . esc_attr( $data[4] ) . '" grid_gap="' . esc_attr( $data[5] ) . '"]' ) . '</div>';
			
		} else if ( $type == 'video' ) {
		
			$hw = 9 / 16;
			
			$html = '<div class="btMediaBox video" data-hw="' . esc_attr( $hw ) . '"><img class="aspectVideo" src="' . esc_url_raw( get_template_directory_uri() . '/gfx/video-16.9.png' ) . '" alt="' . esc_url_raw( get_template_directory_uri() . '/gfx/video-16.9.png' ) . '" role="presentation" aria-hidden="true">';

			if ( strpos( $data[0], 'vimeo.com/' ) > 0 ) {
				$video_id = substr( $data[0], strpos( $data[0], 'vimeo.com/' ) + 10 );
				$html .= '<ifra' . 'me src="' . esc_url_raw( 'https://player.vimeo.com/video/' . ( $video_id ) ) . '" allowfullscreen></ifra' . 'me>';
			} else {
				$yt_id_pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@#?&%=+\/\$_.-]*~i';
				$youtube_id = ( preg_replace( $yt_id_pattern, '$1', $data[0] ) );
				if ( strlen( $youtube_id ) == 11 ) {
					$html .= '<ifra' . 'me width="560" height="315" src="' . esc_url_raw( 'https://www.youtube.com/embed/' . ( $youtube_id ) ) . '" allowfullscreen></ifra' . 'me>';
				} else {
					$html = '<div class="btMediaBox video" data-hw="' . esc_attr( $hw ) . '">';				
					$html .= do_shortcode( $data[0] );
				}
			}
			
			$html .= '</div>';
			
			if ( $data[0] == '' ) {
				$html = '';
			}
			
		} else if ( $type == 'audio' ) {
		
			if ( strpos( $data[0], '</ifra' . 'me>' ) > 0 ) {
				$html = '<div class="btMediaBox audio">' . wp_kses( $data[0], array( 'iframe' => array( 'height' => array(), 'src' =>array() ) ) ) . '</div>';
			} else {
				$html = '<div class="btMediaBox audio">' . do_shortcode( $data[0] ) . '</div>';
			}
			
			if ( $data[0] == '' ) {
				$html = '';
			}
		
		} else if ( $type == 'link' ) {
		
			$html = '<div class="btMediaBox btDarkSkin btLink"><p><a href="' . esc_url_raw( $data[0] ) . '">' . wp_kses_post( $data[1] ) . '</a></p><cite><a href="' . esc_url_raw( $data[0] ) . '">' . esc_url_raw( $data[0] ) . '</a></cite></div>';
			
			if ( $data[1] == '' || $data[0] == '' ) {
				$html = '';
			}
			
		} else if ( $type == 'quote' ) {
		
			$html = '<div class="btMediaBox btQuote btDarkSkin"><p>' . wp_kses_post( $data[0] ) . '</p><cite>' . wp_kses_post( $data[1] ) . '</cite></div>';
			
			if ( $data[0] == '' || $data[1] == '' ) {
				$html = '';
			}
		
		}
		
		return $html;
	}
}

/**
 * Returns heading HTML
 *
 * @param string $superheadline
 * @param string $headline
 * @param string $subheadline
 * @param string $headline_size // small/medium/large/extralarge
 * @param string $dash // no/top/bottom
 * @param string $el_class
 * @param string $el_style
 * @return string
 */
if ( ! function_exists( 'boldthemes_get_heading_html' ) ) {
	function boldthemes_get_heading_html( $superheadline, $headline, $subheadline, $headline_size, $dash, $el_class, $el_style, $responsive = '', $header = false ) {
            
		if ( $header ) {
			if ( MedicareTheme::$what == 'index' && MedicareTheme::$boldthemes_page_for_header_id ) {
				$page = get_post( MedicareTheme::$boldthemes_page_for_header_id );
				$headline = $page->post_title;
				$excerpt = $page->post_excerpt;
				if ( $excerpt != '' ) {
					$subheadline = '<div class="btSubTitle">' . wp_kses_post( $excerpt ) . '</div>';
				}
			} else if ( MedicareTheme::$what == 'search' ) {
				$headline = esc_html__( 'Search', 'medicare' );
			} else if ( MedicareTheme::$what == 'woocommerce' && ! is_singular() && wc_get_page_id( 'shop' ) ) {
				$page = get_post( wc_get_page_id( 'shop' ) );
				$superheadline = '';
				$headline = $page->post_title;
				$excerpt = $page->post_excerpt;
				if ( $excerpt != '' ) {
					$subheadline = '<div class="btSubTitle">' . wp_kses_post( $excerpt ) . '</div>';
				}
			} else if ( is_page() ) {
				$page = get_post( get_the_ID() );
				$excerpt = $page->post_excerpt;
				if ( $excerpt != '' ) {
					$subheadline = '<div class="btSubTitle">' . wp_kses_post( $excerpt ) . '</div>';
				}
			}
		} else {
			if ( $superheadline != '' ) {
				$superheadline = '<div class="btSuperTitle">' . wp_kses_post( $superheadline ) . '</div>';
			}

			if ( $subheadline != '' ) {
				$subheadline = '<div class="btSubTitle">' . wp_kses_post( $subheadline ) . '</div>';
			}
		}
		
		$h_tag = 'h1';
		$class = array();

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = 'style="' . esc_attr( $el_style ) . '"';
		}

		if ( $headline_size != 'no' ) {
			$class[] = $headline_size;
		}
		if ( $headline_size == 'extralarge' || $headline_size == 'huge' ) {
			$h_tag = 'h1';
		} else if ( $headline_size == 'large' ) {
			$h_tag = 'h2';
		} else if ( $headline_size == 'medium' ) {
			$h_tag = 'h3';
		} else {
			$h_tag = 'h4';
		}

		if ( $dash == 'yes' ) {
			$dash = 'top';
		}
		
		if( $dash != 'no' && $dash != '' ) {
			$class[] = 'btDash ' . ( $dash ) . 'Dash';
		}

		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
		
		if ( $responsive && $responsive != '' ) {
			$class = array_merge( $class, preg_filter('/^/', 'bt_bb_', explode( ' ', $responsive ) ) );
		}
		
		$output = '<header class="header btClear ' . esc_attr( implode( ' ', $class ) ) . '" ' . ( $style_attr ) . '>';
		$output .= $superheadline;
                if ( $headline != '' ) {
			$pattern = "/<(strong|b|u|i)([> ])/";
			$replace = '<$1 class="animate">';
			$headline = preg_replace($pattern, $replace, $headline);
			$output .= '<div class="dash"><' . ( $h_tag ) . '><span class="headline">' . wp_kses_post( $headline ) . '</span></' . ( $h_tag ) . '></div>'; 	
		}
                
                $output .= $subheadline;
                $output .= '</header>';	

		return $output;
		
	}
}

/**
 * Returns icon HTML
 *
 * @param string $icon
 * @param string $url
 * @param string $text
 * @param string $el_class 
 * @return string
 */
 if ( ! function_exists( 'boldthemes_get_icon_html' ) ) {
	function boldthemes_get_icon_html( $icon, $url, $text, $el_class, $target = "", $el_style = "", $url_text = "" ) { 
		
		$icon_set = substr( $icon, 0, 2 );
		$icon = substr( $icon, 3 );
		
		if( substr( $url, 0, 3 ) == 'www') $url = "http://" . esc_url_raw( $url );

		$link = "";
	
		if ( $url != '' && $url != '#' && substr( $url, 0, 4 ) != 'http' && substr( $url, 0, 5 ) != 'https'  && substr( $url, 0, 6 ) != 'mailto' ) {
			$link_tmp = get_posts(
				array(
					'name'      => $url,
					'post_type' => 'page'
				)
			);
			
			if ( ( is_array( $link_tmp ) && count( $link_tmp ) > 0 && isset( $link_tmp[0]->ID ) ) ) {
				if ( substr( $url, 0, 4 ) == 'http' ) {
					$link = $url;
				} else {
					$link = get_permalink( $link_tmp[0]->ID );
				}
				
			} else {
				$link = $url;
			}
		} else {
			$link = $url;
		}
		

		if ( $target != '' ) $target = ' target = "' . ( $target ) . '"';

		if ( $text != '' ) $text = '<span class="btIcoText">' . wp_kses_post( $text ) . '</span>';

		$ico_tag = 'a ';
		if ( $link == '' ) {
			$ico_tag = 'span ';
			$ico_tag_end = 'span';	
		} else {
			$ico_tag = 'a href="' . esc_url_raw( $link ) . '" ' . ( $target );
			$ico_tag_end = 'a';
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}

		return '<span class="btIco ' . esc_attr( $el_class ) . '" ' . wp_kses_post( $style_attr ) . '><' . wp_kses_post( $ico_tag ) . ' data-ico-' . esc_attr( $icon_set ) . '="&#x' . esc_attr( $icon ) . ';" class="btIcoHolder"><em>' . esc_html( $url_text ) . '</em></' . wp_kses_post( $ico_tag_end ) . '>' . wp_kses_post( $text ) . '</span>';
	}
}


/**
 * Returns button HTML
 *
 * @param string $icon
 * @param string $url
 * @param string $text
 * @param string $el_class 
 * @param string $el_style 
 * @param string $target 
 * @return string
 */
 if ( ! function_exists( 'boldthemes_get_button_html' ) ) {
	function boldthemes_get_button_html( $icon, $url, $text, $el_class, $el_style = '', $target = '' ) {
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = 'style="' . esc_attr( $el_style ) . '"';
		}

		if ( $url == '' ) {
			$url = '#';
		}

		if ( $text != '' ) {
			$text = '<span class="btnInnerText">' . wp_kses_post( $text ) . '</span>';
		}

		if ( is_array( $el_class ) ) $el_class = implode( ' ', $el_class );

		if ( $icon == '' || $icon == 'no_icon' ) {
			$el_class .= " btnNoIcon";
		}

		$link = "";
	
		if ( $url != '' && $url != '#' && substr( $url, 0, 4 ) != 'http' && substr( $url, 0, 5 ) != 'https'  && substr( $url, 0, 6 ) != 'mailto' ) {
			$link_tmp = get_posts(
				array(
					'name'      => $url,
					'post_type' => 'page'
				)
			);
			
			if ( ( is_array( $link_tmp ) && count( $link_tmp ) > 0 && isset( $link_tmp[0]->ID ) ) ) {
				if ( substr( $url, 0, 4 ) == 'http' ) {
					$link = $url;
				} else {
					$link = get_permalink( $link_tmp[0]->ID );
				}
				
			} else {
				$link = $url;
			}
		} else {
			$link = $url;
		}

		$output = '<a href="' . esc_url_raw( $link ) . '" class="btBtn ' . esc_attr( $el_class ) . '"' . ' ' . ( $style_attr ) . ( $target ) . '>';
			if ( $icon == '' || $icon == 'no_icon' ) {
				$output .= $text;
			} else {
				$output .= $text . boldthemes_get_icon_html( $icon, '', '', '' );
			}
		$output .= '</a>';
		
		return $output;
	}
}

/**
 * Top bar HTML output
 */
 if ( ! function_exists( 'boldthemes_top_bar_html' ) ) {
	function boldthemes_top_bar_html( $type = 'top' ) {
		if ( is_active_sidebar( 'header_left_widgets' ) || is_active_sidebar( 'header_right_widgets' ) ) {
			if ( $type == 'top' ) { ?>
				<div class="topBar btClear">
					<div class="topBarPort btClear">
						<?php if ( is_active_sidebar( 'header_left_widgets' ) && boldthemes_get_option( 'menu_type' ) != 'hLeftBelow' && boldthemes_get_option( 'menu_type' ) != 'hRightBelow' && boldthemes_get_option( 'menu_type' ) != 'hCenterBelowLogo' ) { ?>
						<div class="topTools btTopToolsLeft btTextLeft">
							<?php dynamic_sidebar( 'header_left_widgets' ); ?>
						</div><!-- /ttLeft -->
						<?php } ?>
						<?php if ( is_active_sidebar( 'header_right_widgets' ) ) { ?>
						<div class="topTools btTopToolsRight btTextRight">
							<?php dynamic_sidebar( 'header_right_widgets' ); ?>
						</div><!-- /ttRight -->
						<?php } ?>
					</div><!-- /topBarPort -->
				</div><!-- /topBar -->
			<?php } else if( $type == 'menu' ) { ?>
				<div class="topBarInMenu">
					<div class="topBarInMenuCell">
						<?php // dynamic_sidebar( 'header_left_widgets' ); ?>
						<?php dynamic_sidebar( 'header_right_widgets' ); ?>
					</div><!-- /topBarInMenu -->
				</div><!-- /topBarInMenuCell -->
			<?php }	else if( $type == 'menu-half' && is_active_sidebar( 'header_left_widgets' )) { ?>	
				<div class="topBarInLogoArea">
					<span class="infoToggler"></span>
					<div class="topBarInLogoAreaCell">
						<?php dynamic_sidebar( 'header_left_widgets' ); ?>
					</div><!-- /topBarInLogoAreaCell -->
				</div><!-- /topBarInLogoArea -->		
			<?php }
		}

	}
}

/**
 * Preloader HTML output
 */
 if ( ! function_exists( 'boldthemes_preloader_html' ) ) {
	function boldthemes_preloader_html() {
		if ( ! boldthemes_get_option( 'disable_preloader' ) ) { ?>
			<div id="btPreloader" class="btPreloader fullScreenHeight">
				<div class="animation">
					<div><?php boldthemes_logo( 'preloader' ); ?></div>
					<div class="btLoader"></div>
					<p><?php echo boldthemes_get_option( 'preloader_text' ); ?></p>
				</div>
			</div><!-- /.preloader -->
		<?php }
	}
}

/**
 * Returns image with link HTML
 *
 * @param string $image
 * @param string $caption_text
 * @param string $size
 * @param string $url 
 * @param string $target
 * @param string $el_style 
 * @param string $el_class 
 * @return string
 */

 if ( ! function_exists( 'boldthemes_get_image_html' ) ) {
	function boldthemes_get_image_html( $image, $caption, $caption_text, $size, $shape, $url, $target, $show_titles, $el_style, $el_class, $alt = '' ) {

		$el_style = sanitize_text_field( $el_style );
		$el_class = sanitize_text_field( $el_class );
		
		if ( $size == '' ) $size = 'large';
		if ( $shape == 'circle' ) $el_class .= ' btCircleImage';
			
		$style_html = '';
		if ( $el_style != '' ) {
			$style_html= ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}	
		
		$output = '<div class = "btImage"><img src="' . esc_url_raw( $image ) . '" alt="' . esc_attr( $alt ) . '" ></div>';
		
		if ( strpos( $url, '<a href' ) === 0 ) {
			$link = $url;
		} else {
			$link = '';
		
			if ( $url != '' && $url != '#' && substr( $url, 0, 4 ) != 'http' && substr( $url, 0, 5 ) != 'https'  && substr( $url, 0, 6 ) != 'mailto' ) {
				$link_tmp = get_posts(
					array(
						'name'      => $url,
						'post_type' => 'page'
					)
				);
				
				if ( ( is_array( $link_tmp ) && count( $link_tmp ) > 0 && isset( $link_tmp[0]->ID ) ) ) {
					if ( substr( $url, 0, 4 ) == 'http' ) {
						$link = $url;
					} else {
						$link = get_permalink( $link_tmp[0]->ID );
					}
					
				} else {
					$link = $url;
				}
			} else {
				$link = $url;
			}			
			$link = '<a href="' . esc_url_raw( $link ) . '" target="' . esc_attr( $target ) . '"></a>';
		}

		if ( $caption != '' || $caption_text != '' ) {
		}
		
		if ( $url != '' ) {
			$link_output = '<div class="bpgPhoto ' . esc_attr( $el_class ) . '" ' . wp_kses_post( $style_html ) . '> 
					' . ( $link ) . '
					<div class="boldPhotoBox"><div class="bpbItem">' . wp_kses_post( $output ) . '</div></div>
					<div class="captionPane">
						<div class="captionTable">
							<div class="captionCell">
								<div class="captionTxt">';
			if ( $caption != '' || $caption_text != '' ) {
				$link_output .=			boldthemes_get_heading_html( '', $caption, $caption_text, 'small', 'bottom', 'btAlternateDash', '' );
			}
			$link_output .=		'</div>
							</div>
						</div>
					</div>';
					if ( $show_titles ) {
						$link_output .= '
						<div class="btShowTitle">
							<span class="btShowTitleCaptionTxt">'
									. boldthemes_get_heading_html( '', $caption, $caption_text, 'small', 'bottom', 'btAlternateDash', '' ) . 
								'</span>
						</div>';
					}
			$link_output .= '</div>';
			
			$output = $link_output;
		} else {
			$output = '<div class="bpgPhoto ' . esc_attr( $el_class ) . '" ' . wp_kses_post( $style_html ) . '>' . wp_kses_post( $output ) . '</div>';
		}
 		
		return $output;
	}
}

/**
 * Header headline output - OLD
 */
if ( ! function_exists( 'boldthemes_header_headline_old' ) ) {
	function boldthemes_header_headline_old() {
		$hide_headline = boldthemes_get_option( 'hide_headline' );
		if ( ( ! $hide_headline && ! is_404() && ! is_single() ) || is_search() ) { 
			$extra_class = '';
			$title = get_the_title( );
			if ( MedicareTheme::$boldthemes_page_for_header_id != '' ) {
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id( MedicareTheme::$boldthemes_page_for_header_id ) );
			} else {
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id() );
			}
			if ( $title != '' ) {
				$extra_class .= boldthemes_get_option( 'below_menu' ) ? ' topExtraExtraSpaced' : ' topSemiSpaced';
				$extra_class .= $feat_image ? ' wBackground cover btLightSkin' : '';
				echo '<section class="boldSection bottomSemiSpaced btPageHeadline gutter ' . esc_attr( $extra_class ) . '" style="background-image:url(' . esc_url_raw( $feat_image ) . ')"><div class="port">';
				echo boldthemes_get_heading_html( boldthemes_breadcrumbs(), $title,  '', 'extralarge', '', '', '', true );
				echo '</div></section>';
			}
			
		}
 	}
}

/*
 * Header headline output
 */
if ( ! function_exists( 'boldthemes_header_headline' ) ) {
	function boldthemes_header_headline() {
		$hide_headline  = boldthemes_get_option( 'hide_headline' );                
                
		if ( ( ! $hide_headline && ! is_404() ) || is_search() ) { 
                        $title       = '';
                        $excerpt     = '';
			$extra_class = '';
			if ( is_front_page() ) {
                                $title = get_bloginfo( 'description' );
                        } else if ( is_singular() ) {
                                $title = get_the_title();
                        } else {
                                $title = wp_title( '', false );
                        }
                       
                        if ( MedicareTheme::$boldthemes_page_for_header_id != '' && !is_single() ) {
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id( MedicareTheme::$boldthemes_page_for_header_id ) );                                
                                if ( ! $feat_image ) {
                                        if ( is_singular() &&  !is_singular( "product" ) ) {
                                                $feat_image = wp_get_attachment_url( get_post_thumbnail_id() );
                                        } else {
                                                $feat_image = false;
                                        }
                                }
                                $title      = get_the_title(MedicareTheme::$boldthemes_page_for_header_id);  
                                $excerpt    = boldthemes_get_the_excerpt( MedicareTheme::$boldthemes_page_for_header_id );
			} else {
				if ( is_singular() ) {
                                        $feat_image = wp_get_attachment_url( get_post_thumbnail_id() );
                                } else {
                                        $feat_image = false;
                                }
                                $excerpt = boldthemes_get_the_excerpt( get_the_ID() );
			}
                        
			if ( $title != '' || $excerpt != '' ) {
				$extra_class .= boldthemes_get_option( 'below_menu' ) ? ' topExtraExtraSpaced' : ' topSemiSpaced';
				$extra_class .= $feat_image ? ' wBackground cover btLightSkin' : '';
				echo '<section class="boldSection bottomSemiSpaced btPageHeadline gutter ' . esc_attr( $extra_class ) . '" style="background-image:url(' . esc_url_raw( $feat_image ) . ')"><div class="port">';
				echo boldthemes_get_heading_html( boldthemes_breadcrumbs(), $title,  $excerpt, 'extralarge', '', '', '', true );
				echo '</div></section>';
			}
			
		}
 	}
}

/**
 * Returns post excerpt by post id
 *
 * @param int
 * @return string 
 */
if ( ! function_exists( 'boldthemes_get_the_excerpt' ) ) {
	function boldthemes_get_the_excerpt( $post_id ) {
		$excerpt = get_post_field( 'post_excerpt', $post_id );
		return $excerpt;
	}
}

/**
 * Returns search form HTML
 *
 * @return string
 */

if ( ! function_exists( 'boldthemes_get_search_form_html' ) ) {
    function boldthemes_get_search_form_html() {
            $form = '';
            $form .= '
            <div class="btSearchInner" role="search">
                    <div class="btSearchInnerContent">
                            <form action="' . home_url( '/' ) . '" method="get"><input type="text" name="s" placeholder="' . esc_attr( esc_html__( 'Looking for...', 'medicare' ) ) . '" class="untouched">
                            <button type="submit" data-icon="&#xf105;"></button>
                            </form>
                    </div>
            </div>';
            return $form;
    }
}
