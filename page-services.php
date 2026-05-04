<?php
/*
 * Template Name: Services
 */

get_header(); ?>
<!-- Hero Banner -->
      <div class="services-hero">
        <h1>Our services</h1>
      </div>

      <!-- Content Wrapper -->
      <div class="services-content-wrapper">

        <!-- Intro -->
        <section class="sv-intro-section">
          <span class="sv-intro-badge">What We Offer</span>
          <h2 class="sv-intro-title">Take a brief look at some of the services we offer</h2>
        </section>

        <!-- Services Grid -->
        <div class="sv-grid">

          <!-- Card 1 -->
          <div class="sv-card">
            <div class="sv-card__img-wrap">
              <img src="<?php echo get_template_directory_uri(); ?>/images/services/serv-1.jpg" alt="Real Estate Development" />
            <a href="<?php echo home_url('/real-estate-development'); ?>">
              <div class="sv-card__arrow-wrap">
              <span class="sv-card__arrow">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/>
                </svg>
              </span>
            </div>
            </a>
            </div>
            <div class="sv-card__body">
              <a href="<?php echo home_url('/real-estate-development'); ?>"><h3 class="sv-card__title">Real Estate Development</h3></a>
              <div class="sv-card__divider"></div>
              <p class="sv-card__desc">We engage as early as possible, typically during the conceptual or schematic stage.</p>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="sv-card">
            <div class="sv-card__img-wrap">
              <img src="<?php echo get_template_directory_uri(); ?>/images/services/serv-2.jpg" alt="Project Management" />
              <a href="<?php echo home_url('/project-management'); ?>">
                <div class="sv-card__arrow-wrap">
                  <span class="sv-card__arrow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/>
                    </svg>
                  </span>
                </div>
              </a>
            </div>
            <div class="sv-card__body">
              <a href="<?php echo home_url('/project-management'); ?>"><h3 class="sv-card__title">Project Management</h3></a>
              <div class="sv-card__divider"></div>
              <p class="sv-card__desc">Our comprehensive estimates also reflect available lower-price options.</p>
            </div>
          </div>

          <!-- Card 3 -->
          <div class="sv-card">
            <div class="sv-card__img-wrap">
              <img src="<?php echo get_template_directory_uri(); ?>/images/services/serv-3.jpg" alt="Investment and Capital" />
            <a href="<?php echo home_url('/investment-capital'); ?>">
              <div class="sv-card__arrow-wrap">
                  <span class="sv-card__arrow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/>
                    </svg>
                  </span>
              </div>
            </a>
            </div>
            <div class="sv-card__body">
              <a href="<?php echo home_url('/investment-capital'); ?>"><h3 class="sv-card__title">Investment and Capital</h3></a>
              <div class="sv-card__divider"></div>
              <p class="sv-card__desc">We are focused on improving the way capital projects get done.</p>
            </div>
          </div>

          <!-- Card 4 -->
          <div class="sv-card">
            <div class="sv-card__img-wrap">
              <img src="<?php echo get_template_directory_uri(); ?>/images/services/serv-4.jpg" alt="Construction Management" />
            <a href="<?php echo home_url('/service-details'); ?>">
              <div class="sv-card__arrow-wrap">
              <span class="sv-card__arrow">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/>
                </svg>
              </span>
            </div>
            </a>
            </div>
            <div class="sv-card__body">
              <a href="<?php echo home_url('/service-details'); ?>"><h3 class="sv-card__title">Construction Management</h3></a>
              <div class="sv-card__divider"></div>
              <p class="sv-card__desc">From design to operations, we love to solve complex challenges and exceed expectations.</p>
            </div>
          </div>

          <!-- Card 5 -->
          <div class="sv-card">
            <div class="sv-card__img-wrap">
              <img src="<?php echo get_template_directory_uri(); ?>/images/services/serv-5.jpg" alt="Architecture and Design" />
            
            <a href="<?php echo home_url('/service-details'); ?>">
              <div class="sv-card__arrow-wrap">
              <span class="sv-card__arrow">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/>
                </svg>
              </span>
            </div>
            </a>
            </div>
            <div class="sv-card__body">
              <a href="<?php echo home_url('/service-details'); ?>"><h3 class="sv-card__title">Architecture and Design</h3></a>
              <div class="sv-card__divider"></div>
              <p class="sv-card__desc">We believe good architecture is a crucial foundation that influences the overall performance.</p>
            </div>
          </div>

          <!-- Card 6 -->
          <div class="sv-card">
            <div class="sv-card__img-wrap">
              <img src="<?php echo get_template_directory_uri(); ?>/images/services/serv-6.jpg" alt="Sales and Marketing" />
            <a href="<?php echo home_url('/service-details'); ?>">
              <div class="sv-card__arrow-wrap">
              <span class="sv-card__arrow">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/>
                </svg>
              </span>
            </div>
            </a>
            </div>
            <div class="sv-card__body">
              <a href="<?php echo home_url('/service-details'); ?>"><h3 class="sv-card__title">Sales and Marketing</h3></a>
              <div class="sv-card__divider"></div>
              <p class="sv-card__desc">Building a real estate development is a complicated task requiring both deep understanding…</p>
            </div>
          </div>

        </div>
      </div><!-- end services-content-wrapper -->

<?php get_footer(); ?>
