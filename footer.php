  <footer class="footer">
    <div class="footer-inner">

      <div class="footer-brand">
        <a href="<?php echo home_url('/'); ?>" class="footer-logo">
          <img src="<?php echo get_template_directory_uri(); ?>/images/logo/mizar-logo.png"
               alt="<?php bloginfo('name'); ?>" />
        </a>
        <div class="footer-contact">
          <p class="footer-contact__heading">Contact Us</p>
          <p class="footer-contact__phone">Call : +123 400 123</p>
          <p class="footer-contact__desc">Praesent nulla massa, hendrerit vestibulum gravida in, feugiat auctor felis.</p>
          <p class="footer-contact__email">Email: example@mail.com</p>
        </div>
        <div class="footer-socials">

          <a href="#" class="footer-social" aria-label="Facebook">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
            </svg>
          </a>

          <a href="#" class="footer-social" aria-label="Dribbble">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/>
              <path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"/>
            </svg>
          </a>

          <a href="#" class="footer-social" aria-label="LinkedIn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
              <rect x="2" y="9" width="4" height="12"/>
              <circle cx="4" cy="4" r="2"/>
            </svg>
          </a>

          <a href="#" class="footer-social" aria-label="Instagram">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
              <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
              <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
            </svg>
          </a>

          <a href="#" class="footer-social" aria-label="Behance">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
              <path d="M22 7h-7V5h7v2zm1.726 10c-.442 1.297-2.029 3-5.101 3-3.074 0-5.564-1.729-5.564-5.675 0-3.91 2.325-5.92 5.466-5.92 3.082 0 4.964 1.782 5.375 4.426.078.506.109 1.188.095 2.14H15.97c.13 1.202.811 1.907 1.99 1.907.74 0 1.339-.376 1.627-1.004l2.14.126zM15.970 13h4.406c-.093-1.212-.78-1.896-2.108-1.896-1.261 0-2.048.695-2.298 1.896zM8.242 12.424c1.073-.573 1.68-1.54 1.68-2.814C9.922 7.257 8.22 6 5.564 6H0v12h5.897c2.84 0 4.75-1.319 4.75-3.853 0-1.312-.574-2.255-2.405-1.723zM2.857 8.257h2.45c1.123 0 1.8.517 1.8 1.457 0 .98-.677 1.498-1.8 1.498H2.857V8.257zm2.738 7.486H2.857v-2.952h2.738c1.296 0 2.01.561 2.01 1.47 0 .938-.714 1.482-2.01 1.482z"/>
            </svg>
          </a>

        </div>
      </div>

      <div class="footer-col">
        <p class="footer-col__heading">Features</p>
        <ul class="footer-links">
          <li><a href="#">Home</a></li>
          <li><a href="#">Become a Host</a></li>
          <li><a href="#">Pricing</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <p class="footer-col__heading">Company</p>
        <ul class="footer-links">
          <li><a href="#">About Us</a></li>
          <li><a href="#">Press</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="#">Careers</a></li>
          <li><a href="#">Blog</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <p class="footer-col__heading">Team and policies</p>
        <ul class="footer-links">
          <li><a href="#">Terms of services</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Security</a></li>
        </ul>
      </div>

    </div>
  </footer>

</div><!-- .page -->

<?php wp_footer(); ?>
</body>
</html>
