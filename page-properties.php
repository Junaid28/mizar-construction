<?php
/*
 * Template Name: Properties
 */

get_header(); ?>

    <!-- Hero Banner -->
    <div class="pl-hero">
      <h1>Properties List</h1>
    </div>

    <!-- Content Wrapper -->
    <div class="pl-content-wrapper">

      <!-- Section Heading -->
      <div class="pl-section-heading">
        <span class="pl-label">Property</span>
        <h2>Browse Recent Properties by <span>Mizar</span> Construction</h2>
      </div>

      <!-- Filters -->
      <div class="pl-filters">
        <div class="pl-filter-item">
          <select aria-label="Select Type" id="filter-type" onchange="filterProperties()">
            <option value="">Type</option>
            <option value="apartment">Apartment</option>
            <option value="villa">Villa</option>
            <option value="studio">Studio</option>
            <option value="townhouse">Townhouse</option>
            <option value="house">House</option>
          </select>
        </div>
        <div class="pl-filter-item">
          <select aria-label="Select Location" id="filter-location" onchange="filterProperties()">
            <option value="">Location</option>
            <option value="orlando">Orlando, FL</option>
            <option value="las vegas">Las Vegas, NV</option>
            <option value="miami">Miami, FL</option>
            <option value="henderson">Henderson</option>
            <option value="summerlin">Summerlin</option>
          </select>
        </div>
        <div class="pl-filter-item">
          <select aria-label="Select Budget" id="filter-budget" onchange="filterProperties()">
            <option value="">Budget</option>
            <option value="100-300">$100K – $300K</option>
            <option value="300-500">$300K – $500K</option>
            <option value="500-1000">$500K – $1M</option>
            <option value="1000+">$1M+</option>
          </select>
        </div>
      </div>

      <!-- Divider -->
      <hr class="pl-divider" />

      <!-- No Results Message -->
      <p class="pl-no-results" id="pl-no-results" style="display:none;">
        No properties match your selected filters. Please try a different combination.
      </p>

      <!-- Property Grid -->
      <section class="pl-listing">
        <div class="property-grid" id="propertyGrid">

          <?php
          $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

          $props = new WP_Query([
            'post_type'      => 'property',
            'posts_per_page' => 9,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'paged'          => $paged,
          ]);

          $max_pages = $props->max_num_pages;

          if ( $props->have_posts() ) :
            while ( $props->have_posts() ) : $props->the_post();

              $pid      = get_the_ID();
              $title    = get_the_title();
              $link     = get_permalink();
              $price    = get_post_meta( $pid, '_property_price',    true );
              $beds     = get_post_meta( $pid, '_property_beds',     true );
              $baths    = get_post_meta( $pid, '_property_baths',    true );
              $area     = get_post_meta( $pid, '_property_area',     true );
              $location = get_post_meta( $pid, '_property_location', true );
              $type     = get_post_meta( $pid, '_property_type',     true );

              $img_url = has_post_thumbnail()
                ? get_the_post_thumbnail_url( $pid, 'large' )
                : get_template_directory_uri() . '/images/property-images/placeholder.jpg';

              $price_num           = (int) preg_replace('/[^0-9]/', '', $price) / 1000;
              $location_normalized = strtolower( trim( $location ) );
          ?>

          <article class="property-card"
                   data-type="<?php echo esc_attr( strtolower( $type ) ); ?>"
                   data-location="<?php echo esc_attr( $location_normalized ); ?>"
                   data-price="<?php echo esc_attr( $price_num ); ?>">
            <div class="property-image">
              <img src="<?php echo esc_url( $img_url ); ?>"
                   alt="<?php echo esc_attr( $title ); ?>" />
            </div>
            <div class="property-body">
              <p class="property-location">
                <?php echo esc_html( $location ? strtoupper($location) : strtoupper($title) ); ?>
              </p>
              <p class="property-price">$ <?php echo esc_html( $price ); ?></p>
              <div class="property-details">
                <span class="property-detail">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/logo/double-bed.png" alt="bed" class="detail-icon" />
                  <?php echo esc_html( $beds ); ?>
                </span>
                <span class="property-detail">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/logo/bathtub.png" alt="bath" class="detail-icon" />
                  <?php echo esc_html( $baths ); ?>
                </span>
                <span class="property-detail">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/logo/select.png" alt="area" class="detail-icon" />
                  <?php echo esc_html( $area ); ?> ft
                </span>
              </div>
              <a class="property-btn" href="<?php echo esc_url( $link ); ?>">View Details</a>
            </div>
          </article>

          <?php
            endwhile;
            wp_reset_postdata();
          else : ?>
            <p style="padding:40px 20px;color:rgba(26,26,46,0.6);">
              No properties found. Add properties from WordPress Admin → Properties → Add New.
            </p>
          <?php endif; ?>

        </div>
      </section>

      <?php if ( $max_pages > 1 ) : ?>
      <nav class="pl-pagination" aria-label="Properties pagination">
        <?php
        $big = 999999;
        echo paginate_links([
          'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format'    => '?paged=%#%',
          'current'   => max( 1, $paged ),
          'total'     => $max_pages,
          'prev_text' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>',
          'next_text' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>',
          'type'      => 'plain',
        ]);
        ?>
      </nav>
      <?php endif; ?>

    </div><!-- end pl-content-wrapper -->

    <style>
      .pl-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        padding: 40px 20px;
        flex-wrap: wrap;
      }
      .pl-pagination .page-numbers {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 10px;
        border-radius: 8px;
        border: 1.5px solid rgba(26,26,46,0.15);
        color: rgba(26,26,46,0.75);
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        background: #fff;
        transition: all 0.2s ease;
        cursor: pointer;
      }
      .pl-pagination .page-numbers:hover {
        background: #1a1a2e;
        color: #fff;
        border-color: #1a1a2e;
      }
      .pl-pagination .page-numbers.current {
        background: #1a1a2e;
        color: #fff;
        border-color: #1a1a2e;
        font-weight: 700;
        pointer-events: none;
      }
      .pl-pagination .page-numbers.dots {
        border: none;
        background: transparent;
        pointer-events: none;
        color: rgba(26,26,46,0.4);
      }
      .pl-pagination .prev.page-numbers,
      .pl-pagination .next.page-numbers { padding: 0 12px; }
      .pl-pagination .prev.page-numbers:hover,
      .pl-pagination .next.page-numbers:hover {
        background: #1a1a2e;
        color: #fff;
        border-color: #1a1a2e;
      }
      .pl-no-results {
        text-align: center;
        padding: 40px 20px;
        color: rgba(26,26,46,0.6);
        font-size: 15px;
        width: 100%;
      }
    </style>

    <script>
      /* ── Core filter function ── */
      function filterProperties() {
        const typeVal     = document.getElementById('filter-type').value.toLowerCase().trim();
        const locationVal = document.getElementById('filter-location').value.toLowerCase().trim();
        const budgetVal   = document.getElementById('filter-budget').value;
        const cards       = document.querySelectorAll('.property-card');
        let   visibleCount = 0;

        cards.forEach(card => {
          const cardType     = (card.dataset.type     || '').toLowerCase().trim();
          const cardLocation = (card.dataset.location || '').toLowerCase().trim();
          const cardPrice    = parseFloat(card.dataset.price) || 0;

          const showType     = !typeVal     || cardType === typeVal;
          const showLocation = !locationVal || cardLocation.includes(locationVal);

          let showBudget = true;
          if ( budgetVal === '100-300' )  showBudget = cardPrice >= 100  && cardPrice <= 300;
          if ( budgetVal === '300-500' )  showBudget = cardPrice >  300  && cardPrice <= 500;
          if ( budgetVal === '500-1000' ) showBudget = cardPrice >  500  && cardPrice <= 1000;
          if ( budgetVal === '1000+' )    showBudget = cardPrice >  1000;

          const visible = showType && showLocation && showBudget;
          card.style.display = visible ? '' : 'none';
          if ( visible ) visibleCount++;
        });

        const noResults = document.getElementById('pl-no-results');
        if ( noResults ) noResults.style.display = visibleCount === 0 ? 'block' : 'none';
      }

      /* ── On page load: read URL params and pre-select dropdowns from homepage search ── */
      document.addEventListener('DOMContentLoaded', function () {
        const params = new URLSearchParams(window.location.search);

        const locationParam = params.get('filter-location');
        const typeParam     = params.get('filter-type');
        const budgetParam   = params.get('filter-budget');

        // Pre-select each dropdown if a matching param exists
        if ( locationParam ) {
          const sel = document.getElementById('filter-location');
          // Try exact match first, then partial
          for ( let opt of sel.options ) {
            if ( opt.value.toLowerCase() === locationParam.toLowerCase() ) {
              sel.value = opt.value;
              break;
            }
          }
        }

        if ( typeParam ) {
          const sel = document.getElementById('filter-type');
          for ( let opt of sel.options ) {
            if ( opt.value.toLowerCase() === typeParam.toLowerCase() ) {
              sel.value = opt.value;
              break;
            }
          }
        }

        if ( budgetParam ) {
          document.getElementById('filter-budget').value = budgetParam;
        }

        // Auto-run filter if any param was present
        if ( locationParam || typeParam || budgetParam ) {
          filterProperties();
        }
      });
    </script>

<?php get_footer(); ?>
