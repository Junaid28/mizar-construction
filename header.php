<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body>
<div class="page">
  <header class="navbar">
    <div class="nav-inner">
      <a class="brand" href="<?php echo home_url('/'); ?>">
        <img class="logo-image"
             src="<?php echo get_template_directory_uri(); ?>/images/logo/mizar-logo.png"
             alt="<?php bloginfo('name'); ?>" />
      </a>
      <nav class="nav-links" aria-label="Primary navigation">
        <?php
        $menu_items = wp_get_nav_menu_items( 'Primary-Menu' );
        if ( $menu_items ) {
          foreach ( $menu_items as $item ) {
            $is_current = ( get_the_ID() && $item->object_id == get_the_ID() );
            $current    = $is_current ? ' style="color: var(--red);"' : '';
            echo '<a href="' . esc_url( $item->url ) . '"' . $current . '>'
               . esc_html( $item->title )
               . '</a>';
          }
        }
        ?>
      </nav>
      <a class="cta" href="<?php echo home_url('/contact'); ?>">Get In Touch</a>

    </div>
  </header>
