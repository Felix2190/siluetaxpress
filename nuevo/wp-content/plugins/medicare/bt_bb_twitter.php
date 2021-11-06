<?php

class bt_bb_twitter extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'number'              	=> '',
			'display_type'        	=> '',
			'slides_to_show' 		=> '',
			'gap' 					=> '',
			'auto_play' 			=> '',
			'show_avatar'         	=> '',
			'cache'               	=> '',
			'cache_id'            	=> '',
			'username'            	=> '',
			'consumer_key'        	=> '',
			'consumer_secret'     	=> '',
			'access_token'        	=> '',
			'access_token_secret' 	=> '',
			'responsive'      		=> ''
		) ), $atts, $this->shortcode ) );

		$class = array( $this->shortcode, 'bt_bb_gap_large' );
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}

		$data_slick = '';
		if ( $display_type == 'slider' ) {
			$data_slick = ' ' . 'data-slick=\'{ "lazyLoad": "progressive", "cssEase": "ease-out", "speed": "300", "prevArrow": "&lt;button type=\"button\" class=\"slick-prev\"&gt;", "nextArrow": "&lt;button type=\"button\" class=\"slick-next\"&gt;" ';
			if ( $auto_play != '' ) {
				$data_slick .= ', "autoplay": true, "autoplaySpeed": ' . intval( $auto_play );
			}
			if ( $gap != '' ) {
				$data_slick .= ', "gap": "' . $gap . '"';
			}
			if ( is_rtl() ) {
				$data_slick .= ', "rtl": true' ;
			}
			if ( $slides_to_show != '' ) {
				$data_slick .= ', "slidesToShow": ' . intval( $slides_to_show );
			}
			if ( $slides_to_show > 1 ) {
				$data_slick .= ', "responsive": [';
				if ( $slides_to_show > 1 ) {
					$data_slick .= '{ "breakpoint": 480, "settings": { "slidesToShow": 1, "slidesToScroll": 1 } }';	
				}
				if ( $slides_to_show > 2 ) {
					$data_slick .= ',{ "breakpoint": 768, "settings": { "slidesToShow": 2, "slidesToScroll": 2 } }';	
				}
				if ( $slides_to_show > 3 ) {
					$data_slick .= ',{ "breakpoint": 920, "settings": { "slidesToShow": 3, "slidesToScroll": 3 } }';	
				}
				if ( $slides_to_show > 4 ) {
					$data_slick .= ',{ "breakpoint": 1024, "settings": { "slidesToShow": 3, "slidesToScroll": 3 } }';	
				}				
				$data_slick .= ']';
			}
			$data_slick = $data_slick . '}\' ';
			$data_slick = $data_slick . '}\' ';
			$class[] = $this->prefix . 'display_slider';
		} else {
			$class[] = $this->prefix . 'display_regular';
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		if ( $slides_to_show != '' ) {
			if ( $display_type == 'slider' ) {
				$class[] = $this->prefix . 'multiple_slides';	
			} else {
				$class[] = $this->prefix . 'columns_' . $slides_to_show;
			}
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		$twitter_data = bt_bb_get_twitter_data( $number, $cache, $cache_id, $username, $consumer_key, $consumer_secret, $access_token, $access_token_secret );
		
		$output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . $data_slick . '>';
			if ( $display_type == 'slider' ) {
				$output .= '<div class="slick-slider"' . $data_slick . '>';
			} else {
				$output .= '<div class="bt_bb_twitter_inner">';
			}
				if ( is_array( $twitter_data ) ) {
					foreach ( $twitter_data as $data ) {
						$user =  $data->user->screen_name;
						$profile_link = 'https://twitter.com/' . $user ;
						$link = 'https://twitter.com/' . $user . '/status/' . $data->id_str;
						$text = mb_convert_encoding( utf8_encode( $data->text ), 'HTML-ENTITIES', 'UTF-8' );
						$time = human_time_diff( strtotime( $data->created_at ) );

						$output .= '<div class="bt_bb_twitter_item">';
							$output .= '<div class="content">';
								if( $show_avatar == 'yes' ) {
									$output .= '<a href="' . esc_url( $profile_link ) . '" target="_blank"><img src="https://twitter.com/' . $user . '/profile_image?size=bigger" class="bt_bb_twitter_avatar"/></a>';
								}
								$output .= '<small class="bt_bb_twitter_username"><a href="' . esc_url( $link ) . '" target="_blank">@' . $user . ' - ' . $time . '</a></small>';
								$output .= '<p class="bt_bb_twitter_content">' . BB_Twitter_Widget::parse( $data->text ) . '</p>';
							$output .= '</div>';
						$output .= '</div>';
					}
				}
			$output .= '</div>';
		$output .= '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {

		bt_bb_map( $this->shortcode, array( 'name' => __( 'Twitter', 'boldthemes_framework_textdomain' ), 'description' => __( 'Twitter posts', 'boldthemes_framework_textdomain' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'number', 'type' => 'textfield', 'heading' => __( 'Number of Tweets', 'boldthemes_framework_textdomain' ), 'preview' => true ),
				array( 'param_name' => 'display_type', 'type' => 'dropdown', 'heading' => __( 'Type', 'boldthemes_framework_textdomain' ), 'preview' => true,
					'value' => array(
						__( 'Slider', 'boldthemes_framework_textdomain' ) => 'slider',
						__( 'Regular grid', 'boldthemes_framework_textdomain' ) => 'regular'
					) ),
				array( 'param_name' => 'show_avatar', 'type' => 'dropdown', 'heading' => __( 'Show avatar', 'boldthemes_framework_textdomain' ),
				'value' => array(
					__( 'No', 'boldthemes_framework_textdomain' )  => 'no',
					__( 'Yes', 'boldthemes_framework_textdomain' ) => 'yes'
				) ),
				array( 'param_name' => 'slides_to_show', 'type' => 'textfield', 'preview' => true, 'default' => 1, 'heading' => __( 'Number of slides to show', 'boldthemes_framework_textdomain' ), 'description' => __( '(1-6) e.g. 3' ) ),
				array( 'param_name' => 'gap', 'type' => 'dropdown', 'default' => 'small', 'heading' => __( 'Gap', 'boldthemes_framework_textdomain' ),
					'value' => array(
						__( 'No gap', 'boldthemes_framework_textdomain' ) => 'no_gap',
						__( 'Small', 'boldthemes_framework_textdomain' ) => 'small',
						__( 'Normal', 'boldthemes_framework_textdomain' ) => 'normal',
						__( 'Large', 'boldthemes_framework_textdomain' ) => 'large'
					)
				),
				array( 'param_name' => 'auto_play', 'type' => 'textfield', 'heading' => __( 'Autoplay interval (ms)', 'boldthemes_framework_textdomain' ), 'description' => __( 'e.g. 2000' ) ),
				array( 'param_name' => 'username', 'type' => 'textfield', 'heading' => __( 'Username (or #hashtag)', 'boldthemes_framework_textdomain' ) ),
				array( 'param_name' => 'cache', 'type' => 'textfield', 'heading' => __( 'Cache (minutes)', 'boldthemes_framework_textdomain' ) ),
				array( 'param_name' => 'cache_id', 'type' => 'hidden', 'value' => uniqid() ),
				array( 'param_name' => 'consumer_key', 'type' => 'textfield', 'heading' => __( 'Consumer Key', 'boldthemes_framework_textdomain' ), 'group' => __( 'API', 'boldthemes_framework_textdomain' ) ),
				array( 'param_name' => 'consumer_secret', 'type' => 'textfield', 'heading' => __( 'Consumer Secret', 'boldthemes_framework_textdomain' ), 'group' => __( 'API', 'boldthemes_framework_textdomain' ) ),
				array( 'param_name' => 'access_token', 'type' => 'textfield', 'heading' => __( 'Access Token', 'boldthemes_framework_textdomain' ), 'group' => __( 'API', 'boldthemes_framework_textdomain' ) ),
				array( 'param_name' => 'access_token_secret', 'type' => 'textfield', 'heading' => __( 'Access Token Secret', 'boldthemes_framework_textdomain' ), 'group' => __( 'API', 'boldthemes_framework_textdomain' ) )				
			) )
		);
	}
}

