<?php
/**
 * Plugin Name: Notification : Yoast SEO
 * Description: Yoast SEO merge tags for post triggers
 * Author: Jean-Paul Horn
 * Version: 1.0.3
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) || exit;

add_action( 'notification/trigger/merge_tags', function( $trigger ) {

	$pattern = '/(post\/(.*)\/(updated|trashed|published|drafted|added|pending|scheduled)|scheduled\/(?!.*user).*\/ntfn_st_(.*))/';

	if ( ! preg_match( $pattern, $trigger->get_slug() ) ) {
		return;
	}

	// Add your Tag.
	// Pay attention to the Tag type you are defining.
	// If you want to output an HTML, use HtmlTag instead.
	$trigger->add_merge_tag( new BracketSpace\Notification\Defaults\MergeTag\StringTag( [
		'slug'     => 'yoast_title',
		'name'     => __( 'Title', 'textdomain' ),
		'group'    => __( 'Yoast SEO', 'textdomain' ),
		'resolver' => function( $trigger ) {
			return get_post_meta( $trigger->{ $trigger->get_post_type() }->ID, '_yoast_wpseo_title', true );
		},
	] ) );

	$trigger->add_merge_tag( new BracketSpace\Notification\Defaults\MergeTag\StringTag( [
		'slug'     => 'yoast_desc',
		'name'     => __( 'Description', 'textdomain' ),
		'group'    => __( 'Yoast SEO', 'textdomain' ),
		'resolver' => function( $trigger ) {
			return get_post_meta( $trigger->{ $trigger->get_post_type() }->ID, '_yoast_wpseo_metadesc', true );
		},
	] ) );

	$trigger->add_merge_tag( new BracketSpace\Notification\Defaults\MergeTag\StringTag( [
		'slug'     => 'yoast_focuskw',
		'name'     => __( 'Focus keyword', 'textdomain' ),
		'group'    => __( 'Yoast SEO', 'textdomain' ),
		'resolver' => function( $trigger ) {
			return get_post_meta( $trigger->{ $trigger->get_post_type() }->ID, '_yoast_wpseo_focuskw', true );
		},
	] ) );

	$trigger->add_merge_tag( new BracketSpace\Notification\Defaults\MergeTag\IntegerTag( [
		'slug'     => 'yoast_score_linkdex',
		'name'     => __( 'SEO score', 'textdomain' ),
		'group'    => __( 'Yoast SEO', 'textdomain' ),
		'resolver' => function( $trigger ) {
			return get_post_meta( $trigger->{ $trigger->get_post_type() }->ID, '_yoast_wpseo_linkdex', true );
		},
	] ) );

	$trigger->add_merge_tag( new BracketSpace\Notification\Defaults\MergeTag\IntegerTag( [
		'slug'     => 'yoast_score_readability',
		'name'     => __( 'Readability', 'textdomain' ),
		'group'    => __( 'Yoast SEO', 'textdomain' ),
		'resolver' => function( $trigger ) {
			return get_post_meta( $trigger->{ $trigger->get_post_type() }->ID, '_yoast_wpseo_content_score', true );
		},
	] ) );

} );
