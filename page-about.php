<?php
/*
 * Template Name: About Us
 * Description: About Us page template
 */

get_header(); ?>

      <!-- Hero Banner -->
      <div class="about-hero">
        <h1>About us</h1>
      </div>

      <div class="about-content-wrapper">

        <!-- Intro: badge + two-column -->
        <section class="au-intro-section">
          <span class="au-intro-badge">About Us</span>
          <div class="au-intro-grid">
            <h2 class="au-intro-title">Shaping the world of things to come</h2>
            <div>
              <p class="au-intro-lead">We'd love to share more with you, please complete this form and our dedicated team will get back to you shortly.</p>
              <p class="au-intro-body">In markets from renewable energy, sports and entertainment, to data centers and healthcare, we work to ensure the built environment leaves a lasting positive impact. Together, we strive to make your project better than you imagined possible.</p>
            </div>
          </div>
        </section>

        <!-- Mission / Vision / Values / Resources -->
        <div class="au-values-section">
          <div class="au-value-item">
            <h3 class="au-value-heading">
              Our Mission
              <span class="au-value-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/Goal.png" alt="Mission icon" />
              </span>
            </h3>
            <p class="au-value-text">With over $2 Billion in sales, Our agency is the industry's top luxury producer with over 27 years of experience in marketing Seattle's most prestigious waterfront properties.</p>
          </div>
          <div class="au-value-item">
            <h3 class="au-value-heading">
              Our Vision
              <span class="au-value-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/Millenium Eye.png" alt="Vision icon" />
              </span>
            </h3>
            <p class="au-value-text">Due to our unparalleled results, expertise and dedication, we rank amongst the Top 6 agencies in Seattle and our area. She is also and is an elite member to Corcoran's Presidents Council.</p>
          </div>
          <div class="au-value-item">
            <h3 class="au-value-heading">
              Our Values
              <span class="au-value-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/Morale.png" alt="Values icon" />
              </span>
            </h3>
            <p class="au-value-text">With her years of experience, impressive property portfolio, celebrity clientele, and unparalleled knowledge of the market and pedigree estates, Simone estimable business is sophisticated and renowned.</p>
          </div>
          <div class="au-value-item">
            <h3 class="au-value-heading">
              Our Resources
              <span class="au-value-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/People.png" alt="Resources icon" />
              </span>
            </h3>
            <p class="au-value-text">With her years of experience, impressive property portfolio, celebrity clientele, and unparalleled knowledge of the market and pedigree estates, Simone estimable business is sophisticated and renowned.</p>
          </div>
        </div>

        <!-- Feature property image -->
        <div class="au-feature-image">
          <div class="au-feature-image__bg"></div>
          <img src="<?php echo get_template_directory_uri(); ?>/images/about/image 1.png" alt="Mizar Construction featured property" />
        </div>

        <!-- Stats Bar -->
        <div class="au-stats-section">
          <div class="au-stat">
            <div class="au-stat__top">
              <span class="au-stat__number">20 +</span>
              <span class="au-stat__icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/Total Sales.png" alt="Investment icon" />
              </span>
            </div>
            <span class="au-stat__label">Year Investment</span>
          </div>
          <div class="au-stat">
            <div class="au-stat__top">
              <span class="au-stat__number">210 +</span>
              <span class="au-stat__icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/Apartment.png" alt="Units icon" />
              </span>
            </div>
            <span class="au-stat__label">Unit Available</span>
          </div>
          <div class="au-stat">
            <div class="au-stat__top">
              <span class="au-stat__number">70 +</span>
              <span class="au-stat__icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/Good Quality.png" alt="Partners icon" />
              </span>
            </div>
            <span class="au-stat__label">Trusted Partner</span>
          </div>
          <div class="au-stat">
            <div class="au-stat__top">
              <span class="au-stat__number">40 +</span>
              <span class="au-stat__icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/Homeadvisor.png" alt="Projects icon" />
              </span>
            </div>
            <span class="au-stat__label">Projects in development</span>
          </div>
        </div>

        <!-- Team Section -->
        <section class="au-team-section">
          <span class="au-team-badge">Our Experts</span>
          <h2 class="au-team-title">Connect with Our Team</h2>
          <div class="au-team-grid">
            <div class="au-team-card">
              <img src="<?php echo get_template_directory_uri(); ?>/images/teams/Adora-Montminy.jpg" alt="Adora Montminy" />
              <div class="au-team-card__info">
                <p class="au-team-card__name">Adora Montminy</p>
                <p class="au-team-card__role">Sales Leader</p>
              </div>
            </div>
            <div class="au-team-card">
              <img src="<?php echo get_template_directory_uri(); ?>/images/teams/Carlos-Dobarro.jpg" alt="Carlos Dobarro" />
              <div class="au-team-card__info">
                <p class="au-team-card__name">Carlos Dobarro</p>
                <p class="au-team-card__role">Agent Manager</p>
              </div>
            </div>
            <div class="au-team-card">
              <img src="<?php echo get_template_directory_uri(); ?>/images/teams/Elena-Pernia.jpg" alt="Elena Pernía" />
              <div class="au-team-card__info">
                <p class="au-team-card__name">Elena Pernía</p>
                <p class="au-team-card__role">Agent Supervisor</p>
              </div>
            </div>
          </div>
        </section>

      </div><!-- end about-content-wrapper -->

<?php get_footer(); ?>
