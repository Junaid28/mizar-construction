<?php
/*
 * Template Name: Contact
 */

get_header(); ?>
<!-- Hero Banner -->
      <div class="ct-hero">
        <h1>Contacts</h1>
      </div>

      <!-- Content Wrapper -->
      <div class="ct-content-wrapper">

        <!-- Two-column layout -->
        <div class="ct-layout">

          <!-- LEFT: Contact Info -->
          <div class="ct-info">
            <h2 class="ct-info__headline">Our global real estate experts are here to help you in this ever-changing market.</h2>
            <p class="ct-info__sub">Pacific hake false trevally queen parrotfish black prickleback mosshead warbonnet sweeper! Greenling sleeper.</p>

            <div class="ct-detail">
              <span class="ct-detail__label">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                  <polyline points="22,6 12,13 2,6"/>
                </svg>
                Support email
              </span>
              <p class="ct-detail__value">support@example.com</p>
            </div>

            <div class="ct-detail">
              <span class="ct-detail__label">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.61 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                Phone number
              </span>
              <p class="ct-detail__value">+(084) 123 – 456 88</p>
            </div>

            <div class="ct-detail">
              <span class="ct-detail__label">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                  <circle cx="12" cy="10" r="3"/>
                </svg>
                Location
              </span>
              <p class="ct-detail__value">401 Broadway, 24th Floor, Orchard View, London</p>
            </div>
          </div>

          <!-- RIGHT: Contact Form -->
          <div class="ct-form-col">
            <h2 class="ct-form__title">Get in touch</h2>

            <?php
            // Show success / error message after redirect
            $ct_status = isset($_GET['ct_status']) ? $_GET['ct_status'] : '';
            if ( $ct_status === 'success' ) : ?>
              <div class="ct-alert ct-alert--success">
                ✅ Thank you! Your message has been sent. We'll get back to you soon.
              </div>
            <?php elseif ( $ct_status === 'error' ) : ?>
              <div class="ct-alert ct-alert--error">
                ❌ Something went wrong. Please try again or email us directly.
              </div>
            <?php endif; ?>

            <form class="ct-form"
                  method="POST"
                  action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">

              <input type="hidden" name="action" value="contact_form_submit" />
              <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>

              <div class="ct-field">
                <input type="text"
                       name="ct_name"
                       placeholder="Name"
                       required
                       value="<?php echo isset($_GET['ct_name']) ? esc_attr($_GET['ct_name']) : ''; ?>" />
              </div>
              <div class="ct-field">
                <input type="email"
                       name="ct_email"
                       placeholder="Email"
                       required
                       value="<?php echo isset($_GET['ct_email']) ? esc_attr($_GET['ct_email']) : ''; ?>" />
              </div>
              <div class="ct-field">
                <input type="text"
                       name="ct_subject"
                       placeholder="Subject"
                       value="<?php echo isset($_GET['ct_subject']) ? esc_attr($_GET['ct_subject']) : ''; ?>" />
              </div>
              <div class="ct-field">
                <textarea name="ct_message" placeholder="Message" required></textarea>
              </div>
              <button class="ct-submit" type="submit">Submit</button>
            </form>
          </div>

        </div>

        <!-- Google Map -->
        <div class="ct-map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3597.662794605351!2d85.04751647539554!3d25.61611907744368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ed57303fcd3673%3A0x95049770eebc9056!2sNasa%20Interior%20%26%20Contraction%20in%20Patna!5e0!3m2!1sen!2sin!4v1776940242529!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

      </div><!-- end ct-content-wrapper -->

<style>
  .ct-alert {
    padding: 14px 18px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 500;
  }
  .ct-alert--success {
    background: #f0fdf4;
    border: 1px solid #86efac;
    color: #166534;
  }
  .ct-alert--error {
    background: #fef2f2;
    border: 1px solid #fca5a5;
    color: #991b1b;
  }
</style>

<?php get_footer(); ?>
