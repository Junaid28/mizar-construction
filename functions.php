<?php

/* ── Theme Setup ── */
function mizar_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery' ] );
    register_nav_menus([
        'primary' => __( 'Primary Navigation', 'mizar-construction' ),
        'footer'  => __( 'Footer Navigation',  'mizar-construction' ),
    ]);
}
add_action( 'after_setup_theme', 'mizar_setup' );


/* ── Enqueue Assets ── */
function mizar_enqueue_assets() {
    wp_enqueue_style( 'mizar-style', get_stylesheet_uri(), [], filemtime( get_stylesheet_directory() . '/style.css' ) );
    wp_enqueue_style( 'mizar-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', [], null );
    wp_enqueue_script( 'mizar-scripts', get_template_directory_uri() . '/js/script.js', [], '1.0.0', true );

    // Load media uploader only on property edit pages
    if ( is_admin() ) {
        wp_enqueue_media();
    }
}
add_action( 'wp_enqueue_scripts', 'mizar_enqueue_assets' );


/* ── Enqueue media uploader in admin ── */
function mizar_admin_scripts( $hook ) {
    global $post;
    if ( ( $hook === 'post-new.php' || $hook === 'post.php' ) && isset($post) && $post->post_type === 'property' ) {
        wp_enqueue_media();
        wp_enqueue_script( 'mizar-admin', get_template_directory_uri() . '/js/admin-property.js', ['jquery'], '2.0', true );
    }
}
add_action( 'admin_enqueue_scripts', 'mizar_admin_scripts' );


/* ── Dynamic Background Images ── */
function mizar_dynamic_styles() {
    $uri = get_template_directory_uri();
    ?>
    <style> 
      .hero-card { background-image: linear-gradient(rgba(74,96,161,0.5),rgba(74,96,161,0.5)), url('<?php echo $uri; ?>/images/header/header-img.jpg') !important; }
      .about-hero { background-image: linear-gradient(rgba(30,30,40,0.52),rgba(30,30,40,0.52)), url('<?php echo $uri; ?>/images/about/header-img.jpg') !important; }
      .services-hero { background-image: linear-gradient(rgba(30,30,40,0.55),rgba(30,30,40,0.55)), url('<?php echo $uri; ?>/images/header/service-header-img.jpg') !important; }
      .sd-hero { background-image: linear-gradient(rgba(30,30,40,0.55),rgba(30,30,40,0.55)), url('<?php echo $uri; ?>/images/header/service-header-img.jpg') !important; }
      .blog-hero { background-image: linear-gradient(rgba(30,30,40,0.55),rgba(30,30,40,0.55)), url('<?php echo $uri; ?>/images/header/blog-header-img.jpg') !important; }
      .bd-hero { background-image: linear-gradient(rgba(30,30,40,0.52),rgba(30,30,40,0.52)), url('<?php echo $uri; ?>/images/header/blog-header-img.jpg') !important; }
      .ct-hero { background-image: linear-gradient(rgba(30,30,40,0.52),rgba(30,30,40,0.52)), url('<?php echo $uri; ?>/images/header/contact-header-img.jpg') !important; }
      .pl-hero { background-image: linear-gradient(rgba(30,30,40,0.52),rgba(30,30,40,0.52)), url('<?php echo $uri; ?>/images/header/property-header-img.jpg') !important; }
      .pd-hero { background-image: linear-gradient(rgba(30,30,40,0.52),rgba(30,30,40,0.52)), url('<?php echo $uri; ?>/images/header/properties-header-img.png') !important; }
      .sd-contact-box { background-image: linear-gradient(rgba(20,20,30,0.62),rgba(20,20,30,0.62)), url('<?php echo $uri; ?>/images/services/service-side-banner.png') !important; }
    </style>
    <?php
}
add_action( 'wp_head', 'mizar_dynamic_styles' );


/* ── Property Custom Post Type ── */
function mizar_register_property_cpt() {
    register_post_type('property', [
        'labels'       => [
            'name'          => 'Properties',
            'singular_name' => 'Property',
            'add_new'       => 'Add New Property',
            'add_new_item'  => 'Add New Property',
            'edit_item'     => 'Edit Property',
            'view_item'     => 'View Property',
            'all_items'     => 'All Properties',
        ],
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => [ 'slug' => 'property-listings' ],
        'supports'     => [ 'title', 'thumbnail', 'editor' ],
        'menu_icon'    => 'dashicons-building',
        'show_in_rest' => true,
    ]);
}
add_action( 'init', 'mizar_register_property_cpt' );

