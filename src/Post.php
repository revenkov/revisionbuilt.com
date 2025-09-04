<?php
namespace Selectrum;

use WP_Post;

class Post
{
    public WP_Post $post;

    public function __construct($post)
    {
        if ( is_numeric( $post ) && $post > 0 ) {
            $this->post = get_post( $post );
        } elseif ( $post instanceof self ) {
            $this->post = $post->post;
        } elseif ( ! empty( $post->ID ) ) {
            $this->post = get_post( $post->ID );
        }
    }

    public function __get( $name )
    {
        return get_post_meta( $this->get_id(), $name, true );

    }

    public function __set( $name, $value )
    {
        update_post_meta( $this->get_id(), $name, $value );
    }

    public function __isset( $name ) {
        return get_post_meta( $this->get_id(), $name, true ) !== false;
    }

    public function get_id(): int
    {
        return $this->post->ID;
    }

    public function get_title(): string
    {
        return get_the_title( $this->get_id() );
    }

    public function get_content(): string {
        return $this->post->post_content;
    }

    public function get_post_date( $format = 'Ymd' ): string
    {
        return date_i18n( $format, strtotime( $this->post->post_date ) );
    }
}