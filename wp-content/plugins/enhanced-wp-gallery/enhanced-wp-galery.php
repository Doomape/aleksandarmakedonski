<?php
/*
Plugin Name: Enhanced WP Gallery
Plugin URI: http://ronimarinkovic.com/wordpress/enhanced-wp-gallery/
Description: A plugin to replace the default 'gallery' shortcode and add additional HTML tags for more customization. Displaying Caption, Title and Description of the image if those variables are set for images.
Version: 0.1
Author: Roni Marinković
Author URI: http://ronimarinkovic.com
License: GPL2
*/


class Enhanced_WP_Gallery {
    function __construct(){
        add_action( "init", array( __CLASS__, "init" ) );
    }

    function init(){
        remove_shortcode( 'gallery' ); // Remove the default gallery shortcode implementation
        add_shortcode( 'gallery', array( __CLASS__, "gallery_shortcode" ) ); // And replace it with our own!
    }

    
    function gallery_shortcode($attr) {
        global $post;

        static $instance = 0;
        $instance++;

        $output = apply_filters('post_gallery', '', $attr);
        if ( $output != '' )
            return $output;

        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( !$attr['orderby'] )
                unset( $attr['orderby'] );
        }

        // NOTE: These are all the 'options' you can pass in through the shortcode definition, eg: [gallery itemtag='p']
        extract(shortcode_atts(array(
            'order'      => 'ASC',
            'orderby'    => 'menu_order ID',
            'id'         => $post->ID,
            'itemtag'    => 'dl',
            'icontag'    => 'dt',
            'captiontag' => 'dd',
            'columns'    => 3,
            'size'       => 'thumbnail',
            'include'    => '',
            'exclude'    => '',
            // Here's the new options stuff we added to the shortcode defaults
            'titletag'  => 'p',
            'descriptiontag' => 'p'
        ), $attr));

        $id = intval($id);
        if ( 'RAND' == $order )
            $orderby = 'none';

        if ( !empty($include) ) {
            $include = preg_replace( '/[^0-9,]+/', '', $include );
            $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif ( !empty($exclude) ) {
            $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
            $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        } else {
            $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        }

        if ( empty($attachments) )
            return '';

        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment )
                $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
            return $output;
        }

        $itemtag = tag_escape($itemtag);
        $captiontag = tag_escape($captiontag);
        $columns = intval($columns);
        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
        $float = is_rtl() ? 'right' : 'left';

        $selector = "gallery-{$instance}";

        $gallery_style = $gallery_div = '';
        if ( apply_filters( 'use_default_gallery_style', true ) )
            $gallery_style = "
            <style type='text/css'>
                #{$selector} {
                    margin: auto;
                }
                #{$selector} .gallery-item {
                    float: {$float};
                    margin-top: 10px;
                    text-align: center;
                    width: {$itemwidth}%;
                }
                #{$selector} img {
                    border: 2px solid #cfcfcf;
                }
                #{$selector} .gallery-caption {
                    margin-left: 0;
                }
            </style>
            <!-- see gallery_shortcode() in wp-includes/media.php -->";
        $size_class = sanitize_html_class( $size );
        $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
        $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

        $i = 0;
        foreach ( $attachments as $id => $attachment ) {
            $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

            $output .= "<{$itemtag} class='gallery-item'>";
            $output .= "
                <{$icontag} class='gallery-icon'>
                    $link
                </{$icontag}>";

            // MODIFICATION: include the title and description HTML if we've supplied the relevant shortcode parameters (titletag, descriptiontag)
            if ( $captiontag ) {
                $output .= "
                    <{$captiontag} class='wp-caption-text gallery-caption'>";
                // The CAPTION, if there is one
                if ( trim( $attachment->post_excerpt ) ) {
                    $output .= "
                        " . wptexturize($attachment->post_excerpt);
                }

                // The TITLE, if we've not made the 'titletag' param blank
                if ( $titletag ){
                    $output .= "
                        <{$titletag} class=\"gallery-item-title\">" . $attachment->post_title . "</{$titletag}>";
                }

                // The DESCRIPTION, if we've not specified a blank 'descriptiontag'
                if ( $descriptiontag ){
                    $output .= "
                        <{$descriptiontag} class=\"gallery-item-description\">" . wptexturize( $attachment->post_content ) . "</{$descriptiontag}>";
                }

                $option .= "
                    </{$captiontag}>";
            }
            $output .= "</{$itemtag}>";
            if ( $columns > 0 && ++$i % $columns == 0 )
                $output .= '<br style="clear: both" />';
        }

        $output .= "
                <br style='clear: both;' />
            </div>\n";

        return $output;
    }
}

new Enhanced_WP_Gallery();