require_once get_template_directory() . '/form-handlers.php';

/* ══════════════════════════════════════════
   PROPERTY META BOXES
══════════════════════════════════════════ */
function mizar_property_meta_boxes() {
    add_meta_box( 'property_details',   'Property Details',         'mizar_property_details_fields',   'property', 'normal', 'high' );
    add_meta_box( 'property_gallery',   'Photo Gallery',            'mizar_property_gallery_fields',   'property', 'normal', 'high' );
    add_meta_box( 'property_amenities', 'Features & Amenities',     'mizar_property_amenities_fields', 'property', 'normal', 'default' );
    add_meta_box( 'property_media',     'Video & Map',              'mizar_property_media_fields',     'property', 'normal', 'default' );
}
add_action( 'add_meta_boxes', 'mizar_property_meta_boxes' );


/* ── 1. Property Details Fields ── */
function mizar_property_details_fields( $post ) {
    $price    = get_post_meta( $post->ID, '_property_price',    true );
    $beds     = get_post_meta( $post->ID, '_property_beds',     true );
    $baths    = get_post_meta( $post->ID, '_property_baths',    true );
    $area     = get_post_meta( $post->ID, '_property_area',     true );
    $location = get_post_meta( $post->ID, '_property_location', true );
    $type     = get_post_meta( $post->ID, '_property_type',     true );
    wp_nonce_field( 'mizar_property_nonce', 'property_nonce' );
    ?>
    <style>
      .mizar-meta-table { width:100%; border-collapse:collapse; }
      .mizar-meta-table th { text-align:left; padding:10px 16px 10px 0; width:140px; font-weight:600; font-size:13px; }
      .mizar-meta-table td { padding:8px 0; }
      .mizar-meta-table input[type="text"],
      .mizar-meta-table input[type="number"],
      .mizar-meta-table select { width:100%; padding:8px 12px; border:1px solid #ddd; border-radius:6px; font-size:13px; }
    </style>
    <table class="mizar-meta-table">
      <tr>
        <th><label for="property_price">Price ($)</label></th>
        <td><input type="text" id="property_price" name="property_price" value="<?php echo esc_attr($price); ?>" placeholder="e.g. 590,693" /></td>
      </tr>
      <tr>
        <th><label for="property_beds">Bedrooms</label></th>
        <td><input type="number" id="property_beds" name="property_beds" value="<?php echo esc_attr($beds); ?>" min="0" /></td>
      </tr>
      <tr>
        <th><label for="property_baths">Bathrooms</label></th>
        <td><input type="number" id="property_baths" name="property_baths" value="<?php echo esc_attr($baths); ?>" min="0" /></td>
      </tr>
      <tr>
        <th><label for="property_area">Area (sq ft)</label></th>
        <td><input type="text" id="property_area" name="property_area" value="<?php echo esc_attr($area); ?>" placeholder="e.g. 2,096" /></td>
      </tr>
      <tr>
        <th><label for="property_location">Address</label></th>
        <td><input type="text" id="property_location" name="property_location" value="<?php echo esc_attr($location); ?>" placeholder="e.g. 92 Allium Place, Orlando FL" /></td>
      </tr>
      <tr>
        <th><label for="property_type">Type</label></th>
        <td>
          <select id="property_type" name="property_type">
            <option value="">— Select —</option>
            <option value="apartment" <?php selected($type,'apartment'); ?>>Apartment</option>
            <option value="villa"     <?php selected($type,'villa');     ?>>Villa</option>
            <option value="house"     <?php selected($type,'house');     ?>>House</option>
            <option value="studio"    <?php selected($type,'studio');    ?>>Studio</option>
            <option value="penthouse" <?php selected($type,'penthouse'); ?>>Penthouse</option>
            <option value="townhouse" <?php selected($type,'townhouse'); ?>>Townhouse</option>
          </select>
        </td>
      </tr>
    </table>
    <?php
}


/* ── 2. Photo Gallery Fields ── */
function mizar_property_gallery_fields( $post ) {
    $gallery_ids = get_post_meta( $post->ID, '_property_gallery', true );
    ?>
    <p style="color:#555;font-size:13px;margin:0 0 12px;">
      Upload multiple images for the property gallery. These will appear in the Photo Gallery section on the property detail page.
    </p>
    <div id="property-gallery-wrap" style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:12px;">
      <?php
      if ( $gallery_ids ) {
        $ids = array_filter( array_map( 'trim', explode( ',', $gallery_ids ) ) );
        foreach ( $ids as $id ) {
          $img = wp_get_attachment_image_url( (int) $id, 'thumbnail' );
          if ( $img ) {
            echo '<div class="gallery-img-preview" style="position:relative;display:inline-block;margin:4px;">'
              . '<img src="' . esc_url( $img ) . '" data-id="' . esc_attr( $id ) . '" style="width:100px;height:100px;object-fit:cover;border-radius:6px;border:1px solid #ddd;" />'
              // FIX: use class="remove-gallery-img" + data-id so the existing JS handler in
              // admin-property.js picks it up — the old onclick="mizarRemoveGalleryImg()" was
              // calling an undefined function and causing a JS error that broke the whole script.
              . '<button type="button" class="remove-gallery-img" data-id="' . esc_attr( $id ) . '" '
              . 'style="position:absolute;top:-6px;right:-6px;background:#e8292a;color:#fff;border:none;border-radius:50%;width:22px;height:22px;cursor:pointer;font-size:14px;line-height:1;padding:0;">✕</button>'
              . '</div>';
          }
        }
      }
      ?>
    </div>
    <!--
      FIX: renamed id from "property_gallery" to "property_gallery_input"
      WordPress assigns id="property_gallery" to the meta box wrapper <div>,
      so jQuery's $('#property_gallery') was finding the div, not this input,
      meaning the selected image IDs were never written here before form submit.
    -->
    <input type="hidden" id="property_gallery_input" name="property_gallery" value="<?php echo esc_attr( $gallery_ids ); ?>" />
    <button type="button" id="add-gallery-images" class="button button-secondary">
      + Add Gallery Images
    </button>
    <?php
}


/* ── 3. Features & Amenities Fields ── */
function mizar_property_amenities_fields( $post ) {
    $saved = get_post_meta( $post->ID, '_property_amenities', true );
    $saved_arr = $saved ? explode(',', $saved) : [];

    $all_amenities = [
        'TV Cable', 'Barbeque', 'Gym', 'Microwave', 'Air Conditioning',
        'Outdoor Shower', 'Lawn', 'Refrigerator', 'Washer', 'Swimming Pool',
        'Parking', 'Security', 'WiFi', 'Elevator', 'Balcony',
        'Garden', 'Fireplace', 'Dishwasher', 'Heating', 'Storage',
    ];
    ?>
    <p style="color:#555;font-size:13px;margin:0 0 12px;">Check all amenities available for this property:</p>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;">
      <?php foreach ( $all_amenities as $amenity ) :
        $checked = in_array($amenity, $saved_arr) ? 'checked' : '';
      ?>
      <label style="display:flex;align-items:center;gap:6px;font-size:13px;cursor:pointer;">
        <input type="checkbox"
               name="property_amenities[]"
               value="<?php echo esc_attr($amenity); ?>"
               <?php echo $checked; ?>
               style="width:16px;height:16px;accent-color:#e8292a;" />
        <?php echo esc_html($amenity); ?>
      </label>
      <?php endforeach; ?>
    </div>
    <?php
}


/* ── 4. Video & Map Fields ── */
function mizar_property_media_fields( $post ) {
    $video_url = get_post_meta( $post->ID, '_property_video', true );
    $map_embed = get_post_meta( $post->ID, '_property_map',   true );
    ?>
    <style>
      .mizar-meta-table textarea { width:100%; padding:8px 12px; border:1px solid #ddd; border-radius:6px; font-size:13px; font-family:monospace; }
      .mizar-meta-table input[type="url"] { width:100%; padding:8px 12px; border:1px solid #ddd; border-radius:6px; font-size:13px; }
    </style>
    <table class="mizar-meta-table">
      <tr>
        <th style="vertical-align:top;padding-top:12px;"><label for="property_video">YouTube Video URL</label></th>
        <td>
          <input type="url" id="property_video" name="property_video"
                 value="<?php echo esc_attr($video_url); ?>"
                 placeholder="e.g. https://www.youtube.com/watch?v=xxxxxxx" />
          <p style="color:#888;font-size:12px;margin:6px 0 0;">Paste the full YouTube video URL. It will be automatically converted to an embed.</p>
        </td>
      </tr>
      <tr>
        <th style="vertical-align:top;padding-top:12px;"><label for="property_map">Google Maps Embed URL</label></th>
        <td>
          <textarea id="property_map" name="property_map" rows="3"
                    placeholder="Paste the src URL from Google Maps embed code..."><?php echo esc_textarea($map_embed); ?></textarea>
          <p style="color:#888;font-size:12px;margin:6px 0 0;">
            Go to Google Maps → search your address → Share → Embed a map → copy only the <code>src="..."</code> URL and paste it here.
          </p>
        </td>
      </tr>
    </table>
    <?php
}


/* ── Save All Property Meta ── */
function mizar_save_property_meta( $post_id ) {
    if ( ! isset( $_POST['property_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['property_nonce'], 'mizar_property_nonce' ) ) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( ! current_user_can('edit_post', $post_id) ) return;

    // Basic text/number fields
    // FIX: removed 'property_gallery' and 'property_map' from this loop —
    // gallery needs absint sanitization; map needs esc_url_raw. Both are handled separately below.
    $basic_fields = [
        'property_price', 'property_beds', 'property_baths',
        'property_area',  'property_location', 'property_type',
        'property_video',
    ];
    foreach ( $basic_fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[$field] ) );
        }
    }

    // Gallery — store as comma-separated integer attachment IDs
    // FIX: sanitize each ID with absint() so only valid integers are stored,
    // then filter out any zeroes. This prevents junk data from reaching wp_get_attachment_image_url().
    if ( isset( $_POST['property_gallery'] ) ) {
        $raw_ids   = explode( ',', $_POST['property_gallery'] );
        $clean_ids = array_filter( array_map( 'absint', $raw_ids ) );
        update_post_meta( $post_id, '_property_gallery', implode( ',', $clean_ids ) );
    } else {
        // No gallery posted (e.g. all images removed) — clear the meta
        update_post_meta( $post_id, '_property_gallery', '' );
    }

    // Map embed — esc_url_raw preserves the long Google Maps src URL correctly
    if ( isset( $_POST['property_map'] ) ) {
        update_post_meta( $post_id, '_property_map', esc_url_raw( $_POST['property_map'] ) );
    }

    // Amenities checkboxes
    if ( isset( $_POST['property_amenities'] ) && is_array( $_POST['property_amenities'] ) ) {
        $amenities = array_map( 'sanitize_text_field', $_POST['property_amenities'] );
        update_post_meta( $post_id, '_property_amenities', implode(',', $amenities) );
    } else {
        update_post_meta( $post_id, '_property_amenities', '' );
    }
}
add_action( 'save_post', 'mizar_save_property_meta' );
// Force Gutenberg to render meta boxes outside the iframe canvas
// so admin-property.js can access #property_gallery_input directly
add_filter( 'use_block_editor_for_post_type', function( $use, $post_type ) {
    if ( $post_type === 'property' ) return false;
    return $use;
}, 10, 2 );


/* ══════════════════════════════════════════════════════════════
   USER ROLES
   ══════════════════════════════════════════════════════════════

   Roles added:
   - Agent    → can add/edit/delete their OWN properties only
   - Editor   → can manage blog posts and pages (no properties)
   Subscriber → already exists in WordPress by default

   Runs once on theme activation. To re-run after changes:
   deactivate and reactivate the theme, or call
   mizar_register_roles() manually from wp-cli.
══════════════════════════════════════════════════════════════ */
function mizar_register_roles() {

    // ── Agent Role ──────────────────────────────────────────
    // Can manage their own property listings only.
    // Cannot touch other users' posts, pages, plugins or settings.
    remove_role( 'agent' ); // remove first so re-activation resets caps cleanly
    add_role( 'agent', 'Agent', [
        // WordPress access
        'read'                   => true,  // can log in to WP Admin

        // Properties (custom post type — mapped via mizar_agent_property_caps below)
        'edit_properties'        => true,
        'edit_published_properties' => true,
        'publish_properties'     => true,
        'delete_properties'      => true,
        'delete_published_properties' => true,
        'upload_files'           => true,  // needed for property images

        // Explicitly blocked
        'edit_others_properties' => false,
        'delete_others_properties' => false,
        'edit_pages'             => false,
        'edit_posts'             => false,
        'manage_options'         => false,
        'install_plugins'        => false,
        'activate_plugins'       => false,
    ]);

    // ── Editor Role ──────────────────────────────────────────
    // WordPress ships with an 'editor' role but it has no access
    // to properties. We enhance it here without touching core caps.
    $editor = get_role( 'editor' );
    if ( $editor ) {
        // Make sure editor CANNOT manage properties (agents do that)
        $editor->remove_cap( 'edit_others_properties' );
        $editor->remove_cap( 'delete_others_properties' );
        // Make sure editor cannot change site settings
        $editor->remove_cap( 'manage_options' );
    }
}
add_action( 'after_switch_theme', 'mizar_register_roles' );

// Map the custom 'property' CPT capabilities to the role caps above
add_filter( 'post_type_link', '__return_false', 0 ); // placeholder hook order
function mizar_agent_property_caps( $caps, $cap, $user_id, $args ) {
    // Only intercept capability checks for the 'property' post type
    $property_caps = [
        'edit_post', 'delete_post', 'read_post',
        'edit_posts', 'edit_others_posts', 'publish_posts',
        'delete_posts', 'delete_others_posts',
    ];
    return $caps;
}

// Tell WordPress what primitive caps the 'property' CPT maps to
add_action( 'init', function() {
    global $wp_post_types;
    if ( isset( $wp_post_types['property'] ) ) {
        $wp_post_types['property']->cap->edit_post          = 'edit_properties';
        $wp_post_types['property']->cap->edit_posts         = 'edit_properties';
        $wp_post_types['property']->cap->edit_others_posts  = 'edit_others_properties';
        $wp_post_types['property']->cap->publish_posts      = 'publish_properties';
        $wp_post_types['property']->cap->read_post          = 'read';
        $wp_post_types['property']->cap->delete_post        = 'delete_properties';
        $wp_post_types['property']->cap->delete_posts       = 'delete_properties';
        $wp_post_types['property']->cap->delete_others_posts = 'delete_others_properties';
    }
}, 11 ); // priority 11 = after mizar_register_property_cpt (priority 10)

// Redirect agents away from the main dashboard to the property list
add_action( 'admin_init', function() {
    if ( ! current_user_can('manage_options') && current_user_can('edit_properties') ) {
        $screen = get_current_screen();
        if ( $screen && $screen->id === 'dashboard' ) {
            wp_redirect( admin_url('edit.php?post_type=property') );
            exit;
        }
    }
});

// Hide irrelevant admin menu items for agents
add_action( 'admin_menu', function() {
    if ( current_user_can('manage_options') ) return; // admins see everything

    if ( current_user_can('edit_properties') ) {
        // Agent: only needs Properties + Media
        remove_menu_page( 'edit.php' );               // Posts/Blog
        remove_menu_page( 'edit-comments.php' );      // Comments
        remove_menu_page( 'edit.php?post_type=page' ); // Pages
        remove_menu_page( 'tools.php' );              // Tools
    }
}, 999 );


/* ══════════════════════════════════════════════════════════════
   SECURITY FEATURES
══════════════════════════════════════════════════════════════ */

// ── 1. Limit Login Attempts ─────────────────────────────────
// Blocks brute-force attacks by locking out an IP after
// 5 failed logins. Lockout lasts 15 minutes.
// Data stored in wp_options, no extra DB table needed.

define( 'MIZAR_MAX_LOGIN_ATTEMPTS', 5  );   // fails before lockout
define( 'MIZAR_LOCKOUT_DURATION',   900 );  // seconds (15 min)

add_filter( 'authenticate', 'mizar_check_login_attempts', 30, 3 );
function mizar_check_login_attempts( $user, $username, $password ) {
    // Only check on actual form submit, not on page load
    if ( empty($username) && empty($password) ) return $user;

    $ip       = sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0' );
    $key      = 'mizar_login_fail_' . md5( $ip );
    $data     = get_transient( $key );
    $attempts = $data ? (int) $data : 0;

    if ( $attempts >= MIZAR_MAX_LOGIN_ATTEMPTS ) {
        $minutes = ceil( MIZAR_LOCKOUT_DURATION / 60 );
        // FIX: wp_die() renders proper HTML instead of bleeding
        // raw tags into the username input field via WP_Error
        wp_die(
            '<h2>Too Many Login Attempts</h2>'
            . '<p>Your IP has been temporarily locked out after too many failed login attempts.</p>'
            . '<p>Please try again in <strong>' . $minutes . ' minutes</strong>.</p>'
            . '<p><a href="' . esc_url( home_url() ) . '">&larr; Back to site</a></p>',
            'Login Locked — 403',
            [ 'response' => 403 ]
        );
    }
    return $user;
}

add_action( 'wp_login_failed', 'mizar_record_failed_login' );
function mizar_record_failed_login( $username ) {
    $ip   = sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0' );
    $key  = 'mizar_login_fail_' . md5( $ip );
    $data = get_transient( $key );
    $attempts = $data ? (int) $data + 1 : 1;
    set_transient( $key, $attempts, MIZAR_LOCKOUT_DURATION );
}

add_action( 'wp_login', 'mizar_clear_failed_login' );
function mizar_clear_failed_login( $username ) {
    $ip  = sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0' );
    $key = 'mizar_login_fail_' . md5( $ip );
    delete_transient( $key );
}


// ── 2. Auto-logout Idle Admin Sessions ──────────────────────
// Logs out any logged-in user who has been idle for 30 minutes.
// Idle timer resets on every page load. Works via JS + AJAX.

define( 'MIZAR_IDLE_TIMEOUT', 1800 ); // seconds (30 minutes)

add_action( 'wp_footer',    'mizar_idle_logout_script' );
add_action( 'admin_footer', 'mizar_idle_logout_script' );
function mizar_idle_logout_script() {
    if ( ! is_user_logged_in() ) return;
    $timeout_ms  = MIZAR_IDLE_TIMEOUT * 1000;
    $logout_url  = wp_logout_url( home_url() );
    ?>
    <script>
    (function(){
      var idleTimer;
      var TIMEOUT = <?php echo $timeout_ms; ?>;
      function resetTimer() {
        clearTimeout(idleTimer);
        idleTimer = setTimeout(function(){
          window.location.href = <?php echo json_encode( $logout_url ); ?>;
        }, TIMEOUT);
      }
      ['mousemove','keydown','click','scroll','touchstart'].forEach(function(evt){
        document.addEventListener(evt, resetTimer, { passive: true });
      });
      resetTimer();
    })();
    </script>
    <?php
}


// ── 3. Disable XML-RPC ──────────────────────────────────────
// XML-RPC is a legacy API that is almost never needed and is
// frequently exploited for brute-force and DDoS attacks.
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'wp_headers', function( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
});


// ── 4. Disable File Editing from WP Admin ───────────────────
// Prevents attackers (or careless admins) from editing theme/
// plugin PHP files directly from the WordPress dashboard.
if ( ! defined('DISALLOW_FILE_EDIT') ) {
    define( 'DISALLOW_FILE_EDIT', true );
}


// ── 5. Security Headers ─────────────────────────────────────
// Adds HTTP headers that protect against clickjacking (X-Frame),
// MIME sniffing (X-Content-Type), and XSS (X-XSS-Protection).
add_action( 'send_headers', function() {
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-XSS-Protection: 1; mode=block' );
    header( 'Referrer-Policy: strict-origin-when-cross-origin' );
    header( 'Permissions-Policy: geolocation=(), microphone=(), camera=()' );
});


// ── 6. Hide WordPress Version Number ────────────────────────
// Removes the WP version from page source, RSS feeds and
// style/script query strings so attackers can't target
// version-specific vulnerabilities.
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );
add_filter( 'style_loader_src',  'mizar_remove_version_query', 9999 );
add_filter( 'script_loader_src', 'mizar_remove_version_query', 9999 );
function mizar_remove_version_query( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo('version') ) !== false ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}


