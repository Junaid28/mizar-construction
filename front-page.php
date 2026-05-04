<?php
/*
 * Template Name: Homepage
 */
get_header(); ?>
      <section class="hero-wrapper">
        <div class="hero-card">
          <div class="hero-content">
            <h1 class="hero-title">Find your next Home in Las Vegas</h1>
            <p class="hero-copy" style="font-weight: bold;font-size: 14px;;">
              Mizar Construction is transforming the way clients plan, build, and deliver projects through innovative solutions and a seamless construction experience.
            </p>
          </div>
          <div class="search-card">
            <div class="search-item">
              <span>Locations</span>
              <select id="search-location" aria-label="Select your city">
                <option value="" disabled selected>Select your city</option>
                <option value="las vegas">Las Vegas</option>
                <option value="henderson">Henderson</option>
                <option value="summerlin">Summerlin</option>
              </select>
            </div>
            <div class="search-item">
              <span>Property Type</span>
              <select id="search-type" aria-label="Select property type">
                <option value="" disabled selected>Select property type</option>
                <option value="apartment">Apartment</option>
                <option value="house">House</option>
                <option value="townhouse">Townhouse</option>
              </select>
            </div>
            <div class="search-item">
              <span>Rent Range</span>
              <select id="search-budget" aria-label="Select rent range">
                <option value="" disabled selected>Select rent range</option>
                <option value="100-300">$1,000 - $2,000</option>
                <option value="300-500">$2,000 - $3,500</option>
                <option value="500-1000">$3,500+</option>
              </select>
            </div>
            <button class="search-btn" type="button" onclick="doSearch()">
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M10 18a8 8 0 1 1 5.293-2.707l4.207 4.207-1.414 1.414-4.207-4.207A7.963 7.963 0 0 1 10 18zm0-14a6 6 0 1 0 0 12 6 6 0 0 0 0-12z" />
              </svg>
              Search
            </button>
          </div>
        </div>
      </section>
      <section class="about-section">
        <div class="about-grid">
          <div class="about-image anim-fade-left">
            <img src="<?php echo get_template_directory_uri(); ?>/images/about/about-img.png" alt="About us team" />
          </div>
          <div class="about-copy anim-fade-right">
            <span class="about-label anim-fade-up stagger-1">who we are</span>
            <h2 class="about-title">We help clients buy and<br>sell houses since 1989</h2>
            <p class="about-text">
              With over $2 Billion in sales, due to our unparalleled results, expertise and dedication, we rank amongst the top 6 agencies in Las Vegas. Our agency is the industry’s top luxury producer.
            </p>
            <div class="stats-grid">
              <article class="stat-card anim-scale">
                <span class="stat-label">Active Listings</span>
                <strong class="stat-number counter" data-target="5000" data-suffix="K">0</strong>
              </article>
              <article class="stat-card anim-scale stagger-2">
                <span class="stat-label">Sold Listings</span>
                <strong class="stat-number counter" data-target="5000" data-suffix="K">0</strong>
              </article>
              <article class="stat-card anim-scale stagger-3">
                <span class="stat-label">Clients we've served</span>
                <strong class="stat-number counter" data-target="9000" data-suffix="K">0</strong>
              </article>
            </div>
          </div>
        </div>
      </section>
      <section class="properties-section">
        <div class="properties-heading anim-fade-up">
          <span class="section-label anim-fade-up">recent properties</span>
          <h2>Explore the latest properties available</h2>
        </div>

        <?php
        // Fetch all published properties (up to 12)
        $home_props = new WP_Query([
          'post_type'      => 'property',
          'posts_per_page' => 12,
          'post_status'    => 'publish',
          'orderby'        => 'date',
          'order'          => 'DESC',
        ]);
        $total_props = $home_props->post_count;
        ?>

        <div class="property-grid" id="homePropertyGrid">

          <?php
          $stagger_classes = [ '', 'stagger-1', 'stagger-2', 'stagger-3', 'stagger-4', 'stagger-5' ];
          $idx = 0;

          if ( $home_props->have_posts() ) :
            while ( $home_props->have_posts() ) : $home_props->the_post();

              $pid      = get_the_ID();
              $title    = get_the_title();
              $link     = get_permalink();
              $price    = get_post_meta( $pid, '_property_price',    true );
              $beds     = get_post_meta( $pid, '_property_beds',     true );
              $baths    = get_post_meta( $pid, '_property_baths',    true );
              $area     = get_post_meta( $pid, '_property_area',     true );
              $location = get_post_meta( $pid, '_property_location', true );

              $img_url  = has_post_thumbnail()
                ? get_the_post_thumbnail_url( $pid, 'large' )
                : get_template_directory_uri() . '/images/property-images/placeholder.jpg';

              // Cards beyond 6 are hidden initially; revealed 3-at-a-time by JS
              $hidden_class = ( $idx >= 6 ) ? ' hp-hidden' : '';
              $stagger      = $stagger_classes[ $idx % 6 ];
          ?>

          <article class="property-card anim-fade-up <?php echo $stagger . $hidden_class; ?>"
                   data-index="<?php echo $idx; ?>">
            <a href="<?php echo esc_url( $link ); ?>" class="property-card-link" aria-label="View details for <?php echo esc_attr( $title ); ?>">
              <div class="property-image">
                <img src="<?php echo esc_url( $img_url ); ?>"
                     alt="<?php echo esc_attr( $title ); ?>" />
              </div>
            </a>
            <div class="property-body">
              <p class="property-location">
                <?php echo esc_html( $location ? strtoupper( $location ) : strtoupper( $title ) ); ?>
              </p>
              <?php if ( $price ) : ?>
                <p class="property-price">$ <?php echo esc_html( $price ); ?></p>
              <?php endif; ?>
              <div class="property-details">
                <?php if ( $beds ) : ?>
                <span class="property-detail">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/logo/double-bed.png" alt="bed" class="detail-icon" />
                  <?php echo esc_html( $beds ); ?> beds
                </span>
                <?php endif; ?>
                <?php if ( $baths ) : ?>
                <span class="property-detail">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/logo/bathtub.png" alt="bathtub" class="detail-icon" />
                  <?php echo esc_html( $baths ); ?> baths
                </span>
                <?php endif; ?>
                <?php if ( $area ) : ?>
                <span class="property-detail">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/logo/select.png" alt="area" class="detail-icon" />
                  <?php echo esc_html( $area ); ?> ft
                </span>
                <?php endif; ?>
              </div>
              <a class="property-btn" href="<?php echo esc_url( $link ); ?>">View Details</a>
            </div>
          </article>

          <?php
              $idx++;
            endwhile;
            wp_reset_postdata();
          else :
          ?>
            <p style="padding:40px 20px;color:rgba(26,26,46,0.6);grid-column:1/-1;">
              No properties found. Add properties from WordPress Admin → Properties → Add New.
            </p>
          <?php endif; ?>

        </div><!-- #homePropertyGrid -->

        <?php if ( $total_props > 6 ) : ?>
        <div class="properties-footer">
          <button class="view-more-btn" id="homeViewMoreBtn"
                  data-shown="6"
                  data-total="<?php echo $total_props; ?>"
                  data-step="3"
                  type="button">
            View More
          </button>
        </div>
        <?php endif; ?>

        <style>
          /* Hidden cards — revealed by JS */
          #homePropertyGrid .hp-hidden {
            display: none;
          }
          /* Smooth fade-in when a card is revealed */
          #homePropertyGrid .property-card.hp-revealed {
            animation: hpFadeIn 0.4s ease both;
          }
          @keyframes hpFadeIn {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
          }
          /* Make image area clickable */
          .property-card-link { display: block; text-decoration: none; }
          /* Hide button when all cards are visible */
          #homeViewMoreBtn.hp-all-shown { display: none; }
        </style>

        <script>
        (function () {
          var btn = document.getElementById('homeViewMoreBtn');
          if ( ! btn ) return;

          btn.addEventListener('click', function () {
            var shown = parseInt( btn.dataset.shown, 10 );
            var step  = parseInt( btn.dataset.step,  10 );
            var total = parseInt( btn.dataset.total,  10 );

            var hiddenCards = document.querySelectorAll('#homePropertyGrid .hp-hidden');
            var revealed    = 0;

            hiddenCards.forEach(function (card) {
              if ( revealed < step ) {
                card.classList.remove('hp-hidden');
                card.classList.add('hp-revealed');
                revealed++;
              }
            });

            shown += revealed;
            btn.dataset.shown = shown;

            // Hide the button once all cards are visible
            if ( shown >= total ) {
              btn.classList.add('hp-all-shown');
            }
          });
        })();
        </script>

      </section>
      <section class="services-section" id="services">
        <div class="service_container">
        <div class="services-heading anim-fade-up">
          <span class="services-label">our services</span>
          <h2>Take a brief look at some of the services we offer</h2>
        </div>
        <div class="service-grid">
            <!-- Card 1: Real Estate Development -->
            <div class="service-card anim-scale">
              <img class="service-card__bg" src="<?php echo get_template_directory_uri(); ?>/images/icons/Subtract.png" alt=""/>
              <div class="service-card__content">
                <p class="service-card__title">Real Estate<br>Development</p>
                <div class="service-card__icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/Condo.png"/></div>
              </div>
              <img class="service-card__ellipse" src="<?php echo get_template_directory_uri(); ?>/images/icons/Ellipse_2.png" alt=""/>
              <img class="service-card__arrow"   src="<?php echo get_template_directory_uri(); ?>/images/icons/Pixel_Arrow.png"   alt=""/>
            </div>
            <!-- Card 2: Project Management -->
            <div class="service-card anim-scale stagger-2">
              <img class="service-card__bg" src="<?php echo get_template_directory_uri(); ?>/images/icons/Subtract.png" alt=""/>
              <div class="service-card__content">
                <p class="service-card__title">Project<br>Management</p>
                <div class="service-card__icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/Condo.png"/></div>
              </div>
              <img class="service-card__ellipse" src="<?php echo get_template_directory_uri(); ?>/images/icons/Ellipse_2.png" alt=""/>
              <img class="service-card__arrow"   src="<?php echo get_template_directory_uri(); ?>/images/icons/Pixel_Arrow.png"   alt=""/>
            </div>
            <!-- Card 3: Investment & Capital -->
            <div class="service-card anim-scale stagger-3">
              <img class="service-card__bg" src="<?php echo get_template_directory_uri(); ?>/images/icons/Subtract.png" alt=""/>
              <div class="service-card__content">
                <p class="service-card__title">Investment &amp;<br>Capital</p>
                <div class="service-card__icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/Condo.png"/></div>
              </div>
              <img class="service-card__ellipse" src="<?php echo get_template_directory_uri(); ?>/images/icons/Ellipse_2.png" alt=""/>
              <img class="service-card__arrow"   src="<?php echo get_template_directory_uri(); ?>/images/icons/Pixel_Arrow.png"   alt=""/>
            </div>
        </div>
        </div>

      </section>
      <section class="testimonials-section">
        <div class="testimonials-heading anim-fade-up">
          <div><span class="testimonials-label">our clients</span></div>
          <h2>What are our clients<br>saying about us</h2>
        </div>
        <div class="testimonials-grid">

          <div class="testimonial-card anim-fade-up">
            <div class="testimonial-author">
              <img class="testimonial-avatar" src="<?php echo get_template_directory_uri(); ?>/images/testimonials/client-image.png" alt="Dana Gilmore"/>
              <div class="testimonial-author-info">
                <p class="testimonial-name">Dana Gilmore</p>
                <p class="testimonial-role">happy seller</p>
              </div>
            </div>
            <p class="testimonial-text">The Mizar Construction team did an outstanding job helping me buy my first home. The high level of service and dedication.</p>
            <div class="testimonial-stars">
              <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
            </div>
          </div>

          <div class="testimonial-card anim-fade-up stagger-1">
            <div class="testimonial-author">
              <img class="testimonial-avatar" src="<?php echo get_template_directory_uri(); ?>/images/testimonials/client-image2.png" alt="Susan Barkley"/>
              <div class="testimonial-author-info">
                <p class="testimonial-name">Susan Barkley</p>
                <p class="testimonial-role">happy buyer</p>
              </div>
            </div>
            <p class="testimonial-text">We hired the Mizar Construction team as our buyer agent because they are specifically trained in Short Sale &amp; Foreclosure.</p>
            <div class="testimonial-stars">
              <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
            </div>
          </div>

          <div class="testimonial-card anim-fade-up stagger-2">
            <div class="testimonial-author">
              <img class="testimonial-avatar" src="<?php echo get_template_directory_uri(); ?>/images/testimonials/client-image3.png" alt="Dana Gilmore"/>
              <div class="testimonial-author-info">
                <p class="testimonial-name">Dana Gilmore</p>
                <p class="testimonial-role">happy seller</p>
              </div>
            </div>
            <p class="testimonial-text">The Mizar Construction team did an outstanding job helping me buy my first home. The high level of service and dedication.</p>
            <div class="testimonial-stars">
              <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
            </div>
          </div>

          <div class="testimonial-card anim-fade-up stagger-3">
            <div class="testimonial-author">
              <img class="testimonial-avatar" src="<?php echo get_template_directory_uri(); ?>/images/testimonials/client-image4.png" alt="Anna McKenzie"/>
              <div class="testimonial-author-info">
                <p class="testimonial-name">Anna McKenzie</p>
                <p class="testimonial-role">happy seller</p>
              </div>
            </div>
            <p class="testimonial-text">As I move forward to now BUY my next house, I am extremely certain Residence will be the right partner to help me.</p>
            <div class="testimonial-stars">
              <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
            </div>
          </div>

          <div class="testimonial-card">
            <div class="testimonial-author">
              <img class="testimonial-avatar" src="<?php echo get_template_directory_uri(); ?>/images/testimonials/client-image5.png" alt="Stephanie Barkley"/>
              <div class="testimonial-author-info">
                <p class="testimonial-name">Stephanie Barkley</p>
                <p class="testimonial-role">happy seller</p>
              </div>
            </div>
            <p class="testimonial-text">The sale went smoothly, and we just closed on an ideal new place we're excited to call home.</p>
            <div class="testimonial-stars">
              <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
            </div>
          </div>

          <div class="testimonial-card">
            <div class="testimonial-author">
              <img class="testimonial-avatar" src="<?php echo get_template_directory_uri(); ?>/images/testimonials/client-image6.png" alt="Janine Royce"/>
              <div class="testimonial-author-info">
                <p class="testimonial-name">Janine Royce</p>
                <p class="testimonial-role">happy seller</p>
              </div>
            </div>
            <p class="testimonial-text">His professionalism, personality, attention to detail, responsiveness and his ability to close the deal was Outstanding.</p>
            <div class="testimonial-stars">
              <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
            </div>
          </div>

        </div>
      </section>

      <section class="contact-section">
        <div class="contact-grid">
          <!-- Left: Form Card -->
          <div class="contact-form-card">
            <p class="contact-interest-label">I'm interested in...</p>
            <div class="contact-tags" role="group" aria-label="Select interest">
              <button class="contact-tag contact-tag--active" data-value="investment" type="button" aria-pressed="true">Investment &amp;<br>Capital</button>
              <button class="contact-tag" data-value="buying" type="button" aria-pressed="false">Buying house</button>
              <button class="contact-tag" data-value="selling" type="button" aria-pressed="false">Selling House</button>
              <button class="contact-tag" data-value="inspection" type="button" aria-pressed="false">Home Inspection</button>
              <button class="contact-tag" data-value="photoshoot" type="button" aria-pressed="false">Photoshoot</button>
            </div>
            <input type="hidden" name="interest" id="selected-interest" value="investment" />

            <div class="contact-fields">
              <div class="contact-field">
                <input type="text" placeholder="Your name" class="contact-input contact-input--active"/>
              </div>
              <div class="contact-field">
                <input type="email" placeholder="Your email" class="contact-input"/>
              </div>
              <div class="contact-field">
                <input type="text" placeholder="Your message" class="contact-input"/>
              </div>
            </div>

            <button class="contact-submit">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 21L23 12 2 3v7l15 2-15 2v7z"/>
              </svg>
              Send Message
            </button>
          </div>

          <!-- Right: Copy -->
          <div class="contact-copy">
            <span class="contact-badge">quick inquiry</span>
            <h2 class="contact-title">Get specialist advice for residential, commercial or property</h2>
            <p class="contact-text">Our experts and developers would love to contribute their expertise and insights and help you today. Contact us to help you plan your next transaction, either buying or selling a home.</p>
          </div>

        </div>
      </section>
      <!-- Blog Articles Section -->
      <section class="blog-section">
        <div class="blog-header anim-fade-up">
          <div class="blog-header__left">
            <span class="blog-label">blog articles</span>
            <h2 class="blog-title">The most recent local real estate news</h2>
          </div>
          <a href="<?php echo home_url('/blog'); ?>" class="blog-view-all">
            View All Posts
            <span class="blog-view-all__icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 18l6-6-6-6" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
          </a>
        </div>

        <div class="blog-grid">
          <?php
          $home_blog = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
          ]);
          $stagger_classes = ['anim-scale', 'anim-scale stagger-2', 'anim-scale stagger-3'];
          $i = 0;
          if ( $home_blog->have_posts() ) :
            while ( $home_blog->have_posts() ) : $home_blog->the_post();
              $cats     = get_the_category();
              $cat_name = ! empty( $cats ) ? esc_html( $cats[0]->name ) : 'General';
              $date     = get_the_date( 'M d, Y' );
              $link     = get_permalink();
              $title    = get_the_title();
              $img_url  = has_post_thumbnail()
                ? get_the_post_thumbnail_url( get_the_ID(), 'large' )
                : get_template_directory_uri() . '/images/blogs/blog-placeholder.jpg';
              $stagger  = $stagger_classes[ $i ] ?? 'anim-scale';
              $i++;
          ?>
          <article class="blog-card <?php echo $stagger; ?>">
            <a href="<?php echo esc_url( $link ); ?>" style="text-decoration:none;color:inherit;display:contents;">
              <div class="blog-card__image">
                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
              </div>
              <div class="blog-card__meta">
                <span class="blog-tag"><?php echo $cat_name; ?></span>
                <span class="blog-date"><?php echo $date; ?></span>
              </div>
              <h3 class="blog-card__title"><?php echo esc_html( $title ); ?></h3>
            </a>
          </article>
          <?php
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>
      </section>
