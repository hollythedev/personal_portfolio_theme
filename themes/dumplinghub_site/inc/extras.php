<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package dumplinghub_site_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function dumplinghub_site_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'dumplinghub_site_body_classes' );

function dumplinghub_site_trim_excerpt( $text ) {
    $raw_excerpt = $text;
    if ( '' == $text ) {
        // retrieve the post content
        $text = get_the_content('');
        // delete all shortcode tags from the content
        $text = strip_shortcodes( $text );
        $text = apply_filters( 'the_content', $text );
        $text = str_replace( ']]>', ']]&gt;', $text );
        // indicate allowable tags
        $allowed_tags = '<p>,<a>,<em>,<strong>,<blockquote>,<cite>';
        $text = strip_tags( $text, $allowed_tags );
        // change to desired word count
        $excerpt_word_count = 50;
        $excerpt_length = apply_filters( 'excerpt_length', $excerpt_word_count );
        // create a custom "more" link
        $excerpt_end = '<span>[...]</span><p><a href="' . get_permalink() . '" class="read-more">Read more &rarr;</a></p>'; // modify excerpt ending
        $excerpt_more = apply_filters( 'excerpt_more', ' ' . $excerpt_end );
        // add the elipsis and link to the end if the word count is longer than the excerpt
        $words = preg_split( "/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY );
        if ( count( $words ) > $excerpt_length ) {
            array_pop( $words );
            $text = implode( ' ', $words );
            $text = $text . $excerpt_more;
        } else {
            $text = implode( ' ', $words );
        }
    }
    return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );
}
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'dumplinghub_site_trim_excerpt' );




//Custom about page image

function about_page_method() {
    
    if(!is_page_template( 'page-templates/about.php' )){
        return;
    }
    $url = CFS()->get('about_image');
    $custom_css = "
    .about-hero {
        background-image: linear-gradient( to bottom, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.4) 100% ), url( {$url});
    }";
    wp_add_inline_style( 'dumpling_hub_style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'about_page_method' );

//custom contact page imagegd
function contact_page_method() {
    
    if(!is_page_template( 'page-templates/contact.php' )){
        return;
    }
    $url = CFS()->get('contact_image');
    $custom_css = "
    .contact-hero {
        background-image: linear-gradient( to bottom, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.4) 100% ), url( {$url});
    }";
    wp_add_inline_style( 'dumpling_hub_style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'contact_page_method' );

//get all projects archive
function get_all_project_posts( $query ) {
	if(is_post_type_archive('project') && !is_admin() && $query->is_main_query()) {
		$query->set('posts_per_page', '16');
		$query->set('orderby', 'title');
		$query->set('order' , 'rand');
	}
}
add_action( 'pre_get_posts', 'get_all_project_posts');