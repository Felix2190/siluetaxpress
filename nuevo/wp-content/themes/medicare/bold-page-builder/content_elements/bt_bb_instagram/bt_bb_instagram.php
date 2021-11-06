<?php

class bt_bb_instagram extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'number'       => '',
			'columns'      => '',
			'gap'      	   => '',
			'hashtag'      => '',
			'cache'        => '',			
			'cache_id'     => '',			
			'access_token' => ''
		) ), $atts, $this->shortcode ) );

		$class = array( $this->shortcode );
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
		
		if ( $columns != '' ) {
			$class[] = $this->prefix . 'columns' . '_' . $columns;
		}
		
		if ( $gap != '' ) {
			$class[] = $this->prefix . 'gap' . '_' . $gap;
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );

		$output = '<div' . $id_attr . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . $style_attr . '>';
			ob_start();
			the_widget( 'BT_Instagram', array( 'number' => $number, 'hashtag' => $hashtag, 'cache' => $cache, 'cache_id' => $cache_id, 'access_token' => $access_token ) );
			$output .= ob_get_contents();
			ob_end_clean();
		$output .= '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Instagram', 'medicare' ), 'description' => esc_html__( 'Instagram photos', 'medicare' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'number', 'type' => 'textfield', 'heading' => esc_html__( 'Number of photos', 'medicare' ), 'preview' => true, 'value' => '8' ),
				array( 'param_name' => 'columns', 'type' => 'dropdown', 'heading' => esc_html__( 'Columns', 'medicare' ), 'preview' => true,
					'value' => array(
						esc_html__( '1', 'medicare' ) => '1',
						esc_html__( '2', 'medicare' ) => '2',
						esc_html__( '3', 'medicare' ) => '3',
						esc_html__( '4', 'medicare' ) => '4',
						esc_html__( '5', 'medicare' ) => '5',
						esc_html__( '6', 'medicare' ) => '6'
					)
				),
				array( 'param_name' => 'gap', 'type' => 'dropdown', 'default' => 'small', 'heading' => esc_html__( 'Gap', 'medicare' ),
					'value' => array(
						esc_html__( 'No gap', 'medicare' ) => 'no_gap',
						esc_html__( 'Extra small', 'medicare' ) => 'extrasmall',
						esc_html__( 'Small', 'medicare' ) => 'small',
						esc_html__( 'Normal', 'medicare' ) => 'normal',
						esc_html__( 'Large', 'medicare' ) => 'large'
					)
				),
				array( 'param_name' => 'hashtag', 'type' => 'textfield', 'heading' => esc_html__( 'Hashtag', 'medicare' ) ),
				array( 'param_name' => 'cache', 'type' => 'textfield', 'heading' => esc_html__( 'Cache (minutes)', 'medicare' ), 'value' => '15' ),
				array( 'param_name' => 'cache_id', 'type' => 'textfield', 'heading' => esc_html__( 'Cache unique ID', 'medicare' ), 'description' => esc_html__( 'Do not forget to modify if element is duplicated or copy-pasted', 'medicare' ), 'value' => uniqid() ),				
				array( 'param_name' => 'access_token', 'type' => 'textfield', 'heading' => esc_html__( 'Access token', 'medicare' ) )			
			) )
		);
	}
}