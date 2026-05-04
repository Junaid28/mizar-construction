<?php
/*
 * Template Name: Service Details
 */

get_header(); ?>
<!-- Hero Banner -->
      <div class="sd-hero">
        <h1>Service Details</h1>
      </div>

      <!-- Content Wrapper -->
      <div class="sd-content-wrapper">
        <div class="sd-layout">

          <!-- ── LEFT COLUMN ── -->
          <div class="sd-left">

            <!-- Main image -->
            <img class="sd-main-img" src="<?php echo get_template_directory_uri(); ?>/images/services/service-banner.jpg" alt="Service Detail" />

            <!-- About the service -->
            <h2 class="sd-section-title">About the service</h2>
            <p class="sd-body-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudtium, totam rem aperiam, eaque ipsa quae ab illoentore veritatis et quasi architecto.</p>
            <p class="sd-body-text">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloreue laudantium, totam rem aperiam.</p>

            <!-- Why choose us -->
            <div class="sd-why-section">
              <h2 class="sd-section-title">Why choose us</h2>
              <p class="sd-body-text">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia conseuntur magni.</p>

              <div class="sd-features-grid">

                <div class="sd-feature">
                  <div class="sd-feature__top">
                    <div class="sd-feature__icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                    <h4 class="sd-feature__name">Expertise</h4>
                  </div>
                  <p class="sd-feature__desc">Our goal is zero incidents and our lost time frequency rate is industry leading.</p>
                </div>

                <div class="sd-feature">
                  <div class="sd-feature__top">
                    <div class="sd-feature__icon">
                      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3H14z"/><path d="M7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                    </div>
                    <h4 class="sd-feature__name">Collaboration</h4>
                  </div>
                  <p class="sd-feature__desc">Our multi-skilled team provides innovative, forward-thinking solutions.</p>
                </div>

                <div class="sd-feature">
                  <div class="sd-feature__top">
                    <div class="sd-feature__icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h4 class="sd-feature__name">Creativity</h4>
                  </div>
                  <p class="sd-feature__desc">We work with both investors and developers to create landmarks that make an impact.</p>
                </div>

                <div class="sd-feature">
                  <div class="sd-feature__top">
                    <div class="sd-feature__icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h4 class="sd-feature__name">Client-Centric Focus</h4>
                  </div>
                  <p class="sd-feature__desc">We maintain this by ensuring transparency and professional conduct in every aspect.</p>
                </div>

              </div>
            </div>

            <div class="sd-divider"></div>

            <!-- Services offered -->
            <div class="sd-offered-layout">
              <div>
                <h2 class="sd-offered-title">Services offered</h2>
                <ul class="sd-offered-list">
                  <li>
                    <span class="sd-check-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span><strong>Conceptual Design:</strong> We start by developing preliminary design concepts that explore various spatial arrangements, circulation patterns, and architectural styles. These initial concepts serve as the foundation.</span>
                  </li>
                  <li>
                    <span class="sd-check-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span><strong>Schematic Design:</strong> Building upon the approved concept, we develop schematic drawings that articulate the overall form, massing, and spatial organization of the project. These drawings provide a clear understand.</span>
                  </li>
                  <li>
                    <span class="sd-check-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span><strong>Design Development:</strong> During this phase, we delve into the details, refining the design and incorporating structural, mechanical, and electrical considerations. We produce detailed drawings.</span>
                  </li>
                </ul>
              </div>
              <img class="sd-offered-img" src="<?php echo get_template_directory_uri(); ?>/images/services/Rectangle 28.png" alt="Services offered" />
            </div>

          </div>

          <!-- ── RIGHT SIDEBAR ── -->
          <aside class="sd-sidebar">

            <!-- More Services -->
            <div class="sd-more-services">
              <p class="sd-more-services__heading">More Services</p>
              <ul class="sd-more-services__list">
                <li>
                  <a href="<?php echo home_url('/service-details'); ?>">Real Estate Development
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                  </a>
                </li>
                <li>
                  <a href="<?php echo home_url('/service-details'); ?>">Project Management
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                  </a>
                </li>
                <li>
                  <a href="<?php echo home_url('/service-details'); ?>">Investment &amp; Capital
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                  </a>
                </li>
                <li>
                  <a href="<?php echo home_url('/service-details'); ?>">Construction Management
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                  </a>
                </li>
                <li>
                  <a href="<?php echo home_url('/service-details'); ?>">Architecture &amp; Design
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                  </a>
                </li>
                <li>
                  <a href="<?php echo home_url('/service-details'); ?>">Sales &amp; Marketing
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                  </a>
                </li>
              </ul>
            </div>

            <!-- Contact CTA -->
            <div class="sd-contact-box">
              <img class="sd-contact-box__logo" src="<?php echo get_template_directory_uri(); ?>/images/logo/service-sidebar-icon.png" alt="Mizar" />
              <p class="sd-contact-box__label">Any Questions? Let's talk</p>
              <p class="sd-contact-box__phone">+(084) 123 – 456 88</p>
            </div>

          </aside>

        </div>
      </div><!-- end sd-content-wrapper -->

<?php get_footer(); ?>