// ── 7. Disable REST API for Non-Logged-In Users ─────────────
// The WP REST API exposes user data and post data publicly
// by default. This restricts it to logged-in users only,
// while keeping Gutenberg and admin AJAX working fine.
add_filter( 'rest_authentication_errors', function( $result ) {
    if ( ! empty($result) ) return $result;
    if ( ! is_user_logged_in() ) {
        return new WP_Error(
            'rest_not_logged_in',
            'REST API access is restricted to authenticated users.',
            [ 'status' => 401 ]
        );
    }
    return $result;
});


// ── 8. Activity Log ─────────────────────────────────────────
// Logs important events (login, logout, post publish/delete,
// role changes) to a private custom post type so you always
// know who did what and when.
// View logs: WP Admin → Activity Log

add_action( 'init', 'mizar_register_activity_log_cpt' );
function mizar_register_activity_log_cpt() {
    register_post_type( 'mizar_activity_log', [
        'label'               => 'Activity Log',
        'labels'              => [ 'menu_name' => 'Activity Log' ],
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-list-view',
        'capability_type'     => 'post',
        'capabilities'        => [ 'create_posts' => 'do_not_allow' ],
        'map_meta_cap'        => true,
        'supports'            => [ 'title' ],
        'exclude_from_search' => true,
    ]);
}

