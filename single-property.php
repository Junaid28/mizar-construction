<?php
/**
 * single-property.php
 * WordPress uses this automatically for individual property pages
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

  $pid       = get_the_ID();
  $title     = get_the_title();
  $price     = get_post_meta( $pid, '_property_price',     true );
  $beds      = get_post_meta( $pid, '_property_beds',      true );
  $baths     = get_post_meta( $pid, '_property_baths',     true );
  $area      = get_post_meta( $pid, '_property_area',      true );
  $location  = get_post_meta( $pid, '_property_location',  true );
  $type      = get_post_meta( $pid, '_property_type',      true );
  $gallery   = get_post_meta( $pid, '_property_gallery',   true );


  $video_url = get_post_meta( $pid, '_property_video',     true );
  $map_src   = get_post_meta( $pid, '_property_map',       true );
  $amenities = get_post_meta( $pid, '_property_amenities', true );

  $img_url   = has_post_thumbnail()
    ? get_the_post_thumbnail_url( $pid, 'full' )
    : get_template_directory_uri() . '/images/property-images/placeholder.jpg';

  // Convert YouTube URL to embed URL
  $video_embed = '';
  if ( $video_url ) {
    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $video_url, $matches);
    if ( isset($matches[1]) ) {
      $video_embed = 'https://www.youtube.com/embed/' . $matches[1] . '?controls=1&modestbranding=1&rel=0';
    }
  }

  // Amenities array
  $amenities_arr = $amenities ? array_filter( array_map('trim', explode(',', $amenities)) ) : [];

?>

    <!-- Hero Banner -->
    <div class="pd-hero">
      <h1>Property Details</h1>
    </div>

    <!-- Content Wrapper -->
    <div class="pd-content-wrapper">

      <!-- Breadcrumb -->
      <div class="pd-breadcrumb">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
          <circle cx="12" cy="10" r="3"/>
        </svg>
        <span><?php echo esc_html( $location ?: 'Location not specified' ); ?></span>
      </div>

      <!-- Listing Header -->
      <div class="pd-listing-header">
        <h1 class="pd-listing-title"><?php echo esc_html( $title ); ?></h1>
        <?php if ( $price ) : ?>
          <p class="pd-listing-price">$ <?php echo esc_html( $price ); ?></p>
        <?php endif; ?>
      </div>

      <!-- Stats Bar -->
      <div class="pd-stats">
        <?php if ( $beds ) : ?>
        <span class="pd-stat">
          <img src="<?php echo get_template_directory_uri(); ?>/images/logo/double-bed.png" alt="Bedrooms" />
          <?php echo esc_html($beds); ?> Bedrooms
        </span>
        <?php endif; ?>
        <?php if ( $baths ) : ?>
        <span class="pd-stat">
          <img src="<?php echo get_template_directory_uri(); ?>/images/logo/bathtub.png" alt="Bathrooms" />
          <?php echo esc_html($baths); ?> Bathrooms
        </span>
        <?php endif; ?>
        <?php if ( $type ) : ?>
        <span class="pd-stat">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9 22 9 12 15 12 15 22"/>
          </svg>
          <?php echo esc_html( ucfirst($type) ); ?>
        </span>
        <?php endif; ?>
        <?php if ( $area ) : ?>
        <span class="pd-stat">
          <img src="<?php echo get_template_directory_uri(); ?>/images/logo/select.png" alt="Area" />
          <?php echo esc_html($area); ?> Sqft.
        </span>
        <?php endif; ?>
      </div>

      <!-- Two-Column: About + Request Form -->
      <div class="pd-two-col">

        <!-- About This Listing -->
        <div class="pd-about">
          <h2>About This Listing</h2>

          <?php if ( has_post_thumbnail() ) : ?>
          <img src="<?php echo esc_url($img_url); ?>"
               alt="<?php echo esc_attr($title); ?>"
               style="width:100%;border-radius:12px;margin-bottom:20px;object-fit:cover;aspect-ratio:16/9;" />
          <?php endif; ?>

          <?php if ( get_the_content() ) : ?>
            <div><?php the_content(); ?></div>
          <?php else : ?>
            <p>Contact us for more details about this property.</p>
          <?php endif; ?>
        </div>

        <!-- Request Information Form -->
        <div class="pd-request-card">
          <h3>Request Information</h3>

          <?php
          $pd_status = isset($_GET['pd_status']) ? $_GET['pd_status'] : '';
          if ( $pd_status === 'success' ) : ?>
            <div class="pd-alert pd-alert--success">
              ✅ Thanks! We received your enquiry and will contact you shortly.
            </div>
          <?php elseif ( $pd_status === 'error' ) : ?>
            <div class="pd-alert pd-alert--error">
              ❌ Something went wrong. Please try again.
            </div>
          <?php endif; ?>

          <form method="POST" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
            <input type="hidden" name="action" value="property_enquiry" />
            <input type="hidden" name="property_id" value="<?php echo $pid; ?>" />
            <input type="hidden" name="property_title" value="<?php echo esc_attr($title); ?>" />
            <?php wp_nonce_field('property_enquiry_nonce', 'enquiry_nonce'); ?>
            <div class="pd-form-group">
              <input type="text" name="req_name" placeholder="Name" required />
            </div>
            <div class="pd-form-group">
              <input type="email" name="req_email" placeholder="Email" required />
            </div>
            <div class="pd-form-group">
              <input type="tel" name="req_phone" placeholder="Phone no." />
            </div>
            <div class="pd-form-group">
              <textarea name="req_message" placeholder="Message">I am interested in <?php echo esc_attr($title); ?>. Please send me more details.</textarea>
            </div>
            <button type="submit" class="pd-form-submit">SUBMIT</button>
          </form>
        </div>

      </div>

      <!-- Features & Amenities — Dynamic -->
      <?php if ( ! empty($amenities_arr) ) : ?>
      <section class="pd-amenities">
        <h2>Features &amp; Amenities</h2>
        <div class="pd-amenities-grid">
          <?php foreach ( $amenities_arr as $amenity ) : ?>
          <span class="pd-amenity">
            <svg class="pd-amenity-icon" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="12" fill="#e8292a"/>
              <path d="M7 12.5l3 3 7-7" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <?php echo esc_html($amenity); ?>
          </span>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

      <!-- Photo Gallery — Dynamic -->
      <?php
      $gallery_ids = array_filter( array_map( 'trim', explode( ',', $gallery ) ) );
      if ( ! empty( $gallery_ids ) ) :
      ?>
      <section class="pd-gallery">
        <h2>Photo Gallery</h2>
        <div class="pd-gallery-grid">
          <?php
          $count = 0;
          foreach ( $gallery_ids as $gid ) :
            if ( empty($gid) ) continue;
            $gsrc = wp_get_attachment_image_url( (int)$gid, 'large' );
            if ( ! $gsrc ) {
              // Try full size as fallback
              $gsrc = wp_get_attachment_image_url( (int)$gid, 'full' );
            }
            if ( ! $gsrc ) continue;
            $large_class = ( $count === 0 ) ? ' pd-gallery-item--large' : '';
          ?>
          <div class="pd-gallery-item<?php echo $large_class; ?>">
            <img src="<?php echo esc_url( $gsrc ); ?>"
                 alt="<?php echo esc_attr( get_the_title( (int)$gid ) ); ?>" />
          </div>
          <?php
            $count++;
          endforeach;

          // Show message if IDs exist but no images loaded
          if ( $count === 0 ) :
          ?>
          <p style="color:#888;padding:20px;">Gallery images could not be loaded.</p>
          <?php endif; ?>
        </div>
      </section>
      <?php endif; ?>

      <!-- Video — Dynamic -->
      <?php if ( $video_embed ) : ?>
      <section class="pd-video">
        <h2>Video Tour</h2>
        <div class="pd-video-wrapper">
          <iframe src="<?php echo esc_url($video_embed); ?>"
                  title="Property video tour"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen>
          </iframe>
        </div>
      </section>
      <?php endif; ?>

      <!-- Map — Dynamic -->
      <?php if ( $map_src ) : ?>
      <section class="pd-map">
        <h2>Location</h2>
        <div class="pd-map-wrapper">
          <iframe src="<?php echo esc_url($map_src); ?>"
                  title="Property location"
                  loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </section>
      <?php endif; ?>

      <!-- Back to Properties -->
      <div style="padding:0 0 48px;">
        <a href="<?php echo home_url('/properties-list'); ?>"
           style="display:inline-flex;align-items:center;gap:8px;color:var(--red);font-weight:600;text-decoration:none;font-size:0.95rem;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
          </svg>
          Back to Properties
        </a>
      </div>

    </div><!-- end pd-content-wrapper -->

<style>
  .pd-alert {
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 16px;
    font-size: 14px;
    font-weight: 500;
  }
  .pd-alert--success {
    background: #f0fdf4;
    border: 1px solid #86efac;
    color: #166534;
  }
  .pd-alert--error {
    background: #fef2f2;
    border: 1px solid #fca5a5;
    color: #991b1b;
  }
</style>

<?php
  endwhile;
endif;
get_footer();
?>
