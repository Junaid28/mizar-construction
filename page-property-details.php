<?php
/*
 * Template Name: Property Details
 */

get_header(); ?>
<!-- Hero Banner -->
        <div class="pd-hero">
            <h1>Property Details</h1>
        </div>

        <!-- Content Wrapper -->
        <div class="pd-content-wrapper">

            <!-- Breadcrumb -->
            <div class="pd-breadcrumb">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                    <circle cx="12" cy="10" r="3" />
                </svg>
                <span>New York, New Jersey</span>
            </div>

            <!-- Listing Header -->
            <div class="pd-listing-header">
                <h1 class="pd-listing-title">Townhouse for Rent</h1>
                <p class="pd-listing-price">$45,000</p>
            </div>

            <!-- Stats Bar -->
            <div class="pd-stats">
                <span class="pd-stat">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo/double-bed.png" alt="Bedrooms" />
                    4 Bedrooms
                </span>
                <span class="pd-stat">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo/bathtub.png" alt="Bathrooms" />
                    4 Bathrooms
                </span>
                <span class="pd-stat">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" />
                        <path d="M3 9h18M9 3v18" />
                    </svg>
                    2 Garages
                </span>
                <span class="pd-stat">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo/select.png" alt="Area" />
                    1500 Sqft.
                </span>
            </div>

            <!-- Two-Column: About + Request Form -->
            <div class="pd-two-col">

                <!-- About This Listing -->
                <div class="pd-about">
                    <h2>About This Listing</h2>
                    <p>Beautiful office in emerging rent in New Jersey.</p>
                    <p>
                        This stunning three bedroom apartments have been completely
                        refurbished, and include large living rooms, brand new floors, and
                        enormous windows that flood the apartments with natural light and
                        clean air. The kitchens have plenty of integrated counter
                        and cupboard space, stainless steel appliances, icebreakers,
                        dishwashers, garbage disposal, and are completely tiled, with a deck (a.k.a
                        balcony).
                    </p>
                    <p>
                        The baths are oversized. The apartment has on-site laundry and
                        plenty of closet space. For all amenities in the house, allow
                        tenants access.
                    </p>
                    <p>
                        Please get in touch if you have any more inquiries. Additionally,
                        videos are available upon request.
                    </p>
                    <p style="font-weight:700; margin-top:16px;">*** NO BROKER FEE ***</p>
                    <ul>
                        <li>3 Bedroom and 3 Baths with pole</li>
                        <li>24 Hours security</li>
                        <li>Abundant sunshine</li>
                        <li>Stylish appliances</li>
                        <li>Near a transit hub</li>
                    </ul>
                </div>

                <!-- Request Information -->
                <div class="pd-request-card">
                    <h3>Request Information</h3>
                    <form id="request-form" onsubmit="return false;">
                        <div class="pd-form-group">
                            <input type="text" placeholder="Name" id="req-name" />
                        </div>
                        <div class="pd-form-group">
                            <input type="email" placeholder="Email" id="req-email" />
                        </div>
                        <div class="pd-form-group">
                            <input type="tel" placeholder="Phone no." id="req-phone" />
                        </div>
                        <div class="pd-form-group">
                            <textarea placeholder="Message" id="req-message"></textarea>
                        </div>
                        <button type="submit" class="pd-form-submit">SUBMIT</button>
                    </form>
                </div>

            </div>

            <!-- Features & Amenities -->
            <section class="pd-amenities">
                <h2>Features &amp; Amenities</h2>
                <div class="pd-amenities-grid">
                    <span class="pd-amenity"><svg class="pd-amenity-icon" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="12" fill="#e8292a" />
                            <path d="M7 12.5l3 3 7-7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>TV Cable</span>
                    <span class="pd-amenity"><svg class="pd-amenity-icon" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="12" fill="#e8292a" />
                            <path d="M7 12.5l3 3 7-7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>Barbeque</span>
                    <span class="pd-amenity"><svg class="pd-amenity-icon" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="12" fill="#e8292a" />
                            <path d="M7 12.5l3 3 7-7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>Gym</span>
                    <span class="pd-amenity"><svg class="pd-amenity-icon" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="12" fill="#e8292a" />
                            <path d="M7 12.5l3 3 7-7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>Microwave</span>
                    <span class="pd-amenity"><svg class="pd-amenity-icon" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="12" fill="#e8292a" />
                            <path d="M7 12.5l3 3 7-7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>Air Conditioning</span>
                    <span class="pd-amenity"><svg class="pd-amenity-icon" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="12" fill="#e8292a" />
                            <path d="M7 12.5l3 3 7-7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>Outdoor Shower</span>
                    <span class="pd-amenity"><svg class="pd-amenity-icon" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="12" fill="#e8292a" />
                            <path d="M7 12.5l3 3 7-7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>Lawn</span>
                    <span class="pd-amenity"><svg class="pd-amenity-icon" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="12" fill="#e8292a" />
                            <path d="M7 12.5l3 3 7-7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>Refrigerator</span>
                    <span class="pd-amenity"><svg class="pd-amenity-icon" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="12" fill="#e8292a" />
                            <path d="M7 12.5l3 3 7-7" stroke="#fff" stroke-width="2.2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>Washer</span>
                </div>
            </section>

            <!-- Photo Gallery -->
            <section class="pd-gallery">
                <h2>Photo</h2>
                <div class="pd-gallery-grid">
                    <div class="pd-gallery-item pd-gallery-item--large">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/property-images/Interior-property.jpg" alt="Interior view of the property" />
                    </div>
                    <div class="pd-gallery-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/property-images/luxury-home.jpg" alt="Luxury home interior" />
                    </div>
                    <div class="pd-gallery-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/property-images/modern-property.jpg" alt="Modern property kitchen" />
                    </div>
                </div>
            </section>

            <!-- Video -->
            <section class="pd-video">
                <h2>Video</h2>
                <div class="pd-video-wrapper">
                    <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ?controls=0&modestbranding=1&rel=0"
                        title="Property video tour"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
            </section>

            <!-- Map -->
            <section class="pd-map">
                <h2>Map</h2>
                <div class="pd-map-wrapper">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30596552044!2d-74.25986548248684!3d40.69714941932609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1700000000000!5m2!1sen!2sbd"
                        title="Property location map" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </section>

        </div><!-- end pd-content-wrapper -->

<?php get_footer(); ?>