function mizar_write_log( $action, $detail = '' ) {
    $user    = wp_get_current_user();
    $name    = $user && $user->ID ? $user->user_login : 'guest';
    $ip      = sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' );
    $post_id = wp_insert_post([
        'post_type'   => 'mizar_activity_log',
        'post_title'  => '[' . strtoupper($action) . '] ' . $name . ' — ' . current_time('d M Y H:i:s'),
        'post_status' => 'private',
    ]);
    if ( $post_id ) {
        update_post_meta( $post_id, '_log_user',   $name );
        update_post_meta( $post_id, '_log_action',  $action );
        update_post_meta( $post_id, '_log_detail',  $detail );
        update_post_meta( $post_id, '_log_ip',      $ip );
        update_post_meta( $post_id, '_log_time',    current_time('mysql') );
    }
}

// Log: successful login
add_action( 'wp_login', function( $user_login ) {
    mizar_write_log( 'login', $user_login . ' logged in' );
});

// Log: logout
add_action( 'wp_logout', function() {
    $user = wp_get_current_user();
    mizar_write_log( 'logout', ( $user->user_login ?? 'unknown' ) . ' logged out' );
});

// Log: failed login
add_action( 'wp_login_failed', function( $username ) {
    $ip = sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' );
    mizar_write_log( 'login_failed', 'Failed login for "' . $username . '" from ' . $ip );
});

