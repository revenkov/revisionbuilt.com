<?php
function selectrum_get_hero_image_post_id() {
	global $post;

	if ( !empty( $post->post_parent ) ) :
		return $post->post_parent;
	endif;

	return $post->ID;
}

function selectrum_filter_id( $post_id = 0 ) {
	return apply_filters('wpml_object_id', $post_id);
}

function selectrum_get_permalink( $post_id ) {
	return get_the_permalink( selectrum_filter_id( $post_id ) );
}


function selectrum_get_image_url( $filename ) {
	return get_stylesheet_directory_uri().'/assets/images/'.$filename;
}

function selectrum_get_hero_title() {
	global $post;

	if ( !empty( $post->post_parent ) ) :
		return get_the_title( $post->post_parent );
	endif;

	return get_the_title();
}

function selectrum_get_hero_text() {
    $hero_content = get_field('hero_content');
    if ( !empty( $hero_content ) ) :
        return $hero_content;
    endif;

	$text = '<h1 class="sectionHero__title">'.selectrum_get_hero_title().'</h1>';

	return $text;
}

function selectrum_truncate_string($str, $chars, $to_space, $replacement = "...") {
	if($chars > strlen($str)) return $str;

	$str = substr($str, 0, $chars);

	$space_pos = strrpos($str, " ");
	if($to_space && $space_pos >= 0) {
		$str = substr($str, 0, strrpos($str, " "));
	}

	return($str . $replacement);
}