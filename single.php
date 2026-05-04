<?php
/*
 * Template Name: Blog Details
 */
get_header(); ?>

      <!-- Hero Banner -->
      <div class="bd-hero"></div>

      <!-- Content Wrapper -->
      <div class="bd-content-wrapper">

        <article class="bd-article">

          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

          <!-- Post Title -->
          <h1 class="bd-title"><?php the_title(); ?></h1>

          <!-- Meta -->
          <div class="bd-meta">
            <div class="bd-meta__item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              <span>Post Date:</span> <strong><?php echo get_the_date( 'd F, Y' ); ?></strong>
            </div>
            <div class="bd-meta__item">
              <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18">
                <path d="M20 7H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM4 5h16V4H4v1z"/>
              </svg>
              <span>Category:</span>
              <strong>
                <?php
                $cats = get_the_category();
                echo ! empty( $cats ) ? esc_html( $cats[0]->name ) : 'General';
                ?>
              </strong>
            </div>
          </div>

          <!-- Post Content -->
          <div class="bd-text">
            <?php the_content(); ?>
          </div>

          <?php endwhile; endif; ?>

        </article>

        <!-- Previous / Next post navigation -->
        <nav class="bd-post-nav" aria-label="Post navigation">

          <?php
          $prev_post = get_previous_post();
          $next_post = get_next_post();
          ?>

          <?php if ( $prev_post ) : ?>
          <a class="bd-nav-item" href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>">
            <span class="bd-nav-item__label">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">
                <polyline points="15 18 9 12 15 6"/>
              </svg>
              Previous Post
            </span>
            <span class="bd-nav-item__title"><?php echo esc_html( get_the_title( $prev_post ) ); ?></span>
          </a>
          <?php else : ?>
          <span></span>
          <?php endif; ?>

          <?php if ( $next_post ) : ?>
          <a class="bd-nav-item bd-nav-item--next" href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
            <span class="bd-nav-item__label">
              Next Post
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">
                <polyline points="9 18 15 12 9 6"/>
              </svg>
            </span>
            <span class="bd-nav-item__title"><?php echo esc_html( get_the_title( $next_post ) ); ?></span>
          </a>
          <?php endif; ?>

        </nav>

      </div><!-- end bd-content-wrapper -->

<?php get_footer(); ?>