// Log: post published / updated / deleted
add_action( 'transition_post_status', function( $new, $old, $post ) {
    if ( $post->post_type === 'mizar_activity_log' ) return; // avoid recursion
    if ( $new === $old ) return;
    mizar_write_log(
        'post_' . $new,
        '"' . $post->post_title . '" (' . $post->post_type . ') changed from ' . $old . ' → ' . $new
    );
}, 10, 3 );

// Log: user role change
add_action( 'set_user_role', function( $user_id, $role, $old_roles ) {
    $target = get_userdata( $user_id );
    mizar_write_log(
        'role_change',
        ( $target->user_login ?? $user_id ) . ' role changed from ' . implode(', ', $old_roles) . ' → ' . $role
    );
}, 10, 3 );


/* ══════════════════════════════════════════════════════════════
   CUSTOM LOGIN URL
   ══════════════════════════════════════════════════════════════

   Changes the login URL from /wp-login.php to /mizar-cms
   Anyone hitting /wp-login.php or /wp-admin while not logged in
   gets a 404 — attackers won't even know WordPress is running.

   YOUR LOGIN URL:  https://yoursite.com/mizar-cms
   !! BOOKMARK THIS before uploading — do not forget it !!
══════════════════════════════════════════════════════════════ */
define( 'MIZAR_LOGIN_SLUG', 'mizar-cms' );

