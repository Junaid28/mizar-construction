<?php
/**
 * home.php — WordPress uses this automatically for the Blog posts page
 * (the page set as Posts page in Settings > Reading)
 */
get_header(); ?>

      <!-- Hero Banner -->
      <div class="blog-hero">
        <h1>Blog Posts</h1>
      </div>

      <!-- Content Wrapper -->
      <div class="blog-content-wrapper">

        <!-- Top bar: title + filters -->
        <div class="blog-topbar">
          <h2 class="blog-topbar__title">Latest News</h2>
          <div class="blog-filters">
            <button class="blog-filter-btn active" onclick="filterPosts('all', this)">All Posts</button>
            <button class="blog-filter-btn" onclick="filterPosts('company', this)">Company</button>
            <button class="blog-filter-btn" onclick="filterPosts('social', this)">Social Media</button>
            <button class="blog-filter-btn" onclick="filterPosts('tips', this)">Tips &amp; Tricks</button>
          </div>
        </div>

        <!-- Blog Grid -->
        <div class="blog-grid" id="blogGrid">

          <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

              <?php
              $cats     = get_the_category();
              $cat_slug = ! empty( $cats ) ? sanitize_title( $cats[0]->slug ) : 'company';
              $cat_name = ! empty( $cats ) ? esc_html( $cats[0]->name ) : 'Company';
              $date     = get_the_date( 'M d, Y' );
              $link     = get_permalink();
              $title    = get_the_title();
              $img_url  = has_post_thumbnail()
                ? get_the_post_thumbnail_url( get_the_ID(), 'large' )
                : get_template_directory_uri() . '/images/blog/blog-placeholder.jpg';
              ?>

              <a class="blog-card" href="<?php echo esc_url( $link ); ?>" data-category="<?php echo esc_attr( $cat_slug ); ?>">
                <div class="blog-card__img-wrap">
                  <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
                  <div class="blog-card__arrow-wrap">
                    <span class="blog-card__arrow">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/>
                      </svg>
                    </span>
                  </div>
                </div>
                <div class="blog-card__body">
                  <div class="blog-card__meta">
                    <div class="blog-card__meta-row">
                      <svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14">
                        <path d="M20 7H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM4 5h16V4H4v1z"/>
                      </svg>
                      <?php echo $cat_name; ?>
                    </div>
                    <div class="blog-card__meta-row">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                      </svg>
                      <?php echo $date; ?>
                    </div>
                  </div>
                  <div class="blog-card__divider"></div>
                  <p class="blog-card__title"><?php echo esc_html( $title ); ?></p>
                </div>
              </a>

            <?php endwhile; ?>

          <?php else : ?>
            <p style="padding: 40px 20px; color: rgba(26,26,46,0.6);">No blog posts found. Start by adding posts in WordPress Admin → Posts → Add New.</p>
          <?php endif; ?>

        </div>
      </div>

      <script>
        function filterPosts(category, btn) {
          document.querySelectorAll('.blog-filter-btn').forEach(b => b.classList.remove('active'));
          btn.classList.add('active');
          document.querySelectorAll('.blog-card').forEach(card => {
            card.style.display = (category === 'all' || card.dataset.category === category)
              ? 'flex' : 'none';
          });
        }
      </script>

<?php get_footer(); ?>
