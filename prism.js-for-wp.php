<?php
/*
 * Plugin Name: Prism.js For WordPress
 * Plugin URI: https://github.com/ArRolin/prism.js-for-wp
 * Description: A Shortcode allows you to display code on your Website
 * Version: 1.5
 * Author: ArRolin
 * Author URI: http://binaryar.com
 * License: GPL2
 * Stable tag: trunk
 * GitHub Plugin URI: https://github.com/ArRolin/prism.js-for-wp
 * GitHub Branch:     master

    Copyright 2014  ArRolin

    This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License,
    version 2, as published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/

add_action('wp_enqueue_scripts', 'pu_load_styles');
/**
 * [pu_load_styles description]
 * @return [type] [description]
 */
function pu_load_styles()
{
    wp_enqueue_script( 'prism_js', plugins_url( '/js/prism.js' , __FILE__ ) , array( 'jquery' ), false, true );
    wp_enqueue_style( 'prism_css', plugins_url( '/css/prism.css' , __FILE__ ) );
}

remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 99);
add_filter( 'the_content', 'shortcode_unautop',100 );
remove_filter('the_content', 'wptexturize');

remove_filter('comment_text', 'wptexturize');
remove_filter('the_excerpt', 'wptexturize');

add_shortcode( 'html' , 'paulund_hightlight_html' );
add_shortcode( 'css' , 'paulund_hightlight_css' );
add_shortcode( 'js' , 'paulund_hightlight_javascript' );
add_shortcode( 'php' , 'paulund_hightlight_php' );
add_shortcode( 'coffeescript' , 'paulund_hightlight_coffeescript' );
add_shortcode( 'clike' , 'paulund_hightlight_clike' );
add_shortcode( 'c' , 'paulund_hightlight_c' );
add_shortcode( 'cpp' , 'paulund_hightlight_cpp' );
add_shortcode( 'csharp' , 'paulund_hightlight_csharp' );
add_shortcode( 'bash' , 'paulund_hightlight_bash' );
add_shortcode( 'java' , 'paulund_hightlight_java' );
add_shortcode( 'scss' , 'paulund_hightlight_scss' );
add_shortcode( 'sql' , 'paulund_hightlight_sql' );
add_shortcode( 'py' , 'paulund_hightlight_python' );
add_shortcode( 'ru' , 'paulund_hightlight_ruby' );
add_shortcode( 'http' , 'paulund_hightlight_http' );
add_shortcode( 'go' , 'paulund_hightlight_go' );

function paulund_hightlight_html($atts, $content = null)
{
    return pu_encode_content('markup', $content);
}

function paulund_hightlight_css($atts, $content = null)
{
    return pu_encode_content('css', $content);
}

function paulund_hightlight_javascript($atts, $content = null)
{
    return pu_encode_content('javascript', $content);
}

function paulund_hightlight_php($atts, $content = null)
{
    return pu_encode_content('php', $content);
}

function paulund_hightlight_coffeescript($atts, $content = null)
{
    return pu_encode_content('coffeescript', $content);
}

function paulund_hightlight_clike($atts, $content = null)
{
    return pu_encode_content('clike', $content);
}

function paulund_hightlight_c($atts, $content = null)
{
    return pu_encode_content('c', $content);
}

function paulund_hightlight_cpp($atts, $content = null)
{
    return pu_encode_content('cpp', $content);
}

function paulund_hightlight_csharp($atts, $content = null)
{
    return pu_encode_content('csharp', $content);
}

function paulund_hightlight_bash($atts, $content = null)
{
    return pu_encode_content('bash', $content);
}

function paulund_hightlight_java($atts, $content = null)
{
    return pu_encode_content('java', $content);
}

function paulund_hightlight_scss($atts, $content = null)
{
    return pu_encode_content('scss', $content);
}

function paulund_hightlight_sql($atts, $content = null)
{
    return pu_encode_content('sql', $content);
}

function paulund_hightlight_python($atts, $content = null)
{
    return pu_encode_content('python', $content);
}

function paulund_hightlight_ruby($atts, $content = null)
{
    return pu_encode_content('ruby', $content);
}

function paulund_hightlight_http($atts, $content = null)
{
    return pu_encode_content('http', $content);
}

function paulund_hightlight_go($atts, $content = null)
{
    return pu_encode_content('go', $content);
}

function pu_encode_content($lang, $content)
{
    $find_array = array( '&#91;', '&#93;' );
    $replace_array = array( '[', ']' );

    $content = preg_replace_callback( '|(.*)|isU', 'pu_pre_entities', trim( str_replace( $find_array, $replace_array, $content ) ) );

    $content = str_replace('#038;', '', $content);

    return sprintf('<pre class="language-%s"><code>%s</code></pre>', $lang, $content);
}

function pu_pre_entities( $matches ) {
    return str_replace( $matches[1], htmlspecialchars( $matches[1]), $matches[0] );
}

?>
