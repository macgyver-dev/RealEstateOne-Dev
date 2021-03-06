<?php
/**
 * Add basic metabox tab to property
 *
 * @param $property_metabox_tabs
 *
 * @return array
 */
function ere_basic_metabox_tab( $property_metabox_tabs ) {
	if ( is_array( $property_metabox_tabs ) ) {
		$property_metabox_tabs['details'] = array(
			'label' => esc_html__( 'Basic Information', 'easy-real-estate' ),
			'icon'  => 'dashicons-admin-home',
		);
	}
	return $property_metabox_tabs;
}
add_filter( 'ere_property_metabox_tabs', 'ere_basic_metabox_tab', 10 );


/**
 * Add basic metaboxes fields to property
 *
 * @param $property_metabox_fields
 *
 * @return array
 */
function ere_basic_metabox_fields( $property_metabox_fields ) {

	$ere_basic_fields = array(
		array(
			'id'      => 'REAL_HOMES_property_price',
			'name'    => esc_html__( 'Sale or Rent Price ( Only digits )', 'easy-real-estate' ),
			'desc'    => esc_html__( 'Example: 12500', 'easy-real-estate' ),
			'type'    => 'text',
			'std'     => '',
			'columns' => 6,
			'tab'     => 'details',
		),
		array(
			'id'      => 'REAL_HOMES_property_old_price',
			'name'    => esc_html__( 'Old Price If Any ( Only digits )', 'easy-real-estate' ),
			'desc'    => esc_html__( 'Example: 14500', 'easy-real-estate' ),
			'type'    => 'text',
			'std'     => '',
			'columns' => 6,
			'tab'     => 'details',
		),
		array(
			'id'      => 'REAL_HOMES_property_price_prefix',
			'name'    => esc_html__( 'Price Prefix', 'easy-real-estate' ),
			'desc'    => esc_html__( 'Example: From', 'easy-real-estate' ),
			'type'    => 'text',
			'std'     => '',
			'columns' => 6,
			'tab'     => 'details',
		),
		array(
			'id'      => 'REAL_HOMES_property_price_postfix',
			'name'    => esc_html__( 'Price Postfix', 'easy-real-estate' ),
			'desc'    => esc_html__( 'Example: Monthly', 'easy-real-estate' ),
			'type'    => 'text',
			'std'     => '',
			'columns' => 6,
			'tab'     => 'details',
		),
		array(
			'type'    => 'divider',
			'columns' => 12,
			'id'      => 'price_divider',
			'tab'     => 'details',
		),
		array(
			'id'      => 'REAL_HOMES_property_size',
			'name'    => esc_html__( 'Area Size ( Only digits )', 'easy-real-estate' ),
			'desc'    => esc_html__( 'Example: 2500', 'easy-real-estate' ),
			'type'    => 'text',
			'std'     => '',
			'columns' => 6,
			'tab'     => 'details',
		),
		array(
			'id'      => 'REAL_HOMES_property_size_postfix',
			'name'    => esc_html__( 'Area Size Postfix', 'easy-real-estate' ),
			'desc'    => esc_html__( 'Example: sq ft', 'easy-real-estate' ),
			'type'    => 'text',
			'std'     => '',
			'columns' => 6,
			'tab'     => 'details',
		),
		array(
			'id'      => 'REAL_HOMES_property_lot_size',
			'name'    => esc_html__( 'Lot Size ( Only digits )', 'easy-real-estate' ),
			'desc'    => esc_html__( 'Example: 3000', 'easy-real-estate' ),
			'type'    => 'text',
			'std'     => '',
			'columns' => 6,
			'tab'     => 'details',
		),
		array(
			'id'      => 'REAL_HOMES_property_lot_size_postfix',
			'name'    => esc_html__( 'Lot Size Postfix', 'easy-real-estate' ),
			'desc'    => esc_html__( 'Example: sq ft', 'easy-real-estate' ),
			'type'    => 'text',
			'std'     => '',
			'columns' => 6,
			'tab'     => 'details',
		),
		array(
			'id'      => 'REAL_HOMES_property_bedrooms',
			'name'    => esc_html__( 'Bedrooms', 'easy-real-estate' ),
			'desc'    => esc_html__( 'Example: 4', 'easy-real-estate' ),
			'type'    => 'text',
			'std'     => '',
			'columns' => 6,
			'tab'     => 'details',
		),
		array(
			'id'      => 'REAL_HOMES_property_bathrooms',
			'name'    => esc_html__( 'Bathrooms', 'easy-real-estate' ),
			'desc'    => esc_html__( 'Example: 2', 'easy-real-estate' ),
			'type'    => 'text',
			'std'     => '',
			'columns' => 6,
			'tab'     => 'details',
		),
		array(
			'id'      => 'REAL_HOMES_property_garage',
			'name'    => esc_html__( 'Garages or Parking Spaces', 'easy-real-estate' ),
			'desc'    => esc_html__( 'Example: 1', 'easy-real-estate' ),
			'type'    => 'text',
			'std'     => '',
			'columns' => 6,
			'tab'     => 'details',
		),
		array(
			'id'         => 'REAL_HOMES_property_id',
			'name'       => esc_html__( 'Property ID', 'easy-real-estate' ),
			'desc'       => esc_html__( 'It will help you search a property directly.', 'easy-real-estate' ),
			'type'       => 'text',
			'std'        => ( 'true' === get_option( 'inspiry_auto_property_id_check' ) ) ? get_option( 'inspiry_auto_property_id_pattern' ) : '',
			'columns'    => 6,
			'tab'        => 'details',
			'attributes' => array(
				'readonly' => ( 'true' === get_option( 'inspiry_auto_property_id_check' ) ) ? true : false,
			),
		),
		array(
			'id'      => 'REAL_HOMES_property_year_built',
			'name'    => esc_html__( 'Year Built', 'easy-real-estate' ),
			'desc'    => esc_html__( 'Example: 2017', 'easy-real-estate' ),
			'type'    => 'text',
			'std'     => '',
			'columns' => 6,
			'tab'     => 'details',
		),
		array(
			'name'    => esc_html__( 'Mark this property as featured ?', 'easy-real-estate' ),
			'id'      => 'REAL_HOMES_featured',
			'type'    => 'radio',
			'std'     => '0',
			'options' => array(
				'1' => esc_html__( 'Yes', 'easy-real-estate' ),
				'0' => esc_html__( 'No', 'easy-real-estate' ),
			),
			'columns' => 6,
			'tab'     => 'details',
		),
	);

	return array_merge( $property_metabox_fields, $ere_basic_fields );

}
add_filter( 'ere_property_metabox_fields', 'ere_basic_metabox_fields', 10 );