// ── Step 1: Register the custom login slug as a rewrite rule ─
add_action( 'init', 'mizar_custom_login_rewrite' );
function mizar_custom_login_rewrite() {
    add_rewrite_rule(
        '^' . MIZAR_LOGIN_SLUG . '/?$',
        'index.php?mizar_login=1',
        'top'
    );
    add_rewrite_tag( '%mizar_login%', '1' );
}

// ── Step 2: Intercept the request and serve wp-login.php ─────
add_action( 'template_redirect', 'mizar_serve_custom_login' );
function mizar_serve_custom_login() {
    if ( ! get_query_var('mizar_login') ) return;

    // Already logged in — send to dashboard
    if ( is_user_logged_in() ) {
        wp_redirect( admin_url() );
        exit;
    }

    // FIX: Instead of require_once (which caused $user_login/$error undefined
    // warnings because wp-login.php expects to be loaded as the entry point),
    // we set a global constant and load it cleanly via SHORTINIT bypass.
    // This is the standard approach used by login-redirect plugins.
    global $pagenow;
    $pagenow = 'wp-login.php';

    // Pass through any query params (action=lostpassword, etc.)
    $_SERVER['REQUEST_URI'] = '/wp-login.php'
        . ( ! empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '' );

    // Suppress the undefined variable notices that fire before WP
    // initialises $user_login and $error inside wp-login.php
    set_error_handler( function( $errno, $errstr ) {
        return strpos( $errstr, 'Undefined variable' ) !== false;
    });

    require_once ABSPATH . 'wp-login.php';

    restore_error_handler();
    exit;
}