</div>


<?php
  /*
   * Resolve the Properties page URL robustly — tries 3 methods so it
   * works regardless of slug, permalink structure, or page template name.
   */
  $props_url = '';

  // Method 1: find page by the template file name
  $by_template = get_pages([
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'page-properties.php',
    'number'     => 1,
  ]);
  if ( ! empty( $by_template ) ) {
    $props_url = get_permalink( $by_template[0]->ID );
  }

  // Method 2: find by slug "properties"
  if ( ! $props_url ) {
    $by_slug = get_page_by_path( 'properties' );
    if ( $by_slug ) $props_url = get_permalink( $by_slug->ID );
  }

  // Method 3: hard fallback to /properties/
  if ( ! $props_url ) {
    $props_url = home_url( '/properties/' );
  }
?>
<script>
  /* ── Homepage search: redirect to Properties page with filter params ── */
  var PROPERTIES_URL = <?php echo json_encode( esc_url_raw( $props_url ) ); ?>;

  function doSearch() {
    var location = document.getElementById('search-location').value;
    var type     = document.getElementById('search-type').value;
    var budget   = document.getElementById('search-budget').value;

    var params = [];
    if ( location ) params.push('filter-location=' + encodeURIComponent(location));
    if ( type )     params.push('filter-type='     + encodeURIComponent(type));
    if ( budget )   params.push('filter-budget='   + encodeURIComponent(budget));

    var url = PROPERTIES_URL;
    if ( params.length > 0 ) url += '?' + params.join('&');

    window.location.href = url;
  }
</script>

<?php get_footer(); ?>