if ( ! function_exists( 'bt_bb_get_twitter_data' ) ) {
	
	function bt_bb_get_twitter_data( $number, $cache, $cache_id, $username, $consumer_key, $consumer_secret, $access_token, $access_token_secret ) {
		
		if ( $number < 1 ) {
			$number = 5;
		} else if ( $number > 30 ) {
			$number = 30;
		}

		if ( $cache == 0 || $cache < 0 ) {
			$cache = 0;
		} else if ( $cache > 720 ) {
			$cache = 720;
		}
		
		$trans_name = 'bt_bb_tweets_' . $cache_id;
		
		if ( $cache == 0 ) {
			delete_transient( $trans_name );
		}

		if ( false == ( $twitter_data = unserialize( base64_decode( get_transient( $trans_name ) ) ) ) ) {

			require_once( 'twitteroauth.php' );
			
			$twitter_connection = new TwitterOAuth( $consumer_key, $consumer_secret, $access_token, $access_token_secret );
			if ( !preg_match( '/#/', $username ) ) {
				$twitter_data = $twitter_connection->get(
					'statuses/user_timeline',
					array(
						'screen_name'		=> $username,
						'count'				=> $number + 1,
						'exclude_replies'	=> false
					)
				);
			} else {
				$twitter_data = $twitter_connection->get(
					'search/tweets',
					array(
						'q'					=> $username,
						'count'				=> $number + 1,
						'exclude_replies'	=> false
					)
				);
				$twitter_data = $twitter_data -> statuses;
			}

			if ( $twitter_connection->http_code != 200 ) {
				$twitter_data = unserialize( base64_decode( get_transient( $trans_name ) ) );
			}

			if ( $cache > 0 ) {
				set_transient( $trans_name, base64_encode( serialize( $twitter_data ) ), 60 * $cache );
			}
			
		}
		
		return $twitter_data;
	}
}