// ── Step 3: Rewrite all login URLs throughout WordPress ───────
// This covers wp_login_url(), wp_logout_url(), admin login
// redirects and anything else WordPress generates internally.
add_filter( 'login_url', 'mizar_rewrite_login_url', 10, 3 );
function mizar_rewrite_login_url( $login_url, $redirect, $force_reauth ) {
    $custom = home_url( MIZAR_LOGIN_SLUG );
    if ( $redirect ) {
        $custom = add_query_arg( 'redirect_to', urlencode( $redirect ), $custom );
    }
    if ( $force_reauth ) {
        $custom = add_query_arg( 'reauth', '1', $custom );
    }
    return $custom;
}

// ── Step 4: Block direct access to /wp-login.php ─────────────
// Blocks GET requests to wp-login.php (attackers browsing to it)
// but ALLOWS POST requests (the login form submits via POST to
// wp-login.php — that's hardcoded in WordPress core and cannot
// be changed without patching core files).
add_action( 'init', 'mizar_block_default_login' );
function mizar_block_default_login() {
    $request = parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH );
    $request = rtrim( $request, '/' );

    $is_wp_login  = ( basename( $request ) === 'wp-login.php' );
    $is_wp_admin  = ( strpos( $request, '/wp-admin' ) !== false );
    $is_logged_in = is_user_logged_in();
    $is_ajax      = ( defined('DOING_AJAX') && DOING_AJAX );
    $is_post      = ( $_SERVER['REQUEST_METHOD'] === 'POST' );
    $action       = $_GET['action'] ?? '';

    // Always allow logout (GET with action=logout)
    if ( $is_wp_login && $action === 'logout' ) return;

    // Always allow admin-ajax.php
    if ( strpos( $request, 'admin-ajax.php' ) !== false ) return;

    // FIX: Allow POST to wp-login.php — this is the login form submission.
    // WordPress core hardcodes the form action to wp-login.php so we cannot
    // intercept it. Blocking POST would break login entirely.
    if ( $is_wp_login && $is_post ) return;

    // Block GET requests to wp-login.php for non-logged-in users
    if ( $is_wp_login && ! $is_logged_in ) {
        mizar_write_log(
            'blocked_login_attempt',
            'Direct access to wp-login.php blocked from ' . sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' )
        );
        wp_die(
            '<h1>404 &mdash; Not Found</h1><p>The page you are looking for does not exist.</p>',
            '404 Not Found',
            [ 'response' => 404 ]
        );
    }

    // Block /wp-admin GET for non-logged-in visitors
    if ( $is_wp_admin && ! $is_logged_in && ! $is_ajax && ! $is_post ) {
        wp_die(
            '<h1>404 &mdash; Not Found</h1><p>The page you are looking for does not exist.</p>',
            '404 Not Found',
            [ 'response' => 404 ]
        );
    }
}

// ── Step 5: Fix the "lost password" and "register" URLs ──────
add_filter( 'lostpassword_url', function( $url, $redirect ) {
    return add_query_arg( 'action', 'lostpassword', home_url( MIZAR_LOGIN_SLUG ) );
}, 10, 2 );

// ── Step 6: After successful login always go to wp-admin ─────
// Without this, WordPress sometimes redirects back to wp-login.php
// after processing the POST, which then gets blocked by our 404 rule.
add_filter( 'login_redirect', 'mizar_login_redirect', 10, 3 );
function mizar_login_redirect( $redirect_to, $requested_redirect_to, $user ) {
    if ( is_wp_error($user) ) return $redirect_to;
    // Admins and agents go to wp-admin
    return admin_url();
}

// ── Step 7: Flush rewrite rules once on theme activation ─────
add_action( 'after_switch_theme', function() {
    mizar_custom_login_rewrite();
    flush_rewrite_rules();
});
